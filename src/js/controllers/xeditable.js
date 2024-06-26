
app.controller('XeditableCtrl', ['$scope', '$filter', '$http', 'editableOptions', 'editableThemes','artistFactory',
  function($scope, $filter, $http, editableOptions, editableThemes, artistFactory){



    editableThemes.bs3.inputClass = 'input-sm';
    editableThemes.bs3.buttonsClass = 'btn-sm';
    editableOptions.theme = 'bs3';


$scope.artists = artistFactory.query();

$scope.artists= Artist.query();
console.log($scope.artists);

$scope.initArtist = function(){

  $scope.artists= Artist.query();

}
 
    $scope.html5 = {
      email: 'email@example.com',
      tel: '123-45-67',
      number: 29,
      range: 10,
      url: 'http://example.com',
      search: 'blabla',
      color: '#6a4415',
      date: null,
      time: '12:30',
      datetime: null,
      month: null,
      week: null
    };

    $scope.user = {
    	name: 'awesome',
    	desc: 'Awesome user \ndescription!',
      status: 2,
      agenda: 1,
      remember: false
    }; 

    $scope.actives = [
      {value: 1, text: 'true'},
      {value: 2, text: 'false'}

    ];

    $scope.agenda = [
      {value: 1, text: 'male'},
      {value: 2, text: 'female'}
    ];

    $scope.showStatus = function() {
      var selected = $filter('filter')($scope.actives, {value: $scope.artist.active});
      return ($scope.artist.active && selected.length) ? selected[0].text : 'Not set';
    };

    $scope.showAgenda = function() {
      var selected = $filter('filter')($scope.agenda, {value: $scope.user.agenda});
      return ($scope.user.agenda && selected.length) ? selected[0].text : 'Not set';
    };

    // editable table
    $scope.users = userFactory.getuser.query();
    console.log($scope.users);
    $scope.users = [
      {id: 1, name: 'awesome user1', status: 2, group: 4, groupName: 'admin'},
      {id: 2, name: 'awesome user2', status: undefined, group: 3, groupName: 'vip'},
      {id: 3, name: 'awesome user3', status: 2, group: null}
    ];
    // editable table
   


    $scope.groups = [];
    $scope.loadGroups = function() {
      return $scope.groups.length ? null : $http.get('api/groups').success(function(data) {
        $scope.groups = data;
      });
    };

    $scope.showGroup = function(user) {
      if(user.group && $scope.groups.length) {
        var selected = $filter('filter')($scope.groups, {id: user.group});
        return selected.length ? selected[0].text : 'Not set';
      } else {
        return user.groupName || 'Not set';
      }
    };

    $scope.showStatus = function(artist) {
      var selected = [];
      if(artist && artist.active) {
        selected = $filter('filter')($scope.actives, {value: artist.active});
      }
      return selected.length ? selected[0].text : 'Not set';
    };

    $scope.checkName = function(data, id) {
      if (id === 101 && data !== 'awesome') {
        return "Username 2 should be `awesome`";
      }
    };
      //
    $scope.saveArtist = function(data, id) {
      //$scope.user not updated yet
      console.log(data);
      angular.extend(data, {id: id});
     return Artist.update({id: id}, data);

    };

      // save user
      $scope.saveUser = function(data, id) {
      //$scope.user not updated yet
      console.log(data);
      angular.extend(data, {id: id});
      // return $http.post('api/saveUser', data);
    };


    // remove user
    $scope.removeUser = function(index) {
      $scope.users.splice(index, 1);
    };
     // remove Artist
    $scope.removeArtist = function(index) {
//      $scope.artists.splice(index, 1);
    return Artist.delete({id: index}, null, function(){

      $scope.artists= Artist.query();

    });
       
    };

    // add user
    $scope.addUser = function() {
      $scope.inserted = {
        id: $scope.users.length+1,
        name: '',
        status: null,
        group: null 
      };
      $scope.users.push($scope.inserted);
    };

     // add Artist
    $scope.addArtist = function() {

    return  Artist.save({

  //      id: 99,
        name:'monthe',
        email: 'monthe@denis.com',
        age:'10',
        bio:'denis',
        picture:'http://denis.denis.com',        
        active: 'true',       
        beatMaker: 'true',         
        producer: 'true',         
        stylist: 'true',         
        designer:'true',
        singer:'true'

    });
       

    };

   

}]);
