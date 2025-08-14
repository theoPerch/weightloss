<?php
    $Questions = new PerchPolls_Questions($API);

    $Form = $API->get('Form');

    $Form->set_name('delete');

    if (!$CurrentUser->has_priv('perch_poll.questions.manage')) {
        PerchUtil::redirect($API->app_path());
    }
	
	$message = false;
	
	if (isset($_GET['id']) && $_GET['id']!='') {
	    $Question = $Questions->find($_GET['id']);
	}else{
	    PerchUtil::redirect($API->app_path());
	}
	

    if ($Form->submitted()) {
	
    	if (is_object($Question)) {
    	    $Question->delete();
    
            // clear the caches
            //PerchBlog_Cache::expire_all();


    	    if ($Form->submitted_via_ajax) {
    	        echo $API->app_path().'/questions/';
    	        exit;
    	    }else{
    	       PerchUtil::redirect($API->app_path().'/questions/');
    	    }



        }else{
            $message = $HTML->failure_message('Sorry, that question could not be deleted.');
        }
    }

    
    
    $details = $Question->to_array();

