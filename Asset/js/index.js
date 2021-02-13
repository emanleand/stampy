const URL = "/stampy/Controller";

window.onload = () => {
    /** This controls access every time the page is reloaded */
    accessStatusRequest();

    let viewRegister = document.querySelector('#section-form-register');
    let viewUpdater = document.querySelector('#section-form-updater');
    let viewUserList = document.querySelector('#section-table-user');
    let viewLogin = document.querySelector('#section-form-login');
    
    let linkNewRegister = document.querySelector('#new-register');
    let linkLoginIn = document.querySelector('#link-login-in');
    let linkUsers = document.querySelector('#link-users');
    let addNewRegister = document.querySelector('#new-user');
    let buttonLoginAction = document.querySelector('#login');
    let buttonRegisterAction = document.querySelector('#button-register');
    let buttonUpdateAction = document.querySelector('#button-update');
    let linkLoginOutAction = document.querySelector('#link-login-out');
    let buttonUpdateUserInSessionAction = document.querySelector('#link-username');
    let buttonFilterAction = document.querySelector('#filter');

    focusViewListUser();

    /* *** Click View *** */
    linkNewRegister.addEventListener('click', (e) => {
        removeAlert();
        focusViewRegister();
    });

    linkLoginIn.addEventListener('click', (e) => {
        removeAlert();
        focusViewLogin();
    });

    linkUsers.addEventListener('click', (e) => {
        accessStatusRequest();
        removeAlert();
        focusViewListUser();
    });

    addNewRegister.addEventListener('click', (e) => {
        accessStatusRequest();
        removeAlert();
        focusViewRegister();
    });

    /** Click Process */
    buttonLoginAction.addEventListener('click', (e) => {
        e.preventDefault();
        loginRequest();
    });

    buttonRegisterAction.addEventListener('click', (e) => {
        e.preventDefault();
        userNewRequest();
    });

    buttonUpdateAction.addEventListener('click', (e) => {
        e.preventDefault();
        userUpdateRequest();
    });
    
    linkLoginOutAction.addEventListener('click', (e) => {
        e.preventDefault();
        signOffRequest();
    });

    buttonFilterAction.addEventListener('click', (e) => {
        e.preventDefault();
        let value = document.querySelector('#value-to-search').value;
        let key = document.querySelector('#key-to-search').value;
        location.href = '?key=' + key + '&value=' + value;
    });

    buttonUpdateUserInSessionAction.addEventListener('click', (e) => {
        e.preventDefault();
        removeAlert();
        sessionUserUpdateRequest();
    });

    /**
     * Opena edit html user
     */
    let edit = document.querySelectorAll('.edit-user');
    edit.forEach(button => {
        button.addEventListener('click', () => {
            let id = button.getAttribute('id');
            const viewUpdate = URL + '/User/GetController.php?id=' + id;
        
            let http = new XMLHttpRequest();
            http.open('GET', viewUpdate, true);
            http.onload = function () {
                let response = JSON.parse(http.responseText);
                if (http.readyState == 4 && http.status == "200") {
                    if (response.code === 200) {
                        focusViewUpdater();
                        loadUserData(response, response.id);
                    }
                } else {
                    // return html empty
                }
            }
            http.send(null);
        });
    });

    /* *** Function *** */

    /**
     *  This activates the login screen
     */
    function focusViewLogin() {
        viewLogin.style.display = 'block';
        viewUserList.style.display = 'none';
        viewRegister.style.display = 'none';
        viewUpdater.style.display = 'none';
    }

    /**
     * This activates the registration screen
     */
    function focusViewRegister() {
        viewRegister.style.display = 'block';
        viewLogin.style.display = 'none';
        viewUserList.style.display = 'none';
        viewUpdater.style.display = 'none';
    }

    /**
     * This activates the user list screen 
     */
    function focusViewListUser() {
        viewUserList.style.display = 'block';
        viewRegister.style.display = 'none';
        viewLogin.style.display = 'none';
        viewUpdater.style.display = 'none';
    }

    /**
     * This activates the user update screen 
     */
    function focusViewUpdater() {
        viewUpdater.style.display = 'block';
        viewUserList.style.display = 'none';
        viewRegister.style.display = 'none';
        viewLogin.style.display = 'none';
    }

    /**
     * This loads the data from the registry to update
     * 
     * @param array user 
     * @param int id 
     */
    function loadUserData(user, id) {
        document.querySelector('#user').value = id;
        document.querySelector('#first-name-upd').value = user.first_name;
        document.querySelector('#last-name-upd').value = user.last_name;
        document.querySelector('#username-upd').value = user.username;
        document.querySelector('#email-upd').value = user.email;
    }

    /**
     * This modify the header when a user is offline
     */
    function HeaderNoLoggedIn() {
        document.querySelector('#link-login-in').style.display = 'inline-block';
        document.querySelector('#new-register').style.display = 'inline-block';
        document.querySelector('#link-login-out').style.display = 'none';
        document.querySelector('#link-username').innerHTML = '';
        document.querySelector('#link-username').removeAttribute('code');
    }

    /**
     * This modify the header when a user is logged in.
     * @param string username 
     * @param int id 
     */
    function HeaderLoggedIn(username = '', id = null) {
        document.querySelector('#link-login-out').style.display = 'inline-block';
        document.querySelector('#link-login-in').style.display = 'none';
        document.querySelector('#new-register').style.display = 'none';
        document.querySelector('#link-username').innerHTML = username;
        document.querySelector('#link-username').setAttribute('code', id);
    }

    /**
     * @param string msg
     */
    function showAlert(msg) {console.log('object');
        let error = document.querySelector('#error');
        error.innerHTML = msg;
        error.style.backgroundColor = '#eca58f';
        error.style.opacity = '0.85';
    }

    /**
     * 
     */
    function removeAlert() {
        let error = document.querySelector('#error');
        error.innerHTML = '';
        error.style.backgroundColor = '';
        error.style.opacity
    }
    /**
     * This requests access for a new user.
     */
    function loginRequest() {
        let formData = document.querySelector('#form-login');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        let urlLogin = URL + "/User/LoginController.php";

        let http = new XMLHttpRequest();
        http.open('POST', urlLogin, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                    HeaderLoggedIn(response.data.username, response.data.id);
                } else {
                    showAlert(response.message);
                }
            } else {
                showAlert('Bad Request');
            }
        }
        http.send(dataString);
    }

    /**
     * This requests the registration of a new user
     */
    function userNewRequest() {
        let formData = document.querySelector('#form-register');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        let urlRegister = URL + "/User/RegisterController.php";

        let http = new XMLHttpRequest();
        http.open('POST', urlRegister, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                } else {
                    showAlert(response.message);
                }
            } else {
                showAlert('Bad Request');
            }
        }
        http.send(dataString);
    }
 
    /**
     * This requests the update of a user's data
     */
    function userUpdateRequest() {
        let id = document.querySelector('#user').value;
        
        let formData = document.querySelector('#form-update');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);
        
        let urlRegister = URL + '/User/UpdateController.php?id=' + id;

        let http = new XMLHttpRequest();
        http.open('POST', urlRegister, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                } else {
                    showAlert(response.message);
                }
            } else {
                showAlert('Bad Request');
            }
        }
        http.send(dataString);
    } 

    /**
     * This controls if there is a user in session
     */
    function accessStatusRequest() {
        let urlSession = URL + '/Session/GetController.php';

        let http = new XMLHttpRequest();
        http.open('GET', urlSession, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if(response.code === 200) {
                    HeaderLoggedIn(response.data.username, response.data.id);
                } else {
                    focusViewLogin();
                }
            }
        }
        http.send(null);    
    }

    /**
     * This destroys the current session
     */
    function signOffRequest() {
        let urlSession = URL + '/Session/CloseController.php';

        let http = new XMLHttpRequest();
        http.open('GET', urlSession, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);            
            if (http.readyState == 4 && http.status == "200") {
                window.location.reload();
                HeaderNoLoggedIn();
            }
        }
        http.send(null);
    }

    /**
     * This prepares a user data to edit
     */
    function sessionUserUpdateRequest() {
        let id = buttonUpdateUserInSessionAction.getAttribute('code');
        let viewUpdate = URL + '/User/GetController.php?id=' + id;
    
        let http = new XMLHttpRequest();
        http.open('GET', viewUpdate, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    focusViewUpdater();
                    loadUserData(response, response.id);
                }
            } else {
                // return html empty
            }
        }
        http.send(null);
    }
};

/**
 * This removes a user's data
 * 
 * @param in id 
 */
function deleteUser(id) { 
    const urlDelete = URL + '/User/DeleteController.php?id=' + id;
    let method = 'GET';
    let http = new XMLHttpRequest();
    http.open(method, urlDelete, true);
    http.onload = function () {
        let response = JSON.parse(http.responseText);
        if (http.readyState == 4 && http.status == "200") {
            window.location.reload();           
        } else {
            errorLogin.innerHTML = response.message;
        }
    }
    http.send(null);
}

/**
 * Serialize
 * 
 * @param array data 
 * @returns Object
 */
function serialize(data) {
    let obj = {};
    for (let [key, value] of data) {
        if (obj[key] !== undefined) {
            if (!Array.isArray(obj[key])) {
                obj[key] = [obj[key]];
            }
            obj[key].push(value);
        } else {
            obj[key] = value;
        }
    }
    return obj;
}

// https://desarrolloactivo.com/blog/javascript-peticiones-ajax-es6/
// https://gist.github.com/EtienneR/2f3ab345df502bd3d13e

// para serializar
// https://gomakethings.com/how-to-serialize-form-data-with-vanilla-js/