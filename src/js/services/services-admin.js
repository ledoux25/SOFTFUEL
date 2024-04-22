

app.factory('Produit', function($http) {

  var produit = {

produits : [],
produits_lub : [],
produits_gaz: [],


produit: function(){

 return  $http.get('api/pompistes.php?action=get_produit_carburant').success( function(data, status, headers, config){
       produit.produits = data ;
     })

},

produit_lub: function(){
return $http.get('api/pompistes.php?action=get_produit_carburant').success( function(data, status, headers, config){
        produit.produits_lub = data;
    })
  
},

produit_gaz: function(){
return $http.get('api/pompistes.php?action=get_produit_carburant').success( function(data, status, headers, config){
        produit.produits_gaz = data;
    })
  
}


  };


  return produit

});

app.factory('Cloture', function($http) {


 return{
   
  get_cloture: function(){
    return $http.get('api/pompistes.php?action=get_cloture');
  },
 
 }


});
