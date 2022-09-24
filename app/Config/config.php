<?php

//config.php

//Include Google Client Library for PHP autoload file
// require_once 'vendor/autoload.php';
require APP . 'Vendor' . DS . 'autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('722675145390-eu4pb1jb0ih41lrdu8hpu8o2d8n9sagd.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/EventManagementSystem/events');

//

// $client->addScope(Google_Service_Calendar::CALENDAR);
// $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

// $google_client->addScope('email');

// $google_client->addScope('profile');
$google_client->addScope(Google_Service_Calendar::CALENDAR);

//start session on web page
session_start();

?>