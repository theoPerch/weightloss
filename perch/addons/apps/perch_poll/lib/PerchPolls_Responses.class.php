<?php

class PerchPolls_Responses extends PerchAPI_Factory
{
    protected $table               = 'poll_responses';
    protected $pk                  = 'poll_responseID';
    protected $singular_classname  = 'PerchPolls_Response';
    protected $index_table         = 'poll_index';
    protected $namespace           = 'poll';
    protected $event_prefix        = 'poll.response';
    protected $default_sort_column = 'response';
    public $static_fields          = array();




   public function find_by_poll($pollID)
    {
        $sql = 'SELECT *
                FROM '.$this->table.'
                WHERE pollID='.$this->db->pdb($pollID);
        $rows = $this->db->get_rows($sql);
          return $this->return_instances($rows);

    }

   public function get_responses_rating($pollID,$questionID)
    {


        $sql = 'SELECT a.answer,q.question,count(*) * 100.0 / sum(count(*)) Over() as "AnswerPercentage"
                FROM '.$this->table.' r

                INNER JOIN '.PERCH_DB_PREFIX.'poll_answer a ON r.answer_id=a.answerID
                 INNER JOIN '.PERCH_DB_PREFIX.'poll_question q ON   a.questionID=q.questionID
                WHERE    r.pollID='.$this->db->pdb($pollID).' and a.questionID='.$this->db->pdb($questionID).' GROUP BY r.answer_id ';


        $rows = $this->db->get_rows($sql);
          return $this->return_instances($rows);

    }

    public function receive_response($SubmittedForm)
    {

         $input = $SubmittedForm->data;


         if ($input['pollID']) {

         $Polls = new PerchPolls_Polls;
         			$Poll = $Polls->find((int)$input['pollID']);
         			if (is_object($Poll)) {

         				$data = array();
         				$data['pollID'] = $Poll->id();
         				$data['question_id'] = (int)$input['questionID'];
                        $data['answer_id'] = (int)$input['answer'];
                        $data['member_id'] ='0';


         			    $r = $this->create($data);
         				}




        }

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
