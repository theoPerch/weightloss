<?php

class PerchPoll_Polls extends PerchAPI_Factory
{
	protected $table               = 'polls';
    protected $pk                  = 'pollID';
    protected $singular_classname  = 'PerchPoll_Polls';

	#protected $index_table         = 'blog_index';
    protected $namespace           = 'poll';

    protected $event_prefix        = 'poll.poll';

    protected $default_sort_column = 'pollTitle';


    public $static_fields   = array('pollTitle');


    public function find($id)
    {
    	if (PERCH_RUNWAY) return parent::find((int)$id);
    	return parent::find(1);
    }

    public function get_custom($opts)
    {
        $opts['template'] = 'poll/'.$opts['template'];
        return $this->get_filtered_listing($opts);
    }
}
