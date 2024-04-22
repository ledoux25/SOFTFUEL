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

app.controller('stationCtrl', ['$scope', '$filter', '$http',
  function($scope, $filter, $http){


   $scope.roles= [{nom_role:'UTILISATEUR'},{nom_role:'REGIONAL'},{nom_role:'ADMINISTRATEUR'}];
   $scope.regions= [{nom_region:'LITTORAL'},{nom_region:'CENTRE'},{nom_region:'OUEST'},{nom_region:'SUD-OUEST'},{nom_region:'EST'},{nom_region:'NORD'}];
   $scope.produits = [{nom_produit:'GASOIL'},{nom_produit:'SUPER'},{nom_produit:'PETROLE'}];
/***************************************************************************************************************/      
  $scope.cuves = [];
  $scope.pompes = [];
  $scope.pistolets = [];
  $scope.personnels = [];
  $scope.comptes = [];
  $scope.cuve = {};
  $scope.pompe = {};
  $scope.pistolet = {};
  $scope.personnel = {};
  $scope.compte = {};
  $scope.station = {};

/*$scope.produit =  function(){

  $http.get('http://localhost/station/src/api/pompistes.php?action=get_produit_carburant').success( function(data, status, headers, config){
        $scope.produits = data ;
        console.log(data);
    })

}; */
$scope.removeUser= function(index){

  $scope.comptes.splice(index, 1);
}

$scope.removeCuve= function(index){

  $scope.cuves.splice(index, 1);
}

$scope.removePompe= function(index){

  $scope.pompes.splice(index, 1);
}


$scope.addCuve = function(){

   var obj = {};
    angular.extend(obj, $scope.cuve);
    $scope.cuves.push(obj);
   // $scope.cuve = null ;
    console.log($scope.cuves);
}

$scope.addPompe = function(){

   var obj = {};
    angular.extend(obj, $scope.pompe);
    $scope.pompes.push(obj);
   // $scope.cuve = null ;
    console.log($scope.pompes);
}

$scope.addPistolet = function(){

   var obj = {};
    angular.extend(obj, $scope.pistolet);
    $scope.pistolets.push(obj);
   // $scope.cuve = null ;
    console.log($scope.pistolets);
}

$scope.addPersonnel = function(){

   var obj = {};
    angular.extend(obj, $scope.personnel);
    $scope.personnels.push(obj);
   // $scope.cuve = null ;
    console.log($scope.personnels);
}

$scope.addCompte = function(){

   var obj = {};
    angular.extend(obj, $scope.compte);
    $scope.comptes.push(obj);
   // $scope.cuve = null ;
    console.log($scope.comptes);
}


$scope.Envoyer = function(){

 $http.post('http://localhost/station/src/api/pompistes.php?action=Envoyer_Station',

               {
                'cuves'    :  $scope.cuves,
                'pompes'     :  $scope.pompes, 
                'personnels'     :  $scope.personnels, 
                'pistolets'     :  $scope.pistolets, 
                'comptes'     :  $scope.comptes, 
                'station'     :  $scope.station 
              }

            ).success( function(data, status, headers, config){
                    console.log(data);

                    if (data.msg=="") {
                      $scope.cuves=[];
                      $scope.pompes=[];
                      $scope.personnels=[];
                      $scope.pistolets=[];
                      $scope.comptes=[];
                      $scope.station={};
                      $scope.cuve={};
                      $scope.pompe={};
                      $scope.personnel={};
                      $scope.pistolet={};
                      $scope.compte={};
                      alert('Felicitation! Operation Executer avec success');
                    }else{

                      alert('Desolé! Echec Operation');

                    }

                                      
              });


}
    
    

}]);
