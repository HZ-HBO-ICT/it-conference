document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.flow');
    const participantPasswordInput = document.getElementById('participant-password');
    const participantPasswordRulesDiv = document.getElementById('participant-password-rules');
    const companyPasswordInput = document.getElementById('company-password');
    const companyPasswordRulesDiv = document.getElementById('company-password-rules');
    const registrationDiv = document.getElementById('registration-card');
    const participantDiv = document.getElementById('participant');
    const companyDiv = document.getElementById('company');
    const formDiv = document.getElementById('form-slide');
    const prettyDiv = document.getElementById('pretty-slide');

    if (document.getElementById('company_postcode')) {
        postcodeValidation();
    }

    participantPasswordInput.addEventListener('click', function () {
        participantPasswordRulesDiv.classList.remove('hidden');
    });

    participantPasswordInput.addEventListener('blur', function () {
        participantPasswordRulesDiv.classList.add('hidden');
    });

    participantPasswordInput.addEventListener('input', function () {
        participantPasswordRulesDiv.classList.remove('hidden');

        if (participantPasswordInput.value.length >= 12) {
            document.getElementById('participant-length-true').classList.remove('hidden');
            document.getElementById('participant-length-false').classList.add('hidden');
        } else {
            document.getElementById('participant-length-false').classList.remove('hidden');
            document.getElementById('participant-length-true').classList.add('hidden');
        }
    });

    companyPasswordInput.addEventListener('click', function () {
        companyPasswordRulesDiv.classList.remove('hidden');
    });

    companyPasswordInput.addEventListener('blur', function () {
        companyPasswordRulesDiv.classList.add('hidden');
    });

    companyPasswordInput.addEventListener('input', function () {
        companyPasswordRulesDiv.classList.remove('hidden');

        if (companyPasswordInput.value.length >= 12) {
            document.getElementById('company-length-true').classList.remove('hidden');
            document.getElementById('company-length-false').classList.add('hidden');
        } else {
            document.getElementById('company-length-false').classList.remove('hidden');
            document.getElementById('company-length-true').classList.add('hidden');
        }
    });

    buttons[0].addEventListener('click', clearCompanyDetails);
    buttons[1].addEventListener('click', addCompanyDetails);

    switchActiveFlow(buttons[0], buttons[1]);
    if (!document.getElementById('company').classList.contains('hidden')) {
        switchActiveFlow(buttons[1], buttons[0]);
    }

    function switchRegistrationFlow(event) {
        buttons.forEach(button => {
            button.className = 'flow bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center';
            button.style.cursor = 'pointer';
        });

        event.target.className = 'flow bg-indigo-800 text-white font-bold py-2 px-4 rounded text-center';
        event.target.style.cursor = 'default';
    }

    buttons.forEach(button => {
        button.addEventListener('click', switchRegistrationFlow);
    });

    function addCompanyDetails() {
        companyDiv.classList.remove('hidden');
        participantDiv.classList.add('hidden');
        formDiv.classList.add('md:col-span-5');
        formDiv.classList.remove('md:col-span-3');
        prettyDiv.classList.remove('col-span-4');
        prettyDiv.classList.add('col-span-2');
    }

    function clearCompanyDetails() {
        companyDiv.classList.add('hidden');
        participantDiv.classList.remove('hidden');
        formDiv.classList.remove('md:col-span-5');
        formDiv.classList.add('md:col-span-3');
        prettyDiv.classList.add('col-span-4');
        prettyDiv.classList.remove('col-span-2');
    }

    function postcodeValidation() {
        document.getElementById('company_postcode').addEventListener('keydown', function (event) {
            const position = document.getElementById('company_postcode').selectionStart;
            const userInput = document.getElementById('company_postcode').value;

            if (
                event.key === 'Backspace' ||
                event.key === 'ArrowLeft' ||
                event.key === 'ArrowRight' ||
                event.key === 'ArrowUp' ||
                event.key === 'ArrowDown' ||
                event.key === 'Tab'
            ) {
                return;
            }

            if (
                !((position < 4 && /[0-9]/.test(event.key)) ||
                    (position >= 4 && position <= 5 && /[A-Za-z]/.test(event.key)))
            ) {
                event.preventDefault();
            }
        });
    }

    function switchActiveFlow(activeFlowElement, inactiveFlowElement) {
        activeFlowElement.className = 'flow bg-indigo-800 text-white font-bold py-2 px-4 rounded text-center';
        activeFlowElement.style.cursor = 'default';
        inactiveFlowElement.className = 'flow bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center';
        inactiveFlowElement.style.cursor = 'pointer';
    }

    const emailInput = document.getElementById('email');

    emailInput.addEventListener('blur', function () {
        let enteredEmail = emailInput.value.trim();
        let domain = getEmailDomain(enteredEmail);

        if (document.getElementById('institution')) {
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
