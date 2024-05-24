let myForm = document.getElementById('myForm');

myForm.addEventListener('submit', function(e) {
    let id = document.getElementById('identifiant');
    let nom = document.getElementById('nom');
    let prenom = document.getElementById('prenom');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let date = document.getElementById('date');

    if(id.value.trim() == '') {
        id.placeholder = 'Veuillez entrer votre identifiant';
        id.style.borderColor = 'red';
        id.style.color = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${id.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
        e.preventDefault();
    } else if(nom.value.trim() == '') {
        nom.placeholder = 'Veuillez entrer votre nom';
        nom.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${nom.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(prenom.value.trim() == '') {
        prenom.placeholder = 'Veuillez entrer votre prenom';
        prenom.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${prenom.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(email.value.trim() == '') {
        email.placeholder = 'Veuillez entrer votre email';
        email.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${email.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(date.value.trim() == '') {
        date.placeholder = 'Veuillez entrer votre date de naissance';
        date.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${date.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(password.value.trim() == '') {
        password.placeholder = 'Veuillez entrer votre mot de passe';
        password.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${password.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(password2.value.trim() == '') {
        password2.placeholder = 'Veuillez entrer votre mot de passe';
        password2.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${password2.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }else if(password.value != password2.value) {
        password2.placeholder = 'Veuillez entrer le meme mot de passe';
        password2.style.borderColor = 'red';
        e.preventDefault();
        let label = document.querySelector(`label[for="${password2.id}"]`);
        if (label) {
            label.style.color = 'red';
        }
    }
})


window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    if (error) {
        const errorDiv = document.getElementById('error');
        errorDiv.textContent = error;
        errorDiv.style.color = 'red';
    }
}