app.controller('master_controller', function($scope, ajax_services) {
    $scope.test = 'Welcome';
    $scope.data;
    $scope.message_show;
    $scope.sender_list_call = function() {
        ajax_services.get_method('/sender_list').then(function(response) {
            $scope.senderList = response.data;
        })
    }
    $scope.sender_list_call();
    $scope.unreadMessages = function() {
        ajax_services.get_method('/load_unread_messages').then(function(response) {
            $scope.unreadList = response.data;
            $scope.message_count = response.count;
        })
    }
    $scope.unreadMessages();
    $scope.lastMessages = function() {
        ajax_services.get_method('/load_latest_messages_chat').then(function(response) {
            $scope.lastList = response.data;
        })
    }
    $scope.lastMessages();
    $scope.AllMessages = function() {
        ajax_services.get_method('/load_messages').then(function(response) {
            $scope.AllList = response.data;
        })
    }
    $scope.AllMessages();
    $scope.sendMessage = function(data) {

        ajax_services.post_method('/send', data).then(function(result) {
            $scope.data = undefined;
            $scope.message_show = 'true';
        });
    }
    $scope.markRead = function(data) {

        ajax_services.post_method('/mark_read', data).then(function(result) {
            $scope.data = undefined;
            $scope.unreadMessages();
        });
    }

    // $scope.view_change_pwd = function(user_id) {
    //     console.log(user_id);
    //     data = {};
    //     data.user_id = user_id;

    //     ajax_services.post_method('/profile_data', data).then(function(result) {
    //         console.log(result);
    //         if (result.status == 'success') {
    //             $scope.data_list = result.data;
    //             $fancyModal.open({
    //                 templateUrl: '/popup/change_password',
    //                 scope: $scope,
    //                 'themeClass': 'selectionpop',
    //             });
    //         }
    //     });

    // }

    // $scope.change_passwd = function(user_id, data) {

    //     if (user_id != undefined) {
    //         data.user_id = user_id;
    //     }

    //     ajax_services.post_method('/password_change', data).then(function(result) {
    //         console.log(result);
    //         if (result.status == 'error') {
    //             console.log(result.errors);
    //             $scope.error = result.errors;
    //             if (result.message) {
    //                 $scope.message = result.message;
    //             }

    //         } else if (result.status == 'failure') {
    //             $scope.message = result.message;

    //         } else {
    //             $scope.error = "";
    //             $scope.message = "";
    //             $scope.success = 'Your password changed successfully !!';
    //             $timeout(function() {
    //                 $fancyModal.close();
    //             }, 2000);
    //         }
    //     });

    // };

    // $scope.reset_data = function() {
    //     $scope.data = {};
    // };

});