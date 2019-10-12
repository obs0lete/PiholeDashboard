<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pi-hole ad-block toggle</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            <!-- Pi-hole section -->
                <h2>
                    Pi-hole ad-block toggle
                </h2>
                Click <strong>Disable</strong> to disable ad-block. Once you have finished, click <strong>Enable.</strong>
                <br/><br/>
                <p>
<?php

include 'includes.php';
    // Prevent caching
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Connection: close");

    // Check if the $piHole variable has been set
    if (empty($piHole)) {
        ?>
            <div class="alert alert-dismissable alert-danger">
                <strong>Warning!</strong> Pi-hole IP/URL not set!
            </div>
        <?php
    }

    // Check if the $apiKey variable has been set
    if (empty($apiKey)) {
        ?>
            <div class="alert alert-dismissable alert-danger">
            <strong>Warning!</strong> No API Key is set! <a id="modal-664008" href="#modal-container-664008" class="alert-link" data-toggle="modal">Get your API Key</a>
			
			<div class="modal fade" id="modal-container-664008" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="myModalLabel">
                            How to get your API Key
							</h5> 
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
                            To get your API Key, choose one of the following options:
                            <br /><br />
                            <ol>
                                <li>
                                    Open a terminal on the device running Pi-hole and type <strong>sudo cat /etc/pihole/setupVars.conf | grep PASSWORD</strong>. Copy the value into the <strong>$apiKey</strong> variable in <strong>includes.php</strong>.
                                </li>
                                <br />
                                <li>
                                    Go to <strong>http://youripholeip/settings.php?tab=api</strong> and click on the <strong>Show API</strong> button to get your key. Copy the value into the <strong>$apiKey</strong> variable in <strong>includes.php</strong>.
                                </li>
                            </ol>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
					
				</div>
				
			</div>
			
            </div>
        <?php
    }
    ?>

    <!-- Print the Pi-hole IP/URL -->
    <!-- Pi-hole URL: <a href="<?php echo $piHole; ?>" class="alert-link"><?php echo $piHole; ?></a><br /> -->
    <?php
    // Print the results
    printf("
    Status: %s <br />
    Domains blocked: %s <br />
    Total Queries: %s <br />
    Ads Blocked Today: %s <br />
    Percent Blocked: %u%% <br />
    ", $statusResult, $domainsBlocked, $dnsQueries, $adsBlocked, $percentAdsBlocked);

?>
<form>
<button type="submit" class="btn btn-outline-danger button disable-button" id="disable" method="get" formaction="disable.php">Disable</button>
<button type="submit" class="btn btn-outline-success button enable-button" id="enable" method="get" formaction="enable.php">Enable</button>
</form>
    </p>
        </div>
            <!-- <div class="col-md-4">
                <h2>
                    LAN
                </h2>
                <p>

                <?php
                    /*Ping LAN
                    function pingLAN($host) {
                    exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval); return $rval === 0; }
                    $host = array('10.1.1.1', '10.1.1.2', '10.1.1.3', '10.1.1.4', '10.1.1.5', '10.1.1.6', '10.1.1.7', '10.1.1.104','10.1.1.123');
                    foreach($host as $ip) {
                        $hostname = gethostbyaddr($ip);
                            if (pingLAN($ip)) echo $ip . " ($hostname) " . '<span style="color: #21a75a; font-weight: bold;">ONLINE</span>' ."<br />";
                            else echo $ip . ' <span style="color: #ff0000; font-weight: bold;">OFFLINE</span>' ."<br />";
                        }*/
                ?>
                </p>
            </div>
            <div class="col-md-4">
                <h2>
                    Internet
                </h2>
                <p>
                <?php
                    /*
                    Ping WANfunction pingWAN($host) {
                    exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval); return $rval === 0; }
                    $host = array('google.ca');
                    foreach($host as $ip) {
                            if (pingWAN($ip)) echo ' <span style="color: #21a75a; font-weight: bold;">You are connected to the intenet.</span>' ."<br />";
                            else echo ' <span style="color: #ff0000; font-weight: bold;">You are not connected to the intenet.</span>' ."<br />";
                        }*/
                ?>
                </p>
            </div> -->
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script> 
</body>

</html>
