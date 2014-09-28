'use strict';

/*controllers*/


var myApp = angular.module('myApp',[]);

myApp.controller('saverCtrl' , ['$scope', function($scope) {
		// holds list of data
		$scope.d=[
		{name:'Winnie', filename:'angular', filetype:"document", contactInfo:"12345678"},
		{name:'Niena', filename:'Jasmine Tutorial', filetype:"Video", contactInfo:"0268555582, Room 800"},
		{name:'Iddris', filename:'Python Tutorial', filetype:"Video", contactInfo:"0268555582, Room 801"},
		{name:'Hanif', filename:'Angular Tutorial', filetype:"Video", contactInfo:"0268555582, Room 802"},
		{name:'Ernest', filename:'Angular Tutorial', filetype:"Video", contactInfo:"0268555582, Room 808"}		
		];		
		//adds data entered by user to dataList
		$scope.addData = function(){
			$scope.d.push({name:$scope.name, filename:$scope.filename, filetype:$scope.filetype, contactInfo:$scope.contactInfo});
			$scope.name='';
			$scope.filename='';
			$scope.filetype='';
			$scope.contactInfo='';
		};
	}]);