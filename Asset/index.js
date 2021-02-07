const URL = "/stampy/Controller/User/";

window.onload = () => {
    let viewRegister = document.querySelector('#section-form-register');
    viewRegister.style.display = 'none';

    let viewUserList = document.querySelector('#section-table-user');
    viewUserList.style.display = 'none';

    let viewUserEdit = document.querySelector('#edit-user');
    viewUserEdit.style.display = 'none';

    let viewLogin = document.querySelector('#section-form-login');
    

    let linkNewRegister = document.querySelector('#new-register');
    
    let linkLogin = document.querySelector('#link-login');
    
    let linkUsers = document.querySelector('#link-users');

    /* *** Click *** */
    linkNewRegister.addEventListener('click', (e) => {
        focusViewRegister();
    });

    linkLogin.addEventListener('click', (e) => {
        focusViewLogin();
    });

    linkUsers.addEventListener('click', (e) => {
        focusViewListUser();
    });

    let addNewRegister = document.querySelector('#new-user');
    addNewRegister.addEventListener('click', (e) => {
        focusViewRegister();
    });

    let buttonLogin = document.querySelector('#login');
    buttonLogin.addEventListener('click', (e) => {
        e.preventDefault();
        accessRequest();
    });

    let buttonRegister = document.querySelector('#register');
    buttonRegister.addEventListener('click', (e) => {
        e.preventDefault();
        userRequest();
    });

    /**
     * Opena edit html user
     */
    let edit = document.querySelectorAll('.edit-user');
    edit.forEach(button => {
        button.addEventListener('click', () => {
            let id = button.getAttribute('id');
            const viewDelete = URL + 'EditController.php?id=' + id;
        
            let http = new XMLHttpRequest();
            http.open('GET', viewDelete, true);
            http.onload = function () {
                let response = http.responseText;
                if (http.readyState == 4 && http.status == "200") {
                    focusViewUserEdit();
                    document.querySelector('#edit-user').innerHTML = response;
                } else {
                    // return html empty
                }
            }
            http.send(null);
        });
    });

    /* *** Event *** */
    function focusViewLogin() {
        viewLogin.style.display = 'block';
        viewUserList.style.display = 'none';
        viewRegister.style.display = 'none';
        viewUserEdit.style.display = 'none';
    }

    function focusViewRegister() {
        viewRegister.style.display = 'block';
        viewLogin.style.display = 'none';
        viewUserList.style.display = 'none';
        viewUserEdit.style.display = 'none';
    }
    
    function focusViewListUser() {
        viewUserList.style.display = 'block';
        viewRegister.style.display = 'none';
        viewLogin.style.display = 'none';
        viewUserEdit.style.display = 'none';
    }

    function focusViewUserEdit() {
        viewUserEdit.style.display = 'block';
        viewUserList.style.display = 'none';
        viewRegister.style.display = 'none';
        viewLogin.style.display = 'none';
    }
    /**
     * 
     */
    function accessRequest() {
        let errorLogin = document.querySelector('#error-login');
        errorLogin.innerHTML = '';

        let formData = document.querySelector('#form-login');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        const urlLogin = URL + "LoginController.php";
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, urlLogin, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                console.log(response);
                if (response.code === 200) {
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
    function userRequest() {
        let errorLogin = document.querySelector('#error-register');
        errorLogin.innerHTML = '';

        let formData = document.querySelector('#form-register');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        let urlRegister = URL + "RegisterController.php";
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, urlRegister, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                if (response.code === 200) {
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
};

function deleteUser(id) { 
    const urlDelete = URL + 'DeleteController.php?id=' + id;
    let method = 'GET';

    let http = new XMLHttpRequest();
    http.open(method, urlDelete, true);
    http.onload = function () {
        let response = JSON.parse(http.responseText);
        if (http.readyState == 4 && http.status == "200") {
            console.log(response);            
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