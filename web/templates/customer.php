<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

<div class="container top">
  <div class="row">
    <h1 class="centered headerRow">Schedule your appointment</h1>
  </div>
  <div class="row">
    <div class="col-md-1 col-md-offset-3">
      <span class="glyphicon glyphicon-chevron-left dateNavigate" data-dir="left"></span>
    </div>
    <div class="col-md-4">
        <h1 id="dateHeader">Thurs, Aug 28</h1>
    </div>
    <div class="col-md-1">
      <span class="glyphicon glyphicon-chevron-right dateNavigate" data-dir="right"></span>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="10">10 am</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="11">11 am</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="12">12 pm</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="13">1 pm</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="14">2 pm</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="15">3 pm</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h3 class="selectableTime time" data-hour="16">4 pm</h3>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Confirm Appointment for 
          <span id="appointmentTime"></span>
        </h4>
      </div>
      <form action="/index.php/schedule" method="POST" role="form">
      <div class="modal-body">
          <div class="form-group">
            <label for="nameInput">Name: </label>
            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="emailInput">Email address: </label>
            <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="commentInput">Description: </label>
            <textarea class="form-control" id="commentInput" name="comment" rows="3" placeholder="Description of concerns or topics you would like to discuss during your meeting"></textarea>
          </div>
          <input type="hidden" name="timestamp">
          <input type="hidden" name="daystring">
          <input type="hidden" name="timestring">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Schedule">
      </div>
      </form>
    </div>
  </div>
</div>



<!-- FRAMEWORKS -->
<!-- ********** -->
<!-- ********** -->
<!-- JQuery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
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
<link rel="stylesheet" href="/assets/css/customer.css">
<script src="/assets/js/helper.js"></script>
<script src="/assets/js/customer.js"></script>
<!-- ********** -->
<!-- ********** -->

</body>
</html>
