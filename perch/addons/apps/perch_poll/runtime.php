<?php
    spl_autoload_register(function($class_name){
        if (strpos($class_name, 'PerchPoll')===0) {
            include(__DIR__.'/lib/'.$class_name.'.class.php');
            return true;
        }

        return false;
    });



    if (PERCH_RUNWAY) {
        $poll_init = function(){
            $API  = new PerchAPI(1.0, 'perch_poll');

        };
        $poll_init();
    }



        function perch_poll_form_handler($SubmittedForm)
        {


            if ($SubmittedForm->formID=='response' && $SubmittedForm->validate()) {

                $API  = new PerchAPI(1.0, 'perch_poll');
                $Responses = new PerchPolls_Responses($API);
                $Responses->receive_response($SubmittedForm);
            }


            $Perch = Perch::fetch();
            PerchUtil::debug($Perch->get_form_errors($SubmittedForm->formID));
        }




   /**
      *
      * Gets the categories used for a post to display
      * @param string $id_or_slug id or slug of the current post
      * @param string $template template to render the categories
      * @param bool $return if set to true returns the output rather than echoing it
      */
     function perch_poll_view($id_or_slug, $opts='question_list.html', $return=false)
     {
         $id_or_slug = rtrim($id_or_slug, '/');

         $default_opts = array(
             'template'             => 'question_list.html',
             'skip-template'        => false,
             'split-items'          => false,
             'cache'                => true,
         );

         if (!is_array($opts)) {
             $opts = array('template'=>$opts);
         }

         if (is_array($opts)) {
             $opts = array_merge($default_opts, $opts);
         }else{
             $opts = $default_opts;
         }

         if ($opts['skip-template'] || $opts['split-items']) {
             $return = true;
         }

         if (isset($opts['data'])) PerchSystem::set_vars($opts['data']);

         $opts['template'] = '~perch_poll/templates/poll/'.str_replace('poll/', '', $opts['template']);



         $template = $opts['template'];


         $API  = new PerchAPI(1.0, 'perch_poll');
         $PollPolls = new PerchPolls_Polls($API);

         $pollID = false;

         if (is_numeric($id_or_slug)) {
             $pollID = intval($id_or_slug);
             $Poll = $PollPolls->find_by_status($pollID);

         }else{
             $Poll = $PollPolls->find_by_status_slug($id_or_slug);
             if (is_object($Poll)) {
                 $pollID = $Poll->id();
             }
         }

         if (is_object($Poll)) {
             $questions   = $Poll->get_questions();


             if ($opts['skip-template']) {

                 $out = array();

                 if (PerchUtil::count($questions)) {
                     foreach($questions as $Question) {
                    //  $answers   = $Question->get_answers();
                         $out[] = $Question->to_array();
                     }
                 }


                 return $out;

             }
             PerchSystem::set_var('pollID',  $pollID );

              $TemplatePoll = $API->get('Template');
               $TemplatePoll->set('~perch_poll/templates/poll/'.str_replace('poll/', '', 'list_poll.html'), 'poll');
             $Template = $API->get('Template');
             $Template->set($template, 'question');

             $TemplateAnswer = $API->get('Template');

              $TemplateAnswer->set('~perch_poll/templates/poll/'.str_replace('poll/', '', 'answers_for_question.html'), 'answer');
             //$r ='';
              $r =$TemplatePoll->render($Poll, true);
             foreach($questions as $question){
                 $answers   = $question->get_question_answers();

                $r .= $Template->render($question, true);
               // print_r($question);
                  $html= $TemplateAnswer->render_group($answers, true);
                   $html = $TemplateAnswer->apply_runtime_post_processing($html);
                   $r .= $html;


             }







             if ($return) return $r;
             echo $r;
         }

         return false;
     }

    //include(__DIR__.'/vendor/autoload.php');
