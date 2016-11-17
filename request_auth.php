<?php

$authEndpoint = 'https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=%s&scope=basic+public_content';

$location = sprintf($authEndpoint,
            '0e60bda7e475412188323fe22fde5f2b',
            'http://localhost:9000/confirm.php',
            'code');

header('Location: '. $location);
exit(1);
