<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Pi-hole ad-block toggle</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- Allow page to refresh -->
        <script>var disableRefresh = "false";</script>
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
                         <p></p>

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
                <!-- Disable the page from refreshing -->
                <script>var disableRefresh = "true";</script>
                <div class="alert alert-dismissable alert-danger">
                    <strong>Pi-hole IP/URL not set!</strong>
                    <br />
                    Make sure you set <strong>$piHole</strong> correctly in <strong>includes.php</strong>.
                </div>
            <?php
        }

        // Check if the $apiKey variable has been set
        if (empty($apiKey)) {
            ?>
            <!-- Disable the page from refreshing -->
            <script>var disableRefresh = "true";</script>
            <div class="alert alert-dismissable alert-danger">
                <strong>No Pi-hole API Key is set!</strong>
                <br />
                    <a id="modal-664008" href="#modal-container-664008" class="alert-link" data-toggle="modal">How do I get my Pi-hole API Key?</a>
			        <div class="modal fade" id="modal-container-664008" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				        <div class="modal-dialog" role="document">
					        <div class="modal-content">
						        <div class="modal-header">
							        <h5 class="modal-title" id="myModalLabel">
                                        How to get your Pi-hole API Key
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
    Pi-hole URL: <a href="<?php echo $piHole; ?>" class="alert-link"><?php echo $piHole; ?></a><br />
    <?php
    // Print the results
    printf("
    Status: %s <br />
    Domains blocked: %s <br />
    Total Queries: %s <br />
    Ads Blocked Today: %s <br />
    Percent Blocked: %u%% <br />
    Last Blocked: %s <br />
    ", $statusResult, $domainsBlocked, $dnsQueries, $adsBlocked, $percentAdsBlocked, $lastBlocked);
    ?>
    <br />
    <form>
        <button type="submit" class="btn btn-outline-danger button disable-button" id="disable" method="get" formaction="disable.php">Disable</button>
        <button type="submit" class="btn btn-outline-success button enable-button" id="enable" method="get" formaction="enable.php">Enable</button>
    </form>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    </body>
</html>
