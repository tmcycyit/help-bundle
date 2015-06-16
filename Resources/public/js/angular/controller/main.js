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
                if(params.length === 2 && url.indexOf('/help/') !== -1){
                    var categorySlug = params[0];
                    var articleId = parseInt(params[1]);
                    var articleName = null;
                    angular.forEach($scope.categorys,function(cv){
                        if(cv.slug.toLowerCase() === categorySlug.toLowerCase()){
                            angular.forEach(cv.article,function(av){
                                if(av.id === articleId){
                                    articleName = av.name;
                                }
                            });
                        }
                    });
                    $scope.selectTab(articleId);
                }
                else if($scope.categorys.length) {
                    var catSlug = null, artId = null;
                    angular.forEach($scope.categorys,function(v){
                        if(v.article.length && artId === null){
                            catSlug = v.slug;
                            artId = v.article[0].id;
                        }
                    });
                    $scope.selectTab(artId);
                }
            });

            $scope.selectCat = function(catId){
                if ($scope.selectedCat === catId){
                    $scope.selectedCat = "";
                } else {
                    $scope.selectedCat = catId;
                }

            };

            $scope.selectTab = function(tabId){
                $scope.selectedTab = tabId;
                articleContent.content({'article': $scope.selectedTab},{}, function(data){
                    $scope.articleName = data.name;
                    $scope.content = data.content;
                });
            };

            $scope.redirectTo = function(categorySlug, articleId){
                var url = $window.location.pathname ;
                var subUrl = url.substring(0, url.indexOf('/help'));
                $window.location.href = $window.location.origin + subUrl+ "/help/" + categorySlug + "/" + articleId;
            }

    }
])
    .directive("yitCompileHtml",['$compile',function($compile){
        return {
            restrict: 'EA',
            scope: {
                html: '=yitCompileHtml'
            },
            compile: function(){
                return function(scope, el){
                    scope.$watch('html',function(d){
                        el.append($compile(scope.html)(scope))
                    },true)
                }
            }
        }
    }]);