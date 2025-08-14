<?php


   echo $HTML->title_panel([
            'heading' => $Lang->get('Listing questions'),
            'button'  => [
                            'text' => $Lang->get('Add question'),
                            'link' => $API->app_nav().'/questions/edit/'.(PERCH_RUNWAY ? '?poll='.$Poll->pollID() : ''),
                            'icon' => 'core/plus',
                            'priv' => 'perch_poll.questions.create',
                        ]
            ], $CurrentUser);

    $Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

    $Smartbar->add_item([
        'active' => true,
        'title' => $Lang->get('Questions'),
        'link'  => $API->app_nav().'/questions/',
        'icon'  => 'core/users',
    ]);

    echo $Smartbar->render();

    $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);
        $Listing->add_col([
                'title'     => 'Question',
                'value'     => 'question',
                'sort'      => 'question',
                'edit_link' => 'edit',
            ]);
    /*$Listing->add_col([
            'title'     => 'Question',
            'value'     => 'Question',
            'sort'      => 'Question',
        ]);*/


    

    $Listing->add_delete_action([
            'priv'   => 'perch_poll.question.delete',
            'inline' => true,
            'path'   => 'delete',
        ]);

    echo $Listing->render($questions);
