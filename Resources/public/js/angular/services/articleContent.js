'use strict';

angular.module('helpApp')
        .factory('articleContent', ['$resource',function ($resource) {
            return $resource("/app_dev.php/api/articles/:article",{},{
                'content': { method: "GET" }
            });
        }]);
