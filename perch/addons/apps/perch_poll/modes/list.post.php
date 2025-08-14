<?php

    echo $HTML->title_panel([
        'heading' => $Lang->get('Listing polls'),
        'button'  => [
                        'text' => $Lang->get('Add poll'),
                        'link' => $API->app_nav().'/polls/edit/',
                        'icon' => 'core/plus',
                        'priv' => 'perch_poll.poll.create',
                    ]
        ], $CurrentUser);


    $Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

    $Smartbar->add_item([
        'active' => true,
        'title' => $Lang->get('Polls'),
        'link'  => $API->app_nav().'/polls/',
        'icon'  => 'blocks/newspaper',
    ]);

    echo $Smartbar->render();


    $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);

     $Listing->add_col([
             'title'     => 'Poll ID',
             'value'     => 'pollID',
             'sort'      => 'pollID',
             'edit_link' => 'edit',
         ]);
    $Listing->add_col([
            'title'     => 'Poll Title',
            'value'     => 'pollTitle',
            'sort'      => 'pollTitle',

        ]);

    $Listing->add_col([
            'title'     => 'Status',
            'value'     => 'pollStatus',
            'sort'      => 'pollStatus',
        ]);

   /* $Listing->add_col([
            'title'     => 'Posts',
            'value'     => 'blogPostCount',
        ]);*/

    $Listing->add_delete_action([
            'priv'   => 'perch_poll.poll.delete',
            'inline' => true,
            'path'   => 'delete',
        ]);

    echo $Listing->render($polls);
