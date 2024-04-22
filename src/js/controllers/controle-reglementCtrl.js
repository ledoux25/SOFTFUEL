app.controller('ModalInstancePlaylistCtrl', ['$scope', '$modalInstance', 'items',  function($scope, $modalInstance, items ) {
    $scope.items = items;
    console.log($scope.items);

    $scope.OK = function () {
      $modalInstance.close($scope.items);
      
    };

    $scope.cancel = function () {
      $modalInstance.dismiss('cancel');
    };


  }]);


app.controller('controle-reglementCtrl', ['$scope', '$filter', '$http', '$modal', '$log', 'editableOptions', 'editableThemes',
  function($scope, $filter, $http, $modal, $log, editableOptions, editableThemes){
    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';


    $scope.vue = true ;

    $scope.pl = {} ;
    $scope.pom = {} ;

    $scope.versements = [];
    $scope.stations = [];

    $scope.statut = [{id:1 , nom:'VALIDE'}, {id:2 , nom:'NON VALIDE'}] ;

    $scope.today = function() {
      $scope.pom.date_debut = new Date();
      $scope.pom.date_fin = new Date();
    };
    $scope.today();

    $scope.toggleMin = function() {
      $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open_date = function($event) {
      $event.preventDefault();
      $event.stopPropagation();

      $scope.opened = true;
    };

    $scope.open2_date = function($event) {
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

/**************************************************************************************************************** */

    $scope.selected ;

    $scope.open = function (playlist) {

          var modalInstance = $modal.open({
            templateUrl: 'deleteContent.html',
             controller: 'ModalInstancePlaylistCtrl',
             size: 'sm',
             resolve: {
              items: function () {
                $scope.selected = playlist ;
                angular.extend($scope.selected, {playlistid: $scope.playlistId});
                return $scope.selected ;
                
              }
            }

          });

              console.log($scope.selected);

            modalInstance.result.then(function (selectedItem) {
                  $scope.select = selectedItem;
            
                  return Playlist.delete({id: $scope.select.id}, null, function(data){
                   
                      $scope.playlists= Playlist.query();
                      var modalInstance = $modal.open({
                      templateUrl: 'successContent.html',
                       controller: 'ModalInstancePlaylistCtrl',
                       size: 'sm',
                       resolve: {
                            items: function () {
                              $scope.selected = data ;
                              return $scope.selected ;
                              
                            }
                          }

                      });

                      }, function(data){
                      
                        $scope.playlists= Playlist.query();
                        var modalInstance = $modal.open({
                        templateUrl: 'rejectContent.html',
                         controller: 'ModalInstancePlaylistCtrl',
                         size: 'sm',
                         resolve: {
                              items: function () {
                                $scope.selected = data ;
                                return $scope.selected ;
                                
                              }
                            }
                      
                        });
                  
                    });
          }, function () {
            $log.info('Modal dismissed at: ' + new Date());
          });        

    }

    

/***************************************************************************************************************/      
    $scope.spinner = true ; 

    //$scope.vue = true;  // show playlist form


    $scope.station =  function(){

      $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
            $scope.stations = data ;
            console.log(data);
        })
    
    };

    $scope.get_versement = function(){

      $http.post('api/pompistes.php?action=get_versement',
     
                    {
                     'pompiste'    :  $scope.pom,
                   }
     
                 ).success( function(data, status, headers, config){
                         console.log(data);
     
                         if (data.msg=="") {
                           
                          // $scope.pom={};
                           alert('Felicitation! Operation Executer avec success');
                         }else{
                           alert('Desolé! Echec Operation');
                         }
     
                                           
                   });
     
     
     }


    $scope.edit_pompiste = function(data){

     

    $http.post('api/pompistes.php?action=edit_pompiste',
    
                  {
                    'pompiste'    :  data,
                  }
    
                ).success( function(data, status, headers, config){
                        console.log(data);
    
                        if (data.msg=="") {
                          
                          $scope.pom={};
                          alert('Felicitation! Operation Executer avec success');
                        }else{
                          alert('Desolé! Echec Operation');
                        }
    
                                          
                  });
    
    
    }

    // init pompistes

    $scope.initPompistes = function(){

      $http.get('api/pompistes.php?action=get_pompistes_all').success( function(data, status, headers, config){
        $scope.pompistes = data ;
        console.log(data);
        $scope.spinner = false; 
    })

   
    } 


    $scope.groups = [];
    
    // select group True or False
    $scope.loadGroups = function() {
      return $scope.groups.length ? null : $http.get('api/groups').success(function(data) {
        $scope.groups = data;
      });
    }

    $scope.loadsexe = function() {
      return $scope.sexes.length ? null :  $scope.sexes = $scope.sexes;
      
    }

    $scope.loadstation = function() {
      return $scope.stations.length ? null :  $scope.stations = $scope.station();
      
    }
    
      // update pompiste

    $scope.savePompiste = function(data, id) {

    }

    
     // add Pompiste

    $scope.addPompiste = function() {
     
       

    }

}]);
