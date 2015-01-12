"use strict";

angular.module('myApp.routes', ['ngRoute'])

   // configure views; the authRequired parameter is used for specifying pages
   // which should only be available while logged in

   // Routes link specific paths in the app to controllers and views.
   // http://docs.angularjs.org/tutorial/step_07

   .config(['$routeProvider', function($routeProvider) {
      $routeProvider.when('/home', {
         templateUrl: 'partials/home.html',
         controller: 'HomeCtrl'
      });
      
      $routeProvider.when('/sampleMatches', {
         templateUrl: 'partials/sample-matches.html'
      });
			
			$routeProvider.when('/profile', {
				authRequired: true,
         templateUrl: 'partials/profile.html'
      });
			
			$routeProvider.when('/matches', {
				authRequired: true,
         templateUrl: 'partials/matches.html'
      });
			
			$routeProvider.when('/status', {
				authRequired: true,
         templateUrl: 'partials/status.html'
      });	
			
			$routeProvider.when('/settings', {
				authRequired: true,
         templateUrl: 'partials/settings.html'
      });	

      $routeProvider.when('/login', {
         templateUrl: 'partials/login.html',
         controller: 'LoginCtrl'
      });

      $routeProvider.when('/loginEmployer', {
         templateUrl: 'partials/login-employer.html',
         controller: 'LoginCtrl'
      });

      $routeProvider.when('/employer', {
         templateUrl: 'partials/employer.html',
      });

      $routeProvider.when('/dashboard', {
         authRequired: true,
         templateUrl: 'partials/dashboard.html',
      });

      $routeProvider.when('/newJobPost/:postId', {
         templateUrl: 'partials/new-job-post.html',
         authRequired: true
      });

      $routeProvider.when('/employerDashboard', {
         authRequired: true,
         templateUrl: 'partials/employer-dashboard.html',
      });
			
			$routeProvider.when('/employerSettings', {
         authRequired: true,
         templateUrl: 'partials/employer-settings.html'
      });
			
			$routeProvider.when('/employerStatus', {
         authRequired: true,
         templateUrl: 'partials/employer-status.html'
      });
			
			$routeProvider.when('/employerMatches', {
         authRequired: true,
         templateUrl: 'partials/employer-matches.html'
      });

      $routeProvider.when('/advtalent', {
         templateUrl: 'partials/profile-mockup.html'
      });

      $routeProvider.when('/advemp', {
         templateUrl: 'partials/job-mockup.html'
      });

      $routeProvider.when('/dashboardMockup', {
         templateUrl: 'partials/dashboard-mockup.html'
      });

      $routeProvider.otherwise({redirectTo: '/home'});
   }]);