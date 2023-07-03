
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Spriječi podnošenje obrasca

    // Dohvati unesene vrijednosti
    var email = document.getElementById('inputEmail').value;
    var password = document.getElementById('inputPassword').value;

    // Provjeri da li su polja ispunjena
    if (email.trim() === '' || password.trim() === '') {
        alert('ERROR MESSAGE: All fields are required');
        return;
    }

    // Provjeri unesene podatke
    if (email === 'melisa.geca@stu.ibu.edu.ba' && password === '123456') {
        window.location.href = 'dashboard.html'; // Preusmjeri na dashboard.html
    } else {
        alert('ERROR MESSAGE: Invalid email or password');
    }
});
