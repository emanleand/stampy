'use strict';

(function () {
    function init() {
        var router = new Router([
            new Route('login', 'login_user.php', true),            
            new Route('register', 'register_user.php'),
            new Route('stampy', 'list_user.php')
        ]);
    }
    init();
}());