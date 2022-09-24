<?php

App::uses('AppController', 'Controller');

require APP . 'Vendor' . DS . 'autoload.php';
// require APP . 'Config' . DS . 'config.php';

class EventsController extends AppController {

	public $uses = array('Event');

	public function index() {

		if($this->request->isAjax()) {

			$this->layout = null;

			$this->autoRender = false;

			if($this->request->is('post')) {

				$data = $this->request->data;

				$data['google_calendar_event_id'] = 1;

				if($this->Event->save($data)) {

					$client = $this->getClient();

					$service = new Google_Service_Calendar($client);

					$event = new Google_Service_Calendar_Event(array(
					  'summary' => $data['title'],
					  'location' => $data['location'],
					  'description' => $data['description'],
					  'recurrence' => array(
					    'RRULE:FREQ=DAILY;COUNT=2'
					  ),
					  'start' => $data['time_from'],
					  'end' => $data['time_to'],
					  'attendees' => array(
					    array('email' => 'lpage@example.com'),
					    array('email' => 'sbrin@example.com'),
					  ),
					  'reminders' => array(
					    'useDefault' => FALSE,
					    'overrides' => array(
					      array('method' => 'email', 'minutes' => 24 * 60),
					      array('method' => 'popup', 'minutes' => 10),
					    ),
					  ),
					));

					$calendarId = 'primary';
					$event = $service->events->insert($calendarId, $event);
					printf('Event created: %s\n', $event->htmlLink);


					// return json_encode(array('success' => 1));
				}
			}
		}
	}

	public function getClient() {

	$client = new Google_Client();
    $client->setApplicationName('Event Management System');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    // $client->setClientId('489347066006-30a71acjg246psk8qfegfuushbmb6skv.apps.googleusercontent.com');
    // $client->setClientSecret('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');
    $client->setAuthConfig('client_secret.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $client->setRedirectUri('http://localhost/EventManagementSystem/events');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
	}
}
