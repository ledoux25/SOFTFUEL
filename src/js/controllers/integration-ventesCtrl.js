
  
app.controller('integration-ventesCtrl', function($scope, $http, $filter, $localStorage, $state, FileUploader, Produit) {
  
  
    $scope.role = {};
    $scope.date = {};


    if ($localStorage.User.role == 'ADMINISTRATEUR') {
      $scope.role.user = 'ADMINISTRATEUR';
    } else {
      $scope.role.user = 'UTILISATEUR';
    }

  /************************DATE QUART***************************************************/
  
    $scope.date.date_ouverture = new Date().toUTCString(); 
    $scope.date.quart = 'quart 1'; 

    $scope.heure = function(){

      return $http.get('api/pompistes.php?action=get_heure').success( function(data, status, headers, config){
 
       $date_ouverture = data[0].date_ouverture ;
       $quart = data[0].quart ;  
 
       $scope.date.date_ouverture2 = new Date($date_ouverture).toUTCString(); 
       $scope.date.date_ouverture = $date_ouverture ;
       $scope.date.quart = $quart ;
 
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
  
    
  /****************************UPLOAD FICHIER VENTES********************************************** */
  
  var uploader = $scope.uploader = new FileUploader({
    url: 'js/controllers/upload_ventes.php', formData:$datas
  });
  
  // FILTERS
  
  uploader.filters.push({
    name: 'customFilter',
    fn: function(item /*{File|FileLikeObject}*/, options) {
        return this.queue.length < 10;
    }
  });
  
  // CALLBACKS
  
  uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
    console.info('onWhenAddingFileFailed', item, filter, options);
  };
  uploader.onAfterAddingFile = function(fileItem) {
    console.info('onAfterAddingFile', fileItem);
  };
  uploader.onAfterAddingAll = function(addedFileItems) {
    console.info('onAfterAddingAll', addedFileItems);
  };
  uploader.onBeforeUploadItem = function(item) {
    console.info('onBeforeUploadItem', item);
  };
  uploader.onProgressItem = function(fileItem, progress) {
    console.info('onProgressItem', fileItem, progress);
  };
  uploader.onProgressAll = function(progress) {
    console.info('onProgressAll', progress);
  };
  uploader.onSuccessItem = function(fileItem, response, status, headers) {
    console.info('onSuccessItem', fileItem, response, status, headers);
  };
  uploader.onErrorItem = function(fileItem, response, status, headers) {
    console.info('onErrorItem', fileItem, response, status, headers);
  };
  uploader.onCancelItem = function(fileItem, response, status, headers) {
    console.info('onCancelItem', fileItem, response, status, headers);
  };
  uploader.onCompleteItem = function(fileItem, response, status, headers) {
    console.info('onCompleteItem', fileItem, response, status, headers);

    console.log(response.answer);

    if (response.answer == 'opération exécutée avec success') {
       
        alert('Félicitations ! opération exécutée avec success') ;

    }else if(response.answer == 'Le type de fichier ne correspond pas') {

        alert('Attention !!! Le type de fichier ne correspond pas') ;

    }else if(response.answer == 'Pas de fichier Joint') {

        alert('Attention !!! Pas de fichier Joint') ;

    }else if(response.answer == 'Pas de station selectionnée') {

        alert('Attention !!! Pas de station selectionnée') ;

    }else{

    alert('Désolé !  Veuillez réessayer...') ;

    }

    
    
    
  };
  
  uploader.onCompleteAll = function() {
    console.info('onCompleteAll');
  };
  
  console.info('uploader', uploader);
  
  /**********************************FIN UPLOAD FICHIER STOCK***************************************** */
  
  
});