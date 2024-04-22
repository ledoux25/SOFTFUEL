app.controller('ModalInstancePlaylistCtrl', ['$scope', '$modalInstance',  function($scope, $modalInstance, data, params ) {

    $scope.data = data;
    $scope.params = params;

    console.log($scope.data);

    $scope.OK = function () {
      $modalInstance.close($scope.data);
      
    };

    $scope.cancel = function () {
      $modalInstance.dismiss('cancel');
    };


  }]);


app.controller('suiviManquantCtrl', ['$scope', '$filter', '$http', '$modal', '$log', 'editableOptions', 'editableThemes', 'Cloture',
  function($scope, $filter, $http, $modal, $log, editableOptions, editableThemes, Cloture){

    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';
    $scope.selected ;

    $date_ouverture = '' ;
    $date_fermerture = '' ;

    $scope.pl = {} ;
    $scope.manq = {} ;
    $scope.ret = {} ;
    $scope.manquant = {} ;
    $scope.dt = {} ;
    $scope.pom = {} ;
    $scope.retenue = {};
    
    $scope.pompistes = [];
    $scope.pompistes_all = [];
   
    

    $scope.today = function() {

        Cloture.get_cloture().success(function(data){

            console.log(data) ;
    
            $date_ouverture = data[0].date_ouverture ;
            $date_fermerture = data[0].date_fermerture ;
            $commentaire = data[0].commentaire ;  

            $scope.dt.date_debut = new Date($date_fermerture).toUTCString(); 
            $scope.dt.date_fin = new Date().toUTCString();
            $scope.minDate = $scope.dt.date_debut;

            $scope.manquant.date= new Date().toUTCString();
            $scope.retenue.date= new Date().toUTCString();
            
        });

       
    };

    $scope.today();

      $scope.open_manquant = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
  
        $scope.opened_manquant = true;
      };

      $scope.open_retenue = function($event) {
        $event.preventDefault();
        $event.stopPropagation();
  
        $scope.opened_retenue = true;
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

    $scope.cloturer = function(){

        //   $scope.spinner = true;
   
       $http.post('api/pompistes.php?action=Cloture_Manquants',
       
                     {
                        'manquant'    :  $scope.pompistes_all,
                        'dates'    :  $scope.dt
                     }
       
                   ).success( function(data, status, headers, config){
       
                           console.log(data);

                           if (data[0].Transfert_Reussie == "Transfert_Reussie") {

    
                            alert('FELICITATION ! periode cloturee avec succes');
                          
    
    
                          $state.go('app.suiviManquants');
                            /*   $state.go('wherever', {whenever: 'whatever'}).then(function() {
      // Get in a spaceship and fly to Jupiter, or whatever your callback does.
    });  */
                        }else{
                          alert('ATTENTION ! une erreur est produite, VERIFIER VOS DONNEES');
                        }
                          
                     });
       
       
    }

/**************************************************************************************************************** */
    $scope.open = function () {

        var modalInstance = $modal.open({
        templateUrl: 'manquantContent.html',
        controller: 'ModalInstancePlaylistCtrl',
        size: 'sm',
        resolve: {

            data: function () {
            $scope.selected = $scope.pompistes ;
            return $scope.selected ;
            
            },

            params: $scope.dt
        }

        });

            console.log($scope.selected);

        modalInstance.result.then(function (selectedItem) {

            console.log(selectedItem)
            $scope.cloturer();
                
              
        }, function () {
        $log.info('Modal dismissed at: ' + new Date());
        });        

    }

/***************************************************************************************************************/      
    $scope.spinner = false; 
    $scope.vue = true;  // show playlist form


    $scope.manquant = function(){

     //   $scope.spinner = true;

     $http.post('api/pompistes.php?action=Suivi_Manquants',
    
                  {
                    'manquant'    :  $scope.dt,
                  }
    
                ).success( function(data, status, headers, config){
    
                        console.log(data);
                        $scope.pompistes_all = data ;
                        
                                          
                  });
    
    
    }

    $scope.manquant_exceptionel = function(){

      //   $scope.spinner = true;
 
     $http.post('api/pompistes.php?action=Manquants_exceptionel',
     
                   {
                     'manquant'    :  $scope.manq,
                   }
     
                 ).success( function(data, status, headers, config){
                        
                         console.log(data);
                         $scope.manquant();

                         alert('Felicitation ! le manquant exceptionel a ete ajoute avec succes') ;

                         $scope.manq = {} ;
                         
                                           
                   });
     
     
     }

     $scope.pompiste_all =  function(){

      $http.get('api/pompistes.php?action=get_pompistes_all').success( function(data, status, headers, config){
            $scope.pompistes = data ;
            console.log(data);
        })
    
    };

     $scope.retenue = function(){

      //   $scope.spinner = true;
 
     $http.post('api/pompistes.php?action=Manquants_retenue',
     
                   {
                     'retenue'    :  $scope.ret,
                   }
     
                 ).success( function(data, status, headers, config){
                         
                      console.log(data);
                   
                /*      angular.forEach($scope.pompiste_all, function(value) {

                        if (value.id_pompiste == $scope.ret.pompiste) {
                  
                           value.retenue += $scope.ret.montant ;
                        }
                  
                      });

              */
                    //  $scope.manquant();
                                           
                   });
     
     
     }
   

    $scope.after_save = function(id_pompiste, total_manquant, retenue){


      angular.forEach($scope.pompistes_all, function(value, key){

        console.log(key);
        console.log(value);
        console.log(id_pompiste);
   
       if (id_pompiste == value.id_pompiste) { 
   
          
             $scope.pompistes_all[key].nouveau_solde = total_manquant - retenue ;
            
   
       }
   
     })
   
   
    }

   $scope.before_save = function(matricule, ancien_solde, manquant, manquant_exceptionel, retenue){


    angular.forEach($scope.pompistes_all, function(value, key){

      console.log(key);
      console.log(value);
      console.log(matricule);
 
     if (matricule == value.matricule) { 
 
        
      $scope.pompistes_all[key].total_manquant = ancien_solde + manquant + manquant_exceptionel ;
      $scope.pompistes_all[key].nouveau_solde =  $scope.pompistes_all[key].total_manquant - retenue ;
          
 
     }
 
   })
 
 
   }
    
  
    

}]);
