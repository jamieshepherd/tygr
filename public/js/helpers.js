function generateStub() {
    var current = document.getElementById('name').value;
    current = current.replace(/[^a-z0-9]/gi, '').toLowerCase();
    document.getElementById('stub').value = current;
}