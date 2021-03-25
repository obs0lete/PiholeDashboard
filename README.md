# PiholeDashboard
A simple web interface to quickly disable Pi-hole ad-blocking and show some basic stats. This was made with dark themes in mind.

![image description](https://raw.githubusercontent.com/obs0lete/PiholeDashboard/master/images/screenshot.png)

# Requirements
- A working Pi-hole installation. See https://pi-hole.net/
- Raspberry Pi (this should work on other devices, but you'll need to adjust how the temperature and uptime stats are fetched for your device in the `includes.php` file for your respecitve system)
- Web server
- PHP 7.2
- php-curl
- git

# Getting started
1. Install **PHP 7.2**, **php-curl**, **git** and a **web server**.
2. Log into your Pi-hole and go to **Settings > API/Web Interface**.
3. Click on the **Show API token** button, then **Yes, show API token**.
4. Copy your **API token**.
5. Copy the code to your machine: `git clone https://github.com/obs0lete/PiholeDashboard.git`
6. Edit the **includes.php** and edit the following:
    - **$piHole = "";** Set this to your Pi-hole URL. For example, http://192.168.1.2/admin
    - **$apiKey = ;** Enter your API key here
7. In a console, type `sudo usermod -aG video www-data`. This is needed to fetch temperature data on the Raspberry Pi.
8. Reboot the Raspberry Pi.
9. Launch **index.php**

# Usage
To disable Pi-hole ad-blocking, click on **Disable**. This will disable ad-blocking infinitely.

To (re)enable ad-blocking, click on **Enable**.

You can also specify how long you want to disable ad-blocking for, in minutes. In the text box, enter the amount of minutes you want to disable as-blocking for, then click on the **Disable (mins)** button.