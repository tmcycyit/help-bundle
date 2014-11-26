'use strict';

angular.module('helpApp')
    .factory('helpData', ['$resource',function ($resource) {
        return $resource('../api/category/all',{},{
            'data': {
                method: 'GET',
                isArray: true
            }
        });
    }]);
