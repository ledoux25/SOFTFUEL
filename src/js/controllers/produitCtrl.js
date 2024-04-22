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

app.controller('produitCtrl', ['$scope', '$filter', '$http',
  function($scope, $filter, $http){


   $scope.type_produits= [{type_produit:'CARBURANT'},{type_produit:'LUBRIFIANT'},{type_produit:'GAZ'}];
   $scope.stations = [];
/***************************************************************************************************************/      
  $scope.produits = [];
  $scope.produit = {};

$scope.station =  function(){

  $http.get('http://localhost/station/src/api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })

};
  

$scope.addProduit = function(){

   var obj = {};
    angular.extend(obj, $scope.produit);
    $scope.produits.push(obj);
   // $scope.cuve = null ;
    console.log($scope.produits);
}



$scope.Envoyer = function(){

 $http.post('http://localhost/station/src/api/pompistes.php?action=Envoyer_Produit',

               {
                'produits'    :  $scope.produits,
              }

            ).success( function(data, status, headers, config){
                    console.log(data);

                    if (data.msg=="") {
                      $scope.produits=[];
                      $scope.produit={};
                      alert('Felicitation! Operation Executer avec success');
                    }else{
                      alert('Desolé! Echec Operation');
                    }

                                      
              });


}
    
    

}]);
