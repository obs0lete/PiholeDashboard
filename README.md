# PiholeDashboard
A simple web interface to quickly disable Pi-hole ad-blocking and show some basic stats. This was made with dark themes in mind.

![image description](https://raw.githubusercontent.com/obs0lete/PiholeDashboard/master/images/screenshot.png)

# Requirements
- A Pi-hole
- Web server (nginx)
- PHP 7.2
- php-curl

# Getting started
0. Install **PHP 7.2**, **php-curl** and a **websevr (nginx)**.
1. Log into your Pi-hole and go to **Settings > API/Web Interface**.
2. Click on the **Show API token** button, then **Yes, show API token**.
3. Copy your **API token**.
4. Edit the **includes.php** and edit the following:
    - **$piHole = "";** Set this to your Pi-hole URL. For example, http://192.168.1.2/admin
    - **$apiKey = ;** Enter your API key here
5. Launch **index.php**

# Usage
To disable Pi-hole ad-blocking, click on **Disable**. This will disable ad-blocking infinitely.

To (re)enable ad-blocking, click on **Enable**.

You can also specify how long you want to disable ad-blocking for, in minutes. In the text box, enter the amount of minutes you want to disable as-blocking for, then click on the **Disable (mins)** button.