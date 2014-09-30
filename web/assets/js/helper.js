window.appHelper = {};
appHelper.setDayAndAvail = function(dayDiff) {
  var datestr = moment().add(dayDiff, 'days').format('ddd MMM DD, YYYY');
  var daystring = moment().add(dayDiff, 'days').format(DAYSTRING);
  $('#dateHeader').text(datestr);
  $.get('/index.php/availability/'+daystring, function(res) {
    var bookings = JSON.parse(res);
    $('.time').removeClass('bookedTime');
    for(var i=0;i<bookings.length;i++) {
      var hour = moment(Number(bookings[i])).format('H');
      $('.selectableTime.time[data-hour='+hour+']').addClass('bookedTime');
    }
  });
};
appHelper.getAvailability = function(daystring, cb) {
  $.get('/index.php/availability/'+daystring, function(res) {
    cb(JSON.parse(res));
  });
};
appHelper.getUTCAppointment = function(dayDiff, hour) {
  var utc = moment().hour(Number(hour)).add(dayDiff, 'days')
  utc.set('minute', 0);
  utc.set('second', 0);
  return Number(utc.format('X'));
};
appHelper.getUTCString = function(utc, format) {
  return moment(utc).format(format)
};

