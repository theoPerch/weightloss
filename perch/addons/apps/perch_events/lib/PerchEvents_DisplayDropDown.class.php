
<?php

class PerchEvents_DisplayDropDown {
    
    private $api;

    private $year;
    private $month;    
    private $month_name_full;
    private $month_name_short;
    private $start_day;
    private $end_day;  
	private $start_time;
	private $end_time;
	private $start_offset;
    
    private $day_name_format;
    private $day_name_limit;
    
    private $notinmonth_class   = 'notinmonth';
    private $weekend_class      = 'weekend';
    private $today_class        = 'today';
    private $past_class         = 'past';
    
    private $calendar_template  = 'events/dropdown/dropdown.html';
    private $blank_day_template = 'events/dropdown/blank-day.html';
    private $event_day_template = 'events/dropdown/event-day.html';
    private $timeslot_template = 'events/dropdown/timeslot.html';
    private $EventTemplate;
    private $EventSlotTemplate;
    private $BlankTemplate;
    private $diary       = array();
    private $slots       = array();
    private $HTML;

    

    public function __construct($api, $yr=false, $mo=false)
    {
        $this->api         = $api;
        $this->HTML        = $api->get('HTML');
        
        if ($yr===false) $yr = date('Y');
        if ($mo===false) $mo = date('m');
        
        $this->year        = $yr;
        $this->month       = (int) $mo;
        $this->diary       = array();
     
        $this->start_time   = strtotime("$yr-$mo-01 00:00");
    
        $this->end_day      = date('t', $this->start_time); 
    
        $this->end_time     = strtotime("$yr-$mo-".$this->end_day." 23:59");
     
        $this->start_day    = date('D', $this->start_time);
        $this->start_offset = date('w', $this->start_time) - 1;

    
        if ($this->start_offset < 0) {        
            $this->start_offset = 6;
        }
    

        $this->month_name_full = date('F', $this->start_time);
        $this->month_name_short= date('M', $this->start_time);

        $this->day_name_format = 'l';
        $this->day_name_limit = 0;
    
    }

    public function set_diary($aDiary) 
    {
    	if(is_array($aDiary)) {
    		$this->diary = $aDiary;
    	}
    }


     public function set_slots($aSlots)
      {
      	if(is_array($aSlots)) {
      		$this->slots = $aSlots;
      	}
      }


   /**
    * Displays all day cells for the month
    *
    * @return string
    * @private
    */
    public function display_slots($dow,$eventID,$matcheslots)
    {


        $str ='';
        $matcheslottimes=array();
        $Booking = new PerchEvents_Booking($this->api);
             if(!empty($matcheslots[$eventID])){



                $slot=$matcheslots[$eventID][$dow];

               if(isset($matcheslots[$eventID][$dow])){

               $open_time = strtotime($slot["startDate"]);
               $close_time = strtotime($slot["endDate"]);
               $now = time();

               for( $i=$open_time; $i<$close_time; $i = $i + $slot["slot_duration"]*60) {
                     if( $i < $now) continue;

                     $slot['eventID']=$eventID;
                    $slot['time']=date("H:i",$i);
                    $slot['booking_status']= $Booking->get_booking_status($eventID,$slot["slotID"], $slot['time'], $slot['dayID']);


                    $matcheslottimes[]=$slot;





               }


                }
           }


          //}

          return   $matcheslottimes ;


    }
    public function display($templates=false)
    {
        $Template = $this->api->get('Template');
        
        if (is_array($templates)) {
            if (isset($templates['dropdown'])) $this->calendar_template = $templates['dropdown'];

        }

        $Template->set($this->calendar_template, 'events');


        
        $data = array();
        //$data['header'] = $this->display_day_names();
        $day_items  = $this->get_day_items();
      $data['days']   = $day_items;//implode(",", $day_items);

print_r( $data['days']  );

         $data['events']   = [];
          $data['year']   =  $this->year;
        
    /*    $data['next_month'] = $this->next_month();
        $data['prev_month'] = $this->previous_month();
        $data['selected_month'] = $this->year.'-'.$this->month.'-01';
        $data['current_month'] = date('Y-m-01');*/
        
        $s = $Template->render_group( $data['days']);
        
        return $s;
    }
    
    private function get_day_items()
    {

              $output = false;

              $matches = array();
              $matcheslots = array();

              foreach($this->diary as $Event) {

              $startTime = strtotime( $Event->date() );
              $endTime = strtotime( $Event->enddate());
              $event_days=array();
              // Loop between timestamps, 24 hours at a time
              for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
                $eventDate = date( 'Y-m-d', $i );

              $event_days["day"]= $eventDate;
              }



              }
              return $event_days;
    }


   
 
    private function next_month()
    {
        return date('Y-m-d', strtotime($this->year.'-'.$this->month.'-01 +1 MONTH'));
    }
    
    private function previous_month()
    {
        return date('Y-m-d', strtotime($this->year.'-'.$this->month.'-01 -1 MONTH'));
    }
    
}
