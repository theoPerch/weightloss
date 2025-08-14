<?php
    
    $Questions = new PerchPolls_Questions($API);
     $Answers = new PerchPolls_Answers($API);



    $Form = $API->get('Form');
	
    $message = false;

    if (!$CurrentUser->has_priv('perch_poll.questions.manage')) {
        PerchUtil::redirect($API->app_path());
    }
    
    
    if (isset($_GET['id']) && $_GET['id']!='') {
        $questionID = (int) $_GET['id'];
        $Question = $Questions->find($questionID);
          $answers = $Answers->find_by_question($questionID);
        $details = $Question->to_array();
    }else{
        $questionID = false;
         $answers = [];
        $Question = false;
        $details = false;
    }
    

    $Template   = $API->get('Template');
    $Template->set('poll/question.html', 'poll');

    $Form->handle_empty_block_generation($Template);

    $tags = $Template->find_all_tags_and_repeaters();
    
    $Form->require_field('question', 'Required');

    $Form->set_required_fields_from_template($Template, $details);


    if ($Form->submitted()) {
		$postvars = array('question','answer');
		
    	$data = $Form->receive($postvars);

        $prev = false;


             if (!is_object($Question)) {
                   // $data['blogSlug'] = PerchUtil::urlify($data['blogTitle']);
                    $Question = $Questions->create($data);
                    PerchUtil::redirect($API->app_path() .'/questions/edit/?id='.$Question->questionID().'&created=1');
                }else{
                   $Question->update($data);
                    PerchUtil::redirect($API->app_path() .'/questions/edit/?id='.$Question->questionID());
                }
    	


        $Question->index($Template);
    	
        if (is_object($Question)) {
            $message = $HTML->success_message('The Question has been successfully edited. Return to %squestion listing%s', '<a href="'.$API->app_path() .'/questions">', '</a>');
        }else{
            $message = $HTML->failure_message('Sorry, that Question could not be edited.');
        }
        
        // clear the caches
       // PerchBlog_Cache::expire_all();
        
        $details = $Question->to_array();
    }

    if (isset($_GET['created']) && !$message) {
        $message = $HTML->success_message('The Question has been successfully created. Return to %squestion listing%s', '<a href="'.$API->app_path() .'/questions">', '</a>');
    }

