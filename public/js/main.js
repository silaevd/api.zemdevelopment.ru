M.AutoInit();

const videoRow = document.querySelector('#videoRow');
const videoInputField = document.getElementById('videoInputField');
const addVideoLinkBtn = document.getElementById('addVideoLink');

if(addVideoLinkBtn) {
    addVideoLinkBtn.onclick = function()
    {
        let clone = videoInputField.cloneNode(true);
        videoRow.appendChild(clone);
    }
}

/**
 * http transport
 *
 * @param {string} url
 * @param params mixed of request params
 * @param {string} method
 * @returns {Promise<>}
 */
function http(url = '', params = '', method = 'GET') {
    return new Promise(function (resolve, reject) {
        const xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        if (method === 'POST') {
            xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        }
        xhr.onload = function () {
            if (this.status === 200) {
                resolve(this.response);
            } else {
                const error = new Error(this.statusText);
                error.code = this.status;
                reject(error);
            }
        };
        xhr.onerror = function () {
            reject(new Error("Network Error"));
        };
        if (params) {
            if (params instanceof Object) {
                xhr.send($.param(params));
            } else {
                xhr.send(params);
            }
        } else {
            xhr.send();
        }
    });
}
