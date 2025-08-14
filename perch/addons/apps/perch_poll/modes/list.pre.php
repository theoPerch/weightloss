<?php
	if (!PERCH_RUNWAY) exit;

    $Polls = new PerchPolls_Polls($API);

    $HTML = $API->get('HTML');

    if (!$CurrentUser->has_priv('perch_poll.polls.manage')) {
        PerchUtil::redirect($API->app_path());
    }

   $polls = $Polls->all($Paging);

    if (!PerchUtil::count($polls)) {
         $Polls->attempt_install();
          $polls = $Polls->all($Paging);
    }

