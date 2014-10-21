'use strict';

/*controllers*/

var userId='';

var myApp = angular.module('myApp', ['ngRoute'])


myApp.controller('saverCtrl' , ['$scope', function($scope) {
		// holds list of data
		$scope.d=[
		{name:'Winnie', filename:'angular', filetype:"document", contactInfo:"example@ashesi.edu.gh"},
		{name:'Niena', filename:'Jasmine Tutorial', filetype:"Video", contactInfo:"example@ashesi.edu.gh"},
		{name:'Iddris', filename:'Python Tutorial', filetype:"Video", contactInfo:"example@ashesi.edu.gh"},
		{name:'Hanif', filename:'Angular Tutorial', filetype:"Video", contactInfo:"example@ashesi.edu.gh"},
		{name:'Ernest', filename:'Angular Tutorial', filetype:"Video", contactInfo:"example@ashesi.edu.gh"}		
		];		
		//adds data entered by user to dataList
		$scope.addData = function(){
			$scope.d.push({name:$scope.name, filename:$scope.filename, filetype:$scope.filetype, contactInfo:$scope.contactInfo});
			$scope.name='';
			$scope.filename='';
			$scope.filetype='';
			$scope.contactInfo='';
		};

	/*$scope.formInfo = [{name:'a',email:'b',password:'c'}];
    $scope.addUser = function() {
    	$scope.user=[{name:'',email:'',password:''}];
    	$scope.formInfo.push({name:$scope.user.name, email:$scope.user.email, password:$scope.user.password});
    	
      //database entry
 
    };*/
   
	}]);

myApp.controller('loginCtrl' , ['$scope','$window', function($scope,$window) {
    // holds list of data
   
   
   
    $scope.entry={username:'',password:''};
    $scope.userInfo={username:'winnie',password:'ashesi'};  
    $scope.login= function(){
      
       
      
         if($scope.entry.username == $scope.userInfo.username && $scope.entry.password==$scope.userInfo.password)
         {
          userId=$scope.userInfo.username;
          $window.location.href ='http://localhost:8000/app/home.html';
         } 
         else{
        $(".alert").css("display","block");
        $(".alert").alert();}   
     
    };

  
  }]);