app = angular.module('chat_box', []);

// /////// http Ajax services/////////////
app.factory('ajax_services', function($http) {
    return {
        get_method: function(url) {
            return $http.get(url).then(function(data) {
                return data.data;
            });
        },
        post_method: function(url, obj) {
            return $http.post(url, obj).then(function(data) {
                return data.data;
            });
        }
    };
});