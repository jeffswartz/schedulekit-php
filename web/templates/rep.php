<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

  <div id="leftContainer">
    <span class="glyphicon glyphicon-chevron-left dateNavigate" data-dir="left"></span>
    <h1 id="dateHeader">Thurs, Aug 28</h1>
    <span class="glyphicon glyphicon-chevron-right dateNavigate" data-dir="right"></span>


    <h3 class="selectableTime time" data-hour="10">10 am</h3>
    <h3 class="selectableTime time" data-hour="11">11 am</h3>
    <h3 class="selectableTime time" data-hour="12">12 pm</h3>
    <h3 class="selectableTime time" data-hour="13">1 pm</h3>
    <h3 class="selectableTime time" data-hour="14">2 pm</h3>
    <h3 class="selectableTime time" data-hour="15">3 pm</h3>
    <h3 class="selectableTime time" data-hour="16">4 pm</h3>

  </div>

  <div id="rightContainer">
    <div id="userValueContainer">
      <h1 class="userValue">Please select an appointment</h1>
    </div>
  </div>


<!-- Templating -->
<!-- ********** -->
<!-- ********** -->
<script id="user_value_template" type="text/x-handlebars-template">
  <div id="userValueContainer">
  <div class="userValue">
    <h1 id="timeValue">{{Timestring}}</h1>
  </div>
  <div class="userValue">
    <span class="header">Name: </span>
    <span id="customerName">{{Name}}</span>
  </div>
  <div class="userValue">
    <span class="header">Email: </span>
    <span id="customerEmail">{{Email}}</span>
  </div>
  <div class="userValue">
    <span class="header">Comments: </span>
    <span id="customerComments">{{Comment}}</span>
  </div>
  <div class="userValue">
    <button type="button" id="startButton" class="btn btn-success actionButton">Start Appointment</button>
    <button type="button" id="cancelButton" class="btn btn-danger actionButton">Cancel Appointment</button>
  </div>
  </div>
</script>
<script id="no_appointment_template" type="text/x-handlebars-template">
  <div id="userValueContainer">
  <div class="userValue">
    <h1 id="timeValue">No Appointments on {{timestring}}</h1>
  </div>
  </div>
</script>
<script id="chatting_template" type="text/x-handlebars-template">
    <button type="button" id="stopAppointment" class="btn btn-danger actionButton">Stop Chatting</button>
    <iframe src="{{url}}" id="chatPage" frameborder="0" width="100%" height="98%"></iframe>
</script>
<!-- end -->
<!-- ********** -->
<!-- ********** -->


<!-- FRAMEWORKS -->
<!-- ********** -->
<!-- ********** -->
<!-- JQuery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- Handlebars -->
<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0-alpha.4/handlebars.js"></script>
<!-- Moment: date lib -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment-with-locales.min.js"></script>
<!-- Bootstrap 3.2.0 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Optional theme for Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript for Bootstrap-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- end -->
<!-- ********** -->
<!-- ********** -->


<!-- JS and CSS -->
<!-- ********** -->
<!-- ********** -->
<link rel="stylesheet" href="/assets/css/rep.css">
<script src="/assets/js/helper.js"></script>
<script src="/assets/js/rep.js"></script>
<!-- ********** -->
<!-- ********** -->

</body>
</html>
