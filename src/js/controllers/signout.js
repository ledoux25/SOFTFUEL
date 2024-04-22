
'use strict';

/* Controllers */
  // signout controller
  app.controller('SignoutCtrl',  function($location, $http, $localStorage, $auth, $state, $scope) {

  	$scope.msg = 'Aurevoir! à bientot sur BimStr';
    $scope.template = '';
    $scope.positions = ['center', 'left', 'right'];
    $scope.position = $scope.positions[2];
    $scope.classes= "alert-success";
    $scope.duration = 10000;

    if ( angular.isDefined($localStorage.User) ) {
          $scope.app.user = null;
          $localStorage.User = false ;
          localStorage.clear();
          $http.get('http://localhost/station/src/api/login.php?logout=true').success( function(data, status, headers, config){
          console.log(data);
           })
          $state.go('login');
          console.log($localStorage.User);
      }

	    if (!$auth.isAuthenticated()) { return; }
	    $auth.logout()
	      .then(function() {
	      	$scope.alerts = [];
	      	console.log($auth.getToken());
	      	$localStorage.User = null ;
	      	$scope.app.user.avatar= 'img/a0.jpg';
	      	$scope.app.user.name= '';
	      	$scope.app.user.lname= '';
	      	$scope.app.user.userId= '';
	      /*	 notify({
            message: $scope.msg,
            classes: $scope.classes,
            templateUrl: $scope.template,
            position: $scope.position,
            duration: $scope.duration
        }); */
	      	$state.go('app.dashboard');
	      });

         
  });

