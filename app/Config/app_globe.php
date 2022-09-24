<?php

'Google' => [
      'ClientID' => '722675145390-eu4pb1jb0ih41lrdu8hpu8o2d8n9sagd.apps.googleusercontent.com',
        'ClientSecret' => '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',
        'RedirectUrl' => 'http://' . env("HTTP_HOST") . '/oauth2calendars',
        'ClientCredentials' => WWW_ROOT . 'files'. DS.'google.txt',
        'Scopes' => implode(' ', [Google_Service_Calendar::CALENDAR, Google_Service_Drive::DRIVE, Google_Service_Drive::DRIVE_FILE, Google_Service_Drive::DRIVE_APPDATA, Google_Service_Drive::DRIVE_METADATA]),
    ]