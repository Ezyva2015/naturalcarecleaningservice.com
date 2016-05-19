angular
  .module('MyApp')
  .controller('DemoCtrl', function($scope) {
    $scope.user = {
      title: '',
      email: '',
      firstName: '',
      lastName: '' ,
    };
  })