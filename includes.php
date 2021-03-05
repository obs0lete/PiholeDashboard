<?php

    /* Make sure that you install php-curl: https://stackoverflow.com/questions/38800606/how-to-install-php-curl-in-ubuntu-16-04
     Update 2019/09/20: The above link does not seem to work. Use the following code:
     1. php -v to get the php version
     2. sudo apt-get install libssl1.1=1.1.1c-1
     3. sudo apt-get install libcurl4
     4. sudo apt-get install php7.2-curl (note: this should match php version)
     5. sudo service nginx restart
     */

    // Set version
    $version = "1.02.20210305";

    // Set your Pi-hole IP/URL here
    // Ex: $piHole = "http://192.168.1.2/admin";
    $piHole = "";

    // Set your API key here
    $apiKey = "";
    
    // Set your API Key URL
    $apiKeyURL = $piHole . "/settings.php?tab=api";
    
    // Add /api.php to the $piHole variable
	$apiUrl = $piHole . "/api.php";    
    
    // Disable URL
    $disableUrl = $piHole . "/api.php?disable&auth=" . $apiKey;
    
    // Enable URL
    $enableUrl = $piHole . "/api.php?enable&auth=" . $apiKey;

    // Last blocked domain
    $getLastBlocked = $piHole . "/api.php?recentBlocked&auth=" . $apiKey;
    $lastBlocked = file_get_contents("$getLastBlocked");

    // Get sources
    $getSources = $apiUrl . "/api.php?topClients&auth=" . $apiKey;

    // Get the system temperature
    // Note: For this to work, you need to add www-data to the video group:
    //  sudo usermod -aG video www-data
    // Then reboot the Raspberry Pi.
    // Source: https://stackoverflow.com/questions/30151661/running-vcgencmd-from-php-exec
    $getTemp = shell_exec("vcgencmd measure_temp | egrep -o '[0-9]*\.[0-9]*'");
    
    // Get system uptime
    $upTime = shell_exec("uptime -p");

    // Get the results (JSON)
    $JSONResult = file_get_contents($apiUrl);
     
    // Decode the JSON results
    $JSON = json_decode($JSONResult, true);
    
    // Get the status results
    $statusResult = $JSON['status'];
    // If status is 'enabled', then change the font to green...
    if ($statusResult == 'enabled') {
        $statusResult = "<span style='color: #21a75a; font-weight: bold; text-transform: uppercase;'>$statusResult</span>";
    // ... else change it to red as we assume Pi-hole is disabled.
    } else {
        $statusResult = "<span style='color: #ff0000; font-weight: bold; text-transform: uppercase;'>$statusResult</span>";
    }
    $domainsBlocked = $JSON['domains_being_blocked'];
    $dnsQueries = $JSON['dns_queries_today'];
    $adsBlocked = $JSON['ads_blocked_today'];
    $percentAdsBlocked = $JSON['ads_percentage_today'];

    // If temp is less tha 63, show green text...
    if ($getTemp < '63') {
        $temp = "<span style='color: #21a75a; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C</span>";
    }
    // ... if it's between 63-75 then show a warning...
    else if ($getTemp > '63' && $getTemp < '75') {
        $temp = "<span style='color: #b2841b; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C WARNING</span>";
    }
    // ... if it's higher than 75, there's a problem so show danger.
    else if ($getTemp >= '75') {
        $temp = "<span style='color: #ff0000; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C DANGER</span>";
    }
?>