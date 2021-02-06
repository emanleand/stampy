window.onload = () => {
    document.querySelector('#section-form-register').style.display = "none";
    document.querySelector('#section-table-user').style.display = "none";

    let login = document.querySelector('#login');
    login.addEventListener('click', (e) => {
        e.preventDefault();
        accessRequest();
    });

    /**
     * 
     */
    function accessRequest() {
        $errorLogin = document.querySelector('#error-login');
        $errorLogin.innerHTML = '';

        let formData = document.querySelector('#form-login');
        let data = new FormData(formData);
        let dataObj = serialize(data);
        let dataString = JSON.stringify(dataObj);

        const URL = "/stampy/Controller/User/LoginController.php";
        let method = 'POST';

        let http = new XMLHttpRequest();
        http.open(method, URL, true);
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        http.onload = function () {
            let response = JSON.parse(http.responseText);
            if (http.readyState == 4 && http.status == "200") {
                console.log(response);
                if (response.code === 200) {
                    console.log('200');
                } else {
                    $errorLogin.innerHTML = response.message;
                }
            } else {
                $errorLogin.innerHTML = response.message;
            }
        }
        http.send(dataString);
    }
};

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