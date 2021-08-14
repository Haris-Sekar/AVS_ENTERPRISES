$(document).ready(function () {
    //change selectboxes to selectize mode to be searchable
       $("select").select2();
    });
    var app = angular.module('app', []);

app.controller('test', function($scope) {
  $scope.model = {};
});
    