app.controller('ModalInstanceVideoCtrl', ['$scope','$filter', '$http','$modal', '$modalInstance', 'items', function($scope,$filter, $http,$modal, $modalInstance, items) {
  $scope.items = items;
  console.log($scope.items);

  $scope.alerts = [];
  $scope.jauge = {};
  $scope.volume = {};
 
  $scope.OK = function () {

    angular.extend($scope.jauge, {volume_depart: $scope.volume.volume_depart});
    angular.extend($scope.jauge, {volume_fin: $scope.volume.volume_fin});
    angular.extend($scope.jauge, {id_cuve: $scope.items.id_cuve});
    $modalInstance.close($scope.jauge);

  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };


}]);


app.controller('quart1Ctrl', function($scope, $http, $filter, $localStorage, $state, FileUploader, Produit) {

$scope.date = {};
$scope.chef = {};

$scope.om = {};
$scope.boutique = {} ;
$scope.laverie = {};
$scope.appro = {};
$scope.pomp = {};
$scope.pompistes = [];
$scope.pist = [];
$scope.pistolets = [];
$scope.personnel = [];
$scope.cuves = [];
$scope.produits = [];
$scope.magasin = [];
$scope.livraison = {};
$scope.liv = {};
$scope.carb = {};
$scope.lubrifiant = {};

$scope.lubs = [] ;
$scope.lubri = {} ;
$scope.produits_lub = [] ;

$scope.depense = {};
$scope.versement = {};
$scope.livraisons = [];
$scope.lubrifiants = [];
$scope.vte_carburant = [];
$scope.vte_lubrifiant = [];
$scope.rgt_carburant = [];
$scope.rgt_client = [];
$scope.vte_gaz = [];
$scope.liv_gaz = [];
$scope.depenses = [];
$scope.depen = [{nom_depense: 'Carburant'}, {nom_depense: 'Lubrifiant'}, {nom_depense: 'Gaz'}, {nom_depense: 'Boutique'}, {nom_depense: 'Caisse'}];
$scope.reglements = [{type_reglement: 'Especes'}, {type_reglement: 'Chèque'}, {type_reglement : 'Autres'}];
$scope.services = [{type_service: 'Achat Carburant'}, {type_service: 'Achat Lubrifiant'}, {type_service : 'Autres'}];
$scope.recap = {};
$scope.recap.Lubrifiant=[];
$scope.recap.Carburant=[];
$scope.manquants = [] ;
$scope.commentaire = {} ;
$scope.vue = true ;

$scope.rgt_cli = {} ;
$scope.datas = [] ;
$scope.lubri = {} ;


$scope.quantite = function(produit){

if (produit == 'Gasoil') {

        var qte = 0;

   angular.forEach($scope.app.quart.personnel, function(value) {

    if (value.nom_produit == 'GASOIL') {

        qte = qte + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
    }

  });

   return qte ;

}else if (produit == 'Super') {

   var qte = 0;

   angular.forEach($scope.app.quart.personnel, function(value) {

    if (value.nom_produit == 'SUPER') {
        qte = qte + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
    }
    
  });

   return qte ;

}else if (produit == 'Petrole'){

  var qte = 0;

   angular.forEach($scope.app.quart.personnel, function(value) {

    if (value.nom_produit == 'PETROLE') {
        qte = qte + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
    }
    
  });

   return qte ;

}

}

$scope.prix_unitaire = function(produit){

if (produit == 'Gasoil') {

        var prix_unitaire = 0;

   angular.forEach($scope.app.quart.cuves, function(value) {

    if (value.nom_produit == 'GASOIL') {

      prix_unitaire = value.prix_unitaire;
    }

  });

   return prix_unitaire ;

}else if (produit == 'Super') {

   var prix_unitaire = 0;

   angular.forEach($scope.app.quart.cuves, function(value) {

    if (value.nom_produit == 'SUPER') {

      prix_unitaire = value.prix_unitaire;

    }
    
  });

   return prix_unitaire;

}else if (produit == 'Petrole'){

  var prix_unitaire = 0;

   angular.forEach($scope.app.quart.cuves, function(value) {

    if (value.nom_produit == 'PETROLE') {

      prix_unitaire = value.prix_unitaire;

    }
    
  });

   return prix_unitaire ;

}

}


$scope.qte = function(){

  var qte = 0;

   angular.forEach($scope.recap.Lubrifiant, function(value) {

   qte = qte + parseInt(value.qte_vendu) ;  
    
  });

   return qte ;

}

$scope.qte_gaz_ab = function(){

  var qte = 0;

   angular.forEach($scope.recap.Gaz_AB, function(value) {

   qte = qte + parseInt(value.qv_ab) ;  
    
  });

   return qte ;

}

$scope.qte_gaz_sb = function(){

  var qte = 0;

   angular.forEach($scope.recap.Gaz_SB, function(value) {

   qte = qte + parseInt(value.qv_sb) ;  
    
  });

   return qte ;

}

$scope.qte_client_carb = function(){

  var qte = 0;

   angular.forEach($scope.recap.Client_Carburant, function(value) {

   qte = qte + parseInt(value.quantite) ;  
    
  });

   return qte ;

}

$scope.qte_client = function(produit){

  var qte = 0;

   angular.forEach($scope.recap.Client_Carburant, function(value) {

    if (value.nom_produit == produit) {
       qte = qte + parseInt(value.quantite) ;  
    }
    
  });

   return qte ;

}

$scope.qte_client_lub = function(){

  var qte = 0;

   angular.forEach($scope.recap.Client_Lubrifiant, function(value) {

   qte = qte + parseInt(value.quantite) ;  
    
  });

   return qte ;

}

$scope.qte_commande_carb = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_carb, function(value) {

   qte = qte + parseInt(value.qte_commande) ;  
    
  });

   return qte ;

}

$scope.qte_commande_lub = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_lub, function(value) {

   qte = qte + parseInt(value.qte_commande) ;  
    
  });

   return qte ;

}

$scope.qte_commande_gaz = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_gaz, function(value) {

   qte = qte + parseInt(value.qte_commande) ;  
    
  });

   return qte ;

}

$scope.qte_recu_carb = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_carb, function(value) {

   qte = qte + parseInt(value.qte_recu) ;  
    
  });

   return qte ;

}

$scope.qte_recu_lub = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_lub, function(value) {

   qte = qte + parseInt(value.qte_recu) ;  
    
  });

   return qte ;

}

$scope.qte_recu_gaz = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_gaz, function(value) {

   qte = qte + parseInt(value.qte_recu) ;  
    
  });

   return qte ;

}

$scope.manquant_stock_carb = function(){

  var mtn = 0;

   angular.forEach($scope.recap.stock_carb, function(value) {

   mtn = mtn + parseInt(value.manquant);
    
  });

   return mtn ;


}

$scope.manquant_carb = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_carb, function(value) {

   qte = qte + parseInt(value.manquant) ;  
    
  });

   return qte ;

}

$scope.manquant_lub = function(){

  var qte = 0;

   angular.forEach($scope.recap.livraison_lub, function(value) {

   qte = qte + parseInt(value.manquant) ;  
    
  });

   return qte ;

}

$scope.montant = function(produit){

console.log($scope.produits);

if (produit == 'Gasoil') {

   return $scope.quantite('Gasoil')*$scope.produits[0].prix_unitaire ;

}else if (produit == 'Super') {

   return $scope.quantite('Super')*$scope.produits[1].prix_unitaire ;

}else if (produit == 'Petrole'){

   return $scope.quantite('Petrole')*$scope.produits[2].prix_unitaire ;

} 

} 

$scope.mont = function(){

  var mtn = 0;

   angular.forEach($scope.recap.Lubrifiant, function(value) {

   mtn = parseFloat(mtn)  + parseFloat(value.montant);
    
  });

   return mtn ;

}

$scope.mont_gaz_ab = function(){

  var mtn = 0;

   angular.forEach($scope.recap.Gaz_AB, function(value) {

   mtn = mtn + value.montant_ab;
    
  });

   return mtn ;

}

$scope.mont_gaz_sb = function(){

  var mtn = 0;

   angular.forEach($scope.recap.Gaz_SB, function(value) {

   mtn = mtn + value.montant_sb;
    
  });

   return mtn ;

}

$scope.mont_client_carb = function(){

  var mtn = 0;

   angular.forEach($scope.recap.Client_Carburant, function(value) {

   mtn = mtn + value.montant;
    
  });

   return mtn ;

}

$scope.mont_client = function(produit){

  var mtn = 0;

   angular.forEach($scope.recap.Client_Carburant, function(value) {

    if (value.nom_produit == produit) {
      mtn = mtn + value.montant;
    }

    
  });

   return mtn ;

}

$scope.mont_client_lub = function(){

  var mtn = 0;

   angular.forEach($scope.recap.Client_Lubrifiant, function(value) {

   mtn = mtn + value.montant;
    
  });

   return mtn ;

}

$scope.montant_dep_carb = function(){
  var mtn = 0;

   angular.forEach($scope.recap.dep_carb, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_dep_lub = function(){
  var mtn = 0;

   angular.forEach($scope.recap.dep_lub, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_dep_gaz = function(){
  var mtn = 0;

   angular.forEach($scope.recap.dep_gaz, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_dep_bout = function(){
  var mtn = 0;

   angular.forEach($scope.recap.dep_bout, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_dep_cais = function(){
  var mtn = 0;

   angular.forEach($scope.recap.dep_cais, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_vers_pomp = function(){
  var mtn = 0;

   angular.forEach($scope.recap.vers_pomp, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.montant_vers_client = function(){
  var mtn = 0;

   angular.forEach($scope.recap.vers_client, function(value) {

   mtn = mtn + parseInt(value.montant);
    
  });

   return mtn ;

}

$scope.ecart_stock_carb = function(){

  var mtn = 0;

   angular.forEach($scope.recap.stock_carb, function(value) {

   mtn = mtn + parseInt(value.ecart);
    
  });

   return mtn ;

}

$scope.recap_vers_especes = function(){

  var mtn = 0;

  angular.forEach($scope.recap.vers_client, function(value) {

    if (value.type_reglement == 'Especes') {
      mtn = mtn + parseInt(value.montant);

    }

  });  

   mtn = mtn + $scope.recap.vers_pomp[($scope.recap.vers_pomp.length-1)].montant;

   return mtn ;

}

$scope.recap_vers_cheques = function(){

  var mtn = 0;

   angular.forEach($scope.recap.vers_client, function(value) {

    if (value.type_reglement == 'Chèque') {
      mtn = mtn + parseInt(value.montant);

    }

  });

   return mtn ;

}


$scope.recapCarb= function(){

/*  var deferred = $q.defer();

$scope.recap.Carburant = [{produit: 'Gasoil', quantite: $scope.quantite('Gasoil'), prix_unitaire:$scope.prix_unitaire('Gasoil'), montant_produit: $scope.montant('Gasoil')}, {produit: 'Super', quantite: $scope.quantite('Super'), prix_unitaire:$scope.prix_unitaire('Super'), montant_produit: $scope.montant('Super')}, {produit: 'Petrole', quantite: $scope.quantite('Petrole'), prix_unitaire:$scope.prix_unitaire('Petrole'), montant_produit: $scope.montant('Petrole')}, {produit: 'Total Carburant', quantite:$scope.quantite('Gasoil')+$scope.quantite('Super')+$scope.quantite('Petrole'), prix_unitaire:'', montant_produit:$scope.montant('Gasoil')+$scope.montant('Super')+$scope.montant('Petrole')}];
deferred.resolve(); */
$scope.recap.Carburant = [];

var obj1 = {produit: 'GASOIL', quantite: 0, prix_unitaire:0, montant:0}; 
var obj2 = {produit: 'SUPER', quantite: 0, prix_unitaire:0, montant:0}; 
var obj3 = {produit: 'PETROLE', quantite: 0, prix_unitaire:0, montant:0};


   angular.forEach($scope.app.quart.cuves, function(value) {

      if (value.nom_produit == 'GASOIL') {

          obj1.prix_unitaire = value.prix_unitaire;
      }

      if (value.nom_produit == 'SUPER') {

          obj2.prix_unitaire = value.prix_unitaire;

      }

      if (value.nom_produit == 'PETROLE') {

          obj3.prix_unitaire = value.prix_unitaire;

      }

  });

   angular.forEach($scope.app.quart.personnel, function(value) {

      if (value.nom_produit == 'GASOIL') {

          obj1.quantite = parseInt(obj1.quantite)  + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
          obj1.montant = obj1.quantite*obj1.prix_unitaire ;
      }

      if (value.nom_produit == 'SUPER') {

          obj2.quantite = parseInt(obj2.quantite)  + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
          obj2.montant = obj2.quantite*obj2.prix_unitaire ;

      }

      if (value.nom_produit == 'PETROLE') {

          obj3.quantite = parseInt(obj3.quantite)  + (value.index_fin - value.index_depart) - (value.index_fin_remise - value.index_depart_remise);
          obj3.montant = obj3.quantite*obj3.prix_unitaire ;

      }

  });

   var obj4 = {produit: 'Total Carburant', quantite:obj1.quantite+obj2.quantite+obj3.quantite , prix_unitaire:0, montant:obj1.montant+obj2.montant+obj3.montant};
    $scope.recap.Carburant.push(obj1);
    $scope.recap.Carburant.push(obj2);
    $scope.recap.Carburant.push(obj3);
    $scope.recap.Carburant.push(obj4);
    console.log($scope.recap.Carburant);


//  return deferred.promise;

}

$scope.recapLub = function(){
 $scope.recap.Lubrifiant = [];
 angular.forEach($scope.app.quart.magasin, function(value) {

  
    if (value.qte_vendu != 0) {
  
    var obj = {};
      obj.nom_produit = value.nom_produit;
      obj.code_produit = value.code_produit;
      obj.type_produit = value.type_produit;
      obj.conditionnement = value.conditionnement;
      obj.prix_unitaire = value.prix_produit;
      obj.qte_vendu = value.qte_vendu;
    //  obj.livraison = value.livraison ;
      obj.montant = obj.qte_vendu*obj.prix_unitaire;
      $scope.recap.Lubrifiant.push(obj);

    }

  });

    var obj2 = {nom_produit:'Total Lubrifiant', qte_vendu:$scope.qte(), prix_unitaire:'', montant:$scope.mont()};
   $scope.recap.Lubrifiant.push(obj2);
   console.log($scope.recap.Lubrifiant);

}

$scope.recapGaz_AB = function(){
 $scope.recap.Gaz_AB = [];
 angular.forEach($scope.app.quart.gaz, function(value) {
    if (value.qv_ab != 0) {
    var obj = {};
      obj.nom_produit = value.nom_produit;
      obj.code_produit = value.code_produit;
      obj.type_produit = value.type_produit;
      obj.prix_unitaire_ab = value.prix_produit;
      obj.qv_ab = value.qv_ab;
      obj.montant_ab = obj.qv_ab*obj.prix_unitaire_ab;
   $scope.recap.Gaz_AB.push(obj);

    }

  });

    var obj2 = {nom_produit:'Total Ventes Avec Bouteille', qv_ab:$scope.qte_gaz_ab(), prix_unitaire_ab:'', montant_ab:$scope.mont_gaz_ab()};
   $scope.recap.Gaz_AB.push(obj2);
   console.log($scope.recap.Gaz_AB);

}

$scope.recapGaz_SB = function(){
 $scope.recap.Gaz_SB = [];
 angular.forEach($scope.app.quart.gaz, function(value) {
    if (value.qv_sb != 0) {
    var obj = {};
      obj.nom_produit = value.nom_produit;
      obj.code_produit = value.code_produit;
      obj.type_produit = value.type_produit;
      obj.prix_unitaire_sb = value.prix_produit;
      obj.qv_sb = value.qv_sb;
      obj.montant_sb = obj.qv_sb*obj.prix_unitaire_sb;
   $scope.recap.Gaz_SB.push(obj);

    }

  });

    var obj2 = {nom_produit:'Total Ventes Sans Bouteille', qv_sb:$scope.qte_gaz_sb(), prix_unitaire_sb:'', montant_sb:$scope.mont_gaz_sb()};
   $scope.recap.Gaz_SB.push(obj2);
   console.log($scope.recap.Gaz_SB);

}

$scope.recapClient_Car = function(){

  $scope.recap.Client_Carburant = [] ;
 angular.forEach($scope.app.quart.vte_carburant, function(value) {
    
    var obj = {};
      obj.client = value.nom_client;
      obj.nom_produit = value.nom_produit;
      obj.prix_client = parseInt(value.prix_client);
      obj.quantite = parseInt(value.qte) ;
      obj.montant = parseInt(value.montant);
      $scope.recap.Client_Carburant.push(obj);

  });


   var obj2 = {client:'Total Gasoil', nom_produit:'Gasoil', quantite:$scope.qte_client('gasoil'), prix_client:'', montant:$scope.mont_client('GASOIL')};
   $scope.recap.Client_Carburant.push(obj2);
   console.log($scope.recap.Client_Carburant);

   var obj3 = {client:'Total Super', nom_produit:'Super', quantite:$scope.qte_client('super'), prix_client:'', montant:$scope.mont_client('SUPER')};
   $scope.recap.Client_Carburant.push(obj3);
   console.log($scope.recap.Client_Carburant);

   var obj4 = {client:'Total Petrole', nom_produit:'Petrole', quantite:$scope.qte_client('petrole'), prix_client:'', montant:$scope.mont_client('PETROLE')};
   $scope.recap.Client_Carburant.push(obj4);
   console.log($scope.recap.Client_Carburant);

    var obj5 = {client:'Total Carburant', nom_produit:'', quantite:$scope.qte_client_carb(), prix_client:'', montant: obj2.montant + obj3.montant + obj4.montant};
   $scope.recap.Client_Carburant.push(obj5);
   console.log($scope.recap.Client_Carburant);


}

$scope.recapClient_Lub = function(){
 $scope.recap.Client_Lubrifiant = [];
 angular.forEach($scope.app.quart.vte_lubrifiant, function(value) {
    
     var obj = {};
      obj.client = value.client;
      obj.produit = value.produit;
      obj.prix_client = value.prix_client;
      obj.quantite = value.qte;
      obj.montant = obj.quantite*obj.prix_client;
      $scope.recap.Client_Lubrifiant.push(obj);

  });

    var obj2 = {client:'Total Lubrifiant', nom_produit:'', quantite:$scope.qte_client_lub(), prix_client:'', montant:$scope.mont_client_lub()};
   $scope.recap.Client_Lubrifiant.push(obj2);
   console.log($scope.recap.Client_Lubrifiant);

}

$scope.recapDep_Carb = function(){

 $scope.recap.dep_carb = [];
 angular.forEach($scope.app.quart.depense, function(value) {
    
    if (value.recette == 'Carburant') {

      var obj = {};
      obj.nature = value.nature;
      obj.montant = value.montant;
      $scope.recap.dep_carb.push(obj);
      console.log(obj);
    }
     

  });

    var obj2 = {nature:'Total Dep_Carb', montant:$scope.montant_dep_carb()};
   $scope.recap.dep_carb.push(obj2);
   console.log($scope.recap.dep_carb);

}

$scope.recapDep_Lub = function(){

 $scope.recap.dep_lub = [];
 angular.forEach($scope.app.quart.depense, function(value) {
    
    if (value.recette == 'Lubrifiant') {

      var obj = {};
      obj.nature = value.nature;
      obj.montant = value.montant;
      $scope.recap.dep_carb.push(obj);
      console.log(obj);
    }
     

  });

    var obj2 = {nature:'Total Dep_Lub', montant:$scope.montant_dep_lub()};
   $scope.recap.dep_lub.push(obj2);
   console.log($scope.recap.dep_lub);

}

$scope.recapDep_Gaz = function(){

 $scope.recap.dep_gaz = [];
 angular.forEach($scope.app.quart.depense, function(value) {
    
    if (value.recette == 'Gaz') {

      var obj = {};
      obj.nature = value.nature;
      obj.montant = value.montant;
      $scope.recap.dep_gaz.push(obj);
      console.log(obj);
    }
     

  });

    var obj2 = {nature:'Total Dep_Gaz', montant:$scope.montant_dep_gaz()};
   $scope.recap.dep_gaz.push(obj2);
   console.log($scope.recap.dep_gaz);

}

$scope.recapDep_Bout = function(){

 $scope.recap.dep_bout = [];
 angular.forEach($scope.app.quart.depense, function(value) {
    
    if (value.recette == 'Boutique') {

      var obj = {};
      obj.nature = value.nature;
      obj.montant = value.montant;
      $scope.recap.dep_bout.push(obj);
      console.log(obj);
    }
     

  });

    var obj2 = {nature:'Total Dep_Bout', montant:$scope.montant_dep_bout()};
   $scope.recap.dep_bout.push(obj2);
   console.log($scope.recap.dep_bout);

}

$scope.recapDep_Cais = function(){

 $scope.recap.dep_cais = [];
 angular.forEach($scope.app.quart.depense, function(value) {
    
    if (value.recette == 'Caisse') {

      var obj = {};
      obj.nature = value.nature;
      obj.montant = value.montant;
      $scope.recap.dep_cais.push(obj);
      console.log(obj);
    }
     

  });

    var obj2 = {nature:'Total Dep_Cais', montant:$scope.montant_dep_cais()};
   $scope.recap.dep_cais.push(obj2);
   console.log($scope.recap.dep_cais);



}

$scope.recapVers_pomp = function(){

 $scope.recap.vers_pomp = [];
 angular.forEach($scope.app.quart.rgt_carburant, function(value) {
    
      var obj = {};
      obj.nom_pompiste = value.nom_pompiste;
      obj.montant = value.montant;
      $scope.recap.vers_pomp.push(obj);
      console.log(obj);
  
  });

    var obj2 = {nom_pompiste:'Total Vers_Pomp', montant:$scope.montant_vers_pomp()};
   $scope.recap.vers_pomp.push(obj2);
   console.log($scope.recap.vers_pomp);

}

$scope.recapVers_client = function(){

 $scope.recap.vers_client = [];
 angular.forEach($scope.app.quart.rgt_client, function(value) {
    
      var obj = {};
      obj.client = value.client;
      obj.type_reglement = value.type_reglement;
      obj.type_service = value.type_service;
      obj.montant = value.montant;
      $scope.recap.vers_client.push(obj);
      console.log(obj);

  });

    var obj2 = {client:'Total Vers_Client', type_reglement:'', type_service:'', montant:$scope.montant_vers_client()};
   $scope.recap.vers_client.push(obj2);
   console.log($scope.recap.vers_client);

}

$scope.recapLivraison_carb = function(){

 $scope.recap.livraison_carb = [];
 var obj1={produit:'GASOIL', cuve:'', num_bon:'', num_scdp:'', nom_chauffeur:'', mat_camion:'', transporteur:'', qte_commande:0, qte_recu: 0, manquant:0}; 
 var obj2={produit:'SUPER', cuve:'', num_bon:'', num_scdp:'', nom_chauffeur:'', mat_camion:'', transporteur:'', qte_commande:0, qte_recu: 0, manquant:0}; 
 var obj3={produit:'PETROLE', cuve:'', num_bon:'', num_scdp:'', nom_chauffeur:'', mat_camion:'', transporteur:'', qte_commande:0, qte_recu: 0, manquant:0};
 
   angular.forEach($scope.app.quart.livraisons, function(value) {
      
  if (value.produit == 'GASOIL') {

      obj1.produit = 'GASOIL';
      obj1.cuve = value.cuve;
      obj1.num_bon = value.num_bon;
      obj1.num_scdp = value.num_scdp;
      obj1.nom_chauffeur = value.nom_chauffeur;
      obj1.mat_camion = value.mat_camion;
      obj1.transporteur = value.transporteur;
      obj1.qte_commande = obj1.qte_commande +  value.qte_commande ;
      obj1.qte_recu = obj1.qte_recu + value.qte_recu ;
      obj1.manquant = parseInt(obj1.qte_commande) - parseInt(obj1.qte_recu) ;
      
  }

  if (value.produit == 'SUPER') {
      
      obj2.produit = 'SUPER';
      obj2.cuve = value.cuve;
      obj2.num_bon = value.num_bon;
      obj2.num_scdp = value.num_scdp;
      obj2.nom_chauffeur = value.nom_chauffeur;
      obj2.mat_camion = value.mat_camion;
      obj2.transporteur = value.transporteur;
      obj2.qte_commande = obj2.qte_commande +  parseInt(value.qte_commande) ;
      obj2.qte_recu = obj2.qte_recu + parseInt(value.qte_recu) ;
      obj2.manquant = parseInt(obj2.qte_commande) - parseInt(obj2.qte_recu) ;
     
  }

   if (value.produit == 'PETROLE') {
      
      obj3.produit = 'PETROLE';
      obj3.cuve = value.cuve;
      obj3.num_bon = value.num_bon;
      obj3.num_scdp = value.num_scdp;
      obj3.nom_chauffeur = value.nom_chauffeur;
      obj3.mat_camion = value.mat_camion;
      obj3.transporteur = value.transporteur;
      obj3.qte_commande = obj3.qte_commande +  parseInt(value.qte_commande) ;
      obj3.qte_recu = obj3.qte_recu + parseInt(value.qte_recu) ;
      obj3.manquant = parseInt(obj3.qte_commande) - parseInt(obj3.qte_recu) ;
      
  }
     
      

  });

 

   $scope.recap.livraison_carb.push(obj1);
    
  



   $scope.recap.livraison_carb.push(obj2);
    
  

 

   $scope.recap.livraison_carb.push(obj3);

    
  

  

    var obj4 = {produit:'TOTAL', qte_commande:$scope.qte_commande_carb(), qte_recu:$scope.qte_recu_carb(), manquant:$scope.manquant_carb()};
   $scope.recap.livraison_carb.push(obj4);
   console.log($scope.recap.livraison_carb);

}

$scope.recapLivraison_carb2 = function(){

$scope.recap.livraison_carb2 = [];

$scope.livraison_carb_quart() ;


}

$scope.recapLivraison_carb3 = function(){


$scope.recap.livraison_carb3 = [];

var obj1 = {produit: 'GASOIL', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj2 = {produit: 'SUPER', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj3 = {produit: 'PETROLE', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj4 = {produit: 'SYNTHESE', qte_commande: 0, qte_recu: 0, manquant: 0} ;


obj1.produit = 'GASOIL';
obj1.qte_commande =  $scope.recap.livraison_carb[0].qte_commande + $scope.recap.livraison_carb2[0].qte_commande ;
obj1.qte_recu = $scope.recap.livraison_carb[0].qte_recu + $scope.recap.livraison_carb2[0].qte_recu ;
obj1.manquant = $scope.recap.livraison_carb[0].manquant + $scope.recap.livraison_carb2[0].manquant ;

obj2.produit = 'SUPER';
obj2.qte_commande = $scope.recap.livraison_carb[1].qte_commande + $scope.recap.livraison_carb2[1].qte_commande ;
obj2.qte_recu = $scope.recap.livraison_carb[1].qte_recu + $scope.recap.livraison_carb2[1].qte_recu ;
obj2.manquant = $scope.recap.livraison_carb[1].manquant + $scope.recap.livraison_carb2[1].manquant ;

obj3.produit = 'PETROLE';
obj3.qte_commande = $scope.recap.livraison_carb[2].qte_commande + $scope.recap.livraison_carb2[2].qte_commande ;
obj3.qte_recu = $scope.recap.livraison_carb[2].qte_recu + $scope.recap.livraison_carb2[2].qte_recu ;
obj3.manquant = $scope.recap.livraison_carb[2].manquant + $scope.recap.livraison_carb2[2].manquant ;


obj4.produit = 'SYNTHESE';
obj4.qte_commande = $scope.recap.livraison_carb[3].qte_commande + $scope.recap.livraison_carb2[3].qte_commande ;
obj4.qte_recu = $scope.recap.livraison_carb[3].qte_recu + $scope.recap.livraison_carb2[3].qte_recu ;
obj4.manquant = $scope.recap.livraison_carb[3].manquant + $scope.recap.livraison_carb2[3].manquant ;

$scope.recap.livraison_carb3.push(obj1);
$scope.recap.livraison_carb3.push(obj2);
$scope.recap.livraison_carb3.push(obj3);
$scope.recap.livraison_carb3.push(obj4);


console.log( $scope.recap.livraison_carb3) ;

}

$scope.recapLivraison_lub = function(){

 $scope.recap.livraison_lub = [];
 angular.forEach($scope.app.quart.lubrifiants, function(value) {
    
      var obj = {};
      obj.produit = value.produit;
      obj.num_bon = value.num_bon;
      obj.num_scdp = value.num_scdp;
      obj.nom_chauffeur = value.nom_chauffeur;
      obj.mat_camion = value.mat_camion;
      obj.transporteur = value.transporteur;
      obj.qte_commande = value.qte_commande;
      obj.qte_recu = value.qte_recu;
      obj.manquant = obj.qte_commande - obj.qte_recu ;
      $scope.recap.livraison_lub.push(obj);
      console.log(obj);

  });

    var obj2 = {produit:'TOTAL', qte_commande:$scope.qte_commande_lub(), qte_recu:$scope.qte_recu_lub(), manquant: $scope.qte_commande_lub() - $scope.qte_recu_lub()};
   $scope.recap.livraison_lub.push(obj2);

   console.log($scope.recap.livraison_lub);

}

$scope.recapLivraison_lub2 = function(){

$scope.recap.livraison_lub2 = [];
$scope.livraison_lub_quart() ;



}

$scope.recapLivraison_lub3 = function(){

$scope.recap.livraison_lub3 = [];

var obj1 = {produit: 'TOTAL', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj2 = {produit: '', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj3 = {produit: '', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj4 = {produit: '', qte_commande: 0, qte_recu: 0, manquant: 0} ;

$scope.recap.livraison_lub3.push(obj1);

}



$scope.recapLivraison_gaz = function(){

 $scope.recap.livraison_gaz = [];
 angular.forEach($scope.app.quart.liv_gaz, function(value) {
    
      var obj = {};
      obj.produit = value.produit;
      obj.num_bon = value.num_bon;
      obj.nom_chauffeur = value.nom_chauffeur;
      obj.mat_camion = value.mat_camion;
      obj.transporteur = value.transporteur;
      obj.qte_commande = value.qte_commande;
      obj.qte_recu = value.qte_recu;
      obj.manquant = obj.qte_commande - obj.qte_recu ;
      $scope.recap.livraison_gaz.push(obj);
      console.log(obj);

  });

    var obj2 = {produit:'Total Liv_gaz', qte_commande:$scope.qte_commande_gaz(), qte_recu:$scope.qte_recu_gaz(), manquant:($scope.qte_commande_gaz()-$scope.qte_recu_gaz())};
   $scope.recap.livraison_gaz.push(obj2);
   console.log($scope.recap.livraison_gaz);

}

$scope.recapStock_carb = function(){

 $scope.recap.stock_carb = [];
 var obj1={qte_commande:0, qte_recu: 0, manquant:0, ventes:0, ecart:0, stock_ouverture:0, stock_physique:0}; var obj2={qte_commande:0, qte_recu: 0, manquant:0, ventes:0, ecart:0, stock_ouverture:0, stock_physique:0}; var obj3={qte_commande:0, qte_recu: 0, manquant:0, ventes:0, ecart:0, stock_ouverture:0, stock_physique:0};
 
   angular.forEach($scope.app.quart.cuves, function(value) {
      
  if (value.nom_produit == 'GASOIL') {
      
      obj1.produit = 'Gasoil';
      obj1.stock_ouverture = parseInt(obj1.stock_ouverture)  + parseInt(value.volume_debut) ;
      obj1.qte_commande = $scope.recap.livraison_carb[0].qte_commande  ;
      obj1.qte_recu = $scope.recap.livraison_carb[0].qte_recu ;
      obj1.manquant = parseInt(obj1.qte_commande) - parseInt(obj1.qte_recu) ;
      obj1.ventes = parseInt($scope.quantite('Gasoil'))+parseInt($scope.qte_client('gasoil')) ;
      obj1.stock_theorique = parseInt(obj1.stock_ouverture)+parseInt(obj1.qte_recu)-parseInt(obj1.ventes) ;
      obj1.stock_physique = parseInt(obj1.stock_physique) + parseInt(value.volume_fin) ;
      obj1.ecart = parseInt(obj1.stock_physique)-parseInt(obj1.stock_theorique) ;
      
  }

  if (value.nom_produit == 'SUPER') {
      
      obj2.produit = 'Super';
      obj2.stock_ouverture = parseInt(obj2.stock_ouverture)  + parseInt(value.volume_debut) ;
      obj2.qte_commande = $scope.recap.livraison_carb[1].qte_commande ;
      obj2.qte_recu = $scope.recap.livraison_carb[1].qte_recu ;
      obj2.manquant = parseInt(obj2.qte_commande) - parseInt(obj2.qte_recu) ;
      obj2.ventes = parseInt($scope.quantite('Super'))+parseInt($scope.qte_client('super')) ;
      obj2.stock_theorique = parseInt(obj2.stock_ouverture)+parseInt(obj2.qte_recu)-parseInt(obj2.ventes) ;
      obj2.stock_physique = obj2.stock_physique + parseInt(value.volume_fin) ;
      obj2.ecart = parseInt(obj2.stock_physique)-parseInt(obj2.stock_theorique) ;
  }

   if (value.nom_produit == 'PETROLE') {
      
      obj3.produit = 'Petrole';
      obj3.stock_ouverture = parseInt(obj3.stock_ouverture)  + parseInt(value.volume_debut) ;
      obj3.qte_commande = $scope.recap.livraison_carb[2].qte_commande ;
      obj3.qte_recu = $scope.recap.livraison_carb[2].qte_recu ;
      obj3.manquant = parseInt(obj3.qte_commande) - parseInt(obj3.qte_recu) ;
      obj3.ventes =parseInt($scope.quantite('Petrole'))+parseInt($scope.qte_client('petrole')) ;
      obj3.stock_theorique = parseInt(obj3.stock_ouverture)+parseInt(obj3.qte_recu)-parseInt(obj3.ventes) ;
      obj3.stock_physique = obj3.stock_physique + parseInt(value.volume_fin) ;
      obj3.ecart = parseInt(obj3.stock_physique)-parseInt(obj3.stock_theorique) ;
      
  }
     
  });

   $scope.recap.stock_carb.push(obj1);
   $scope.recap.stock_carb.push(obj2);
   $scope.recap.stock_carb.push(obj3);
  

    var obj4 = {produit:'Total Stock_Carb', stock_ouverture:(obj1.stock_ouverture + obj2.stock_ouverture + obj3.stock_ouverture), qte_commande:$scope.recap.livraison_carb[3].qte_commande, qte_recu:$scope.recap.livraison_carb[3].qte_recu, manquant:$scope.recap.livraison_carb[3].manquant, ventes:obj1.ventes+obj2.ventes+obj3.ventes , stock_theorique:obj1.stock_theorique+obj2.stock_theorique+obj3.stock_theorique, stock_physique:obj1.stock_physique+obj2.stock_physique+obj3.stock_physique, ecart:obj1.ecart+obj2.ecart+obj3.ecart};
   $scope.recap.stock_carb.push(obj4); 
   console.log($scope.recap.stock_carb);    

}

$scope.recapStock_lub = function(){

 $scope.recap.stock_lub = [];
 var obj1={qte_commande:0, qte_recu: 0, manquant:0}; var obj2={qte_commande:0, qte_recu: 0, manquant:0}; var obj3={qte_commande:0, qte_recu: 0, manquant:0};
 
   angular.forEach($scope.app.quart.cuves, function(value) {
  
      obj1.nom_produit = value.nom_produit;
      obj1.stock_ouverture = value.stock_ouverture;
      obj1.qte_commande = $scope.qte_commande_carb() ;
      obj1.qte_recu = $scope.qte_recu_carb() ;
      obj1.manquant = parseInt(obj1.qte_commande) - parseInt(obj1.qte_recu) ;
      obj1.ventes = parseInt($scope.quantite('Gasoil'))+parseInt($scope.quantite('Super'))+parseInt($scope.quantite('Petrole'))+parseInt($scope.qte_client_carb()) ;
      obj1.stock_theorique = parseInt(obj1.stock_ouverture)+parseInt(obj1.qte_recu)-parseInt(obj1.ventes) ;
      obj1.stock_physique = value.volume_fin;
      obj1.ecart = parseInt(obj1.stock_physique)-parseInt(obj1.stock_theorique) ;
      
  });

   $scope.recap.stock_carb.push(obj1);

/*    var obj4 = {produit:'TOTAL', stock_ouverture:'', qte_commande:'', qte_recu:'', manquant:'', ventes:parseInt($scope.montant('Gasoil'))+parseInt($scope.montant('Super'))+parseInt($scope.montant('Petrole')) , stock_theorique:'', stock_physique:'', ecart:$scope.montant_ecart_carb()};
   $scope.recap.stock_carb.push(obj4); 
   console.log($scope.recap.stock_carb);  */

}     

 //   $scope.recette = $scope.recap.Carburant[3].montant_produit+$scope.recap.Lubrifiant[($scope.recap.Lubrifiant.length-1)].montant ;
    $scope.solde_caisse = parseInt(($scope.app.quart.appro)?$scope.app.quart.appro.ancien_solde:$scope.appro.ancien_solde)+parseInt(($scope.app.quart.appro)?$scope.app.quart.appro.montant:$scope.appro.montant)-parseInt($scope.montant_dep_cais());



if ($localStorage.Quart) {
  $scope.chef.nom_pompiste = $localStorage.Quart1.chef.nom_pompiste ;

  $scope.chef.nom_pompiste = $localStorage.Quart1.chef.nom_pompiste ;
  
}else{
  $localStorage.Quart1 = {};
  $scope.recap.Carburant = [];
  $scope.recap.Lubrifiant = [];
  $scope.recap.Gaz_AB = [];
  $scope.recap.Gaz_SB = [];
  $scope.recap.Client_Carburant = [];
  $scope.recap.Client_Lubrifiant = [];
}

if ($localStorage.Quart1.boutique) {
  $scope.boutique.ancien_solde = $localStorage.Quart1.boutique.ancien_solde ;
  $scope.boutique.montant = $localStorage.Quart1.boutique.montant ;
}

 if ($localStorage.Quart1.versement) {
  $scope.versement.num_banque = $localStorage.Quart1.versement.num_banque ;
  $scope.versement.num_compte = $localStorage.Quart1.versement.num_compte;
  $scope.versement.montant = $localStorage.Quart1.versement.montant ;
  $scope.versement.num_bordereau = $localStorage.Quart1.versement.num_bordereau;
}

 if ($localStorage.Quart1.om) {
  $scope.om.ancien_solde = $localStorage.Quart1.om.ancien_solde ;
  $scope.om.nouveau_solde = $localStorage.Quart1.om.nouveau_solde;
  
}

if ($localStorage.Quart1.laverie) {
  $scope.laverie.montant = $localStorage.Quart1.laverie.montant ;
}

 if ($localStorage.Quart1.appro) {
  $scope.appro.ancien_solde = $localStorage.Quart1.appro.ancien_solde ;
  $scope.appro.montant = $localStorage.Quart1.appro.montant;
  
}

  if ($localStorage.Quart1.depense) {
  $scope.depense.nature = $localStorage.Quart1.depense.nature ;
  $scope.depense.responsable = $localStorage.Quart1.depense.responsable;
  $scope.depense.montant = $localStorage.Quart1.depense.montant;
  $scope.depense.recette = $localStorage.Quart1.depense.recette;
  
}


/******************************Livraison Carburant************************************** */

$scope.livraison_carb_quart = function(){

// $scope.recap.livraison_carb2 = [] ;

var obj1 = {produit: 'GASOIL', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj2 = {produit: 'SUPER', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj3 = {produit: 'PETROLE', qte_commande: 0, qte_recu: 0, manquant: 0} ;
var obj4 = {produit: 'TOTAL', qte_commande: 0, qte_recu: 0, manquant: 0} ;



return $http.get('api/pompistes.php?action=livraison_carb_quart').success( function(data, status, headers, config){
 
// console.log(data);

 angular.forEach(data, function(value) {
      
  if (value.produit == 'GASOIL') {

      obj1.produit = 'GASOIL';
      obj1.qte_commande = parseInt(value.quantite_commande) ;
      obj1.qte_recu = parseInt(value.quantite_recu) ;
      obj1.manquant = parseInt(value.manquant);
      
  }

  if (value.produit == 'SUPER') {
      
      obj2.produit = 'SUPER';
      
      obj2.qte_commande = parseInt(value.quantite_commande) ;
      obj2.qte_recu = parseInt(value.quantite_recu) ;
      obj2.manquant = parseInt(value.manquant) ;
     
  }

   if (value.produit == 'PETROLE') {
      
      obj3.produit = 'PETROLE';
      
      obj3.qte_commande = parseInt(value.quantite_commande) ;
      obj3.qte_recu = parseInt(value.quantite_recu) ;
      obj3.manquant = parseInt(value.manquant) ;
      
  }


});

   $scope.recap.livraison_carb2.push(obj1);
   $scope.recap.livraison_carb2.push(obj2);
   $scope.recap.livraison_carb2.push(obj3);
  

   var obj4 = {produit:'TOTAL', qte_commande: ($scope.recap.livraison_carb2[0].qte_commande + $scope.recap.livraison_carb2[1].qte_commande + $scope.recap.livraison_carb2[2].qte_commande)
     , qte_recu: ($scope.recap.livraison_carb2[0].qte_recu + $scope.recap.livraison_carb2[1].qte_recu + $scope.recap.livraison_carb2[2].qte_recu)
     , manquant: ($scope.recap.livraison_carb2[0].qte_manquant + $scope.recap.livraison_carb2[1].qte_manquant + $scope.recap.livraison_carb2[2].qte_manquant)};
   $scope.recap.livraison_carb2.push(obj4); 
   console.log($scope.recap.livraison_carb2) ;
    
   $scope.recapLivraison_carb3() ;
}) // End Http query




}


/******************************Livraison Lubrifiant************************************** */

$scope.livraison_lub_quart = function(){


 return $http.get('api/pompistes.php?action=livraison_lub_quart').success( function(data, status, headers, config){
  
  console.log(data);

 angular.forEach(data, function(value) {
   
  var obj = {};

  obj.produit = value.produit;
  obj.qte_commande = value.qte_commande;
  obj.qte_recu = value.qte_recu;
  obj.manquant = value.manquant;
 
  // console.log(obj);
  $scope.recap.livraison_lub2.push(obj) ;

});

var obj2 = {produit:'TOTAL', qte_commande:0, qte_recu:0, manquant: 0};

$scope.recap.livraison_lub2.push(obj2);
console.log($scope.recap.livraison_lub2);
     
    // $scope.recapLivraison_lub3() ;

 }) // End Http query

 


}



/************************HEURE***************************************************/

  $scope.date.date_banque = new Date().toUTCString(); 

  $scope.heure = function(){

     return $http.get('api/pompistes.php?action=get_heure').success( function(data, status, headers, config){

      $date_ouverture = data[0].date_ouverture ;
      $quart = data[0].quart ;  

      $scope.date.date_ouverture2 = new Date($date_ouverture).toUTCString(); 
      $scope.date.date_ouverture = $date_ouverture ;
      $scope.date.quart = $quart ;

  })

  }
  

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


  
/**************************TABS**************************************************/

  $scope.data = {
    selectedIndex : 0,
    secondLocked : true,
    secondLabel : "Item Two"
  };

  $scope.next = function() {
    $scope.data.selectedIndex = Math.min($scope.data.selectedIndex + 1, 2) ;
  };

  $scope.previous = function() {
    $scope.data.selectedIndex = Math.max($scope.data.selectedIndex - 1, 0);
  }; 

  /**************************SELECT POMPISTES PISTOLETS********************************************/


$scope.pompiste =  function(){
  return $http.get('api/pompistes.php?action=get_pompistes').success( function(data, status, headers, config){
      $scope.pompistes = data ;
      console.log($scope.pompistes);

  })
};

$scope.transporteur =  function(){
  $http.get('api/pompistes.php?action=get_transporteur').success( function(data, status, headers, config){
      $scope.transporteurs = data ;
      console.log($scope.transporteurs);

  })
};



$scope.produit_lub =  function(){
  $http.get('api/pompistes.php?action=get_produit_lubrifiant').success( function(data, status, headers, config){

    $scope.produits_lub = data ;
  //  $scope.lubs = data ;
    console.log($scope.produits_lub) ;

  })
};

$scope.produit_lub_all =  function(){
  $http.get('api/pompistes.php?action=get_produit_lubrifiant_all').success( function(data, status, headers, config){

  //  $scope.produits_lub = data ;
    $scope.lubs = data ;
    console.log($scope.lubs) ;

  })
};

$scope.produit_gaz =  function(){
  $http.get('api/pompistes.php?action=get_produit_gaz').success( function(data, status, headers, config){
      $scope.produits_gaz = data ;
      console.log($scope.produits_gaz);

  })
};

$scope.pistolet =  function(){
  return $http.get('api/pompistes.php?action=get_pistolets').success( function(data, status, headers, config){
      $scope.pistolets = data ;
      console.log($scope.pistolets);

    })
};

$scope.cuve =  function(){
  return $http.get('api/pompistes.php?action=get_cuves').success( function(data, status, headers, config){
      $scope.cuves = data ;
      console.log($scope.cuves);

  })
};

$scope.produit =  function(){

$http.get('api/pompistes.php?action=get_produit_carburant').success( function(data, status, headers, config){
      $scope.produits = data ;
      console.log(data);
  })

};

$scope.client =  function(){
  return $http.get('api/pompistes.php?action=get_client').success( function(data, status, headers, config){
      $scope.clients = data ;
      console.log($scope.clients);

  })
};

$scope.station =  function(){
  return $http.get('api/pompistes.php?action=get_station').success( function(data, status, headers, config){
      $scope.stations = data ;
      console.log($scope.stations);

  })
};

$scope.addItem =  function(){

  angular.forEach($scope.pist, function(value, key) {

    var obj = {};
    var error = '';

    obj.nom_pompiste = $scope.pomp.nom_pompiste;
    obj.nom_pistolet = value.nom_pistolet;
    obj.nom_produit = value.nom_produit;
    obj.index_depart = 0;
    obj.index_fin = 0;
    obj.index_depart_remise = 0;
    obj.index_fin_remise = 0;
    obj.responsable = '';
    obj.motif = '';
    obj.cuve= '';
    
    if ($localStorage.Quart) {

      angular.forEach($scope.app.quart.personnel, function(value){

        if (value.nom_pistolet===obj.nom_pistolet) {

          error='Un pompiste est déjà affecté à ce pistolet';
        }

      })

        if (error === '') {
          $scope.app.quart.personnel.push(obj) ;
        }else{
           alert(error);
        }


    }else{

        angular.forEach($scope.personnel, function(value){

        if ((value.nom_pistolet===obj.nom_pistolet)) {

          error='Un pompiste est déjà affecté à ce pistolet';

        }
        
        })

        if (error === '') {
          $scope.personnel.push(obj) ;

        }else{
           alert(error);
        }


    }
      
  });

 // console.log($scope.pom) ;
  //console.log($scope.pist) ;

 // $scope.pom.nom_pompiste = '' ;
  $scope.pist = [];
  

};

// remove an item
$scope.remove = function(index) {

if ($scope.app.quart.personnel) {
$scope.app.quart.personnel.splice(index, 1);
}else{
$scope.personnel.splice(index, 1);
}
};

$scope.remove_livraison_lub = function(index) {

if ($scope.app.quart.lubrifiants) {
$scope.app.quart.lubrifiants.splice(index, 1);
}else{
$scope.lubrifiants.splice(index, 1);
}
};

$scope.removeLivraison = function(index) {

  console.log($scope.app.quart.livraisons);

if ($scope.app.quart.livraisons) {
$scope.app.quart.livraisons.splice(index, 1);
}else{
$scope.livraisons.splice(index, 1);
}
};

$scope.removeLubrifiant = function(index) {

console.log($scope.app.quart.magasin);

  if ($scope.app.quart.magasin) {
  $scope.app.quart.magasin.splice(index, 1);
  }else{
  $scope.produits_lub.splice(index, 1);
  }
};

$scope.removeClient = function(index) {

if ($scope.app.quart.vte_carburant) {
$scope.app.quart.vte_carburant.splice(index, 1);
}else{
$scope.vte_carburant.splice(index, 1);
}
};

// Save Quart
$scope.saveQuart = function(){

if ($localStorage.Quart) {

  $localStorage.Quart1.personnel = $scope.app.quart.personnel;
  $localStorage.Quart1.chef = $scope.chef;
  $localStorage.Quart1.date = $scope.date ;

  console.log($localStorage.Quart1);
  alert('Félicitations! vos données ont été enregistrées avec success');

}else{
  
       $http.post('api/pompistes.php?action=get_index',

             {
              'personnel'    :  $scope.personnel,
            }

          ).success( function(data, status, headers, config){

                  console.log(data);

                  if (data[0].check == 1) {

                    $localStorage.Quart1.personnel = data;
                    $localStorage.Quart1.chef = $scope.chef;
                    $localStorage.Quart1.date = $scope.date;
                  
                    $scope.app.quart.personnel = $localStorage.Quart1.personnel;

                    $scope.app.quart.chef = $localStorage.Quart1.chef;
                    $scope.app.quart.date = $localStorage.Quart1.date;

                    console.log($localStorage.Quart1);
                    $localStorage.Quart = true;
                    
                    alert('Félicitations! vos données ont été enregistrées avec success');
                  }else{
                    alert('Desolé! Une erreur s\'est produite');
                  }

                                    
            });

}
}

$scope.saveStock = function(){

if ($scope.app.quart.cuves) {
  $localStorage.Quart1.cuves = $scope.app.quart.cuves ;
  $localStorage.Quart1.magasin = $scope.app.quart.magasin ;
  $localStorage.Quart1.gaz = $scope.app.quart.gaz ;
  
  alert('Félicitations! vos données ont été enregistrées avec success');


console.log($localStorage.Quart1) ;

}else{

  $localStorage.Quart1.cuves = $scope.cuves;
  $localStorage.Quart1.magasin = $scope.produits_lub;
  $localStorage.Quart1.gaz = $scope.produits_gaz;
  $localStorage.Quart1.produits = $scope.produit();

  $scope.app.quart.cuves = $localStorage.Quart1.cuves;
  $scope.app.quart.magasin = $localStorage.Quart1.magasin;
  $scope.app.quart.gaz = $localStorage.Quart1.gaz;
  $scope.app.quart.produits = $localStorage.Quart1.produits;

alert('Félicitations! vos données ont été enregistrées avec success');


  console.log($localStorage.Quart1);

}

}

$scope.saveVersement = function(){

if ($scope.app.quart.versement) {
  $localStorage.Quart1.versement = $scope.versement;

  if ($scope.versement.num_banque == '') {

    alert('Attention !!! Selectionner le nom de la banque');
    
  }
alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.versement = $scope.versement;
  $scope.app.quart.versement = $localStorage.Quart1.versement;

  if ($scope.versement.num_banque == '') {

    alert('Attention !!! Selectionner le nom de la banque');
    
  }
alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveCommentaire = function(){

if ($scope.app.quart.commentaire) {
  $localStorage.Quart1.commentaire = $scope.commentaire;
alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.commentaire = $scope.commentaire;
  $scope.app.quart.commentaire = $localStorage.Quart1.commentaire;
alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveOm = function(){

if ($scope.app.quart.om) {
  $localStorage.Quart1.om = $scope.om;
  alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.om = $scope.om;
  $scope.app.quart.om = $localStorage.Quart1.om;
  alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveLaverie = function(){

if ($scope.app.quart.laverie) {
  $localStorage.Quart1.laverie = $scope.laverie ;
  console.log($localStorage.Quart1);
  alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.laverie = $scope.laverie;
  $scope.app.quart.laverie = $localStorage.Quart1.laverie;
  console.log($localStorage.Quart1);
  alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveBoutique = function(){

if ($scope.app.quart.boutique) {
  $localStorage.Quart1.boutique = $scope.boutique ;
  alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.boutique = $scope.boutique;
  $scope.app.quart.boutique = $localStorage.Quart1.boutique;
  alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveAppro = function(){

if ($scope.app.quart.appro) {
  $localStorage.Quart1.appro = $scope.appro;
  alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.appro = $scope.appro;
  $scope.app.quart.appro = $localStorage.Quart1.appro;
  alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.saveDepense = function(){

if ($scope.app.quart.depense) {
  $localStorage.Quart1.depense = $scope.app.quart.depense;
alert('Félicitations! vos données ont été enregistrées avec success');


}else{

  $localStorage.Quart1.depense = $scope.depenses;
  $scope.app.quart.depense = $localStorage.Quart1.depense;
alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.savePistolets = function(){

alert('Félicitations! vos données ont été enregistrées avec success');
}

$scope.saveVentes = function(){

var volume_cuve = 0;
var qte_livraison = 0;
var volume_ventes = 0;
var nom_cuve = '';
var nom_cuves = [];
var obj = {};


angular.forEach($scope.app.quart.cuves, function(value){

  volume_cuve += parseInt(value.volume_debut) ;

})

angular.forEach($scope.app.quart.livraisons, function(value){


  qte_livraison += parseInt(value.qte_recu) ;

})

angular.forEach($scope.app.quart.personnel, function(value){

  volume_ventes += (value.index_fin - value.index_depart + value.index_fin_remise - value.index_depart_remise) ;

})

angular.forEach($scope.app.quart.vte_carburant, function(value){

  volume_ventes += (parseInt(value.index_fin) - parseInt(value.index_depart)) ;

})


console.log(volume_cuve);
console.log(qte_livraison);
console.log(volume_ventes);


if (volume_ventes < 0 ) {

alert('Attention !!! Les ventes seront en negatif. Vérifier vos index de fin');
/* angular.forEach($scope.app.quart.personnel, function(value, key){
        $scope.app.quart.personnel[key].index_fin=0; 
}) */

}


if (volume_ventes > (volume_cuve + qte_livraison)) {

alert('Attention ! le volume total des ventes est supérieur a la quantité globale du stock ');
/* angular.forEach($scope.app.quart.personnel, function(value, key){
        $scope.app.quart.personnel[key].index_fin=0;
}) */

}



angular.forEach($scope.app.quart.cuves, function(value){

  var nom_cuve = value.nom_cuve ;
  var capacite_cuve = parseInt(value.capacite_cuve) ;
  var stock_ouverture = parseInt(value.volume_debut) ;
  var livraison_cuve = 0 ;
  var ventes_cuve = 0 ;

    angular.forEach($scope.app.quart.personnel, function(value){

      if (value.nom_cuve == nom_cuve) {

        ventes_cuve += (value.index_fin - value.index_depart + value.index_fin_remise - value.index_depart_remise) ;
        
      }
    })

    angular.forEach($scope.app.quart.livraisons, function(value){

      if (value.nom_cuve == nom_cuve) {

        livraison_cuve += value.qte_recu ;
        
      }
    })

    if (stock_ouverture + livraison_cuve - ventes_cuve > capacite_cuve) {

      alert('Attention !!! le volume restant dans la cuve '+nom_cuve+' est supérieur à la capacité de cette cuve. Vérifier les index de fin')
      
    }

})



if ($scope.app.quart.magasin) {

    $localStorage.Quart1.magasin = $scope.app.quart.magasin ;

    alert('Félicitations! vos données ont été enregistrées avec success');


}else{

    $localStorage.Quart1.magasin = $scope.produits_lub;
    $localStorage.Quart1.boutique = $scope.boutique;
    $localStorage.Quart1.laverie = $scope.laverie;

    $scope.app.quart.magasin = $localStorage.Quart1.magasin;
    $scope.app.quart.boutique = $localStorage.Quart1.boutique.ancien_solde;
    $scope.app.quart.boutique = $localStorage.Quart1.boutique.montant_boutique;
    $scope.app.quart.laverie = $localStorage.Quart1.laverie.montant_laverie;

  alert('Félicitations! vos données ont été enregistrées avec success');



}

 if ($scope.app.quart.boutique) {

  $localStorage.Quart1.boutique = $scope.app.quart.boutique;
  $localStorage.Quart1.laverie = $scope.app.quart.laverie;


}else{
 
  $localStorage.Quart1.boutique = $scope.boutique;
  $localStorage.Quart1.laverie = $scope.laverie;
  $scope.app.quart.boutique = $localStorage.Quart1.boutique;
  $scope.app.quart.laverie = $localStorage.Quart1.laverie;

}

 if ($scope.app.quart.vte_carburant) {
  $localStorage.Quart1.vte_carburant = $scope.app.quart.vte_carburant;
  $localStorage.Quart1.vte_lubrifiant = $scope.app.quart.vte_lubrifiant;

}else{
 
  $localStorage.Quart1.vte_carburant = $scope.vte_carburant;
  $localStorage.Quart1.vte_lubrifiant = $scope.vte_lubrifiant;
  $scope.app.quart.vte_carburant = $localStorage.Quart1.vte_carburant;
  $scope.app.quart.vte_lubrifiant = $localStorage.Quart1.vte_lubrifiant;

}

}

$scope.saveReglement = function(){

 if ($scope.app.quart.rgt_carburant) {
  $localStorage.Quart1.rgt_carburant = $scope.app.quart.rgt_carburant;
  alert('Félicitations! vos données ont été enregistrées avec success');


  }else{
   
    $localStorage.Quart1.rgt_carburant = $scope.rgt_carburant;
    $scope.app.quart.rgt_carburant = $localStorage.Quart1.rgt_carburant;
  alert('Félicitations! vos données ont été enregistrées avec success');


  }

 if ($scope.app.quart.rgt_client) {
  $localStorage.Quart1.rgt_client = $scope.app.quart.rgt_client;
  console.log($localStorage.Quart1);

  }else{
   
    $localStorage.Quart1.rgt_client = $scope.rgt_client;
    $scope.app.quart.rgt_client = $localStorage.Quart1.rgt_client;
    console.log($localStorage.Quart1);

  }

}

// Save Livraison

$scope.addLivraison = function(){

  var obj = {};
  var error = '';
  angular.extend(obj, $scope.livraison);
  angular.extend(obj, {produit: ''});

  if ($scope.app.quart.livraisons) {


    angular.forEach($scope.app.quart.livraisons, function(value){

          if ((value.num_bon === obj.num_bon)&&(value.cuve === obj.cuve)) {
            error = 'cet enregistrement existe deja dans le tableau';
            
          }else if((value.num_bon === obj.num_bon)&&(value.num_scdp !== obj.num_scdp)){
            error = 'Attention ! Le numero scdp n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.nom_chauffeur !== obj.nom_chauffeur)){
            error = 'Attention ! Le nom du chauffeur n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.mat_camion !== obj.mat_camion)){
            error = 'Attention ! Le matricule du camion n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.transporteur !== obj.transporteur)){
            error = 'Attention ! Le transporteur n\'est pas correct';

          }

    });

    angular.forEach($scope.app.quart.cuves, function(value){

          console.log(value);
          console.log(obj);

        if (obj.cuve === value.nom_cuve) {

          obj.produit = value.nom_produit ;

            if (obj.qte_recu > value.capacite_cuve) {
              error = 'la capacité de la cuve est inferieur a la quantité recu';
              
            }else if(obj.qte_commande > value.capacite_cuve) {
              error = 'la capacité de la cuve est inferieur a la quantité commande';
              
            }
        }

       

    })

        if (error == '') {

          $scope.app.quart.livraisons.push(obj) ;
          $scope.livraison.qte_commande = null ;
          $scope.livraison.qte_recu = null ;
          $scope.livraison.cuve = null ;
          console.log($scope.app.quart.livraisons);

        }else{
          alert(error);
        }

    
   }else{

      angular.forEach($scope.livraisons, function(value){

          if ((value.num_bon === obj.num_bon)&&(value.cuve === obj.cuve)) {
            error = 'cet enregistrement existe deja dans le tableau';
            
          }else if((value.num_bon === obj.num_bon)&&(value.num_scdp !== obj.num_scdp)){
            error = 'Attention ! Le numero scdp n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.nom_chauffeur !== obj.nom_chauffeur)){
            error = 'Attention ! Le nom du chauffeur n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.mat_camion !== obj.mat_camion)){
            error = 'Attention ! Le matricule du camion n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.transporteur !== obj.transporteur)){
            error = 'Attention ! Le transporteur n\'est pas correct';

          }

      });

      angular.forEach($scope.app.quart.cuves, function(value){

          console.log(value);
          console.log(obj);

        if (obj.cuve === value.nom_cuve) {
          obj.produit = value.nom_produit ;

            if (obj.qte_recu > value.capacite_cuve) {
              error = 'la capacité de la cuve est inferieur a la quantité recu';
              
            }else if(obj.qte_commande > value.capacite_cuve) {
              error = 'la capacité de la cuve est inferieur a la quantité commande';
              
            }
        }

      })

        if (error == '') {
            $scope.livraisons.push(obj);
            $scope.livraison.qte_commande = null ;
            $scope.livraison.qte_recu = null ;
            $scope.livraison.cuve = null ;
            console.log($scope.livraisons);

          }else{
            alert(error);
        }

     
  }

}

$scope.addLubrifiant = function(){

var obj = {};
var error = '';
angular.extend(obj, $scope.lubrifiant);

if ($scope.app.quart.lubrifiants) {

    angular.forEach($scope.app.quart.lubrifiants, function(value){

          if ((value.num_bon === obj.num_bon)&&(value.nom_chauffeur !== obj.nom_chauffeur)) {
            error = 'Attention ! Le nom du chauffeur n\'est pas correct';
            
          }else if((value.num_bon === obj.num_bon)&&(value.mat_camion !== obj.mat_camion)){
            error = 'Attention ! Le matricule du camion n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.transporteur !== obj.transporteur)){
            error = 'Attention ! Le transporteur n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.produit === obj.produit)){
            error = 'Attention ! cet enregistrement existe déjà dans le tableau';

          }

    });

    if (error == '') {
     $scope.app.quart.lubrifiants.push(obj) ;
     $scope.livraison.produit = null ;
     $scope.livraison.qte_commande = null ;
     $scope.livraison.qte_recu = null ;
     console.log($scope.app.quart.lubrifiants);
      
    }else{
      alert(error);
    }

   
} else{

  angular.forEach($scope.lubrifiants, function(value){

          if ((value.num_bon === obj.num_bon)&&(value.nom_chauffeur !== obj.nom_chauffeur)) {
            error = 'Attention ! Le nom du chauffeur n\'est pas correct';
            
          }else if((value.num_bon === obj.num_bon)&&(value.mat_camion !== obj.mat_camion)){
            error = 'Attention ! Le matricule du camion n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.transporteur !== obj.transporteur)){
            error = 'Attention ! Le transporteur n\'est pas correct';

          }else if((value.num_bon === obj.num_bon)&&(value.produit === obj.produit)){
            error = 'Attention ! cet enregistrement existe déjà dans le tableau';

          }

  });

   if (error == '') {

    $scope.lubrifiants.push(obj) ;
    $scope.livraison.produit = null ;
    $scope.livraison.qte_commande = null ;
    $scope.livraison.qte_recu = null ;
    
    }else{
      alert(error);
    }


    
} 

}

$scope.addVte_carb = function(){

$http.post('api/pompistes.php?action=addVte_carb',

             {
              
              'client'     :  $scope.carb.client.id_client ,
              'produit'     :  $scope.carb.produit.id_produit 
            }

          ).success( function(data, status, headers, config){
                  console.log(data);

                   var obj = {};

                  // angular.extend(obj, $scope.carb);

                   obj.prix_client = data[0].prix_client ;
                   obj.nom_client =  $scope.carb.client.nom_client;
                   obj.id_client =  $scope.carb.client.id_client;
                   obj.nom_produit =  $scope.carb.produit.nom_produit;
                   obj.id_produit =  $scope.carb.produit.id_produit;
                   obj.nom_pompiste =  $scope.carb.pompiste.nom_pompiste;
                   obj.id_pompiste =  $scope.carb.pompiste.id_pompiste;
                   obj.montant =  $scope.carb.montant;
                   obj.qte = obj.montant / obj.prix_client ;

                  console.log(obj);

                  if ($scope.app.quart.vte_carburant) {
                    $scope.app.quart.vte_carburant.push(obj) ;
                    console.log($scope.app.quart.vte_carburant);
                  } else{
                    $scope.vte_carburant.push(obj) ;
                    console.log($scope.vte_carburant);

                  } 
                            
            });

}

$scope.addRgt_carb = function(){

var obj = {};
angular.extend(obj, $scope.pom);

if ($scope.app.quart.rgt_carburant) {
  $scope.app.quart.rgt_carburant.push(obj) ;
  console.log($scope.app.quart.rgt_carburant);
} else{
  $scope.rgt_carburant.push(obj) ;
  console.log($scope.rgt_carburant);

} 

}

$scope.addRgt_cli = function(){

console.log($scope.rgt_cli) ;

var obj = {};
angular.extend(obj, $scope.rgt_cli);



if ($scope.app.quart.rgt_client) {
  $scope.app.quart.rgt_client.push(obj) ;
  console.log($scope.app.quart.rgt_carburant);
} else{
  $scope.rgt_client.push(obj) ;
  console.log($scope.rgt_client);

} 

}

$scope.addVte_lubri = function(){

  $http.post('api/pompistes.php?action=addVte_lubri',

             {
              'produit'     :  $scope.lubri.produit.id_produit  ,
              'client'     :  $scope.lubri.client.id_client
            }

          ).success( function(data, status, headers, config){
                  console.log(data);

                  var obj = {};
                  angular.extend(obj, $scope.lubri);

                  obj.prix_client = data[0].prix_client ;
                  obj.id_pompiste =  $scope.lubri.pompiste.id_pompiste;
                  obj.nom_pompiste =  $scope.lubri.pompiste.nom_pompiste;
                  obj.nom_client =  $scope.lubri.client.nom_client;
                  obj.id_client =  $scope.lubri.client.id_client;
                  obj.nom_produit =  $scope.lubri.produit.nom_produit;
                  obj.id_produit =  $scope.lubri.produit.id_produit;

                  obj.montant =  $scope.lubri.montant;

                  if (obj.prix_client == null ) {
                    
                    obj.qte = 0 ;

                  }else{

                    obj.qte = obj.montant / obj.prix_client ;

                  }

                  console.log(obj) ;

                 if ($scope.app.quart.vte_lubrifiant) {
                    $scope.app.quart.vte_lubrifiant.push(obj) ;
                    console.log($scope.app.quart.vte_lubrifiant);
                  } else{
                    $scope.vte_lubrifiant.push(obj) ;
                    console.log($scope.vte_lubrifiant);

                   } 
                                    
            });

}

$scope.addGaz = function(){

var obj = {};
angular.extend(obj, $scope.gaz);

if ($scope.app.quart.liv_gaz) {
  $scope.app.quart.liv_gaz.push(obj) ;
   $scope.livraison.produit = null ;
    $scope.livraison.qte_commande = null ;
    $scope.livraison.qte_recu = null ;
    $scope.livraison.retour = null ;
  console.log($scope.app.quart.liv_gaz);
} else{
  $scope.liv_gaz.push(obj) ;
   $scope.livraison.produit = null ;
    $scope.livraison.qte_commande = null ;
    $scope.livraison.qte_recu = null ;
    $scope.livraison.retour = null ;
} 

}

$scope.addDepense = function(){

var obj = {};
angular.extend(obj, $scope.depense);

if ($scope.app.quart.depense) {
  $scope.app.quart.depense.push(obj) ;
  console.log($scope.app.quart.depense);
} else{
  $scope.depenses.push(obj) ;
} 

}


$scope.checkQte= function(data, cuve, index, mat_camion, qte_recu, qte_commande, transporteur, nom_chauffeur, num_scdp, num_bon){

if ($scope.app.quart.livraisons) {

angular.forEach($scope.app.quart.cuves, function(value){

  if (cuve == value.nom_cuve) { 

    console.log(data);

      if (data.qte_recu  > value.capacite_cuve ) {
        alert('la quantite recu est superieur à la capacité de la cuve');
        $scope.app.quart.livraisons.splice(index, 1);
        $scope.livraison = {cuve:cuve, mat_camion:mat_camion, qte_commande:qte_commande, qte_recu:qte_recu, nom_chauffeur:nom_chauffeur, num_bon:num_bon, num_scdp:num_scdp, transporteur:transporteur};
        
      }else if(data.qte_commande  > value.capacite_cuve){
        alert('la quantite commande est superieur à la capacité de la cuve');
        $scope.app.quart.livraisons.splice(index, 1);
        $scope.livraison = {cuve:cuve, mat_camion:mat_camion, qte_commande:qte_commande, qte_recu:qte_recu, nom_chauffeur:nom_chauffeur, num_bon:num_bon, num_scdp:num_scdp, transporteur:transporteur};
      }
  }
})

}else{

angular.forEach($scope.app.quart.cuves, function(value){

  if (cuve == value.nom_cuve) { 

    console.log(data);

      if (data.qte_recu  > value.capacite_cuve ) {
        alert('la quantite recu est superieur à la capacité de la cuve');
        $scope.livraisons.splice(index, 1);
        $scope.livraison = {cuve:cuve, mat_camion:mat_camion, qte_commande:qte_commande, qte_recu:qte_recu, nom_chauffeur:nom_chauffeur, num_bon:num_bon, num_scdp:num_scdp, transporteur:transporteur};
        
      }else if(data.qte_commande  > value.capacite_cuve){
        alert('la quantite commande est superieur à la capacité de la cuve');
        $scope.livraisons.splice(index, 1);
        $scope.livraison = {cuve:cuve, mat_camion:mat_camion, qte_commande:qte_commande, qte_recu:qte_recu, nom_chauffeur:nom_chauffeur, num_bon:num_bon, num_scdp:num_scdp, transporteur:transporteur};
      }
  }
})

}


}




$scope.checkIndex=function(data, index, cuve, pistolet, index_depart, index_fin){



 angular.forEach($scope.app.quart.personnel, function(value, key){
  //console.log(key);

  if (pistolet === value.nom_pistolet) { 

      if (data.index_fin  < index_depart ) {

        alert('Attention ! l\'index de fin est inferieur à l\'index_depart');
        $scope.app.quart.personnel[key].index_fin = $scope.app.quart.personnel[key].index_depart ;
       
      }

  }

})


}

$scope.checkRemise=function(data, index, pistolet, index_depart, index_fin){


 angular.forEach($scope.app.quart.personnel, function(value, key){
  //console.log(key);

  if (pistolet === value.nom_pistolet) { 

      if (data.index_fin_remise  < data.index_depart_remise ) {

        alert('Attention ! l\'index de fin est inferieur à l\'index_depart');
        $scope.app.quart.personnel[key].index_fin_remise = 0 ;
       
      }else if ((data.index_depart_remise < value.index_depart) || (data.index_depart_remise > value.index_fin)) {

         alert('Attention ! l\'index de debut n\'est pas valide');
        $scope.app.quart.personnel[key].index_depart_remise = 0 ;
        $scope.app.quart.personnel[key].index_fin_remise = 0 ;

      }else if ((data.index_fin_remise < value.index_depart) || (data.index_fin_remise > value.index_fin)) {

        alert('Attention ! l\'index de fin n\'est pas valide');
        $scope.app.quart.personnel[key].index_depart_remise = 0 ;
        $scope.app.quart.personnel[key].index_fin_remise = 0 ;

      }

  }

})


}


$scope.checkVte_carb=function(data, index, pistolet, index_depart, index_fin){


if ($scope.app.quart.vte_carburant) {
  console.log(data);
  console.log(pistolet);
  


  angular.forEach($scope.app.quart.personnel, function(value, key){
  //console.log(key);

  if (pistolet === value.nom_pistolet) { 

      if (data.index_fin  < data.index_depart ) {

        alert('Attention ! l\'index de fin est inferieur à l\'index_depart');
        $scope.app.quart.vte_carburant[key].index_fin = 0 ;
       
      }else if ((data.index_depart < value.index_depart) || (data.index_depart > value.index_fin)) {

         alert('Attention ! l\'index de debut n\'est pas valide');
        $scope.app.quart.vte_carburant[key].index_depart = 0 ;
        $scope.app.quart.vte_carburant[key].index_fin = 0 ;

      }else if ((data.index < value.index_depart) || (data.index_fin > value.index_fin)) {

        alert('Attention ! l\'index de fin n\'est pas valide');
        $scope.app.quart.vte_carburant[key].index_depart = 0 ;
        $scope.app.quart.vte_carburant[key].index_fin = 0 ;

      }

  }

})



}else{

  console.log(data);

  angular.forEach($scope.app.quart.personnel, function(value, key){
  //console.log(key);

  if (pistolet === value.nom_pistolet) { 

      if (data.index_fin  < data.index_depart ) {

        alert('Attention ! l\'index de fin est inferieur à l\'index_depart');
        $scope.vte_carburant[key].index_fin = 0 ;
       
      }else if ((data.index_depart < value.index_depart) || (data.index_depart > value.index_fin)) {

         alert('Attention ! l\'index de debut n\'est pas valide');
        $scope.vte_carburant[key].index_depart_remise = 0 ;
        $scope.vte_carburant[key].index_fin_remise = 0 ;

      }else if ((data.index < value.index_depart) || (data.index_fin > value.index_fin)) {

        alert('Attention ! l\'index de fin n\'est pas valide');
        $scope.vte_carburant[key].index_depart = 0 ;
        $scope.vte_carburant[key].index_fin = 0 ;

      }

  }

})



}


 

}




$scope.saveLivraison = function(){

console.log($scope.app.quart.livraisons) ;

if ($scope.app.quart.livraisons) {

 $localStorage.Quart1.livraisons = $scope.app.quart.livraisons;
 $localStorage.Quart1.lubrifiants = $scope.app.quart.lubrifiants;
 $localStorage.Quart1.liv_gaz = $scope.app.quart.liv_gaz;

angular.forEach($scope.app.quart.livraisons, function(value, key){

  angular.forEach($scope.app.quart.magasin, function(value2, key2){

    if (value.code_produit == value2.code_produit) {

      $scope.app.quart.magasin[key2].livraison = value.qte_recu ;

    }

    console.log(value.code_produit) ;
    console.log(value2.code_produit) ;

  })

})


 alert('Félicitations! vos données ont été enregistrées avec success');

  
}else{


  console.log($scope.app.quart.livraisons) ;

 
 $localStorage.Quart1.livraisons = $scope.livraisons;
 $localStorage.Quart1.lubrifiants = $scope.lubrifiants;
 $localStorage.Quart1.liv_gaz = $scope.liv_gaz;
 $scope.app.quart.livraisons = $localStorage.Quart1.livraisons ;
 $scope.app.quart.lubrifiants = $localStorage.Quart1.lubrifiants ;
 $scope.app.quart.liv_gaz = $localStorage.Quart1.liv_gaz ;


 angular.forEach($scope.livraisons, function(value, key){

  angular.forEach($scope.app.quart.magasin, function(value2, key2){

    if (value.code_produit == value2.code_produit) {

      $scope.app.quart.magasin[key2].livraison = value.qte_recu ;
      
    }

    console.log(value.code_produit) ;
    console.log(value2.code_produit) ;

  })

})

 alert('Félicitations! vos données ont été enregistrées avec success');


}

}

$scope.remiseCuves = function(data, nom_pistolet){

    angular.forEach($scope.app.quart.personnel, function(value) {

      if (value.nom_pistolet == nom_pistolet) {
          
         angular.extend(value, {index_depart_remise: data.index_depart_remise});
         angular.extend(value, {index_fin_remise: data.index_fin_remise});
      }
   });



    $localStorage.Quart1.personnel = $scope.app.quart.personnel;
    alert('Félicitations! vos données ont été enregistrées avec success');

}

// Save Index

$scope.saveIndex = function(data, nom_pistolet){

angular.forEach($scope.app.quart.personnel, function(value, key) {

  if (value.nom_pistolet ==  nom_pistolet) {

// angular.extend(value, {index_depart: data.index_depart});
angular.extend(value, {index_fin: data.index_depart});

  }
$localStorage.Quart1.personnel = $scope.app.quart.personnel;
alert('Félicitations! vos données ont été enregistrées avec success');


});

}

$scope.removeProduit = function(index){

if ($scope.app.quart.vte_lubrifiant) {

$scope.app.quart.vte_lubrifiant.splice(index, 1);

}else{
 
 $scope.vte_lubrifiant.splice(index, 1);

}

}

$scope.removeRP = function(index){

if ($scope.app.quart.rgt_carburant) {

$scope.app.quart.rgt_carburant.splice(index, 1);

}else{
 
 $scope.rgt_carburant.splice(index, 1);

}

}

$scope.removeRC = function(index){

if ($scope.app.quart.rgt_client) {

$scope.app.quart.rgt_client.splice(index, 1);

}else{
 
 $scope.rgt_client.splice(index, 1);

}

}

$scope.removeDepense = function(index){

if ($scope.app.quart.depense) {

$scope.app.quart.depense.splice(index, 1);

}else{
 
 $scope.depense.splice(index, 1);

}

}


$scope.manquant = function() {

var pompistes = [] ;

angular.forEach($scope.app.quart.personnel, function(value) {

  pompistes.push(value.nom_pompiste) ;

});

angular.forEach($scope.app.quart.rgt_carburant, function(value) {

  pompistes.push(value.nom_pompiste) ;

});

angular.forEach($scope.app.quart.vte_carburant, function(value) {

  pompistes.push(value.nom_pompiste) ;

});

var uniquePompistes = Array.from(new Set(pompistes)) ;

angular.forEach(uniquePompistes, function(value) {

    var obj = {} ;

    obj.pompiste = value ;
    obj.quantite_gasoil = 0  ;
    obj.quantite_super = 0  ;
    obj.quantite_petrole = 0  ;
    obj.prix_gasoil = 0 ;
    obj.prix_super = 0 ;
    obj.prix_petrole = 0 ;
    obj.montant_gasoil = 0 ;
    obj.montant_super = 0 ;
    obj.montant_petrole = 0 ;
    obj.montant = 0 ;
    obj.client = 0 ;
    obj.versement = 0 ;
    obj.manquant = 0 ;

    angular.forEach($scope.app.quart.personnel, function(value2) { 


      if (value2.nom_pompiste == obj.pompiste && value2.nom_produit == 'GASOIL') {

        obj.quantite_gasoil +=  (parseInt(value2.index_fin) - parseInt(value2.index_depart)) - (parseInt(value2.index_fin_remise) - parseInt(value2.index_depart_remise)) ;
        
      }

      if (value2.nom_pompiste == obj.pompiste && value2.nom_produit == 'SUPER') {

        obj.quantite_super +=  (parseInt(value2.index_fin) - parseInt(value2.index_depart)) - (parseInt(value2.index_fin_remise) - parseInt(value2.index_depart_remise)) ;
        
      }

      if (value2.nom_pompiste == obj.pompiste && value2.nom_produit == 'PETROLE') {

        obj.quantite_petrole += (parseInt(value2.index_fin) - parseInt(value2.index_depart)) - (parseInt(value2.index_fin_remise) - parseInt(value2.index_depart_remise)) ;
        
      }
  
    });

    angular.forEach($scope.app.quart.cuves, function(value3) {

      if (value3.nom_produit == 'GASOIL') {

        obj.prix_gasoil = parseInt(value3.prix_unitaire ) ;
        
      }

      if (value3.nom_produit == 'SUPER') {

        obj.prix_super = parseInt(value3.prix_unitaire ) ;
        
      }

      if (value3.nom_produit == 'PETROLE') {

        obj.prix_petrole = parseInt(value3.prix_unitaire ) ;
        
      }
  
    });

    angular.forEach($scope.app.quart.rgt_carburant, function(value4) {

      if (value4.nom_pompiste == obj.pompiste) {

        obj.versement += parseInt(value4.montant) ;
        
      }
  
    });

    angular.forEach($scope.app.quart.vte_carburant, function(value5) {

      if (value5.nom_pompiste == obj.pompiste) {

        obj.client += parseInt(value5.montant) ;
        
      }
  
    });


    obj.montant_gasoil = obj.quantite_gasoil * obj.prix_gasoil ;
    obj.montant_super = obj.quantite_super * obj.prix_super ;
    obj.montant_petrole = obj.quantite_petrole * obj.prix_petrole ;

    obj.montant = obj.montant_gasoil + obj.montant_super + obj.montant_petrole ;
    obj.manquant = obj.montant - obj.client - obj.versement ;


    $scope.manquants.push(obj) ;

    console.log($scope.manquants) ;

});



}





/**************************CUVES********************************************/

$scope.open = function (cuve) {
        console.log(cuve);
        var modalInstance = $modal.open({
          templateUrl: 'cuve.html',
           controller: 'ModalInstanceVideoCtrl',
           size: 'lg',
           resolve: {
            items: function () {
              $scope.selected = cuve ;
              return $scope.selected ;
            }
            
          }
        });

modalInstance.result.then(function (selectedItem) {
          $scope.select = selectedItem;
          console.log(selectedItem);
  angular.forEach(($scope.app.quart.cuves) ? $scope.app.quart.cuves : $scope.cuves , function(value) {
          console.log(value);

    if (value.id_cuve == selectedItem.id_cuve) {
        value.jauge_debut = selectedItem.jauge_depart;
        value.jauge_fin = selectedItem.jauge_fin;
        value.volume_debut = selectedItem.volume_depart;
        value.volume_fin = selectedItem.volume_fin;
        console.log(value);
    }

  });

}, function () {
          
         // $log.info('Modal dismissed at: ' + new Date());
});  

};

/****************************UPLOAD FICHIER BANQUE********************************************** */

var uploader = $scope.uploader = new FileUploader({
      url: 'js/controllers/upload.php'
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
      
      if (response.answer = 'File transfer completed') {

        console.log($scope.date.date_banque) ;

        $scope.app.quart.date.lien_banque = "" ;
        $scope.app.quart.date.date_banque = $scope.date.date_banque;

       // console.log($localStorage.User.nom) ;
       // console.log(fileItem.file.name) ;

        $scope.app.quart.date.lien_banque = $scope.app.quart.date.lien_banque + "station/documents/relevebanque/" + $localStorage.User.nom + "/" + fileItem.file.name ;
        
        console.log($scope.app.quart);

        alert('Félicitations ! Le fichier a été correctement envoyé') ;

        

      }else{

        alert('Désolé ! Le fichier n\'a pas été envoyé. Veuillez réessayer...') ;
      }
  };

  uploader.onCompleteAll = function() {
      console.info('onCompleteAll');
  };

  console.info('uploader', uploader);

/**********************************FIN UPLOAD FICHIER BANQUE***************************************** */

/****************************UPLOAD FICHIER STOCK********************************************** */

var uploader2 = $scope.uploader2 = new FileUploader({
  url: 'js/controllers/upload2.php'
});

// FILTERS

uploader2.filters.push({
  name: 'customFilter',
  fn: function(item /*{File|FileLikeObject}*/, options) {
      return this.queue.length < 10;
  }
});

// CALLBACKS

uploader2.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
  console.info('onWhenAddingFileFailed', item, filter, options);
};
uploader2.onAfterAddingFile = function(fileItem) {
  console.info('onAfterAddingFile', fileItem);
};
uploader2.onAfterAddingAll = function(addedFileItems) {
  console.info('onAfterAddingAll', addedFileItems);
};
uploader2.onBeforeUploadItem = function(item) {
  console.info('onBeforeUploadItem', item);
};
uploader2.onProgressItem = function(fileItem, progress) {
  console.info('onProgressItem', fileItem, progress);
};
uploader2.onProgressAll = function(progress) {
  console.info('onProgressAll', progress);
};
uploader2.onSuccessItem = function(fileItem, response, status, headers) {
  console.info('onSuccessItem', fileItem, response, status, headers);
};
uploader2.onErrorItem = function(fileItem, response, status, headers) {
  console.info('onErrorItem', fileItem, response, status, headers);
};
uploader2.onCancelItem = function(fileItem, response, status, headers) {
  console.info('onCancelItem', fileItem, response, status, headers);
};
uploader2.onCompleteItem = function(fileItem, response, status, headers) {
  console.info('onCompleteItem', fileItem, response, status, headers);
  
  if (response.answer = 'File transfer completed') {

    $scope.app.quart.date.lien_stock = "" ;
    $scope.app.quart.date.date_stock = $scope.app.quart.date.date_ouverture.slice(0,10) ;
    //$scope.app.quart.date.date_stock = fileItem.file.name.split(".")[0].slice(-10) ;

   // console.log($localStorage.User.nom) ;
   // console.log(fileItem.file.name) ;

    $scope.app.quart.date.lien_stock = $scope.app.quart.date.lien_stock + "station/documents/relevestock/" + $localStorage.User.nom + "/" + fileItem.file.name ;
    
    console.log($scope.app.quart);

    alert('Félicitations ! Le fichier a été correctement envoyé') ;

    

  }else{

    alert('Désolé ! Le fichier n\'a pas été envoyé. Veuillez réessayer...') ;
  }
};

uploader2.onCompleteAll = function() {
  console.info('onCompleteAll');
};

console.info('uploader2', uploader2);

/**********************************FIN UPLOAD FICHIER STOCK***************************************** */

$scope.add_stock_lub = function(){

if ($scope.app.quart.magasin) {

  $scope.produits_lub.push($scope.lubri.produit) ;
  console.log($scope.produits_lub) ;
  
} else {

  $scope.produits_lub.push($scope.lubri.produit) ;
  console.log($scope.produits_lub) ;
  
}


}

$scope.update_prix_produit = function(mag) {

$http.post('api/pompistes.php?action=edit_prix_produit', {produit: mag}

          ).success( function(data, status, headers, config){

                  console.log(data);

                  if (data.msg == "") {

                      alert('Felicitation! Le prix a été modifié');
                   
                  }else{

                    //  alert('Desolé! Echec Operation');
                  }

                                    
  });

}

$scope.update_prix_client = function(mag) {

$http.post('api/pompistes.php?action=edit_prix_client', {produit: mag}

          ).success( function(data, status, headers, config){

                  console.log(data);

                  if (data.msg == "") {

                      alert('Felicitation! Le prix a été modifié');
                   
                  }else{

                    //  alert('Desolé! Echec Operation');
                  }

                                    
  });

}

$scope.update_stock = function(mag){

/*
  angular.forEach($scope.app.quart.magasin, function(value, key){

  if (mag.code_produit == value.code_produit) { 
      
  $scope.app.quart.magasin[key].stock_fermerture = parseFloat($scope.app.quart.magasin[key].stock_ouverture) + parseFloat($scope.app.quart.magasin[key].livraison) - parseFloat(mag.qte_vendu)    ;

  }

  })

*/

}

$scope.ecart_gerant = function(){

$scope.datas = [] ;

var clients = [] ;
var vers_clients = [] ;

/******************************DEBUT TRAITEMENT EN-TETE****************************************** */

 $en_tete = {} ;
           
 $en_tete.date = 'DATE' ;
 $en_tete.quart = 'QUART' ;
 $en_tete.super = 'SUPER' ;
 $en_tete.gasoil = 'GASOIL' ;
 $en_tete.petrole = 'PETROLE' ;
 $en_tete.tpc = 'TPC' ;
 $en_tete.total_carb = 'TOTAL CARB' ;
 $en_tete.total_lub = 'TOTAL LUB' ;
 $en_tete.vers_clients = [] ;
 $en_tete.total_attendu = 'TOTAL ATTENDU' ;
 $en_tete.versement = 'VERSEMENT BANQUE' ;
 $en_tete.ventes_client = 0 ;
 $en_tete.versement_pompistes = 0 ;
 $en_tete.manquant_pompiste = 'MQTS POMPISTES' ;
 $en_tete.depense = 'DEPENSES' ;
 $en_tete.ecart = 'ECART' ;
 $en_tete.ecart_gerant = 'ECART GERANT' ;
 $en_tete.clients = [] ;

 angular.forEach($scope.app.quart.vte_carburant, function(value10) {

  clients.push(value10.nom_client) ;
   
 }) ;

 angular.forEach($scope.app.quart.vte_lubrifiant, function(value10) {

  clients.push(value10.client.nom_client) ;
   
 }) ;

 angular.forEach($scope.app.quart.rgt_client, function(value11) {

  vers_clients.push(value11.client.nom_client) ;
   
 })

 $en_tete.clients = Array.from(new Set(clients)) ;
 $en_tete.vers_clients = Array.from(new Set(vers_clients)) ;

// console.log($en_tete.clients) ;
// console.log($en_tete.vers_clients) ;

 $scope.datas.push($en_tete) ;

 // console.log($scope.datas) ;

 /**********************************FIN TRAITEMENT EN-TETE********************************** */

  var $data = {} ;
  $data.date = $scope.app.quart.date.date_ouverture.slice(0,10) ;
  $data.quart = $scope.app.quart.date.quart.toUpperCase() ;
  $data.super = 0 ;
  $data.gasoil = 0 ;
  $data.petrole = 0 ;
  $data.tpc = 0 ;
  $data.total_carb = 0 ;
  $data.total_lub = 0 ;
  $data.vers_clients = [] ;
  $data.total_attendu = 0 ;
  $data.versement = 0 ;
  $data.ventes_client = 0 ;
  $data.versement_pompistes = 0 ;
  $data.manquant_pompiste = 0 ;
  $data.depense = 0 ;
  $data.ecart = 0 ;
  $data.ecart_gerant = 0 ;
  $data.clients = [] ;

  angular.forEach($scope.recap.Carburant, function($value2) {
                
      if ($value2.produit == 'SUPER') {

          $data.super += $value2.quantite ;

          $data.tpc += $value2.quantite ;
          $data.total_carb += $value2.montant ;

      } 
      if ($value2.produit == 'GASOIL') {

          $data.gasoil += $value2.quantite ;

          $data.tpc += $value2.quantite ;
          $data.total_carb += $value2.montant ;

      }
      if ($value2.produit == 'PETROLE'){
           
          $data.petrole += $value2.quantite ;

          $data.tpc += $value2.quantite ;
          $data.total_carb += $value2.montant ;
      }

     
     
   })

   angular.forEach($scope.recap.Lubrifiant, function($value3) {

    if ($value3.nom_produit == 'Total Lubrifiant') {
                
      $data.total_lub = $value3.montant ;
          
     }
    
   
   })

  $data.versement = $scope.app.quart.versement.montant ;

   angular.forEach($scope.app.quart.vte_carburant, function($value5) {
   
    $data.ventes_client += $value5.montant ;
          
   })

   angular.forEach($en_tete.clients, function($value10) {
   
     var $client = 0 ;

    // console.log($value10) ;

     angular.forEach($scope.app.quart.vte_carburant, function($value11) {
   
      if ($value10 == $value11.nom_client) {
         
        $client += $value11.montant ;

      } 
            
     })

    // console.log($client) ;

     angular.forEach($scope.app.quart.vte_lubrifiant, function($value20) {

    //  console.log($value10) ;
    //  console.log($value20) ;

      if ($value10 == $value20.client.nom_client) {
         
        $client += $value20.montant ;

      } 
            
     })

    // console.log($client) ;

     $data.clients.push($client)  ;
    
          
   })

   angular.forEach($en_tete.vers_clients, function($value12) {
   
    var $vers_client = 0 ;

    angular.forEach($scope.app.quart.rgt_client, function($value13) {
  
     if ($value12 == $value13.client.nom_client) {
        
       $vers_client += $value13.montant ;

     } 
           
    })
   
    $data.vers_clients.push($vers_client)  ;
   
         
   })

   angular.forEach($scope.app.quart.rgt_carburant, function($value6) {

    $data.versement_pompistes += $value6.montant ;
   
   })

   angular.forEach($scope.app.quart.depense, function($value7) {

    $data.depense += $value7.montant ;
   
   })

   $data.total_attendu = $data.total_carb + $data.total_lub ;

   angular.forEach($scope.app.quart.rgt_client, function($value9) {

    $data.total_attendu += $value9.montant ;
   
   })

   $data.ecart = parseFloat($data.total_attendu) - parseFloat($data.versement) ;
   $data.manquant_pompiste = $data.total_carb - $data.ventes_client - $data.versement_pompistes ;
   $data.ecart_gerant =  $data.ecart - $data.manquant_pompiste - $data.depense ;

   angular.forEach($scope.app.quart.vte_carburant, function($value8) {

    $data.ecart_gerant -= $value8.montant ;
     
   }) ;

   angular.forEach($scope.app.quart.vte_lubrifiant, function($value14) {

    $data.ecart_gerant -= $value14.montant ;
     
   }) ;

   $scope.datas.push($data) ;

   console.log($scope.datas) ;


}

$scope.Envoyer = function(){

$scope.vue = false ;
var obj2 = {};

var obj = {
              'recap_livraison_carb'     :  $scope.app.quart.livraisons  ,
              'recap_livraison_lub'     :  $scope.app.quart.lubrifiants, 
              'app_quart_personnel'     :  $scope.app.quart.personnel, 
              'app_quart_cuves'     :  $scope.app.quart.cuves, 
              'app_quart_magasin'     :  $scope.app.quart.magasin, 
              'app_quart_vte_carburant'     :  $scope.app.quart.vte_carburant, 
              'app_quart_vte_lubrifiant'     :  $scope.app.quart.vte_lubrifiant, 
              'app_quart_rgt_carburant'     :  $scope.app.quart.rgt_carburant, 
              'app_quart_rgt_client'     :  $scope.app.quart.rgt_client, 
              'app_quart_depense'     :  $scope.app.quart.depense, 
              'app_quart_versement'     :  $scope.app.quart.versement, 
              'app_quart_commentaire'     :  $scope.app.quart.commentaire,
              'app_quart_om'     :  $scope.app.quart.om, 
              'app_quart_appro'     :  $scope.app.quart.appro, 
              'app_quart_boutique'     :  $scope.app.quart.boutique, 
              'app_quart_laverie'     :  $scope.app.quart.laverie,
              'app_quart_date'     :  $scope.app.quart.date
            } ;

console.log(obj);

// Object.keys(obj.app_quart_boutique).length > 0
// angular.isDefined(obj.recap_livraison_carb)

if ( obj.recap_livraison_carb.length > 0 ) {

  angular.extend(obj2, {'recap_livraison_carb'     :  $scope.app.quart.livraisons});
}


if ( obj.recap_livraison_lub.length > 0 ) {

  angular.extend(obj2, {'recap_livraison_lub'     :  $scope.app.quart.lubrifiants});

}

if ( obj.app_quart_personnel.length > 0) {

  angular.extend(obj2, {'app_quart_personnel'     :  $scope.app.quart.personnel});
  
}

 if ( obj.app_quart_cuves.length > 0) {

  angular.extend(obj2, {'app_quart_cuves'     :  $scope.app.quart.cuves});
  
}

if ( obj.app_quart_magasin.length > 0) {

  angular.extend(obj2, {'app_quart_magasin'     :  $scope.app.quart.magasin});
  
}

if ( obj.app_quart_vte_carburant.length > 0) {

  angular.extend(obj2, {'app_quart_vte_carburant'     :  $scope.app.quart.vte_carburant});
  
}

if ( obj.app_quart_vte_lubrifiant.length > 0) {

  angular.extend(obj2, {'app_quart_vte_lubrifiant'     :  $scope.app.quart.vte_lubrifiant});
  
}

if ( obj.app_quart_rgt_carburant.length > 0) {

  angular.extend(obj2, {'app_quart_rgt_carburant'     :  $scope.app.quart.rgt_carburant});
  
}

if ( obj.app_quart_rgt_client.length > 0) {

  angular.extend(obj2, {'app_quart_rgt_client'     :  $scope.app.quart.rgt_client});
  
}

if ( obj.app_quart_depense.length > 0) {

  angular.extend(obj2, {'app_quart_depense'     :  $scope.app.quart.depense});
  
}

if ( Object.keys(obj.app_quart_versement).length > 0) {

  angular.extend(obj2, {'app_quart_versement'     :  $scope.app.quart.versement});
  
}

if ( Object.keys(obj.app_quart_commentaire).length > 0) {

angular.extend(obj2, {'app_quart_commentaire'     :  $scope.app.quart.commentaire});

}

if (angular.isDefined(obj.app_quart_om.ancien_solde)||angular.isDefined(obj.app_quart_om.nouveau_solde)) {

  angular.extend(obj2, {'app_quart_om'     :  $scope.app.quart.om});
  
}

if ( angular.isDefined(obj.app_quart_appro.ancien_solde)) {

  angular.extend(obj2, {'app_quart_appro'     :  $scope.app.quart.appro});
  
}

if (angular.isDefined(obj.app_quart_boutique.ancien_solde) || angular.isDefined(obj.app_quart_boutique.montant)) {

  angular.extend(obj2, {'app_quart_boutique'     :  $scope.app.quart.boutique});
  
}

if (angular.isDefined(obj.app_quart_laverie.montant)) {

  angular.extend(obj2, {'app_quart_laverie'     :  $scope.app.quart.laverie});
  
}

if (angular.isDefined(obj.app_quart_date.date_ouverture)) {

angular.extend(obj2, {'app_quart_date'     :  $scope.app.quart.date});

}


console.log(obj2);


  $http.post('api/pompistes.php?action=Envoyer', obj2

          ).success( function(data, status, headers, config){
                  console.log(data);

                  if (data.error == 'Duplicata') {

                    alert('ATTENTION ! Les données sont déjà dans la base !') ;
                    
                      
                  }else if (data[0].Transfert_Reussie == "Transfert_Reussie") {
                    
                    // localStorage.clear();
                    $localStorage.Quart = false ;
                    $scope.app.quart = {} ;
                    $scope.app.quart.cuves = [] ;
                    $scope.app.quart.personnel = [] ;
                    $scope.personnel = [];
                    $localStorage.Quart1.personnel = [] ;
                    

                    alert('Felicitation! Operation Execute avec success') ;

                    $state.go('login');

                      /*   $state.go('wherever', {whenever: 'whatever'}).then(function() {
                    // Get in a spaceship and fly to Jupiter, or whatever your callback does.
                    });  */

                  }else{

                    alert('Desolé! Echec Operation');
                  }

          
                                    
  });


          

}




});