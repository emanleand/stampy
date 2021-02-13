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

    let http = new XMLHttpRequest();
    http.open('POST', urlRegister, true);
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
 * AJAX to UpdateController
 */
function userUpdateRequest() {
    let id = document.querySelector('#user').value;
    let errorLogin = document.querySelector('#error-update');
    errorLogin.innerHTML = '';
    
    let formData = document.querySelector('#form-update');
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
    let urlSession = URL + '/Session/GetController.php';
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
    let urlSession = URL + '/Session/CloseController.php';
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

/**
 * 
 * @param {*} id 
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

/**
 * 
 * @param {*} username 
 * @param {*} id 
 */
function HeaderLoggedIn(username = '', id = '') {
    document.querySelector('#link-login-out').style.display = 'inline-block';
    document.querySelector('#link-login-in').style.display = 'none';
    document.querySelector('#new-register').style.display = 'none';
    document.querySelector('#link-username').innerHTML = username;
    document.querySelector('#link-username').setAttribute('code', id);
}

/**
 * 
 * @param array user 
 * @param string| mode 
 * @param int id 
 */
function loadUserData(user = [], mode = 'insert', id = null) {
    document.querySelector('#user').value = id;
    document.querySelector('#first-name-upd').value = user.first_name;
    document.querySelector('#last-name-upd').value = user.last_name;
    document.querySelector('#username-upd').value = user.username;
    document.querySelector('#email-upd').value = user.email;
}