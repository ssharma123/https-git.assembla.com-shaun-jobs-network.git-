'use strict';

/* Directives */
// Directives create custom tags in HTML that can be easily reused with Angular.

angular.module('myApp.directives', [])


  .directive('appVersion', ['version', function(version) {
    return function(scope, elm, attrs) {
      elm.text(version);
    };
  }])

  .directive('inputMiles', function () {
    return {
        require: 'ngModel',
        link: function(elem, $scope, attrs, ngModel){
            ngModel.$formatters.push(function(val){
                return val + " miles";
            });
            ngModel.$parsers.push(function(val){
                return val.replace(/^ miles/, '')
            });
        }
    }
})
