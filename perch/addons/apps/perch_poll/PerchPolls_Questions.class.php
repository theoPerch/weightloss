<?php

class PerchPolls_Questions extends PerchAPI_Factory
{
    protected $table               = 'poll_question';
    protected $pk                  = 'questionID';
    protected $singular_classname  = 'PerchPoll_Question';
    protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';
    protected $event_prefix        = 'poll.question';
    protected $default_sort_column = ' question';
    public $static_fields          = array('question');





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
