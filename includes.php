<?php

    // Set your Pi-hole IP/URL here
    // Ex: $piHole = "http://192.168.1.2/admin";
    $piHole = '';

    // Set your API key here
    $apiKey = '';

    // Set your API Key URL
    $apiKeyURL = $piHole . "/settings.php?tab=api";
    
    // Add /api.php to the $piHole variable
    $apiUrl = $piHole . "/api.php";    
    
    // Disable URL
    $disableUrl = $piHole . "/api.php?disable&auth=" . $apiKey;
    
    // Enable URL
    $enableUrl = $piHole . "/api.php?enable&auth=" . $apiKey;
    
    // Get the results (JSON)
    $JSONResult = file_get_contents($apiUrl);
     
    // Decode the JSON results
    $JSON = json_decode($JSONResult, true);
    
    // Get the status results
    $statusResult = $JSON['status'];
    if ($statusResult == 'enabled') {
        $statusResult = "<span style='color: #21a75a; font-weight: bold; text-transform: uppercase;'>$statusResult</span>";
    } else {
        $statusResult = "<span style='color: #ff0000; font-weight: bold; text-transform: uppercase;'>$statusResult</span>";
    }
    $domainsBlocked = $JSON['domains_being_blocked'];
    $dnsQueries = $JSON['dns_queries_today'];
    $adsBlocked = $JSON['ads_blocked_today'];
    $percentAdsBlocked = $JSON['ads_percentage_today'];
?>