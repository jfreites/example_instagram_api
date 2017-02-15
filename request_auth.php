<?php

$authEndpoint = 'https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=%s&scope=basic+public_content';

$location = sprintf($authEndpoint,
            'your_client_id',
            'http://localhost:9000/confirm.php',
            'code');

header('Location: '. $location);
exit(1);
