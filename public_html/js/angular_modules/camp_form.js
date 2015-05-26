"use strict";

var app = angular.module('CampForm', []);

app.controller('SubjectController', ['$scope',
    function ($scope) {
        $scope.subjects = savedData.subjects;

        $scope.addSubject = function () {
            $scope.subjects.push({
                tests:[]
            });
        };
        
        $scope.addTest = function(subject){
            subject.tests.push({});
        };

        $scope.removeSubject = function(subject){
            var index = $scope.subjects.indexOf(subject);
            $scope.subjects.splice(index,1);
        };

        $scope.removeTest = function(test,subject){
            var index = subject.tests.indexOf(test);
            subject.tests.splice(index,1);
        };
    }
]);

app.directive('subjectList', function () {
    return {
        restrict: 'E',
        controller: 'SubjectController',
        templateUrl: 'angular_templates/camp_subject_lists.html'
    };
});

app.controller('FieldController', ['$scope',
    function ($scope) {
        $scope.fields = savedData.fields;

        $scope.addField = function () {
            $scope.fields.push({is_required:true});
        };

        $scope.deleteField = function(field){
            var index = $scope.fields.indexOf(field);
            $scope.fields.splice(index,1);
        };
    }
]);

app.directive('fieldList', function () {
    return {
        restrict: 'E',
        controller: 'FieldController',
        templateUrl: 'angular_templates/camp_field_lists.html'
    };
});