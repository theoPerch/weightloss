<?php

class PerchPolls_Polls extends PerchAPI_Factory
{
	protected $table               = 'polls';
    protected $pk                  = 'pollID';
    protected $singular_classname  = 'PerchPolls_Poll';

	#protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';

    protected $event_prefix        = 'poll.poll';

    protected $default_sort_column = 'pollTitle';


    public $static_fields   = array('pollTitle');



	public function create($data)
	{


		$data_Poll = array();
		$data_Poll['pollTitle'] = $data['pollTitle'];
		$data_Poll['pollStatus'] = $data['pollStatus'];
		$Poll = parent::create($data_Poll);

		 if (PerchUtil::count($data['questions'])) {

          foreach($data['questions'] as $question) {
			$data_question = array();
        	$data_question['pollID'] = $Poll->pollID();
        	$data_question['questionID'] = $question;
        	$this->db->insert(PERCH_DB_PREFIX.'poll_questions_for_poll', $data_question);
        	}

		}



		return $Poll;

	}

	    public function find_by_status($id)
        {
            $sql    = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->pk . '='. $this->db->pdb($id) .' AND pollStatus="Published" LIMIT 1';
            $result = $this->db->get_row($sql);

            if (is_array($result)) {
                return $this->return_instance($result);
            }

            return false;
        }
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
