# OpenTok Scheduling Starter Kit

An OpenTok 1-to-1 solution focussed on call scheduling


## Installation

1. Clone the repository.
2. Rename   `config.ini.sample` to `config.ini` and configure your credentials.
2. Set the `OPENTOK_KEY` and `OPENTOK_SECRET` variables in `config.ini` to your OpenTok API key and
   secret values from the [TokBox Dashboard](https://dashboard.tokbox.com).
3. Set the `MYSQL_URL` environment variable with your MySQL database URL in `config.ini`. The format is
   `mysql://username:password@mysqlurl:port/database_name`
3. This app requires your email credentials to send emails to customers notifying them about their appointments. Set `GMAIL_USER` and `GMAIL_PW` in `config.ini`
4. Install [Composer](https://getcomposer.org/).
5. Use Composer to install dependencies: `composer install`
6. Set the document root for your web server (such as Apache, nginx, etc.) to the `web` directory
   of this project. In the case of Apache, the provided `.htaccess` file handles URL rewriting.
   See the [Slim Route URL Rewriting Guide](http://docs.slimframework.com/#Route-URL-Rewriting)
   for more details.

## Usage

### Customer

1. Visit the URL mapped to the application by your web server. `tbschedule.com:8888`
2. Select an appointment time and fill in your information. You should then get an email confirming
   your appointment.
3. At the time of your appointment, join the chatroom.

### Representative
1. Have another user (possibly in another window or tab) visit `/rep` URL to be the rep.
2. The representative has the ability to click through and view different appointment.
3. The representative selects an appointment and calls customer

## Requirements

* PHP
* MySQL
* Email account

## Code and Conceptual Walkthrough

### Server

* All server code is located in `index.php`.
* `index.php` starts off by creating and connecting to the database and table required for the app.
* Schedule table:
  * Name -- the customer's name
  * Email -- the customer's email address, used to send appointment confirmation and cancellations
  * Comment -- The customer's comment about the things he/she would like to talk to the rep about
  * Timestamp -- A timestamp of the customer's appointment time
  * Daystring -- A string representing the day of the appointment, used to look up the availability
    on that day
  * Sessionid - The OpenTok session ID that both the customer and the representative connect to at
    the time of the appointment
  * Timestring - The appointment time in a human readable format
* All end points are created in `index.php`

### Customer
* The customer starts by going to the root url and `index.php` will render `templates/customer.php`
* `customer.php` is a simple HTML of the customer page:
  * The page shows a list of appointment times for that day.
  * When the customer clicks on an appointment, a form prompts for the customer's information.
* All styling is located in `assets/css/customer.css`
* `assets/js/customer.js` contains the JavaScript that manages the customer's interaction with
  the page.
  * The arrows on the page, which use the class `dateNavigate`, help customers navigate through the
    different dates. Whenever customer clicks on `.dateNavigate`, the JavaScript first computes the
    offset (`dayDiff`) from current time and then calls the `setDayAndAvail()` function.
  * `setDayAndAvail()` computes the `daystring` value and sends a request to the server at the
    `/availability/:daystring` endpoint in `index.php` to get a list of unavailable appointments.
    * `index.php` then queries the table for all appointment timestamps in the table that have the
      same `daystring` value and returns the array as JSON.
    * When the response from server is received, all unavailable dates are blacked out by removing
      the 'selectableTime' class
  * When user clicks on an available time (which have the `time` class), the form is shown for user
    to input information. The form data is submitted to the server at the `/schedule` endpoint.
    * When `index.php` gets the POST request, it generates an OpenTok ID, stores it along with the
      customer's information in the table, and sends the customer an email to confirm the
      appointment. It then sends the customer to `templates/schedule.php`, which is a simple
      appointment confirmed page.
* At the time of the appointment, the customer would click the link in the email to navigate to
  `/chat/:session_id` endpoint defined in `index.php`.
  * When the customer enters the chatroom, `index.php` retrieves the OpenTok session ID from the
    URL, generates a valid token for that session ID, and renders `templates/chat.php`.
  * `chat.php` shows the chatroom. It connects to the OpenTok session, publishes video to the
    session, and subscribes to videos in the session.

### Representative
* The representative starts by going to `/rep`, which is an endpoint defined in `index.php`, and
  renders `templates/rep.php`.
* `rep.php` is a simple HTML of the representative page.
  * The page has a sidebar that shows a list of appointment times for that day and an area to
    display information about that appointment and allows the representative to video chat with
    the customer.
* All styling is located in `assets/css/rep.css`
* `assets/js/rep.js` contains the JavaScript that manages the customer's interaction with the page
  * Like the customer page, the arrows on the sidebar has class `dateNavigate` and help reps
    navigate through the different dates. Whenever representative clicks `.dateNavigate`, the
    JavaScript computes the offset (`dayDiff`) from the current time and calls the
    `setDayAndAvail()` function.
  * `setDayAndAvail()` computes the `daystring` and sends a request to the server at the
    `/availability/:daystring` endpoint in `index.php` to get a list of unavailable appointments.
    * `index.php` then queries the table for all appointments' timestamp with the same `daystring`
       value and returns the array as JSON.
    * When the response from server is received, the class `bookedTime` is added to all booked
      dates, which highlights them to indicate when there is an appointment booked.
  * When the representative clicks  a time, a request is sent to `index.php` at the
    `/getinfo/:timestamp` endpoint.
    * `index.php` then queries the table and retrieves the customer information for that time and
      returns a JSON response with the customer's information.
    * When the response is received, the customer's information is displayed on the page. If the
      current time is within an hour of the appointment time, a `start chat` button appears.
* At the time of the appointment, the representative clicks the appointment time and the start chat
  button. The main view is replaced with an iframe of the same chatroom that the customer would see.
* If the representative clicks the cancel appointment button, a request is sent to `index.php` at
  the `/cancel/:timestamp` endpoint.
  * `index.php` will look up that timestamp, retrieve the customer information, delete that row in
    the table, and send an email to the customer indicating that the appointment has been canceled.


## Appendix

### Deploying to Heroku

Heroku is a PaaS (Platform as a Service) that can use to deploy simple and small applications for
free. For that reason, you may choose to experiment with this code and deploy it using
Heroku.

*  The provided `Procfile` describes a web process that launches this application.
*  This application needs MYSQL to run. Follow [heroku addons:add cleardb:ignite](these instructions) to install ClearDB addon for heroku to get MYSQL
*  Use Heroku config to set the following keys:
   -  `OPENTOK_KEY` - Your OpenTok API Key
   -  `OPENTOK_SECRET` - Your OpenTok API Secret
   -  `MYSQL_URL` - Your ClearDB url when you added the addon
      the [ClearDB add-on](https://devcenter.heroku.com/articles/cleardb) for Heroku.
   -  `GMAIL_USER` - Set this to your gmail username to send instructions to user
   -  `GMAIL_PW` - Set this to your gmail password to send instructions to user
