<?php
    if (!PERCH_RUNWAY) exit;

    $Polls = new PerchPolls_Polls($API);

    $Form = $API->get('Form');

    $Form->set_name('delete');

    if (!$CurrentUser->has_priv('perch_poll.polls.manage')) {
        PerchUtil::redirect($API->app_path());
    }

	$message = false;

	if (isset($_GET['id']) && $_GET['id']!='') {
	    $Poll = $Polls->find($_GET['id']);
	}else{
	    PerchUtil::redirect($API->app_path());
	}


    if ($Form->submitted()) {

    	if (is_object($Poll)) {
    	    $Poll->delete();

            // clear the caches
           // PerchPoll_Cache::expire_all();


    	    if ($Form->submitted_via_ajax) {
    	        echo $API->app_path().'/polls/';
    	        exit;
    	    }else{
    	       PerchUtil::redirect($API->app_path().'/polls/');
    	    }

        }else{
            $message = $HTML->failure_message('Sorry, that poll could not be deleted.');
        }
    }



    $details = $Poll->to_array();


