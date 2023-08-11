const detachButtons = document.getElementsByClassName('detach-buttons');
const editButton = document.getElementById('edit-button');

//when edit button is clicked, remove 'none' display of the 'disenroll' buttons
editButton.addEventListener("click", function () {
    for (let i = 0; i < detachButtons.length; i ++) {
        detachButtons[i].style.removeProperty('display');
    }
});
