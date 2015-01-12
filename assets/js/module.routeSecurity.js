(function(angular) {
   angular.module('routeSecurity', [])
      .run(['$injector', '$location', '$rootScope', 'loginRedirectPath', function($injector, $location, $rootScope, loginRedirectPath) {
         if( $injector.has('$route') ) {
            new RouteSecurityManager($location, $rootScope, $injector.get('$route'), loginRedirectPath);
         }
      }]);

   function RouteSecurityManager($location, $rootScope, $route, path) {
      this._route = $route;
      this._location = $location;
      this._rootScope = $rootScope;
      this._loginPath = path;
      this._redirectTo = null;
      this._authenticated = false;
      this._init();
   }

   RouteSecurityManager.prototype = {
      _init: function() {
         var self = this;
         this._checkCurrent();

         // Set up a handler for all future route changes, so we can check
         // if authentication is required.
         self._rootScope.$on("$routeChangeStart", function(e, next) {
            self._authRequiredRedirect(next, self._loginPath);
         });

         // Bind this to Parse login!
         self._rootScope.$on('loginService:login', angular.bind(this, this._login));
         self._rootScope.$on('loginService:logout', angular.bind(this, this._logout));
         self._rootScope.$on('loginService:error', angular.bind(this, this._error));
      },

      _checkCurrent: function() {
         // Check if the current page requires authentication.
         if (this._route.current) {
            this._authRequiredRedirect(this._route.current, this._loginPath);
         }
      },

      _login: function() {

         console.log("Route Security received 'login'");

         this._authenticated = true;
         if( this._redirectTo ) {
            this._redirect(this._redirectTo);
            this._redirectTo = null;
         }
         else if( this._location.path() === this._loginPath ) {
            this._location.replace();
            // Go to this app location by default.
            this._location.path('/dashboard');
         }
      },

      _logout: function() {

         console.log("Route Security received 'logout'");

         this._authenticated = false;
         //this._checkCurrent();

         this._location.path('/home');

      },

      _error: function() {

         console.log("Route Security received 'error'");

         this._authenticated = false;
         /*
         if( !this._rootScope.auth || !this._rootScope.auth.user ) {
            this._authenticated = false;
         }
         */

         if(this._rootScope.mode == 'employer')
         {
            this._location.path('loginEmployer');
         }
         else
         {
            this._checkCurrent();
         }
      },

      _redirect: function(path) {
         this._location.replace();
         this._location.path(path);
      },

      // A function to check whether the current path requires authentication,
      // and if so, whether a redirect to a login page is needed.
      _authRequiredRedirect: function(route, path) {

         var _authenticated = Parse.User.current();
         if (route.authRequired && !_authenticated){
            if (route.pathTo === undefined) {
               this._redirectTo = this._location.path();
            } else {
               this._redirectTo = route.pathTo === path ? "/" : route.pathTo;
            }
            console.log("routeSecurity redirect: " + path);
            this._redirect(path);
         }
         else if( _authenticated && this._location.path() === this._loginPath ) {
            console.log("routeSecurity redirect B: Going to login page when logged in.. Redirect to dashboard.");
            this._redirect('/dashboard');
         }
      }
   };
})(angular);
