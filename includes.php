<?php
    // Set version
    $version = "1.04.20220128";

    // Set your Pi-hole IP/URL here
    // Ex: $piHole = "http://pi.hole/admin";
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

    // Get the system temperature for Raspberry Pi
    // Note: For this to work, you need to add www-data to the video group:
    //  sudo usermod -aG video www-data
    // Then reboot the Raspberry Pi.
    // Source: https://stackoverflow.com/questions/30151661/running-vcgencmd-from-php-exec
    // This may be different for other hardware.
    $getTemp = shell_exec("vcgencmd measure_temp | egrep -o '[0-9]*\.[0-9]*'");
    
    // Get system uptime
    // This may be different for other hardware.
    $upTime = shell_exec("uptime -p | awk '{print $2, $3, $4, $5, $6, $7, $8, $9}' | sed 's/,//'");

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
    $dnsQueries = $JSON['dns_queries_today'];
    $queriesBlocked = $JSON['ads_blocked_today'];
    $getPercentAdsBlocked = $JSON['ads_percentage_today'];
    $percentAdsBlocked = round($getPercentAdsBlocked, 1);

    // If temp is less tha 63, show green text...
    if ($getTemp < '63') {
        // Change &deg;C to &deg;F for Fahrenheit.
        $temp = "<span style='color: #21a75a; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C</span>";
    }
    // ... if it's between 63-75 then show a warning...
    else if ($getTemp > '63' && $getTemp < '75') {
        // Change &deg;C to &deg;F for Fahrenheit
        $temp = "<span style='color: #b2841b; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C WARNING</span>";
    }
    // ... if it's higher than 75, there's a problem so show danger.
    else if ($getTemp >= '75') {
        $temp = "<span style='color: #ff0000; font-weight: bold; text-transform: uppercase;'>" . $getTemp . "&deg;C DANGER</span>";
    }
?>