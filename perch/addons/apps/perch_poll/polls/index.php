<?php
    # include the API
    include('../../../../core/inc/api.php');

    if (!PERCH_RUNWAY) {
        exit;
    }

    $API  = new PerchAPI(1.0, 'perch_poll');
    $HTML   = $API->get('HTML');
    $Lang   = $API->get('Lang');
    $Paging = $API->get('Paging');

    # Set the page title
    $Perch->page_title = $Lang->get('Manage Polls');

    $Perch->add_css($API->app_path().'/assets/css/poll.css');

    # Do anything you want to do before output is started
    include('../modes/_subnav.php');
    include('../modes/list.pre.php');

    # Top layout
    include(PERCH_CORE . '/inc/top.php');

    # Display your page
    include('../modes/list.post.php');


    # Bottom layout
    include(PERCH_CORE . '/inc/btm.php');
