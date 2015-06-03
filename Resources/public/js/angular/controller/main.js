'use strict';

angular.module("helpApp")
    .controller('yitHelpCtrl', ['$scope',
        'helpData',
        'articleContent',
        '$window',
        function($scope, helpData, articleContent, $window) {

            helpData.data({},function(data){
                $scope.categorys = data;

                var url = $window.location.pathname;
                var subUrl = url.substring(url.indexOf('/help/') + 6, url.length);
                var params = subUrl.split('/');
                if(params.length === 2){
                    var categoryName = params[0];
                    var articleId = parseInt(params[1]);
                    var articleName = null;
                    angular.forEach($scope.categorys,function(cv){
                        if(cv.name.toLowerCase() === categoryName.toLowerCase()){
                            angular.forEach(cv.article,function(av){
                                if(av.id === articleId){
                                    articleName = av.name;
                                }
                            });
                        }
                    });

                    $scope.selectTab(articleId,articleName);
                }
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

            $scope.redirectTo = function(categoryName, articleId){
                var url = $window.location.pathname ;
                var subUrl = url.substring(0,url.indexOf('/help'));
                $window.location.href = $window.location.origin + subUrl+ "/help/" + categoryName + "/" + articleId;
            }

    }
]);