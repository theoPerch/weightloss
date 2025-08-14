<?php
    // switch($_SERVER['SERVER_NAME']) {

    //     case '':
    //         include(__DIR__.'/config.ra-d41d-cd98.php');
    //         break;

    //     default:
    //     include(__DIR__.'/config.ra-d41d-cd98.php');
    //       //  include('config.production.php');
    //         break;
    // }

    define('PERCH_DB_USERNAME', 'nlclinic');
	define('PERCH_DB_PASSWORD', 'EfJS1HHkCNOlyOeT');
	define('PERCH_DB_SERVER', 	"nlclinic.mysql.database.azure.com");
	define('PERCH_DB_DATABASE', 'getweightlossmain');
	define('PERCH_DB_PREFIX', 	'p4_');

    define('PERCH_LICENSE_KEY', 'R42403-XPM166-BSJ537-XXP315-RGP009');
    define('PERCH_EMAIL_FROM', 'no-reply@getweightloss.co.uk');
    define('PERCH_EMAIL_FROM_NAME', 'GetWeightLoss');
    define('PERCH_LOGINPATH', '/perch');
   // define('PERCH_LOGINPATH', '/getweightloss/perch');
   // define('PERCH_SITEPATH', '/getweightloss');

    define('PERCH_PATH', str_replace(DIRECTORY_SEPARATOR.'config', '', __DIR__));
    define('PERCH_CORE', PERCH_PATH.DIRECTORY_SEPARATOR.'core');

    define('PERCH_RESFILEPATH', PERCH_PATH . DIRECTORY_SEPARATOR . 'resources');
    define('PERCH_RESPATH', PERCH_LOGINPATH . '/resources');

    define('PERCH_HTML5', true);
    define('PERCH_TZ', 'UTC');
    //define('PERCH_LOCALE', 'fr_FR');
  // define('PERCH_DEBUG', true);
    define('PERCH_STRIPSLASHES', false);
    define('PERCH_TWILLIO_AUTHTOKEN', "b9b26ad2b32c51034f96910d560aba5a");
    //define('PERCH_TWILLIO_FROM',"+14155238886");
    define('PERCH_EMAIL_METHOD', 'smtp');
    define('PERCH_EMAIL_HOST', 'smtp.postmarkapp.com');
    define('PERCH_EMAIL_AUTH', true);
    // define('PERCH_EMAIL_SECURE', 'ssl');
    define('PERCH_EMAIL_PORT', 2525);
    define('PERCH_EMAIL_USERNAME', '6c67dfc8-1130-4f61-92a6-bf6fb82c2c7e');
    define('PERCH_EMAIL_PASSWORD', '6c67dfc8-1130-4f61-92a6-bf6fb82c2c7e');
    //dev
    //define('PERCH_reCAPTCHA_SITE_KEY', '6LenfOkqAAAAAMfOcdOlTq4GgOW-Rr5OxQJ_pv2E');
    //define('PERCH_reCAPTCHA_SECRET_KEY', '6LenfOkqAAAAAHEbu4wA0Z6F-yCxl6mTG8elCUjd');

    //live
define('PERCH_reCAPTCHA_SITE_KEY', '6Lc8cukqAAAAAOzP-o9BA7GMjq47cue2EtnQ8wdN');
define('PERCH_reCAPTCHA_SECRET_KEY', '6Lc8cukqAAAAAE8dA6sKiNrJm5EZ-mo1XsqE_rPf');
//email octopus
//eo_eab5af54779347da43fea0a42f9ceaf87d7bcedcdcb505668687c270087faf7a
