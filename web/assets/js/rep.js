var dayDiff = 0,
    DAYSTRING = "dddMMMDDYYYY",
    ONE_HOUR = 3600000;

// Templates
var user_template = Handlebars.compile($("#user_value_template").html()),
    no_appointment_template = Handlebars.compile($("#no_appointment_template").html()),
    chatting_template = Handlebars.compile($("#chatting_template").html());

function setDayAndAvail() {
  var datestr = moment().add(dayDiff, 'days').format('ddd MMM DD, YYYY');
  var daystring = moment().add(dayDiff, 'days').format(DAYSTRING);
  $("#dateHeader").text(datestr);
  appHelper.getAvailability(daystring, function(bookings) {
    $(".time").removeClass('bookedTime');
    for(var i=0;i<bookings.length;i++) {
      var hour = moment(Number(bookings[i])).format('H');
      $(".selectableTime.time[data-hour="+hour+"]").addClass('bookedTime');
    }
  });
}

$(".dateNavigate").click(function() {
  dayDiff = $(this).data('dir') === "left" ? dayDiff - 1 : dayDiff + 1;
  setDayAndAvail();
});

$(".time").click(function() {
  if(!$(this).hasClass("selectableTime")) return;
  var utc = appHelper.getUTCAppointment(dayDiff, $(this).data('hour'))*1000;
  var timestring = appHelper.getUTCString(utc, "ddd MMM DD, YYYY") + " at " + appHelper.getUTCString(utc, "hA");

  $.get("/index.php/getinfo/"+utc, function(res) {
    var info = JSON.parse(res);
    if(info) {
      $("#rightContainer").html(user_template(info));

      if(Math.abs(Number(info.Timestamp) - Date.now()) >= ONE_HOUR) {

        // appointment is too far away or has passed
        $("#rightContainer #startButton").hide();
      }

      $("#startButton").click(function() {
        startAppointment(info);
      });
      $("#cancelButton").click(function() {
        if(window.confirm("are you sure you want to cancel this appointment?")) {
          $.get("/index.php/cancel/"+utc, function(res) {
            location.reload();
          });
        }
      });
    }else{
      $("#rightContainer").html(no_appointment_template({timestring: timestring}));
    }
  });
});

function startAppointment(info) {
  info.url = location.protocol + "//" + location.host + "/index.php/chat/" + info.Sessionid;
  $("#rightContainer").html(chatting_template(info));
  $("#stopAppointment").click(function() {
    if(window.confirm("stop chatting?")) {
      location.reload();
    }
  });
}

setDayAndAvail();

