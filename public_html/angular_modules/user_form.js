"use strict";

var app = angular.module('UserForm', []);


app.controller('AddressController', ['$scope',
    function ($scope) {
        $scope.addresses = window.addresses;
        $scope.provinces = window.provinces;
        $scope.districts = {};
        $scope.subDistricts = {};

        function clearObject(obj){
            for(var k in obj){
                delete obj[k];
            }
        }

        $scope.onProvinceChange = function (address) {
            var province_id = address.province_id;
            var districts = window.districts;
            clearObject($scope.districts);
            var noReset = false;
            for(var i = 0,l=districts.length;i<l;i++){
                var district = districts[i];

                if (province_id == district.parent_id ) {
                    if(district.id == address.district_id){
                        noReset = true;
                    }
                    $scope.districts[district.id] = district.name;
                }

            }
            
            if(!noReset){
                address.district_id = 0;
            }
            $scope.onDistrictChange(address);
        };

        $scope.onDistrictChange = function (address) {
            var district_id = address.district_id;
            var subDistricts = window.subDistricts;
            clearObject($scope.subDistricts);
            var noReset = false;
            for(var i = 0,l=subDistricts.length;i<l;i++){
                var subDistrict = subDistricts[i];
                //console.log(district_id , subDistrict.parent_id)
                if (district_id == subDistrict.parent_id+"") {
                    if(subDistrict.id == address.sub_district_id){
                        noReset = true;
                        
                    }
                    $scope.subDistricts[subDistrict.id] = subDistrict.name;

                }

            }
            console.log($scope.subDistricts);
            if(!noReset){
                address.sub_district_id = 0;
            }
        };

        $scope.addAddress = function(){
            $scope.addresses.push({});
        };

        for (var key in window.addresses) {
            window.addresses[key].province_id = window.addresses[key].province_id + "";
            window.addresses[key].district_id = window.addresses[key].district_id + "";
            window.addresses[key].sub_district_id = window.addresses[key].sub_district_id + "";
            $scope.onProvinceChange(window.addresses[key]);
            //$scope.onDistrictChange(window.addresses[key]);
        }

    }
]);

app.directive('addressList', function () {
    return {
        restrict: 'E',
        controller: 'AddressController',
        templateUrl: 'angular_templates/user_address_list.html'
    };
});

app.controller('ParentController', ['$scope',
    function($scope){
        $scope.parents = window.parents;
        
        $scope.addParent = function(){
            $scope.parents.push({});
        };
    }
]);

app.directive('parentList', function () {
    return {
        restrict: 'E',
        controller: 'ParentController',
        templateUrl: 'angular_templates/user_parent_list.html'
    };
});

app.controller('SemesterController', ['$scope',
    function($scope){
        var semesters = window.semesters
        $scope.semesters = semesters;
        $scope.lastLevel = window.lastLevel;

        for(var i = 0,l=semesters.length;i<l;i++){
            semesters[i].level_id = parseInt( semesters[i].level_id, 10);
        }

        $scope.addSemester = function(){
            $scope.semesters.push({});
        };
    }
]);

app.directive('semesterList', function () {
    return {
        restrict: 'E',
        controller: 'SemesterController',
        templateUrl: 'angular_templates/user_semester_list.html'
    };
});