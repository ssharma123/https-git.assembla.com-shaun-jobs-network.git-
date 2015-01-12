
angular.module('myApp.service.login', [])

   .factory('loginService', ['$rootScope', '$timeout', '$location', 
      function($rootScope, $timeout, $location) {
         var auth = null;

         return {
            init: function() {
               return auth = Parse.User;  // Login using Parse.
               console.log("Login Init called");
               //auth.user = Parse.User.current();
            },

            /**
             * @param {string} email
             * @param {string} pass
             * @param {Function} [callback]
             * @returns {*}
             */
            login: function(email, pass, callback) {

              console.log("Login called with: " + email + ", callback: " + callback);
               // Login using parse.
               Parse.User.logIn(email, pass, {
                  success: function(user) {
                    // Do stuff after successful login.
                    console.log("Login successful!");
                    $rootScope.$broadcast("loginService:login", user);
                    //auth.user = Parse.User.current();

                    if( callback ) {
                        callback(null, user);
                     }
                  },
                  error: function(user, error) {
                    // The login failed. Check error to see why.
                    console.log("Login failed: " + JSON.stringify(error));
                    //auth.user = Parse.User.current();
                    $rootScope.$broadcast("loginService:error");

                    if(callback)
                    {
                      callback(error, user);
                    }
                  }
                });
            },

            logout: function() {

               // Logout using parse.
               console.log("Logout called.");
               Parse.User.logOut();
               //auth.user = Parse.User.current();
               $rootScope.$broadcast("loginService:logout");
            },

         };

      }]);