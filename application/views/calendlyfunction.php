<?php

function getScheduledEvents($inviteeEmail) {
	
// Usage
$apiKey = 'eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzM1NjEyOTc4LCJqdGkiOiI4OTY2N2JlMi0xMDc4LTQ0MGItOTI1MS1mZGYzODZhOTg1MGYiLCJ1c2VyX3V1aWQiOiI0MjRkMGJhMi1lOTkzLTRmMjUtYTJlNS1kZjUzMDYyOWE4NmYifQ.sYibEAOHTD4f5fcAycCApfQZp0VelsaKYg35PCsY9XRSV_we24pklaj6M1qkz8SrstzyCvVuFzzGBkBYBs8-Ug';
$userUri = 'https://api.calendly.com/users/424d0ba2-e993-4f25-a2e5-df530629a86f';
	
    $endpoint = 'https://api.calendly.com/scheduled_events';
    $params = [
        'user' => $userUri, // Specify the user URI
        'invitee_email' => $inviteeEmail, // Filter events by invitee's email
        'status' => 'active', // Only fetch active events (not canceled)
    ];

    $url = $endpoint . '?' . http_build_query($params);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return json_decode($response, true);
}

// Usage
/*
$inviteeEmail = 'kian@ecnetsolutions.ca'; // Replace with the invitee's email

// Pass $userUri explicitly to the function
$events = getScheduledEvents($inviteeEmail);

echo '<pre>';
if(isset($events["collection"][0]["event_memberships"][0]["buffered_start_time"]))
{
print_r($events["collection"][0]["event_memberships"][0]["buffered_start_time"]);
}
echo '</pre>';
*/
?>
