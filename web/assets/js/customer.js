var dayDiff = 0,
    DAYSTRING = 'dddMMMDDYYYY';

function setDayAndAvail() {
  var datestr = moment().add(dayDiff, 'days').format('ddd MMM DD, YYYY');
  var daystring = moment().add(dayDiff, 'days').format(DAYSTRING);
  $('#dateHeader').text(datestr);
  appHelper.getAvailability(daystring, function(bookings) {
    $('.time').addClass('selectableTime');
    for(var i=0;i<bookings.length;i++) {
      var hour = moment(Number(bookings[i])).format('H');
      $('.selectableTime.time[data-hour='+hour+']').removeClass('selectableTime');
    }
  });
}
$('.dateNavigate').click(function() {
  var currentUTC = Number(moment().hour(0).minute(0).second(0).format('X'));
  dayDiff = $(this).data('dir') === 'left' ? dayDiff - 1 : dayDiff + 1;
  if(appHelper.getUTCAppointment(dayDiff, 0) < currentUTC) dayDiff = dayDiff + 1;
  setDayAndAvail();
});

$('.time').click(function() {
  if(!$(this).hasClass('selectableTime')) return;
  var utc = appHelper.getUTCAppointment(dayDiff, $(this).data('hour'))*1000;
  var timestring = appHelper.getUTCString(utc, 'ddd MMM DD, YYYY') + ' at ' + appHelper.getUTCString(utc, 'hA');
  $('#appointmentTime').text(timestring);

  // set input fields hidden
  $('input[name=timestamp]').val(utc);
  $('input[name=daystring]').val(appHelper.getUTCString(utc, DAYSTRING));
  $('input[name=timestring]').val(timestring);
  $('#myModal').modal('show');
});

setDayAndAvail();

