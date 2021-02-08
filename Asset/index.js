const URL = "/stampy/Controller";

window.onload = () => {

    accessStatusRequest();

    let viewRegister = document.querySelector('#section-form-register');

    let viewUserList = document.querySelector('#section-table-user');

    let viewLogin = document.querySelector('#section-form-login');
    
    let linkNewRegister = document.querySelector('#new-register');
    
    let linkLoginIn = document.querySelector('#link-login-in');
    
    let linkUsers = document.querySelector('#link-users');

    let addNewRegister = document.querySelector('#new-user');

    let buttonLogin = document.querySelector('#login');

    let buttonRegister = document.querySelector('#button-register');
    
    let buttonUpdate = document.querySelector('#button-update');

    let linkLoginOut = document.querySelector('#link-login-out');

    let buttonUpdateUserCurrent = document.querySelector('#link-username');

    focusViewListUser();

    /* *** Click *** */
    linkNewRegister.addEventListener('click', (e) => {
        focusViewRegister();
    });

    linkLoginIn.addEventListener('click', (e) => {
        focusViewLogin();
    });

    linkUsers.addEventListener('click', (e) => {
        accessStatusRequest();
        focusViewListUser();
    });

    addNewRegister.addEventListener('click', (e) => {
        accessStatusRequest();
        focusViewRegister();
    });

    buttonLogin.addEventListener('click', (e) => {
        e.preventDefault();
        loginRequest();
    });

    buttonRegister.addEventListener('click', (e) => {
        e.preventDefault();
        userNewRequest();
    });

    buttonUpdate.addEventListener('click', (e) => {
        e.preventDefault();
        userUpdateRequest();
    });
    
    linkLoginOut.addEventListener('click', (e) => {
        e.preventDefault();
        signOffRequest();
    });

    buttonUpdateUserCurrent.addEventListener('click', (e) => {
        let id = buttonUpdateUserCurrent.getAttribute('code');
        const viewDelete = URL + '/User/GetController.php?id=' + id;
    
        let http = new XMLHttpRequest();
        http.open('GET', viewDelete, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    focusViewRegister();
                    loadUserData(response, 'update', response.id);
                }
            } else {
                // return html empty
            }
        }
        http.send(null);
    });

    /**
     * Opena edit html user
     */
    let edit = document.querySelectorAll('.edit-user');
    edit.forEach(button => {
        button.addEventListener('click', () => {
            let id = button.getAttribute('id');
            const viewDelete = URL + '/User/GetController.php?id=' + id;
        
            let http = new XMLHttpRequest();
            http.open('GET', viewDelete, true);
            http.onload = function () {
                let response = JSON.parse(http.responseText);
                if (http.readyState == 4 && http.status == "200") {
                    if (response.code === 200) {
                        focusViewRegister();
                        loadUserData(response, 'update', response.id);
                    }
                } else {
                    // return html empty
                }
            }
            http.send(null);
        });
    });

    /* *** Function *** */

    function focusViewLogin() {
        viewLogin.style.display = 'block';
        viewUserList.style.display = 'none';
        viewRegister.style.display = 'none';
    }

    function focusViewRegister() {
        viewRegister.style.display = 'block';
        viewLogin.style.display = 'none';
        viewUserList.style.display = 'none';
    }
    
    function focusViewListUser() {
        viewUserList.style.display = 'block';
        viewRegister.style.display = 'none';
        viewLogin.style.display = 'none';
    }

    /**
     * 
     * 
     * @param array user 
     * @param string| mode 
     * @param int id 
     */
    function loadUserData(user = [], mode = 'insert', id = null) {        
        if (mode === 'update') {
            document.querySelector('#button-register').style.display = 'none';
            document.querySelector('#button-update').style.display = 'block';
            document.querySelector('#user').value = id;
            document.querySelector('#first-name').value = user.first_name;
            document.querySelector('#last-name').value = user.last_name;
            document.querySelector('#username').value = user.username;
            document.querySelector('#email').value = user.email;
            document.querySelector('#password').value = user.password;
            document.querySelector('#password-repeat').value = user.password;

        } else if (mode === 'insert') {
            document.querySelector('#first-name').value = '';
            document.querySelector('#last-name').value = '';
            document.querySelector('#username').value = '';
            document.querySelector('#email').value = '';
            document.querySelector('#password').value = '';
            document.querySelector('#password-repeat').value = '';
        }
    }

    function HeaderNoLoggedIn() {
        document.querySelector('#link-login-in').style.display = 'inline-block';
        document.querySelector('#new-register').style.display = 'inline-block';
        document.querySelector('#link-login-out').style.display = 'none';
        document.querySelector('#link-username').innerHTML = '';
        document.querySelector('#link-username').removeAttribute('code');
    }
    
    function HeaderLoggedIn(username = '', id = '') {
        document.querySelector('#link-login-out').style.display = 'inline-block';
        document.querySelector('#link-login-in').style.display = 'none';
        document.querySelector('#new-register').style.display = 'none';
        document.querySelector('#link-username').innerHTML = username;
        document.querySelector('#link-username').setAttribute('code', id);
    } 

    /**
     * 
     */
    function loginRequest() {
        let errorLogin = document.querySelector('#error-login');
        errorLogin.innerHTML = '';

        let formData = document.querySelector('#form-login');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        const urlLogin = URL + "/User/LoginController.php";
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, urlLogin, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            console.log(response);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                    HeaderLoggedIn(response.data.username, response.data.id);
                } else {
                    errorLogin.innerHTML = response.message;
                }
            } else {
                errorLogin.innerHTML = response.message;
            }
        }
        http.send(dataString);
    }

    /**
     * 
     */
    function userNewRequest() {
        let errorLogin = document.querySelector('#error-register');
        errorLogin.innerHTML = '';

        let formData = document.querySelector('#form-register');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        let urlRegister = URL + "/User/RegisterController.php";
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, urlRegister, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {console.log(response);
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                } else {
                    errorLogin.innerHTML = response.message;
                }
            } else {
                errorLogin.innerHTML = response.message;
            }
        }
        http.send(dataString);
    }
 
    /**
     * 
     */
    function userUpdateRequest() {
        let id = document.querySelector('#user').value;
        let errorLogin = document.querySelector('#error-register');
        errorLogin.innerHTML = '';
        
        let formData = document.querySelector('#form-register');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);
        
        let urlRegister = URL + '/User/UpdateController.php?id=' + id;
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, urlRegister, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                console.log(response);
                if (response.code === 200) {
                    window.location.reload();
                    focusViewListUser();
                } else {
                    errorLogin.innerHTML = response.message;
                }
            } else {
                errorLogin.innerHTML = response.message;
            }
        }
        http.send(dataString);
    } 

    /**
     * 
     */
    function accessStatusRequest() {
        const urlSession = URL + '/Session/GetController.php';
        let method = 'GET';

        let http = new XMLHttpRequest();
        http.open(method, urlSession, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                console.log(response);
                if(response.code === 200) {
                    HeaderLoggedIn(response.data.username, response.data.id);
                    loadUserData();
                } else {
                    focusViewLogin();
                }
            }
        }
        http.send(null);    
    }

    /**
     * 
     */
    function signOffRequest() {
        const urlSession = URL + '/Session/CloseController.php';
        let method = 'GET';

        let http = new XMLHttpRequest();
        http.open(method, urlSession, true);
        http.onload = function () {
            let response = JSON.parse(http.responseText);            
            if (http.readyState == 4 && http.status == "200") {
                window.location.reload();
                HeaderNoLoggedIn();
            }
        }
        http.send(null);
    }
};

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
 * 
 * @param {*} data 
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