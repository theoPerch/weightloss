<?php

class PerchPolls_Questions extends PerchAPI_Factory
{
    protected $table               = 'poll_question';
    protected $pk                  = 'questionID';
    protected $singular_classname  = 'PerchPolls_Question';
    protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';
    protected $event_prefix        = 'poll.question';
    protected $default_sort_column = ' question';
    public $static_fields          = array('question');



	public function create($data)
	{


		$data_question = array();
		$data_question['question'] = $data['question'];

		$Question = parent::create($data_question);
       $Answers = new PerchPolls_Answers();

        if (PerchUtil::count($data['answer'])) {

                  foreach($data['answer'] as $answer) {
                  if($answer!=""){

            			$data_answer = array();
                    	$data_answer['answer'] = $answer;
                    	$data_answer['questionID'] =$Question->questionID();

                        $Answer = $Answers->create($data_answer);
                        }

                    }

            }



		return $Question;

	}

    public function get_custom($opts)
    {
        $opts['template'] = 'poll/'.$opts['template'];

        $where_callback = function(PerchQuery $Query) use ($opts) {
            if (!isset($opts['include-empty']) || $opts['include-empty']==false) {
                 $Query->where[] = 'pollStatus=="Published"';
            }
            return $Query;
        };

        return $this->get_filtered_listing($opts, $where_callback);
    }




}
