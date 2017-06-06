$(function () {

    var DynamicPhone = (function () {

        var dynamicCookie = $.cookie('dynamic_phone');

        var init = function () {
            if (dynamicCookie) {
                // Cookie exists, inject it only
                injectNumber(dynamicCookie);
            } else {
                $.ajax({
                    url: '/api/dynamicnumbers/numbers',
                    type: 'POST',
                    data: {},
                    success: function(data) {

                        var phone = determineNumber(data);
                        var cookieExpiration = data.cookieExpiration; // in days

                        var date = new Date();
                        date.setTime(date.getTime()+(cookieExpiration * 24 * 60 * 60 * 1000));

                        // Inject and store cookie
                        injectNumber(phone);
                        $.cookie('dynamic_phone', phone, { expires: date });
                    }
                });
            }
        };

        var determineNumber = function (data) {
            var defaultPhone = data.default;''
            var numbers = data.phones;

            var path = getPath();
            var query = getQuery();

            var score = 0;
            var phone;

            if (numbers.length > 0) {

                // Loop through each number
                $.each(numbers, function (key, obj) {

                    var currentPhone = obj.phone;
                    var parameters = obj.parameters;
                    var urls = obj.urls;

                    var currentScore = 0;
                    var matchesUrl = false;

                    // Search Parameters
                    if (query.length > 0) {
                        $.each(query, function (key, value) {

                            // Compare parameters
                            if(parameters.hasOwnProperty(value[0])) {
                                var paramValue = parameters[value[0]];
                                if(paramValue == value[1]) {
                                    currentScore += 1;
                                }
                            }
                        });
                    }

                    // Search Urls
                    if (urls.length > 0) {
                        $.each(urls, function (key, rule) {
                            var regex = new RegExp("^" + rule.split("*").join(".*") + "$").test(path);

                            if (regex) {
                                matchesUrl = true;
                                currentScore += 1;
                                return false;
                            }

                        });
                    } else {
                        // If no urls are specified, then accept all url paths.
                        matchesUrl = true;
                    }

                    // Compare scores
                    if (currentScore > score && matchesUrl) {
                        score = currentScore;
                        phone = currentPhone;
                    }

                });
            }

            // There wasn't a matching phone
            if (typeof phone == 'undefined') {
                phone = defaultPhone;
            }

            return phone;
        };

        var getPath = function () {
            return window.location.pathname;
        };

        var getQuery = function () {
            var queryString = (window.location.search.substring(1)).split('&');
            var query = [];

            // Build query array.
            if (queryString.length > 0) {
                for (var i = 0; i < queryString.length; i++) {
                    var param = queryString[i].split('=');
                    query.push(param);
                }
            }

            return query;
        };

        var injectNumber = function (phone) {
            var $call = $('.dynamic-number');

            if ($call.length > 0) {
                // Inject href
                $call.attr("href", "tel:" + phone);
                // Change value
                $call.html('<span class="dynamic-phone-inner">' + phone.replace(/(\d{3})\-?(\d{3})\-?(\d{4})/, '($1) $2-$3') + '</span>');
            }
        };

        return {
            init: init
        }

    })();

    DynamicPhone.init();

});
