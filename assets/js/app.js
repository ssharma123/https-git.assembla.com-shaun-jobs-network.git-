'use strict';

// Declare app level module which depends on filters, and services
angular.module('myApp',
      ['myApp.config', 'myApp.routes', 'myApp.filters', 'myApp.services', 
      'myApp.directives', 'myApp.controllers', 'routeSecurity', 
      'ui.bootstrap', 'ngAnimate', 'ngAnimate-animate.css', 'angularFileUpload']
   )

   .run(['loginService', '$rootScope', function(loginService, $rootScope) {
      
         /*
         // Just store the basic static lists here for easy access and editing.
         $rootScope.specialties = [
            "Neurosurgery",
            "Neurosociology",
            "Medical Genetics",
            "Internal Medicine",
            "General Surgery",
            "Family Medicine",
            "Emergency Medicine",
            "Cardiothoracic Anesthesiology",
            "Anesthesiologist",
            "Urology",
            "Radiology",
            "Radiation Therapy",
            "Preventive Healthcare",
            "Plastic Surgery",
            "Pediatrics",
            "Orthopedic Surgery",
            "Opthalmology",
            "Obstetrics and Gynaecology"
         ];
         */

         Parse.initialize("80j1AfSqCmnloLnKZDiy6TkLSsC8lwfOWECjHtZB", "ALMuNZr8IZKektnGDbbnwfhVcvWDHBUOYA444MN6");

         $rootScope.states = [
               "AL",
                "AK",
                "AS",
                "AZ",
                "AR",
                "CA",
                "CO",
                "CT",
                "DE",
                "DC",
                "FM",
                "FL",
                "GA",
                "GU",
                "HI",
                "ID",
                "IL",
                "IN",
                "IA",
                "KS",
                "KY",
                "LA",
                "ME",
                "MH",
                "MD",
                "MA",
                "MI",
                "MN",
                "MS",
                "MO",
                "MT",
                "NE",
                "NV",
                "NH",
                "NJ",
                "NM",
                "NY",
                "NC",
                "ND",
                "MP",
                "OH",
                "OK",
                "OR",
                "PW",
                "PA",
                "PR",
                "RI",
                "SC",
                "SD",
                "TN",
                "TX",
                "UT",
                "VT",
                "VI",
                "VA",
                "WA",
                "WV",
                "WI",
                "WY"
         ];

		// establish authentication
      $rootScope.specialties = null;

      var SpecialtiesClass = Parse.Object.extend("Specialties");
      var SpecialtiesQuery = new Parse.Query(SpecialtiesClass);
      SpecialtiesQuery.ascending("name");
      SpecialtiesQuery.find({
         success: function(results) {
            $rootScope.$apply($rootScope.specialties = results);
         },
         error: function(obj, error) {

         }
      });

         $rootScope.auth = loginService.init();
      
   }]);
