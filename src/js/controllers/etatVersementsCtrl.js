$(document).ready(function() {
  $('tbody').scroll(function(e) { //detect a scroll event on the tbody
  	/*
    Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
    of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain 			it's relative position at the left of the table.    
    */
    $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
    //$('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
    //$('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
  });
});

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
  
  app.controller('etatVersementsCtrl', ['$scope', '$filter', '$http','$localStorage',
  function($scope, $filter, $http, $localStorage){
  
    $scope.dt = {} ;
    $scope.dates = [] ;
    $scope.recap_versement = [] ;
    $scope.recap_versement_me = [] ;
    $scope.recap = [] ;
  
    $scope.role = {};
  
    if ($localStorage.User.role == 'ADMINISTRATEUR') {
      $scope.role.user = 'ADMINISTRATEUR';
    } else {
      $scope.role.user = 'UTILISATEUR';
    }
  
   
    $scope.today = function() {
      $scope.dt.date_debut = new Date();
      $scope.dt.date_fin = new Date();
    };
  
    $scope.today();
  
  /*
    $scope.clear = function () {
      $scope.date_debut = null;
      $scope.date_fin = null;
    };
  
    
    $scope.disabled = function(date, mode) {
      return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };
  */
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
  
  /**************************************************************************************************************** */
  
  
   $scope.quarts = [{quart:'QUART 1'},{quart:'QUART 2'},{quart:'JOURNEE ENTIERE'}];
   $scope.stations = [];
  /***************************************************************************************************************/      
  
  $scope.versement = function(){
  
  console.log($scope.dt);
  
  $http.post('api/pompistes.php?action=Etats_Versements',
  
               {
                'versement'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              $scope.recap_versement = data ;
  
                                      
              });
  
  }

  $scope.versement_me = function(){
  
    console.log($scope.dt);
    
    $http.post('api/pompistes.php?action=Etats_Versements_ME',
    
                 {
                  'versement'    :  $scope.dt,
                }
    
              ).success( function(data, status, headers, config){
                      
                console.log(data);
    
                $scope.recap_versement_me = data ;
    
                                        
                });
    
  }
  
  $scope.date = function(){
  
  console.log($scope.dt);
  
  $http.post('api/pompistes.php?action=Get_dates',
  
               {
                'date'    :  $scope.dt,
              }
  
            ).success( function(data, status, headers, config){
                    
              console.log(data);
  
              $scope.dates = data ;
  
                                      
              });
  
  }

  $scope.export_me = function(){

    console.log($scope.dt) ;
    
    $http.post('api/pompistes_export.php?action=Etats_Versements_ME',
    
              {
                'versement'    :  $scope.dt,
              }
  
    
              ).success( function(data, status, headers, config){
  
                console.log(data) ;
  
                if (data.status === 'OK') {
  
                  window.open(
                    '../src/api/etat_versements_me.'+$scope.dt.format, '_blank' 
                  );
  
                }
                      
                });
    
  }
  
/*  $scope.formats_export_me = [
    
    {nom_format:'PDF', format:'pdf', lien_export:'http://192.168.1.3/station/src/api/etat_versements_me.pdf'},
    {nom_format:'HTML', format:'html', lien_export:'http://192.168.1.3/station/src/api/etat_versements_me.html'},
    {nom_format:'WORD', format:'docx', lien_export:'http://192.168.1.3/station/src/api/etat_versements_me.docx'},
    {nom_format:'EXCEL', format:'xls', lien_export:'http://192.168.1.3/station/src/api/etat_versements_me.xls'},
    {nom_format:'POWERPOINT', format:'pptx', lien_export:'http://192.168.1.3/station/src/api/etat_versements_me.pptx'},
    
  ];

  */

  $scope.export_excel = function(){

    console.log($scope.dt) ;
    
    $http.post('api/pompistes_export.php?action=Etats_Versements_Excel',
    
              {
                'versement'    :  $scope.dt,
              }
  
    
              ).success( function(data, status, headers, config){
  
                console.log(data) ;
  
                if (data.status === 'OK') {
  
                  window.open(
                    '../src/api/DOCUMENTS/etat_versements.xlsx', '_blank' 
                  );
  
                }
                      
                });
    
  }
  /*
  $scope.formats_export = [
    
    {nom_format:'PDF', format:'pdf', lien_export:'http://192.168.1.3/station/src/api/etat_versements.pdf'},
    {nom_format:'HTML', format:'html', lien_export:'http://192.168.1.3/station/src/api/etat_versements.html'},
    {nom_format:'WORD', format:'docx', lien_export:'http://192.168.1.3/station/src/api/etat_versements.docx'},
    {nom_format:'EXCEL', format:'xls', lien_export:'http://192.168.1.3/station/src/api/etat_versements.xls'},
    {nom_format:'POWERPOINT', format:'pptx', lien_export:'http://192.168.1.3/station/src/api/etat_versements.pptx'},
    
  ];
  */
    
  
  }]);
  