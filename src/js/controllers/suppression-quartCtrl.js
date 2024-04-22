
  
app.controller('suppression-quartCtrl', function($scope, $http, $localStorage, $state) {
  
  
    $scope.role = {};
    $scope.date = {};


    if ($localStorage.User.role == 'ADMINISTRATEUR') {
      $scope.role.user = 'ADMINISTRATEUR';
    } else {
      $scope.role.user = 'UTILISATEUR';
    }

  /************************DATE QUART***************************************************/
  
    $scope.date.date_ouverture = new Date().toDateString(); 
    $scope.date.quart = 'quart 1'; 

    $scope.heure_suppression = function(){

      return $http.get('api/pompistes.php?action=get_heure_suppression').success( function(data, status, headers, config){
 
       $date_ouverture = data[0].date_ouverture ;
       $quart = data[0].quart ;  
 
       $scope.date.date_ouverture2 = new Date($date_ouverture).toDateString() ; 
       $scope.date.date_ouverture = $date_ouverture ;
       $scope.date.quart = $quart ;

       $scope.date.station = $scope.stations[0].nom_station
 
      })
 
    }
  
    $scope.station =  function(){

        $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
            $scope.stations = data ;
            console.log(data);
        })
      
    };
      
    $scope.station_courante =  function(){
    
    $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];
    
    };
  
    $scope.open_quart = function($event) {
      $event.preventDefault();
      $event.stopPropagation();
  
      $scope.opened = true;
    };
  
    $scope.dateOptions = {
      formatYear: 'yy',
      startingDay: 1,
      class: 'datepicker'
    };
  
    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

    $datas = [] ;
    $datas.push($scope.date) ;


    $scope.supprimer_quart =  function(){

        $http.post('api/pompistes.php?action=supprimer_quart',
       
        {
         'quart'    :  $scope.date,
       }

     ).success( function(data, status, headers, config){
            
            console.log(data);

            if (data.msg=="") {

                alert('Felicitation! Operation Execute avec success') ;

                $state.go('login');
                
            } else {

                alert('Desolé! Echec Operation');
                
            }
        })
      
    };
    
  /****************************UPLOAD FICHIER VENTES********************************************** */
  /**********************************FIN UPLOAD FICHIER STOCK***************************************** */
  
  
});