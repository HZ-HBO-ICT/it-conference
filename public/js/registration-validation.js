
document.addEventListener("DOMContentLoaded", function() {
    const passwordRulesDiv = document.getElementById('password-rules');
    const passwordInput = document.getElementById('password');

    //show password rules when user clicks on password field
    passwordInput.addEventListener('click', function () {
        passwordRulesDiv.classList.remove('hidden');
    });

    //perform input checks
    passwordInput.addEventListener('input', function () {
        //in case user used 'Tab' to move between fields
        passwordRulesDiv.classList.remove('hidden');

        //check for length
        if (passwordInput.value.length >= 12) {
            document.getElementById('length-true').classList.remove('hidden');
            document.getElementById('length-false').classList.add('hidden');
        } else {
            document.getElementById('length-false').classList.remove('hidden');
            document.getElementById('length-true').classList.add('hidden');
        }
    });

    passwordInput.addEventListener('blur', function () {
        passwordRulesDiv.classList.add('hidden');
    });

    const emailInput = document.getElementById('email');

    emailInput.addEventListener('blur', function() {
        let enteredEmail = emailInput.value.trim();
        let domain = getEmailDomain(enteredEmail);

        if(document.getElementById('institution')) {
            const institutionInput = document.getElementById('institution');
            institutionInput.value = '';
            institutionInput.removeAttribute('readonly');

            if (domain === 'hz.nl') {
                institutionInput.value = 'HZ University of Applied Sciences';
                institutionInput.setAttribute('readonly', true);
            } else if (domain === 'scalda.nl') {
                institutionInput.value = 'Scalda';
                institutionInput.setAttribute('readonly', true);
            }
        }
    });

    function getEmailDomain(email) {
        const atIndex = email.indexOf('@');
        if (atIndex !== -1) {
            return email.slice(atIndex + 1);
        }
        return null;
    }
});
