function generateStub() {
    var current = document.getElementById('name').value;
    current = current.replace(/[^a-z0-9]/gi, '').toLowerCase();
    document.getElementById('stub').value = current;
}
function generatePassword() {
    var password = (Math.random() + 1).toString(36).substring(7);
    document.getElementById('password').value = password;
}