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

app.controller('transporteurCtrl', ['$scope', '$filter', '$http',
  function($scope, $filter, $http){


   $scope.type_transporteurs= [{type_transporteur:'CARBURANT'},{type_transporteur:'LUBRIFIANT'},{type_transporteur:'GAZ'}];
   $scope.stations = [];
   $scope.produits = [];
/***************************************************************************************************************/      
  $scope.transporteurs = [];
  $scope.transporteur = {};

$scope.station =  function(){

  $http.get('http://localhost/station/src/api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })

};

$scope.produit =  function(){

  $http.get('http://localhost/station/src/api/pompistes.php?action=get_produits').success( function(data, status, headers, config){
        $scope.produits = data ;
        console.log(data);
    })

};
  

$scope.addTransporteur = function(){

   var obj = {};
    angular.extend(obj, $scope.transporteur);
    $scope.transporteurs.push(obj);
   // $scope.cuve = null ;
    console.log($scope.transporteurs);
}



$scope.Envoyer = function(){

 $http.post('http://localhost/station/src/api/pompistes.php?action=Envoyer_Transporteur',

               {
                'transporteurs'    :  $scope.transporteurs,
              }

            ).success( function(data, status, headers, config){
                    console.log(data);

                    if (data.msg=="") {
                      $scope.transporteurs=[];
                      $scope.transporteur={};
                      alert('Felicitation! Operation Executer avec success');
                    }else{
                      alert('Desolé! Echec Operation');
                    }

                                      
              });


}
    
    

}]);
