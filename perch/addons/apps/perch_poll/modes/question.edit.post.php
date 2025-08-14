<?php

    # Title panel
    $heading = $Lang->get('Editing Question ‘%s’', $HTML->encode(trim($details['question']. ' '.$details['question'])));

    echo $HTML->title_panel([
            'heading' => $heading,
            ], $CurrentUser);


    if ($message) echo $message;


    $template_help_html = $Template->find_help();
    if ($template_help_html) {
        echo $HTML->heading2('Help');
        echo '<div class="template-help">' . $template_help_html . '</div>';
    }


    echo $HTML->heading2('Question details');

    echo $Form->form_start('edit', 'magnetic-save-bar');

        echo $Form->text_field('question', 'Question', $details['question']);
        echo $Form->text_field('answer[]', 'New Answer', '');
        $opts = array();
        if (PerchUtil::count($answers)) {
            foreach($answers as $Answer) {
                //$opts[] = array('value'=>$Answer->answerID(), 'label'=>$Answer->answer());
                 echo $Form->text_field('answer[]', 'Answer #'.$Answer->answerID(), $Answer->answer());
            }
        }
        //if()
       // echo $Form->select_field('answer', 'Answer', $opts, (isset($details['questionID']) ? $details['questionID'] : ''));


        echo $Form->fields_from_template($Template, $details, $Questions->static_fields);

        echo $Form->submit_field('btnSubmit', 'Save', $API->app_path().'/questions/');


    echo $Form->form_end();
