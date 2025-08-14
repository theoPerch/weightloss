<?php
    if (!PERCH_RUNWAY) exit;

    $Polls = new PerchPolls_Polls($API);
    $Questions = new PerchPolls_Questions($API);
    $Responses = new PerchPolls_Responses($API);

    $questions = $Questions->all();
$responses=array();
    $HTML = $API->get('HTML');
    $Form = $API->get('Form');

    $message = false;

    if (!$CurrentUser->has_priv('perch_poll.polls.manage')) {
        PerchUtil::redirect($API->app_path());
    }


    if (isset($_GET['id']) && $_GET['id']!='') {
        $pollID = (int) $_GET['id'];
        $Poll = $Polls->find($pollID);
        $details = $Poll->to_array();


    }else{
        $pollID = false;
        $Poll = false;
        $details = array();

    }


    $Template   = $API->get('Template');
    $Template->set('poll/poll.html', 'poll');
    $Form->handle_empty_block_generation($Template);
    $tags = $Template->find_all_tags_and_repeaters();



    $Form->require_field('pollTitle', 'Required');
    $Form->set_required_fields_from_template($Template, $details);

    if ($Form->submitted()) {
		$postvars = array('pollTitle','questions','pollStatus');

    	$data = $Form->receive($postvars);

        $prev = false;



        if (!is_object($Poll)) {

            $Poll = $Polls->create($data);
           PerchUtil::redirect($API->app_path() .'/polls/edit/?id='.$Poll->pollID().'&created=1');
        }else{
         $Poll->update($data);
        }




        if (is_object($Poll)) {
            $message = $HTML->success_message('Your poll has been successfully edited. Return to %spoll listing%s', '<a href="'.$API->app_path() .'">', '</a>');
        }else{
            $message = $HTML->failure_message('Sorry, that poll could not be edited.');
        }


        $details = $Poll->to_array();
    }

    if (isset($_GET['created']) && !$message) {
        $message = $HTML->success_message('Your poll has been successfully created. Return to %spoll listing%s', '<a href="'.$API->app_path() .'/polls">', '</a>');
    }
