app.controller('ModalInstanceBeatCtrl', ['$scope', '$modalInstance', 'items', function($scope, $modalInstance, items) {
    $scope.items = items;
    console.log($scope.items);

    $scope.OK = function () {
      $modalInstance.close($scope.items);
    };

    $scope.cancel = function () {
      $modalInstance.dismiss('cancel');
    };


  }]);

app.controller('etatStockCtrl', ['$scope', '$filter', '$http', '$localStorage',
  function($scope, $filter, $http, $localStorage){

    $scope.dt = {} ;
    $scope.recap_coulages = [] ;

    $scope.role = {};

    if ($localStorage.User.role == 'ADMINISTRATEUR') {
      $scope.role.user = 'ADMINISTRATEUR';
    } else {
      $scope.role.user = 'UTILISATEUR';
    }
    
   
    $scope.today = function() {

      var date = new Date();

      //$scope.dt.date_debut = new Date(date.getFullYear(), date.getMonth(), 1);
      //$scope.dt.date_fin = new Date(date.getFullYear(), date.getMonth() + 1, 0);

      $scope.dt.date_debut = new Date();
      $scope.dt.date_fin = new Date();

      $scope.date_debut = $scope.dt.date_debut.toLocaleString('fr-FR'); 
      $scope.date_fin = $scope.dt.date_fin.toLocaleString('fr-FR');

      //let f = new Intl.DateTimeFormat('fr');
      //let a = f.formatToParts();
      //console.log(a);

    };

    $scope.today();

    console.log($scope.date_debut) ;
    console.log($scope.date_fin) ;


    $scope.toggleMin = function() {
      $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function($event) {
      $event.preventDefault();
      $event.stopPropagation();

      $scope.opened = true;
    };

    $scope.open2 = function($event) {
      $event.preventDefault();
      $event.stopPropagation();

      $scope.opened2 = true;
    };

    $scope.dateOptions = {
      formatYear: 'yy',
      startingDay: 1,
      class: 'datepicker'
    };

  //  $scope.initDate = new Date('2016-15-20');
    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];




$scope.station =  function(){

  $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })

};
  
$scope.station_courante =  function(){

  $scope.stations = [{id_station:$localStorage.User.id, nom_station:$localStorage.User.nom, email_station:$localStorage.User.email}];
  console.log($scope.stations);
};

$scope.equation_stock_station = function(){

  console.log($scope.dt);

 $http.post('api/pompistes.php?action=Etats_Coulages_Station_Mensuel',

               {
                'coulages'    :  $scope.stations[0].nom_station,
                'periode'    :  $scope.dt, 
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

}

$scope.equation_stock_lub_station = function(){

  console.log($scope.dt);

 $http.post('api/pompistes.php?action=Etats_Coulages_Lub_Station_Mensuel',

               {
                'coulages'    :  $scope.stations[0].nom_station,
                'periode'    :  $scope.dt,
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

}

$scope.equation_stock_reseau = function(){

  console.log($scope.dt);

  $http.post('api/pompistes.php?action=Etats_Coulages_Station_Mensuel',

               {
                'coulages'    :  $scope.dt.station,
                'periode'    :  $scope.dt, 
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

 
}

$scope.equation_stock_lub_reseau = function(){

  console.log($scope.dt);

  $http.post('api/pompistes.php?action=Etats_Coulages_Lub_Station_Mensuel',

               {
                'coulages'    :  $scope.dt.station,
                'periode'    :  $scope.dt,
              }

            ).success( function(data, status, headers, config){
                    
              console.log(data);

              $scope.recap_coulages = data ;

                                      
              });

 
}

$scope.equation_stock_mensuel = function(){


  if (($scope.role.user == 'ADMINISTRATEUR')) {

    $scope.equation_stock_reseau() ;
    
  } else {
    
    $scope.equation_stock_station() ;
  }
}

$scope.equation_stock_lub_mensuel = function(){


  if (($scope.role.user == 'ADMINISTRATEUR')) {

    $scope.equation_stock_lub_reseau() ;
    
  } else {
    
    $scope.equation_stock_lub_station() ;
  }
}

$scope.export_pdf = function(){


  $http.post('api/pompistes_export.php?action=Equation_Stock_Carb_Pdf',

               {
                'coulages'    :  $scope.recap_coulages,
                'date_debut'    :  $scope.dt.date_debut,
                'date_fin'    :  $scope.dt.date_fin,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/equation_stock_carb.pdf', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}

$scope.export_pdf_valeur = function(){


  $http.post('api/pompistes_export.php?action=Equation_Stock_Carb_Pdf_Valeur',

               {
                'coulages'    :  $scope.recap_coulages,
                'date_debut'    :  $scope.dt.date_debut,
                'date_fin'    :  $scope.dt.date_fin,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/equation_stock_carb_valeur.pdf', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}

$scope.export_lub_pdf = function(){


  $http.post('api/pompistes_export.php?action=Equation_Stock_Lub_Pdf',

               {
                'coulages'    :  $scope.recap_coulages,
                'date_debut'    :  $scope.dt.date_debut,
                'date_fin'    :  $scope.dt.date_fin,
                'station'    :  $scope.dt.station,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/equation_stock_lub.pdf', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}

$scope.export_excel = function(){


  $http.post('api/pompistes_export.php?action=Equation_Stock_Carb_Excel',

               {
                'coulages'    :  $scope.recap_coulages,
              }

  ).success( function(data, status, headers, config){

    console.log(data) ;

    if (data.status === 'OK') {

      window.open(
        '../src/api/DOCUMENTS/equation_stock_carb.xlsx', '_blank' 
      );

    }
          
  //  window.location.href="../src/api/etat_ventes.pdf";
                            
    });



}

    

}]);
