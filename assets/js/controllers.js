'use strict';

/* Controllers */

angular.module('myApp.controllers', [])

   // Login controller. Provided by the app seed.
   .controller('LoginCtrl', ['$scope', 'loginService', '$location', '$rootScope', 
      function($scope, loginService, $location, $rootScope) {
      $scope.email = null;
      $scope.pass = null;
      $scope.confirm = null;
      $scope.createMode = false;

      $scope.login = function(cb) {
         $scope.err = null;
         if( !$scope.email ) {
            $scope.err = 'Please enter an email address';
         }
         else if( !$scope.pass ) {
            $scope.err = 'Please enter a password';
         }
         else {
            loginService.login($scope.email, $scope.pass, function(err, user) {
             $scope.err = err? "Please check your login credentials!" : null;

             // Only if logged in properly.
             if(!$scope.err)
             {
							 //$rootScope.loginDone = true;
               $rootScope.$apply(function() {

                   $location.path("/profile");
                 });
             }

            });
         }
      };

      function assertValidLoginAttempt() {
         if( !$scope.email ) {
            $scope.err = 'Please enter an email address';
         }
         else if( !$scope.pass ) {
            $scope.err = 'Please enter a password';
         }
         else if( $scope.pass !== $scope.confirm ) {
            $scope.err = 'Passwords do not match';
         }
         return !$scope.err;
      }
   }])

  .controller('EnforceEmployerTheme', ['$rootScope', function($rootScope){

    $rootScope.mode = 'employer';

  }])

  .controller('ContactFormCtrl', ['$scope', function($scope){

    $scope.name = null;
    $scope.phone = null;
    $scope.email = null;
    $scope.message = null;

    $scope.sendMessage = function() {

      console.log("Attempting to send message.");

      if(!$scope.name)
        return;

      if(!$scope.email)
        return;

      if(!$scope.message)
        return;

      // Send email via Mailgun?
      Parse.Cloud.run('sendFeedbackEmail', { name: $scope.name, email: $scope.email, phone: $scope.phone, message: $scope.message });

      console.log("Sent message!");

      $scope.name = null;
      $scope.phone = null;
      $scope.email = null;
      $scope.message = null;

      alert("Thank You!");

    }

  }])


function escapeEmail(email)
  {
      return email.split(".").join(",");
  }
