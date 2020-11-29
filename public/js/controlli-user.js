$(document).ready(function(){
    // variabili elementi input
    const emailField = document.getElementById('emailField');
    const passwordField = document.getElementById('passwordField');
    const nameField= document.getElementById('nameField');
    const lastnameField=document.getElementById('lastnameField');

    // bottone form
    const okButton = document.getElementById('buttonSubmit');

    // variabili di errore
    const emailError= document.getElementById('emailError');
    const passwordError= document.getElementById('passwordError');
    const nameError= document.getElementById('nameError');
    const lastNameError= document.getElementById('lastnameError');

    // check email
    emailField.addEventListener('keyup', function (event) {
    isValidEmail = emailField.checkValidity();

        if(isValidEmail){
            okButton.disabled = false;
        }else{
            emailError.innerHTML = 'inserisci un email valida, altrimenti non passi';
            okButton.disabled = true;
        }
    });

    // check email
    passwordField.addEventListener('keyup', function (event) {

        const strongRegex = RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

        if(strongRegex.test(passwordField.value)){
            okButton.disabled = false;
        }else{
            passwordError.innerHTML = 'inserisci un password sicura, rispetta le indicazioni';
            okButton.disabled = true;
        }
            // spiegazione password forte
            /*  (?=.*[a-z])	La stringa deve contenere almeno 1 carattere alfabetico minuscolo
                (?=.*[A-Z]) La stringa deve contenere almeno 1 carattere alfabetico maiuscolo
                (?=.*[0-9])	La stringa deve contenere almeno 1 carattere numerico
                (?=.*[!@#$%^&*])	La stringa deve contenere almeno un carattere speciale, ma stiamo sfuggendo ai caratteri RegEx riservati per evitare conflitti
                (?=. {8,})	La stringa deve essere di otto caratteri o più lunga
            */
    });

    //check name
    nameField.addEventListener('keyup', function (event) {

        const regexName = /^[a-zA-Z ]{2,30}$/;

        if(regexName.test(nameField.value)){
            okButton.disabled = false;
        }else{
            nameError.innerHTML = 'Veramente ti chiami così? Non inserire numeri o caratteri speciali';
            okButton.disabled = true;
        }

        // spiegazione name regex
        /*
            /^[a-zA-Z ]{2,30}$/ caratteri ammessi minuscole e maiuscole, niente numeri o caratteri speciali, lunghezza minima 2 e max 30
        */
    });


    //check lastname
    lastnameField.addEventListener('keyup', function (event) {

        const regexLastname = /^[a-zA-Z ]{2,30}$/;

        if(regexLastname.test(lastnameField.value)){
            okButton.disabled = false;
        }else{
            lastNameError.innerHTML = 'Bel cognome, ricordati di non inserire numeri o caratteri speciali';
            okButton.disabled = true;
        }
    });
    
    //let regexemail = RegExp("[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}");
})