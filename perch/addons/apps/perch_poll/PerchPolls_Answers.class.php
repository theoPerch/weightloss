<?php

class PerchPolls_Answers extends PerchAPI_Factory
{
    protected $table               = 'poll_answer';
    protected $pk                  = 'answerID';
    protected $singular_classname  = 'PerchPoll_Answer';
    protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';
    protected $event_prefix        = 'poll.answer';
    protected $default_sort_column = ' answer';
    public $static_fields          = array('answer');





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
