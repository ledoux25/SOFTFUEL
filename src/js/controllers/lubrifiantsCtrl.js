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


app.controller('lubrifiantsCtrl', ['$scope', '$filter', '$http', '$modal', '$log', 'editableOptions', 'editableThemes',
  function($scope, $filter, $http, $modal, $log, editableOptions, editableThemes){
    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';

    $scope.pr = {} ;
    $scope.pro = {} ;
    $scope.produits = [];
    $scope.stations = [];


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
    $scope.spinner = true; 
    $scope.vue = true;  // show playlist form


    $scope.station =  function(){

      $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
            $scope.stations = data ;
            console.log(data);
        })
    
    };

    $scope.add_lubrifiant = function(){

      $http.post('api/lubrifiants.php?action=add_lubrifiant',
     
                    {
                     'produit'    :  $scope.pro,
                   }
     
                 ).success( function(data, status, headers, config){
                         console.log(data);
     
                         if (data.msg=="") {
                           
                           $scope.pro={};
                           alert('Felicitation! Operation Executer avec success');
                         }else{
                           alert(data.msg);
                         }
     
                                           
                   });
     }
 

    $scope.edit_lubrifiant = function(data){
    $http.post('api/lubrifiants.php?action=edit_lubrifiant',
    
                  {
                    'produit'    :  data,
                  }
    
                ).success( function(data, status, headers, config){
                        console.log(data);
    
                        if (data.msg=="") {
                          
                          $scope.pro={};
                          alert('Felicitation! Operation Executer avec success');
                        }else{
                          alert('Desolé! Echec Operation');
                        }
    
                                          
                  });
    
    
    }

    // init pompistes

    $scope.initLubrifiants = function(){

      $http.get('api/lubrifiants.php?action=get_lubrifiants').success( function(data, status, headers, config){
        $scope.produits = data ;
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
