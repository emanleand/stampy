const URL = "/stampy/Controller";

window.onload = () => {
// document.addEventListener('load', () => {

    // accessStatusRequest();

    let viewRegister = document.querySelector('#section-form-register');
    let viewUpdater = document.querySelector('#section-form-updater');

    let viewUserList = document.querySelector('#section-table-user');

    let viewLogin = document.querySelector('#section-form-login');
    
    let linkNewRegister = document.querySelector('#new-register');
    
    let linkLoginIn = document.querySelector('#link-login-in');
    
    // let linkUsers = document.querySelector('#link-users');

    let addNewRegister = document.querySelector('#new-user');

    let buttonLogin = document.querySelector('#login');

    let buttonRegister = document.querySelector('#button-register');
    
    let buttonUpdate = document.querySelector('#button-update');

    let linkLoginOut = document.querySelector('#link-login-out');

    let buttonUpdateUserCurrent = document.querySelector('#link-username');

    let buttonFilter = document.querySelector('#filter');

    // focusViewListUser();

    /* *** Click *** */
    // linkNewRegister.addEventListener('click', (e) => {
    //     window.location.replace('Html/User/register_user.php');
    // });

    // linkLoginIn.addEventListener('click', (e) => {
    //     focusViewLogin();
    // });

    // linkUsers.addEventListener('click', (e) => {
    //     accessStatusRequest();
    //     focusViewListUser();
    // });

    // addNewRegister.addEventListener('click', (e) => {
    //     accessStatusRequest();
    //     focusViewRegister();
    // });

    document.querySelector('#login').addEventListener('click', (e) => {
        e.preventDefault();
        console.log('object');
        // loginRequest();
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

    buttonFilter.addEventListener('click', (e) => {
        // e.preventDefault();
        // let value = document.querySelector('#to-search').value;
        // console.log('--> ', value);
        // const viewFilter = URL + '/User/GetController.php?value=' + value;
    
        // let http = new XMLHttpRequest();
        // http.open('GET', viewFilter, true);
        // http.onload = function () {
        //     let response = JSON.parse(http.responseText);
        //     if (http.readyState == 4 && http.status == "200") {
        //         // if (response.code === 200) {

        //         // }
        //     } else {
        //         // return html empty
        //     }
        // }
        // http.send(null);
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
                    focusViewUpdater();
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
                        focusViewUpdater();
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

    // function focusViewLogin() {
    //     viewLogin.style.display = 'block';
    //     viewUserList.style.display = 'none';
    //     viewRegister.style.display = 'none';
    //     viewUpdater.style.display = 'none';
    // }

    // function focusViewRegister() {
    //     viewRegister.style.display = 'block';
    //     viewLogin.style.display = 'none';
    //     viewUserList.style.display = 'none';
    //     viewUpdater.style.display = 'none';
    // }
    
    // function focusViewListUser() {
    //     viewUserList.style.display = 'block';
    //     viewRegister.style.display = 'none';
    //     viewLogin.style.display = 'none';
    //     viewUpdater.style.display = 'none';
    // }

    // function focusViewUpdater() {
    //     viewUpdater.style.display = 'block';
    //     viewUserList.style.display = 'none';
    //     viewRegister.style.display = 'none';
    //     viewLogin.style.display = 'none';
    // }

    // function HeaderNoLoggedIn() {
    //     document.querySelector('#link-login-in').style.display = 'inline-block';
    //     document.querySelector('#new-register').style.display = 'inline-block';
    //     document.querySelector('#link-login-out').style.display = 'none';
    //     document.querySelector('#link-username').innerHTML = '';
    //     document.querySelector('#link-username').removeAttribute('code');
    // }   
});

// https://desarrolloactivo.com/blog/javascript-peticiones-ajax-es6/
// https://gist.github.com/EtienneR/2f3ab345df502bd3d13e

// para serializar
// https://gomakethings.com/how-to-serialize-form-data-with-vanilla-js/

// window.history.replaceState('Html/User/register_user.php', 'eejem' , '/user/register');
// https://medium.com/better-programming/js-vanilla-script-spa-1b29b43ea475