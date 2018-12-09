// GET UI Elements

document.addEventListener('DOMContentLoaded', function () { 

    
    let container = document.querySelector('#body-container');

    if (container.children[0].classList.contains('alert'))
    {
        setTimeout(hideAlertMessage, 2000);
    }

    function hideAlertMessage()
    {
        // container.children[0].style.display = 'none';

        $('.alert').fadeOut(1000);
    }

 });