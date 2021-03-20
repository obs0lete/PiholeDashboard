<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Pi-hole Toggle</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="https://toggle.obs0lete.com/imgs/favicons/apple-touch-icon.png?v=5AB4KMlkQk">
        <link rel="icon" type="image/png" sizes="32x32" href="https://toggle.obs0lete.com/imgs/favicons/favicon-32x32.png?v=5AB4KMlkQk">
        <link rel="icon" type="image/png" sizes="194x194" href="https://toggle.obs0lete.com/imgs/favicons/favicon-194x194.png?v=5AB4KMlkQk">
        <link rel="icon" type="image/png" sizes="192x192" href="https://toggle.obs0lete.com/imgs/favicons/android-chrome-192x192.png?v=5AB4KMlkQk">
        <link rel="icon" type="image/png" sizes="16x16" href="https://toggle.obs0lete.com/imgs/favicons/favicon-16x16.png?v=5AB4KMlkQk">
        <link rel="manifest" href="https://toggle.obs0lete.com/imgs/favicons/site.webmanifest?v=5AB4KMlkQk">
        <link rel="mask-icon" href="https://toggle.obs0lete.com/imgs/favicons/safari-pinned-tab.svg?v=5AB4KMlkQk" color="#5a5a59">
        <link rel="shortcut icon" href="https://toggle.obs0lete.com/imgs/favicons/favicon.ico?v=5AB4KMlkQk">
        <meta name="apple-mobile-web-app-title" content="Pi-hole Toggle">
        <meta name="application-name" content="Pi-hole Toggle">
        <meta name="msapplication-TileColor" content="#5a5a59">
        <meta name="msapplication-TileImage" content="https://toggle.obs0lete.com/imgs/favicons/mstile-144x144.png?v=5AB4KMlkQk">
        <meta name="msapplication-config" content="https://toggle.obs0lete.com/imgs/favicons/browserconfig.xml?v=5AB4KMlkQk">
        <meta name="theme-color" content="#ffffff">

        <!-- Create an alert when disabling per X mins -->
        <script>
        function getInputValue(){
            var val = document.getElementById("disableTime").value;
                if (val === "") {
                    alert("You must enter a number, in minutes. ");
                } else if (val === "0")  {
                    alert("You must enter a nummber greater than 0.");
                    return false;
                } else {
                    alert("Pi-hole ad-blocking will be disabled for " + val + " minute(s).\nPi-hole will re-enable ad-blocking automatically.\n\nYou can manually re-enable by pressing the Enable button.");
                return true;
                }
            }
        </script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Header -->
                    <h1>Pi-hole Toggle</h1>
                    <br /><br />
                    Click <strong>Disable</strong> to disable ad-blocking.
                    <br/>
                    Once you have finished, click <strong>Enable.</strong>
                    <br/>

<?php
    include 'includes.php';
        // Prevent caching
        header("Cache-Control: max-age=0, must-revalidate");

        // Check if the $piHole variable has been set
        if (empty($piHole)) {
            ?>
                <div class="alert alert-dismissable alert-danger">
                    <strong>Pi-hole IP/URL not set!</strong>
                    <br />
                    Make sure you set <strong>$piHole</strong> correctly in <strong>includes.php</strong>.
                    <br />
                    E.g. http://pi.hole/admin/
                    <br />
                </div>
            <?php
        }

        // Check if the $apiKey variable has been set
        if (empty($apiKey)) {
            ?>
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
    <div id="results">
    <br />
    Pi-hole URL: <a href="
        <?php echo $piHole; ?>" class="alert-link">
        <?php echo $piHole; ?>
        </a><br />
        <?php printf("Last Blocked: %s <br />", $lastBlocked);?><br />
    <table class="table">
    <thead class="thead-dark">
        </thead>
            <tbody>
            <!-- First row -->
                <tr>
                    <td>
                        <?php printf("Ad-block Status: %s", $statusResult);?>
                    </td>

                    <td>
                        <?php printf("Uptime: %s", $upTime);?>
                    </td>

                    <td>
                        <?php printf("Temperature: %s", $temp);?>
                    </td>
                </tr>
                <!-- Second row -->
                <tr>
                    <td>
                        <?php printf("Total Queries: %s", $dnsQueries);?>
                    </td>

                    <td>
                        <?php printf("Domains Blocked: %s", $domainsBlocked);?>
                    </td>

                    <td>
                        <?php printf("Ads Blocked Today: %s", $adsBlocked);?>
                    </td>
                </tr>
             </tbody>    
        </table>
    <br />
    </div>

    <!-- Enable/Disable buttons -->
    <form>
        <button type="submit" class="btn btn-outline-danger button disable-button" id="disable" method="get" formaction="disable.php">Disable</button>
        <br /><br />
        <button type="submit" class="btn btn-outline-success button enable-button" id="enable" method="get" formaction="enable.php">Enable</button>
    </form>
    <br />

    <!-- Disable (min) buttons -->
    <form action="disableTime.php" method="post">
        <div class="input-group mb-3">
            <input type="number" class="form-control" id="disableTime" name="disableTime" aria-label="disableTime" placeholder="0" min="1" oninput="this.value=(parseInt(this.value)||0)" required>
                <div class="input-group-append">
                &emsp;<button type="submit" name="submit" class="btn btn-outline-info" type="button" onclick="getInputValue();">Disable (mins)</button>
                </div>
        </div>
    </form>
    <!-- Version -->
    <div class="version">
    <a href="https://github.com/obs0lete/PiholeDashboard"><?php echo $version;?></a>
    </div>

    <!-- Scripts -->
    <script src="js/tether.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    </body>
</html>