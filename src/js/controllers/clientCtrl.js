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

app.controller('clientCtrl', ['$scope', '$filter', '$http',
  function($scope, $filter, $http){


   $scope.type_clients= [{type_client:'TRANSPORTEUR'},{type_client:'REVENDEUR PETROLE'},{type_client:'INDUSTRIEL'}];
   $scope.stations = [];
   $scope.produits = [];
/***************************************************************************************************************/      
  $scope.clients = [];
  $scope.client = {};

$scope.station =  function(){

  $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
        $scope.stations = data ;
        console.log(data);
    })

};

$scope.produit =  function(){

  $http.get('api/pompistes.php?action=get_produits').success( function(data, status, headers, config){
        $scope.produits = data ;
        console.log(data);
    })

};
  

$scope.addClient = function(){

   var obj = {};
    angular.extend(obj, $scope.client);
    $scope.clients.push(obj);
   // $scope.cuve = null ;
    console.log($scope.clients);
}



$scope.Envoyer = function(){

 $http.post('api/pompistes.php?action=Envoyer_Client',

               {
                'clients'    :  $scope.clients,
              }

            ).success( function(data, status, headers, config){
                    console.log(data);

                    if (data.msg=="") {
                      $scope.clients=[];
                      $scope.client={};
                      alert('Felicitation! Operation Executer avec success');
                    }else{
                      alert('Desolé! Echec Operation');
                    }

                                      
              });


}
    
    

}]);
