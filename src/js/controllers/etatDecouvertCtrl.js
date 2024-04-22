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

app.controller('etatDecouvertCtrl', ['$scope', '$filter', '$http', '$localStorage', 
function($scope, $filter, $http, $localStorage){

  $scope.dt = {} ;

  $scope.pl = {} ;
  $scope.pla = {} ;

  $scope.qte = {} ;
  $scope.prix = {} ;
  $scope.montant = {}

  $scope.dt.date_debut = new Date().toUTCString(); 
  $scope.dt.date_fin = new Date().toUTCString();
  $scope.dt.client = '' ;
  
  $scope.decouvert = {} ;
  $scope.recap_creances = [] ;

  $scope.clients = [] ;
  $scope.code_client = 

  $scope.role = {} ;

  $scope.vue_livraison = true ;
  $scope.vue_versement = true ;

  if ($localStorage.User.role == 'ADMINISTRATEUR') {
    $scope.role.user = 'ADMINISTRATEUR';
  } else {
    $scope.role.user = 'UTILISATEUR';
  }
  
 
$scope.today = function() {


  $http.post('api/pompistes.php?action=get_cloture_decouvert',

             {
              'decouvert'    :  $scope.dt,
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data) ;

        $date_ouverture = data[0].date_ouverture ;
        $commentaire = data[0].commentaire ;  
        $solde = data[0].solde ;  

        $scope.dt.date_debut = new Date($date_ouverture).toUTCString(); 
        $scope.dt.date_fin = new Date().toUTCString();
       
        $scope.ancien_solde = $solde ;
        $scope.date_cloture = $date_ouverture ;


      //  $scope.decouvert() ;

                                    
  });

   
};

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

};

$scope.client =  function(){

    $http.get('api/pompistes.php?action=get_client_gescom').success( function(data, status, headers, config){
      $scope.clients = data ;
      console.log(data);
  })
};

$scope.client_all =  function(){

  $http.get('api/pompistes.php?action=get_client_all_gescom').success( function(data, status, headers, config){
        $scope.clients = data ;
        console.log(data);
    })

};

$scope.creances = function(){

console.log($scope.dt);

$http.post('api/pompistes.php?action=Etats_Releve_echeance',

              {
              'creances'    :  $scope.dt,
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data);

            $scope.recap_creances = data ;

            console.log($scope.decouvert);

            $scope.decouvert.solde_gescom = data[(data.length-1)].solde ;

                                    
            });

}

$scope.nettoyer_versement = function(versement, index){

console.log(versement) ;

$http.post('api/pompistes.php?action=Nettoyer_Reglement',

              {
              'nettoyer'    : versement.date
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data);

            if (data.msg == "" ) {

              $scope.decouvert.recap_versement_total = $scope.decouvert.recap_versement_total - versement.montant ;
              $scope.decouvert.recap_versement[index].montant = 0 ;
              $scope.decouvert.recap_versement[index].status = 1 ;

              alert("Felicitation ! Nettoyage effectué ") ;

             
             // $scope.decouvert.status = false ;
            //  $scope.decouvert.recap_versement[index].prix_unitaire = versement.montant ; 
              
              
            }

                                    
            });

}

$scope.restaurer_versement = function(versement, index){

  console.log(versement) ;
  $scope.decouvert.recap_versement_total = $scope.decouvert.recap_versement_total + versement.montant ;
  $scope.decouvert.recap_versement[index].montant = versement.montant ;
  
  $http.post('api/pompistes.php?action=Restaurer_Reglement',
  
                {
                'restaurer'    : versement.date
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {

                $scope.decouvert.recap_versement_total = $scope.decouvert.recap_versement_total + versement.montant ;
                $scope.decouvert.recap_versement[index].montant = versement.montant ;
                $scope.decouvert.recap_versement[index].status = 0 ;
  
                alert("Felicitation ! Restauration effectué ") ;
  
               
               // $scope.decouvert.status = false ;
              //  $scope.decouvert.recap_versement[index].prix_unitaire = versement.montant ; 
                
               
  
               
  
                
              }
  
                                      
              });
  
}

$scope.nettoyer_depense = function(depense, index){

  console.log(depense) ;
  
  $http.post('api/pompistes.php?action=Nettoyer_Depense',
  
                {
                'nettoyer'    : depense.date
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {
  
                alert("Felicitation ! Nettoyage effectué ") ;
  
                $scope.decouvert.recap_depenses_total = $scope.decouvert.recap_depenses_total - depense.montant ;
                $scope.decouvert.recap_depenses[index].montant = 0 ;
                $scope.decouvert.recap_depenses[index].status = 1 ;
  
               
  
                
              }
  
                                      
              });
  
}

$scope.restaurer_depense = function(depense, index){

  console.log(depense) ;
  
  $http.post('api/pompistes.php?action=Restaurer_Depense',
  
                {
                'restaurer'    : depense.date
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {
  
                alert("Felicitation ! Restauration effectué ") ;
  
               
               // $scope.decouvert.status = false ;
  
              //  $scope.decouvert.recap_depenses[index].prix_unitaire = depense.montant ; 
                
                $scope.decouvert.recap_depenses_total = $scope.decouvert.recap_depenses_total + depense.montant ;
                $scope.decouvert.recap_depenses[index].montant = depense.montant ;
                $scope.decouvert.recap_depenses[index].status = 0 ;
  
               
  
                
              }
  
                                      
              });
  
}

$scope.restaurer_coulage = function(coulage, index){

  console.log(coulage) ;

  if (coulage.produit.substr(0, 17) == 'COULAGE ANTERIEUR') {

    var obj = {} ;

     angular.extend(obj, {'date_debut'     :  $scope.dt.date_debut});
     angular.extend(obj, {'date_fin'     :  $scope.dt.date_fin});
     angular.extend(obj, {'montant'     :  coulage.montant});
     angular.extend(obj, {'quantite'     :  coulage.quantite});
     angular.extend(obj, {'id_coulage'     :  coulage.id_coulage})

     $http.post('api/pompistes.php?action=Restaurer_Coulage',
  
              {
                'restaurer'    : coulage
              }
  
      ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {
  
                alert("Felicitation ! Restauration effectué ") ;
  
                $scope.decouvert.recap_coulage = $scope.decouvert.recap_coulage + coulage.montant ;
                $scope.decouvert.recap_coulage_carb[index].montant = coulage.montant ;
                $scope.decouvert.recap_coulage_carb[index].status = 0 ;
               
              }
                                      
    });

  }else{


    alert("Felicitation ! Restauration effectué ") ;
  
               
    $scope.decouvert.recap_coulage = $scope.decouvert.recap_coulage + coulage.montant ;
    $scope.decouvert.recap_coulage_carb[index].montant = coulage.montant ;
    $scope.decouvert.recap_coulage_carb[index].status = 0 ;

  }
  
  
  
}

$scope.nettoyer_livraison = function(livraison, index){

// console.log(livraison) ;

$http.post('api/pompistes.php?action=Nettoyer_Livraison',

              {
              'nettoyer'    : livraison ,
            }

          ).success( function(data, status, headers, config){
                  
           // console.log(data);

            if (data.msg == "" ) {

              alert("Felicitation ! Nettoyage effectué ") ;

             // $scope.decouvert.recap_livraison[index].statut_decouvert = 1 ;
              $scope.decouvert.recap_livraison_total -= livraison.montant ;
              $scope.decouvert.recap_livraison[index].montant = 0 ;
              $scope.decouvert.recap_livraison[index].status = 1 ;

              
            }

                                    
            });

}

$scope.restaurer_livraison = function(livraison, index){

  console.log(livraison) ;
  
  $http.post('api/pompistes.php?action=Restaurer_Livraison',
  
                {
                'restaurer'    : livraison ,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {
  
                alert("Felicitation ! Restauration effectué ") ;
  
                $scope.decouvert.recap_livraison[index].statut_decouvert = 0 ;
                $scope.decouvert.recap_livraison_total += livraison.montant ;
                $scope.decouvert.recap_livraison[index].montant = livraison.montant ;
                $scope.decouvert.recap_livraison[index].status = 0 ;
  
                
              }
  
                                      
              });
  
}

$scope.nettoyer_manquant = function(manquant, index){

    console.log(manquant) ;

    alert("Felicitation ! Nettoyage effectué ") ;

    //$scope.decouvert.recap_manquant[index].statut_decouvert = 1 ;
    $scope.decouvert.recap_manquant_total -= manquant.montant ;
    $scope.decouvert.recap_manquant[index].montant_initial = manquant.montant ;
    $scope.decouvert.recap_manquant[index].montant = 0 ;
    $scope.decouvert.recap_manquant[index].status = 1 ;

}

$scope.nettoyer_coulage = function(coulage, index){

  console.log(coulage) ;
  console.log(coulage.produit.substr(0, 17)) ;

  if (coulage.produit.substr(0, 17) == 'COULAGE ANTERIEUR') {


    var obj = {} ;

     //angular.extend(obj, $scope.dt);
     angular.extend(obj, {'date_debut'     :  $scope.dt.date_debut});
     angular.extend(obj, {'date_fin'     :  $scope.dt.date_fin});
     angular.extend(obj, {'montant'     :  coulage.montant});
     angular.extend(obj, {'quantite'     :  coulage.quantite});
     angular.extend(obj, {'id_coulage'     :  coulage.id_coulage});
   
   
     $http.post('api/pompistes.php?action=Nettoyer_Coulage', obj
                 
     ).success( function(data, status, headers, config){
                       
                 console.log(data);
     
                 if (data.msg == "" ) {
     
                   alert("Felicitation ! Nettoyage effectué") ;

                   $scope.decouvert.recap_coulage -= coulage.montant ;
                    $scope.decouvert.recap_coulage_carb[index].montant_initial = coulage.montant ;
                    $scope.decouvert.recap_coulage_carb[index].montant = 0 ;
                    $scope.decouvert.recap_coulage_carb[index].status = 1 ;
     
                 }
     
                                         
                 });

    
  } else {

    console.log(coulage) ;

    alert("Felicitation ! Nettoyage effectué ") ;

    //$scope.decouvert.recap_coulage[index].statut_decouvert = 1 ;
    $scope.decouvert.recap_coulage -= coulage.montant ;
    $scope.decouvert.recap_coulage_carb[index].montant_initial = coulage.montant ;
    $scope.decouvert.recap_coulage_carb[index].montant = 0 ;
    $scope.decouvert.recap_coulage_carb[index].status = 1 ;

    
  }

  
}

$scope.cloturer = function(){

  var obj = {} ;

 // $scope.dt.date_fin = new Date().toUTCString();
  
 // $montant = ($scope.decouvert.recap_coulage + $scope.decouvert.recap_manquant_total + $scope.decouvert.recap_creances_total + $scope.decouvert.recap_versement_total + $scope.decouvert.recap_livraison_total + $scope.decouvert.recap_stock) ;
   $montant =  $scope.decouvert.solde_gescom ;
  //angular.extend(obj, $scope.dt);
 
  angular.extend(obj, {'date_debut'     :  $scope.dt.date_debut});
  angular.extend(obj, {'date_fin'     :  $scope.dt.date_fin});
  angular.extend(obj, {'montant'     :  $montant});
  angular.extend(obj, {'station'     :  $scope.dt.client.code_client});

  angular.forEach($scope.decouvert.recap_coulage_carb, function($value) {

      if (($value.produit == 'COULAGE GASOIL' && $value.status == 0)) {

        angular.extend(obj, {'montant2'     :  $value.montant});
        angular.extend(obj, {'quantite'     :  $value.quantite});
        angular.extend(obj, {'libelle_coulage'     :  'COULAGE ANTERIEUR GASOIL'});
        angular.extend(obj, {'periode_coulage'     :  'DU '+$scope.dt.date_debut+' AU '+$scope.dt.date_fin});

        $http.post('api/pompistes.php?action=Cloturer_Decouvert_Coulage', obj) ;
        
      }

      if (($value.produit == 'COULAGE SUPER' && $value.status == 0)) {

        angular.extend(obj, {'montant2'     :  $value.montant});
        angular.extend(obj, {'quantite'     :  $value.quantite});
        angular.extend(obj, {'libelle_coulage'     :  'COULAGE ANTERIEUR SUPER'});
        angular.extend(obj, {'periode_coulage'     :  'DU '+$scope.dt.date_debut+' AU '+$scope.dt.date_fin});

        $http.post('api/pompistes.php?action=Cloturer_Decouvert_Coulage', obj) ;
        
      }

      if (($value.produit == 'COULAGE PETROLE' && $value.status == 0)) {

        angular.extend(obj, {'montant2'     :  $value.montant});
        angular.extend(obj, {'quantite'     :  $value.quantite});
        angular.extend(obj, {'libelle_coulage'     :  'COULAGE ANTERIEUR PETROLE'});
        angular.extend(obj, {'periode_coulage'     :  'DU '+$scope.dt.date_debut+' AU '+$scope.dt.date_fin});

        $http.post('api/pompistes.php?action=Cloturer_Decouvert_Coulage', obj) ;
        
      }



     
   }) ;


  $http.post('api/pompistes.php?action=Cloturer_Decouvert', obj
              
  ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              if (data.msg == "" ) {
  
                alert("Felicitation ! Decouvert Cloturé ") ;

                $state.go('login');
  
              }
  
                                      
              });
  
}

$scope.decouvert = function(){

console.log($scope.dt);

$http.post('api/pompistes.php?action=Etats_Decouvert',

             {
              'decouvert'    :  $scope.dt,
            }

          ).success( function(data, status, headers, config){
                  
            console.log(data) ;

            $scope.decouvert = data ;
            $scope.date_debut = data.date ;

           // $scope.creances() ;

           $scope.prix.super = data.recap_stock_carb[1].montant / data.recap_stock_carb[1].quantite ;
           $scope.prix.gasoil = data.recap_stock_carb[0].montant / data.recap_stock_carb[0].quantite ;
           $scope.prix.petrole = data.recap_stock_carb[2].montant / data.recap_stock_carb[2].quantite ;

           $scope.montant.super = $scope.qte.super * $scope.prix.super ;
           $scope.montant.gasoil = $scope.qte.gasoil * $scope.prix.gasoil ;
           $scope.montant.petrole = $scope.qte.petrole * $scope.prix.petrole ;

                                    
            });

}

  

}]);
