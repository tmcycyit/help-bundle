'use strict';

angular.module('helpApp')
        .factory('articleContent', ['$resource',function ($resource) {
            return $resource("/api/help/articles/:article",{},{
                'content': { method: "GET" }
            });
        }]);
