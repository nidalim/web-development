/*********************************************************************
 * #### jQuery htmlfromrss.js V.0.001 ####
 * Coded by Ican Bachors 2016.
 * http://ibacor.com/labs/htmlfromrssjs
 * Updates will be posted to this site.
 *********************************************************************/

$.fn.htmlfromrss = function(f) {
    $(this).each(function(i, a) {
        $(this).html('<div class="htmlfromrss"><ul id="htmlfromrss' + i + '"></ul></div>');
        rsstohtml('SELECT channel.item, channel.title FROM feednormalizer WHERE url ="' + $(this).data('htmlfromrss') + '"', i)
    });

    function rsstohtml(d, i) {
        $.ajax({
            url: 'https://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(d) + '&format=json&diagnostics=false&callback=?',
            crossDomain: true,
            dataType: 'json'
        }).done(function(c) {
            var s = "";
            $.each(c.query.results.rss, function(e, a) {
                if (e < f) {
                    var b = a.channel.item.pubDate,
                        g = a.channel.title,
                        desk = prevedi_u_lat(zameni_u_lat(a.channel.item.description));
                    s += '<li><div class="title"><a href="' + a.channel.item.link + '" target="_BLANK" >' + prevedi_u_lat(zameni_u_lat(a.channel.item.title)) + '</a></div>';
                    s += (b != null && b != undefined ? '<div class="date">' + prevedi_u_lat(zameni_u_lat(relative_time(b))) + ' na ' + '<span>' + prevedi_u_lat(zameni_u_lat(a.channel.title.toUpperCase())) + '</span>' + '</div>' : '');
                    s += (desk != null && desk != undefined ? '<div class="post">' + desk.replace('align="left"', '') + '</div>' : '')
                }
            });
            $('.htmlfromrss ul#htmlfromrss' + i).html(s)
        })
    }

    function relative_time(x) {
        if (!x) {
            return
        }
        var a = x;
        a = $.trim(a);
        a = a.replace(/\.\d\d\d+/, "");
        a = a.replace(/-/, "/").replace(/-/, "/");
        a = a.replace(/T/, " ").replace(/Z/, " UTC");
        a = a.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2");
        var b = new Date(a);
        var c = (arguments.length > 1) ? arguments[1] : new Date();
        var d = parseInt((c.getTime() - b) / 1000);
        d = (d < 2) ? 2 : d;
        var r = '';
        if (d < 60) {
            r = 'Članak upravo objavljen '
        } else if (d < 120) {
            r = 'Članak objavljen pre jedan minut '
        } else if (d < (45 * 60)) {
            r = 'Članak objavljen pre ' + (parseInt(d / 60, 10)).toString() + ' minuta '
        } else if (d < (2 * 60 * 60)) {
            r = 'Članak objavljen pre sat vremena '
        } else if (d < (24 * 60 * 60)) {
            r = 'Članak objavljen pre ' + (parseInt(d / 3600, 10)).toString() + ' časova '
        } else if (d < (48 * 60 * 60)) {
            r = 'Članak objavljen pre jedan dan '
        } else {
            r = 'Članak objavljen pre ' + (parseInt(d / 86400, 10)).toString() + ' dana '
        }
        return (r.match('NaN') ? x : r)
    }
}
