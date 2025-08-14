<?php

class PerchPolls_Answers extends PerchAPI_Factory
{
    protected $table               = 'poll_answer';
    protected $pk                  = 'answerID';
    protected $singular_classname  = 'PerchPolls_Answer';
    protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';
    protected $event_prefix        = 'poll.answer';
    protected $default_sort_column = ' answer';
    public $static_fields          = array('answer');


    public function empty_answers($questionID)
	{
          $sql = 'DELETE FROM '.$this->table.' WHERE  questionID='.$this->db->pdb($questionID);

         $this->db->execute($sql);
	}

   public function find_by_question($questionID)
    {
        $sql = 'SELECT *
                FROM '.$this->table.'
                WHERE questionID='.$this->db->pdb($questionID);
        $rows = $this->db->get_rows($sql);
          return $this->return_instances($rows);

    }

    /*public function get_custom($opts)
    {
        $opts['template'] = 'blog/'.$opts['template'];

        $where_callback = function(PerchQuery $Query) use ($opts) {
            if (!isset($opts['include-empty']) || $opts['include-empty']==false) {
                 $Query->where[] = 'authorPostCount>0';               
            }
            return $Query;
        };

        return $this->get_filtered_listing($opts, $where_callback);
    }*/





}
