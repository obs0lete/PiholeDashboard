# PiholeDashboard
A simple web interface to quickly disable Pi-hole ad-blocking and show some basic stats. This was made with dark themes in mind.

![image description](https://raw.githubusercontent.com/obs0lete/PiholeDashboard/master/images/screenshot.png)

# Requirements
- Raspberry Pi (this should work on other devices, but you'll need to adjust how the temperature and uptime stats are fetched for your device in the `includes.php` file for your respecitve system)
- A working Pi-hole installation. See https://pi-hole.net/
- php7.3
- php-curl
- git

# Getting started
You can either host this application on the same Raspberry Pi where Pi-hole is installed, or set this up on a different machine.
Below are the steps for both.

## Install alongside Pi-hole on a Raspberry Pi.
Note: Pi-hole already installs PHP and git, so it can be skipped.
1. SSH into your Raspberry Pi enter the following to **php-curl**: `sudo apt-get install php-curl`.
2. Next type in `sudo usermod -aG video www-data`. This is needed to fetch temperature data on a Raspberry Pi.
3. Next type in `cd /var/www/html/`.
4. Copy the PiHoleDashboard code to your machine: `git clone https://github.com/obs0lete/PiholeDashboard.git piholedashboard`.
5. Log into your Pi-hole (UI) and go to **Settings > API/Web Interface**.
6. Click on the **Show API token** button, then **Yes, show API token**.
7. Copy your **API token**.
8. Edit the **includes.php** and as follows:
    - **$piHole = "";** Set this to your Pi-hole URL. For example, http://pi.hole/admin
    - **$apiKey = ;** Enter your API key here
9. In your SSH console, edit the `/etc/lighttpd/lighttpd.conf` with your editor of choice and enter the following:
Note: Make sure to replace **some.server** with the FQDN that you will use to access this application.
`
$HTTP["host"] == "some.server" {
    # Ensure the Pi-hole Block Page knows that this is not a blocked domain
    setenv.add-environment = ("fqdn" => "true")
    server.document-root = "/var/www/html/piholetoggle/"
}
`
Note: If you want to access this via HTTPS, you will need to use the following instead of the above code. You will need to adjust the values of `ssl.pemfile` and `ssl.ca-file` to pooint to your certificates accorrdingly. 
```
# Pi-hole Dashboard
$HTTP["host"] == "some.server" {
  # Ensure the Pi-hole Block Page knows that this is not a blocked domain
  setenv.add-environment = ("fqdn" => "true")

  # Enable the SSL engine with a LE cert, only for this specific host
  $SERVER["socket"] == ":443" {
    ssl.engine = "enable"
    ssl.pemfile = "/certs/combined.pem"
    ssl.ca-file =  "/certs/fullchain.pem"
    ssl.honor-cipher-order = "enable"
    ssl.cipher-list = "EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH"
    ssl.use-sslv2 = "disable"
    ssl.use-sslv3 = "disable"
    server.document-root = "/var/www/html/piholedashboard/"
  }

  # Redirect HTTP to HTTPS
  $HTTP["scheme"] == "http" {
    $HTTP["host"] =~ ".*" {
      url.redirect = (".*" => "https://%0$0")
    }
  }
}
```

10. Next, edit the `/etc/hosts` file and add the IP address and FQDN of your Pi-hole, for example:
`192.168.1.2   pi.hole`
11. Go back to the Pi-hole UI and nvigate to `Settings > Local DNS > DNS Records` and add entry to resolve `some.server` to the same IP address of your Pi-hole.
12. Next, restart lighttpd by entering `sudo systemctl restart lighttpd`.
13. In a browser, go to http(s)://some.server and the Pi-Hole Daashboard should now be working.

# Install on a seperate server
Note: The web server setup is out of the scope of this guide. You will need to configure a working web server yourself. 
Note: Depending on the hardware this is running on, you will need to configure the `$getTemp` variable in the `includes.php` file with the correct commands to fetch the temperature for your system.
1. Install `php7.3`, `php-curl`, `git` and a web server such as `nginx`.
`
sudo apt-get install php7.3
sudo apt-get install php-curl
sudo apt-get install git
sudo apt-get install nginx
`
2. Copy the code to the location your web server's document root: `git clone https://github.com/obs0lete/PiholeDashboard.git`
3. Log into your Pi-hole (UI) and go to **Settings > API/Web Interface**.
4. Click on the **Show API token** button, then **Yes, show API token**.
5. Copy your **API token**.
6. Edit the **includes.php** and as follows:
    - **$piHole = "";** Set this to your Pi-hole URL. For example, http://pi.hole/admin
    - **$apiKey = ;** Enter your API key here
7. In a browser, access the site.

# Usage
To disable Pi-hole ad-blocking, click on **Disable**. This will disable ad-blocking infinitely.

To (re)enable ad-blocking, click on **Enable**.

You can also specify how long you want to disable ad-blocking for, in minutes. In the text box, enter the amount of minutes you want to disable as-blocking for, then click on the **Disable (mins)** button.
