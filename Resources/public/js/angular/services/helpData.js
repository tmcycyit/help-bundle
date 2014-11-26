'use strict';

angular.module('helpApp')
    .factory('helpData', ['$resource',function ($resource) {
        return $resource('/app_dev.php/api/category/all',{},{
            'data': {
                method: 'GET',
                isArray: true
            }
        });
    }]);
