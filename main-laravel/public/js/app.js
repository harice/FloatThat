App = {
    init: function() {
        App.convertTimezones();
    },

    convertTimezones: function() {
        $.each($("time"), function() {
            var time = $(this).attr("datetime");
            var format = $(this).data("format");
            var timezone = jstz.determine();

            console.debug(timezone.name());
            format = format ? format : "LL";

            console.debug('original: ' + time);
            time = moment.tz(time, "UTC");
            time = moment().tz(timezone.name());
            time = time.format(format);
            console.debug('converted: ' + time);


            $(this).text(time);
        });
    }
};

$(document).ready(function() {
    App.init();
});
