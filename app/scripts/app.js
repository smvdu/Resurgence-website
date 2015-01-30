'use strict';

/**
 * @ngdoc overview
 * @name resurgenceWebsiteApp
 * @description
 * # resurgenceWebsiteApp
 *
 * Main module of the application.
 */
angular
  .module('resurgenceWebsiteApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'timer'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
      })
      .when('/events', {
        templateUrl: 'views/events.html',
      })
      .when('/gallery', {
        templateUrl: 'views/gallery.html',
      })
      .when('/sponsors', {
        templateUrl: 'views/sponsors.html',
      })
      .when('/contact', {
        templateUrl: 'views/contact.html',
      })
      .when('/register', {
        templateUrl: 'views/register.html',
      })
      .otherwise({
        redirectTo: '/'
      });
  });
