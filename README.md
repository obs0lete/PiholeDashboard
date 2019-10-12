# PiholeDashboard
A web interface to show quick stats from Pi-hole and allow a user to disable it.

![image description](https://raw.githubusercontent.com/obs0lete/PiholeDashboard/master/images/screenshot.png)

# Requirements:
- A Pi-hole
- Web server (nginx)
- PHP 7.2
- php-curl

# Getting started
0. Install PHP 7.2, php-curl and a websevr (nginx).
1. Log into your Pi-hole and go to **Settings > API/Web Interface**.
2. Click on the **Show API token** button, then **Yes, show API token**.
3. Copy your **API token**.
4. Edit the **includes.php** and edit the following:
    - **$piHole = "";** Set this to your Pi-hole URL. For example, http://192.168.1.2/admin
    - **$apiKey = ;** Enter your API key here
5. Launch **index.php**

# To-do:
- Better setup guide
- Code clean-up