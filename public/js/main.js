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
