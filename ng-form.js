var app = angular.module('App', []);

app.directive('overwriteEmail', function() {
    var EMAIL_REGEXP = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

    return{
        require: 'ngModel',
        restrict: 'A',
        link: function(scope, elm, attrs, ctrl) {
            // only apply the validator if ngModel is present and Angular has added the email validator
            if (ctrl && ctrl.$validators.email) {

                // this will overwrite the default Angular email validator
                ctrl.$validators.email = function(modelValue) {

                    if (!ctrl.$isEmpty(modelValue)) {
                        return EMAIL_REGEXP.test(modelValue);
                    }
                };
            }
        }
    }
});


app.directive('phonenumber', function() {
    var PHONE_REGEXP = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;
    return{
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            ctrl.$validators.phonenumber = function(modelValue, viewValue) {
                if (ctrl.$isEmpty(modelValue)) {
                    // consider empty models to be valid
                    return true;
                }

                if (PHONE_REGEXP.test(viewValue)) {
                    // it is valid
                    return true;
                }

                // it is invalid
                return false;
            };
        }
    }

});

app.factory('MyFactory', function($http) {
    return {
        saveRequest: function(data) {
            return $http.post(baseUrl + 'request_quotes/send_request_quote', data);
        },
        getServerType: function() {
            return $http.get(baseUrl + 'getservertypes');
        },
        sendContactUs: function(data) {
            // console.log(data);
            return $http.post(baseUrl + 'send-contact-us-req', data);
        },
        getAboutUsList: function() {
            // console.log(data);
            return $http.post(baseUrl + 'getAboutUsList');
        },
        registerEvent: function(data) {
            // console.log(data);
            return $http.post(baseUrl + 'event_registrations/register_event', data);
        },
        registerforIec:function(data) {
            console.log(data);
            return $http.post(baseUrl + 'iec_registrations/register', data);
        },
        gitexInviteReg:function(data) {
            console.log(data);
            return $http.post(baseUrl + 'gitex_invites/register', data);
        }
    }

});

app.controller('RequestQuoteController', function($scope, MyFactory) {

    $scope.handleform = function() {
        if (!$scope.form.$valid) {
            return false;
        }
        MyFactory.saveRequest($scope.rq)
            .success(function(data, status, headers, config) {
                if (data.status == 'fail') {
                    if (data.error.captcha.length) {
                        $scope.form.captcha.$error.required = true;
                    }
                }

                if (data.status == 'success') {
                    $scope.rq = {};
                    $scope.formsentsuccessfully = true;
                    $scope.submitted = false;
                    window.location.href = baseUrl + 'thank-you'
                }
                // console.log(data);
            })
            .error(function(data, status, headers, config) {

            });

    }

});

app.controller('ContactUsController', function($scope, MyFactory) {

    $scope.cu = {};

    $scope.$watch('cu.server_type_id', function(newValue, oldValue) {
        if (newValue === null) {
            $scope.form.server_type_id.$error.required = true;
        } else {
            $scope.form.server_type_id.$error.required = false;
        }
    });

    MyFactory.getServerType()
        .success(function(data, status, headers, config) {
            $scope.server_types = data.data;
            //console.log(data.data);

        })
        .error(function(data, status, headers, config) {

        });


    $scope.submitform = function() {

        if ($scope.cu.server_type_id == null || $scope.cu.server_type_id == 'undefined') {
            $scope.form.server_type_id.$error.required = true;
        } else {
            $scope.form.server_type_id.$error.required = false;
        }

        if (!$scope.form.$valid) {
            return false;
        }

        $scope.cu.server_type_id = $scope.cu.server_type_id.id;
        MyFactory.sendContactUs($scope.cu)
            .success(function(data, status, headers, config) {
                if (data.status == 'success') {
                    $scope.cu = {};
                    $scope.formsentsuccessfully = true;
                    $scope.submitted = false;
                    window.location.href = baseUrl + 'thank-you'
                }
                if (data.status == 'fail') {
                    if (data.error.captcha.length) {
                        $scope.form.captcha.$error.required = true;
                    }
                }

            })
            .error(function(data, status, headers, config) {

            });

    }

});


app.controller('EventRegController', function($scope, MyFactory) {

    $scope.eventReg = {};

    $scope.$watch('eventReg.about_us_id', function(newValue, oldValue) {
        if (newValue === null) {
            $scope.form.about_us_id.$error.required = true;
        } else {
            $scope.form.about_us_id.$error.required = false;
        }
    });

    MyFactory.getAboutUsList()
        .success(function(data, status, headers, config) {
            $scope.about_us_masters = data.data;
            //console.log(data.data);

        })
        .error(function(data, status, headers, config) {

        });


    $scope.submitform = function() {

        if ($scope.eventReg.about_us_id == null || $scope.eventReg.about_us_id == 'undefined') {
            $scope.form.about_us_id.$error.required = true;
        } else {
            $scope.form.about_us_id.$error.required = false;
        }

        if (!$scope.form.$valid) {
            return false;
        }
        //console.log($scope.eventReg.about_us_id.id);return false;
        $scope.eventReg.about_us_id = $scope.eventReg.about_us_id.id;
        MyFactory.registerEvent($scope.eventReg)
            .success(function(data, status, headers, config) {
                if (data.status == 'success') {
                    $scope.eventReg = {};
                    $scope.formsentsuccessfully = true;
                    $scope.submitted = false;
                    window.location.href = baseUrl + 'thank-you-event'
                }
                if (data.status == 'fail') {
                    if (data.error.captcha.length) {
                        $scope.form.captcha.$error.required = true;
                    }
                }
            })
            .error(function(data, status, headers, config) {

            });

    }
});



app.controller('IecRegiController', function($scope, MyFactory) {

    $scope.iecReg = {};

    $scope.submitform = function() {

        if (!$scope.form.$valid) {
            return false;
        }

        MyFactory.registerforIec($scope.iecReg)
            .success(function(data, status, headers, config) {
                if (data.status == 'success') {
                    $scope.iecReg = {};
                    $scope.submitted = false;
                    window.location.href = baseUrl + 'thank-you-for-iec-registration'
                }
                if (data.status == 'fail') {
                    if (data.error.captcha.length) {
                        $scope.form.captcha.$error.required = true;
                    }
                }
            })
            .error(function(data, status, headers, config) {

            });

    }
});

app.controller('GitexInvitesController', function($scope, MyFactory) {

    $scope.gitexInvite = {};

    $scope.submitform = function() {

        if (!$scope.form.$valid) {
            return false;
        }

        MyFactory.gitexInviteReg($scope.gitexInvite)
            .success(function(data, status, headers, config) {
                if (data.status == 'success') {
                    $scope.gitexInvite = {};
                    $scope.formsentsuccessfully = true;
                    $scope.submitted = false;
                    window.location.href = baseUrl + 'thank-you-for-iec-registration'
                }
                if (data.status == 'fail') {
                    if (data.error.captcha.length) {
                        $scope.form.captcha.$error.required = true;
                    }
                }
            })
            .error(function(data, status, headers, config) {

            });

    }
});