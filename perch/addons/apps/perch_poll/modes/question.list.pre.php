<?php
    
    $Questions = new PerchPolls_Questions($API);


    if (!$CurrentUser->has_priv('perch_poll.questions.manage')) {
        PerchUtil::redirect($API->app_path());
    }

    $Polls = new PerchPolls_Polls($API);
    $polls = $Polls->all();

    $Poll = false;

    if (PERCH_RUNWAY) {
        if (PerchUtil::get('poll')) {
            $Poll = $Polls->get_one_by('pollID', PerchUtil::get('poll'));
              $questions = $Questions->get_by('pollID', (int)$Poll->pollID(), false, $Paging);
        }
    }
    if (!$Poll) {
        $Poll = $Polls->first();
           $questions = $Questions->all($Paging);
    }


