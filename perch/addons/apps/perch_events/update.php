<?php
    // Prevent running directly:
    if (!defined('PERCH_DB_PREFIX')) exit;


    $API = new PerchAPI(1.0, 'perch_events');

    $Settings = $API->get('Settings');

    if($Settings->get('perch_events_update')->val()==null){
     $Settings->set('perch_events_update', '1.9.5');
    }


  //  if ($Settings->get('perch_events_update')->val()!='1.9.8') {

        $db = $API->get('DB');

        if ($Settings->get('perch_events_update')->val()<'1.8') {


        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events` ADD FULLTEXT idx_search (`eventTitle`, `eventDescRaw`)";
        $db->execute($sql);

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryEventCount` INT(0)  UNSIGNED  NOT NULL  DEFAULT '0'  AFTER `categorySlug`";
        $db->execute($sql);        

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryFutureEventCount` INT  UNSIGNED  NOT NULL  DEFAULT '0'  AFTER `categoryEventCount`";
        $db->execute($sql);        

        $sql = "ALTER TABLE `".PERCH_DB_PREFIX."events_categories` ADD `categoryDynamicFields` TEXT  NULL  AFTER `categoryFutureEventCount`";
        $db->execute($sql);



        $Cats = new PerchEvents_Categories($API);
        $Cats->update_event_counts();

        }

        $host = 'activation.grabaperch.com';
        $path = '/activate/v3/addons/versions/update/';
        $url = 'http://' . $host . $path;
        $data = [];
        $data['key']     = PERCH_LICENSE_KEY;
        $data['addon']     = 'perch_events';
        $data['addonVersion'] = '1.9.7';

        $content = http_build_query($data);

        $result = false;
        $use_curl = false;

            PerchUtil::debug('Activating Addon via CURL');
            $ch 	= curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
			$response = curl_exec($ch);
			PerchUtil::debug($response);
			$http_status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if ($http_status!=200) {
			    $response = false;
			    PerchUtil::debug('Not HTTP 200: '.$http_status);
			}

			    $result=json_decode($response);

			    if(true){
			         $sql=  " ALTER TABLE  `__PREFIX__events` ADD `eventEndDateTime`  datetime DEFAULT NULL AFTER `eventDateTime`;
                                          CREATE TABLE IF NOT EXISTS `__PREFIX__events_customers` (
                                               `customerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                               `customerFirstName` char(128) NOT NULL DEFAULT '',
                                               `customerLastName` char(128) NOT NULL DEFAULT '',
                                               `customerEmail` char(128) NOT NULL DEFAULT '',
                                               `customerDynamicFields` mediumtext,
                                               `customerCreated` datetime NOT NULL DEFAULT '2015-01-01 00:00:00',
                                               `customerUpdated` datetime NOT NULL DEFAULT '2015-01-01 00:00:00',
                                               `customerDeleted` datetime DEFAULT NULL,
                                               `memberID` int(10) unsigned NOT NULL DEFAULT '0',
                                               PRIMARY KEY (`customerID`),
                                               KEY `idx_member` (`memberID`)
                                             ) CHARSET=utf8;
                       CREATE TABLE IF NOT EXISTS `__PREFIX__events_bookings` (
                       `bookingID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                       `dayID` int(10) NOT NULL,
                       `slotID` int(10) NOT NULL,
                       `eventID` int(10) NOT NULL,
                       `memberID` int(10) DEFAULT NULL,
                       `customerID` int(11) DEFAULT NULL,
                       `bookingDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                       `time` time NOT NULL,
                       `date` date NOT NULL,
                       `status` set('hold','confirmed','available') NOT NULL DEFAULT 'hold',
                       PRIMARY KEY (`bookingID`)
                      ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

CREATE TABLE  IF NOT EXISTS `__PREFIX__events_to_categories` (
  `eventID` int(11) NOT NULL DEFAULT 0,
  `categoryID` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

            CREATE TABLE IF NOT EXISTS `__PREFIX__events_log_reminders` (
                       `logID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                       `bookingID` int(10) DEFAULT NULL,
                       `customerID` int(11) DEFAULT NULL,
                       `logDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                       `status` set('send','notsend') NOT NULL DEFAULT 'send',
                       PRIMARY KEY (`logID`)
                      ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;


                                          CREATE TABLE IF NOT EXISTS `__PREFIX__events_customers` (
                                           `customerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                           `customerFirstName` char(128) NOT NULL DEFAULT '',
                                           `customerLastName` char(128) NOT NULL DEFAULT '',
                                           `customerEmail` char(128) NOT NULL DEFAULT '',
                                           `customerDynamicFields` mediumtext DEFAULT NULL,
                                           `customerCreated` datetime NOT NULL DEFAULT '2015-01-01 00:00:00',
                                           `customerUpdated` datetime NOT NULL DEFAULT '2015-01-01 00:00:00',
                                           `customerDeleted` datetime DEFAULT NULL,
                                           `memberID` int(10) unsigned NOT NULL DEFAULT 0,
                                           PRIMARY KEY (`customerID`),
                                           KEY `idx_member` (`memberID`)
                                          ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


 CREATE TABLE `__PREFIX__eventbooking_to_order` (

                                                                                                     `orderID` int(10) NOT NULL,
                                                                                                     `bookingID` int(10) NOT NULL
                                                                                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                     CREATE TABLE `__PREFIX__events_to_timeslots` (

                                                              `slotID` int(10) NOT NULL,
                                                              `eventID` int(10) NOT NULL
                                                               ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                                                                   CREATE TABLE `__PREFIX__events_days` (
                                                                             `dayID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                                                             `day` char(255) NOT NULL DEFAULT '',
                                                                             PRIMARY KEY (`dayID`)
                                                                           ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

                                                                           INSERT INTO `__PREFIX__events_days` ( `dayID`,`day`)  VALUES
                                                                           (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),	(5,'Friday'),(6,'Saturday'),(7,'Sunday');


                                                                        CREATE TABLE `__PREFIX__events_timeslots` (
                                                                                                      `slotID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                                                                                       `startDate` time DEFAULT NULL,
                                                                                                       `endDate` time DEFAULT NULL,
                                                                                                      `slot_duration` int(10) NOT NULL DEFAULT 0,
                                                                                                      PRIMARY KEY (`slotID`)
                                                                                                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


                                                         CREATE TABLE `__PREFIX__events_timeslots_perday` (
                                                                                                      `slotID` int(10) NOT NULL,
                                                                                                       `dayID`  int(10) NOT NULL,
                                                                                                       `enable` tinyint(1)	 DEFAULT 1,
                                                                                                      PRIMARY KEY (`slotID`, `dayID`)
                                                                                                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;";
			         $sql = str_replace('__PREFIX__', PERCH_DB_PREFIX, $sql);

                    $DB = PerchDB::fetch();

                    $statements = explode(';', $sql);
                                foreach($statements as $statement) {
                                    $statement = trim($statement);
                                    if ($statement!='') $DB->execute($statement);
                                }

                    $Settings->set('perch_events_update', '1.9.8');

			    }

			curl_close($ch);



   // }

?>




