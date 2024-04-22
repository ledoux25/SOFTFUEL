'use strict';

/* Controllers */
  // signin controller
app.controller('SigninFormController', ['$scope', '$http', '$state', '$auth','$location', '$localStorage',
  function($scope, $http, $state, $auth, $location, $localStorage) {



    $scope.msg = 'Bienvenue sur BimStr';
    $scope.template = '';
    $scope.positions = ['center', 'left', 'right'];
    $scope.position = $scope.positions[2];
    $scope.classes= "alert-success";
    $scope.duration = 10000;
   // $localStorage.User={};

    $scope.vider_cache = function() {

      // localStorage.clear();
      $localStorage.Quart = false ;
      $scope.app.quart = {} ;
      $scope.app.quart.cuves = [] ;
      $scope.app.quart.personnel = [] ;
      $scope.personnel = [];
      $localStorage.Quart1.personnel = [] ;
    }



    $scope.login = function() {
      $scope.authError = null;
      // Try to login
      $http.post('api/login.php', {name: $scope.user.name, password: $scope.user.password})
      .success(function(data, status, headers, config) {
          $scope.data = data ;
          $localStorage.User={};
        //console.log($scope.data);
        if ( $scope.data.msg === "success") {

          $scope.app.user.photo = $scope.data.photo;
          $scope.app.user.email = $scope.data.email;
          $scope.app.user.role = $scope.data.role;
          $scope.app.user.nom = $scope.data.nom;
          $scope.app.user.id = $scope.data.id;
          
          $localStorage.User.photo = $scope.data.photo;
          $localStorage.User.email= $scope.data.email;
          $localStorage.User.role= $scope.data.role;
          $localStorage.User.nom = $scope.data.nom;
          $localStorage.User.id = $scope.data.id;
          $localStorage.User.id_station = $scope.data.id_station;
          $localStorage.User.id_region = $scope.data.id_region;
          $localStorage.User.nom_station = $scope.data.nom_station;
          $localStorage.User.email_station = $scope.data.email_station;
          $localStorage.User.nom_gerant = $scope.data.nom_gerant;
          $localStorage.User.telephone_gerant = $scope.data.telephone_gerant;

          $localStorage.User.objectif_carburant = $scope.data.objectif_carburant;
          $localStorage.User.objectif_lubrifiant = $scope.data.objectif_lubrifiant;
          $localStorage.User.objectif_coulage = $scope.data.objectif_coulage ;
          $localStorage.User.email_regional = $scope.data.email_regional ;
          $localStorage.User.telephone_regional = $scope.data.telephone_regional ;
        
        
        //  console.log(response);
        //  console.log($scope.app.user);
          console.log($localStorage.User);

         $state.go('app.dashboard-v3');
          
        /*  notify({
            message: $scope.msg,
            classes: $scope.classes,
            templateUrl: $scope.template,
            position: $scope.position,
            duration: $scope.duration
        }); */
          

        }else{
          $scope.authError = 'Email or Password not right';

        }
      }, function(x) {
        $scope.authError = 'Server Error';
      });
    };

    // $scope.login = function() {
    //   $auth.login($scope.user)
    //     .then(function() {
    //       $location.path('/');
    //     })
    //     .catch(function(error) {
    //       toastr.error(error.data.message, error.status);
    //     });
    // };

    $scope.logout = function() {
      if (!$auth.isAuthenticated()) { return; }
      $auth.logout()
        .then(function(response) {
          console.log(response.data);
          $state.go('app.dashboard');
        });
    };

    $scope.authenticate = function(provider) {
      $auth.authenticate(provider)
        .then(function(response) {

          

          $scope.app.user.avatar = response.data.avatar;
          $scope.app.user.name = response.data.fname;
          $scope.app.user.lname = response.data.lname;
          $scope.app.user.userId = response.data.userId;
          $localStorage.User.avatar = response.data.avatar;
          $localStorage.User.name = response.data.fname;
          $localStorage.User.lname = response.data.lname;
          $localStorage.User.userId = response.data.userId;
        
          console.log(response);
          console.log($auth.getToken());
          console.log($auth.getPayload());
          console.log($localStorage.User);
        
          $state.go('app.dashboard');
          notify({
            message: $scope.msg,
            classes: $scope.classes,
            templateUrl: $scope.template,
            position: $scope.position,
            duration: $scope.duration
        });

          // $location.path('/');
/*          toastr.success('You have successfully signed in with ' + provider + '!');
          $location.path('/');*/
        })
        .catch(function(error) {
          $scope.classes= "alert-danger";
          if (error.error) {
            // Popup error - invalid redirect_uri, pressed cancel button, etc.
            $scope.msg = 'Oups! Erreur lors du login :'+ error.error;
          } else if (error.data) {
            // HTTP response error from server
            $scope.msg = 'Oups! Erreur lors du login :'+ error.data.message + error.status;
          } else {
            // toastr.error(error);
            $scope.msg = 'Oups! Erreur lors du login. Reesayez ulterieurement';
          }
          notify({
            message: $scope.msg,
            classes: $scope.classes,
            templateUrl: $scope.template,
            position: $scope.position,
            duration: $scope.duration
        });
        });
    };

  }])
;
