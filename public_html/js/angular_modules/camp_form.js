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
            $scope.fields.push({});
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