<?php

class PerchPolls_Poll extends PerchAPI_Base
{
    protected $table        = 'polls';
    protected $pk           = 'pollID';

    protected $index_table  = 'poll_index';
    protected $event_prefix = 'poll.poll';

        public function empty_questions()
    	{
              $sql = 'DELETE FROM '.$this->table.' WHERE  questionID='.$this->db->pdb($this->pollID());

             $this->db->execute($sql);
    	}


   public function update($data)
        {

          $data_Poll = array();
           $data_Poll['pollTitle'] = $data['pollTitle'];
           $data_Poll['pollStatus'] = $data['pollStatus'];
           $r = parent::update($data_Poll);


		 if (PerchUtil::count($data['questions'])) {
             $this->empty_questions();
          foreach($data['questions'] as $question) {
			$data_question = array();
        	$data_question['pollID'] = $this->pollID();
        	$data_question['questionID'] = $question;
        	$this->db->insert(PERCH_DB_PREFIX.'poll_questions_for_poll', $data_question);
        	}

		}



        	return $r;
        }

   public function find_questions()
    {
        $sql = 'SELECT * FROM '.PERCH_DB_PREFIX.'poll_questions_for_poll
                WHERE pollID='.$this->db->pdb($this->pollID());

        $rows = $this->db->get_rows($sql);
        $results=[];

        if (PerchUtil::count($rows)) {
                               //  $Poll->empty_answers($this->questionID());
           foreach($rows as $question) {
              array_push($results,$question['questionID']);

            }
         }

          return $results;

    }

    public function find_questions_and_answers()
     {
         $sql = 'SELECT * FROM '.PERCH_DB_PREFIX.'poll_questions_for_poll q,'.PERCH_DB_PREFIX.'poll_question qu,'.PERCH_DB_PREFIX.'poll_answer a
                 WHERE q.questionID=qu.questionID AND q.questionID=a.questionID AND q.pollID='.$this->db->pdb($this->pollID());

         $rows = $this->db->get_rows($sql);
         $results=[];

         if (PerchUtil::count($rows)) {
                                //  $Poll->empty_answers($this->questionID());
            foreach($rows as $question) {
            //print_r($question);
            $results[$question["questionID"]]=[];
            $answers=[];
            $answers[$question["answerID"]]=$question["answer"];
             $results[$question["questionID"]]["question"]= $question["question"];
           $results[$question["questionID"]]["answers"]= $answers;

              // array_push($results,$question);

             }
          }

           return $results; //$this->return_instances($rows);

     }

    public function get_field($field, $use_template=true)
    {
        $data = $this->to_array(array($field));

        if (isset($data[$field])) {

            if ($use_template) {
                $Template = $this->api->get('Template');
                $Template->set('poll/list_poll.html', 'poll');
                $Tag = $Template->find_tag($field);
                if ($Tag) {
                    if ($Tag->is_set('suppress')) {
                        $Tag->set('suppress', false);
                    }
                    $Template->set_from_string(PerchXMLTag::create('perch:poll', 'template', $Tag->get_attributes()), 'poll');
                    return $Template->render($data);
                }
            }
            return $data[$field];
        }
        return false;
    }

    public function get_questions()
    {
        $qs = $this->find_questions();
       // print_r($qs);
        //$this->get_field('questions', false);
        if (PerchUtil::count($qs)) {
            $Questions = new PerchPolls_Questions();
            $out = array();
            foreach($qs as $questionID) {
                $out[] = $Questions->find((int)$questionID);
            }
            return $out;
        }
        return false;
    }

}
