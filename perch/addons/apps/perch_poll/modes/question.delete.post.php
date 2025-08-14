<?php 
    echo $Form->form_start();
    
    if ($message) {
        echo $message;
    }else{
        echo $HTML->warning_message('Are you sure you wish to delete the question %s?', '<strong>'.trim($details['question'].' '.$details['question']).'</strong>');
        echo $Form->form_start();
		echo $Form->submit_field('btnSubmit', 'Delete', $API->app_path().'/questions/');
        echo $Form->form_end();
    }
