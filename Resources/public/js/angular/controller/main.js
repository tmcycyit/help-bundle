'use strict';

angular.module("helpApp")
    .controller('mainCtrl', ['$scope','helpData', 'articleContent', function($scope,helpData,articleContent) {
            helpData.data({},function(data){
                $scope.categorys = data;
            });

            $scope.selectCat = function(cat){
                $scope.selectedCat = cat;
//                if (!angular.isDefined(cat.open)){
//                    cat.open = true;
//                } else {
//                    cat.open = !cat.open;
//                }
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