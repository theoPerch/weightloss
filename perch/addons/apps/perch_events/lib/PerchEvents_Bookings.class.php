<?php

class PerchEvents_Bookings extends PerchEvents_Factory
{
    protected $table     = 'events_bookings';
	protected $pk        = 'bookingID';
	protected $singular_classname = 'PerchEvents_Booking';

	protected $default_sort_column = 'bookingDate';

    //public $static_fields   = array('bookingID', 'dayID', 'slotID', 'eventID', 'bookingDate', 'time', 'status');

    public $static_fields   =array('date','time','status');

    /**
     * Find a category by its categorySlug
     *
     * @param string $id
     * @return void
     * @author Theodora
     */
    public function find_by_id($id)
    {
        $sql    = 'SELECT *
                    FROM ' . $this->table . '
                    WHERE bookingID='. $this->db->pdb($id) .'
                    LIMIT 1';

        $result = $this->db->get_row($sql);

        if (is_array($result)) {
            return new $this->singular_classname($result);
        }

        return false;
    }

   public function all($Paging = false){
       $sql = 'SELECT b.*,e.eventTitle
   	            FROM '.$this->table.' b, '.PERCH_DB_PREFIX.'events e
   	            WHERE b.eventID=e.eventID'  ;
   	    $rows   = $this->db->get_rows($sql);

   	    return $this->return_instances($rows);

   }

	public function get_for_event($eventID)
	{
	    $sql = 'SELECT b.*
	            FROM '.$this->table.' b, '.PERCH_DB_PREFIX.'events e
	            WHERE b.eventID=e.eventID
	                AND e.eventID='.$this->db->pdb($eventID);
	    $rows   = $this->db->get_rows($sql);

	    return $this->return_instances($rows);
	}

public function get_order_for_booking($bookingID)
	{
	    $sql = 'SELECT b.*,o.orderid,p.title,i.itemTotal
	            FROM  '.$this->table.' b,'.PERCH_DB_PREFIX.'events_bookings_orders o,   '.PERCH_DB_PREFIX.'shop_order_items i,
	            '.PERCH_DB_PREFIX.'shop_products p
	            WHERE b.bookingID=o.bookingid AND o.orderid=i.orderID AND i.productID=p.productID AND o.bookingid='.$this->db->pdb($bookingID);

        $row = $this->db->get_row($sql);

		if (PerchUtil::count($row)) {
			return $this->return_instance($row);
		}

	}




	public function get_5daysbefore_bookings()
	{
	       $sql = 'SELECT b.*,e.eventTitle
          	            FROM '.$this->table.' b, '.PERCH_DB_PREFIX.'events e
          	            WHERE b.eventID=e.eventID AND b.date = CURDATE() + INTERVAL 4 DAY;'  ;
	    $rows   = $this->db->get_rows($sql);

	    return $this->return_instances($rows);


	}

}


?>
