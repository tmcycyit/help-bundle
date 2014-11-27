'use strict';

angular.module("helpApp")
    .controller('yitHelpCtrl', ['$scope','helpData', 'articleContent', function($scope,helpData,articleContent) {
            helpData.data({},function(data){
                $scope.categorys = data;
            });

            $scope.selectCat = function(catId){
                if ($scope.selectedCat === catId){
                    $scope.selectedCat = "";
                } else {
                    $scope.selectedCat = catId;
                }

            };

            $scope.selectTab = function(tabId, articleName){
                $scope.selectedTab = tabId;
                $scope.articleName = articleName;
                articleContent.content({'article': $scope.selectedTab},{}, function(content){
                    $scope.content = content;
                });
            };

    }
]);