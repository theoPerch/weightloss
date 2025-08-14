<?php
	if ($CurrentUser->logged_in()) {
    	$this->register_app('perch_poll', 'Poll', 10, 'App to create polls', '1.0');
    	//$this->require_version('perch_twitter', '3.0.11');
    }

    spl_autoload_register(function($class_name){
        if (strpos($class_name, 'PerchPoll')===0) {
            include(PERCH_PATH.'/addons/apps/perch_poll/lib/'.$class_name.'.class.php');
            return true;
        }


        return false;
    });

    // Fieldtypes
    //include_once(__DIR__.'/fieldtypes.php');

    //PerchSystem::register_shortcode_provider('PerchTwitter_ShortcodeProvider');
