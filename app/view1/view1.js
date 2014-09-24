'use strict';

angular.module('myApp.view1', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/view1', {
    templateUrl: 'view1/view1.html',
    controller: 'View1Ctrl'
  });
}])

.controller('View1Ctrl', [function() {
	$scope.dataList = 
			{name:'Winnie',
			filename:'newFile', 
			filetype:'word',
			contactInfo:'54418418'};	
		
}]);