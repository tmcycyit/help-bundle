'use strict';

angular.module('helpApp')
        .factory('articleContent', ['$resource',function ($resource) {
            return $resource("/api/articles/:article",{},{
                'content': { method: "GET" }
            });
        }]);
