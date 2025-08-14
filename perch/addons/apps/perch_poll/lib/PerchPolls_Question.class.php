<?php

class PerchPolls_Question extends PerchAPI_Base
{
    protected $table        = 'poll_question';
    protected $pk           = 'questionID';
    protected $index_table  = 'poll_index';
    protected $namespace    = 'poll';
    protected $event_prefix = 'poll.question';

        public function update($data)
        {
        $data_question = array();
        		$data_question = array();
        		$data_question['question'] = $data['question'];
        	        $r = parent::update($data_question);
                    $Answers = new PerchPolls_Answers();

                if (PerchUtil::count($data['answer'])) {
                 $Answers->empty_answers($this->questionID());
                  foreach($data['answer'] as $answer) {
                  if($answer!=""){

            			$data_answer = array();
                    	$data_answer['answer'] = $answer;
                    	$data_answer['questionID'] = $this->questionID();

                        $Answer = $Answers->create($data_answer);
                        }

                    }

            }

        	return $r;
        }


          public function find_answers()
                 {
                     $sql = 'SELECT a.*,q.pollID FROM '.PERCH_DB_PREFIX.'poll_questions_for_poll q,'.PERCH_DB_PREFIX.'poll_question qu,'.PERCH_DB_PREFIX.'poll_answer a
                             WHERE q.questionID=qu.questionID AND q.questionID=a.questionID AND q.questionID='.$this->db->pdb($this->questionID());

                     $rows = $this->db->get_rows($sql);
                     $results=[];

                     if (PerchUtil::count($rows)) {

                        foreach($rows as $question) {

                      /*  $results[$question["questionID"]]=[];
                        $answers=[];
                        $answers[$question["answerID"]]=$question["answer"];
                         $results[$question["questionID"]]["question"]= $question["question"];
                       $results[$question["questionID"]]["answers"]= $answers;*/

                          array_push($results,$question["answerID"]);

                         }
                      }

                       return  $results; //$this->return_instances($rows);

                 }

            public function get_question_answers()
            {
                $as = $this->find_answers();

                if (PerchUtil::count($as)) {
                    $Answers = new PerchPolls_Answers();
                    $out = array();
                    foreach($as as $answer) {

                        $out[] = $Answers->find((int)$answer);
                    }
                    return $out;
                }
                return false;
            }


}
