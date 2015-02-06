function generateStub() {
    var current = document.getElementById('name').value;
    current = current.replace(/[^a-z0-9]/gi, '').toLowerCase();
    document.getElementById('stub').value = current;
}
function generatePassword() {
    var password = (Math.random() + 1).toString(36).substring(7);
    document.getElementById('password').value = password;
}
function addAttachment() {
    // Add attachment
}

function resizeNav() {

    var nav = document.getElementById('nav');
    var resizer = document.getElementsByClassName('resizer');
    if(nav.classList.contains('large')) {
        nav.className = 'large';
    } else {
        nav.className = 'small';
    }

    if(nav.className == 'large') {
        nav.style.width = '80px';
        document.getElementById('main').style.marginLeft = '80px';
        var children = document.getElementsByClassName('resizable');
        for(var i = 0; i < children.length; i++) {
            children[i].style.display = 'none';
        }
        nav.className  = 'small';
    } else {
        nav.style.width = '300px';
        document.getElementById('main').style.marginLeft = '300px';
        var children = document.getElementsByClassName('resizable');
        for(var i = 0; i < children.length; i++) {
            children[i].style.display = 'inline';
        }
        nav.className  = 'large';

    }

}

function closeNotification() {
    document.getElementById("close-notification").parentNode.style.display = "none"
}