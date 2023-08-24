<x-app-layout>
    <div class="pb-10">
        <x-authentication-card>
            <x-slot name="logo">
                <h1 class="text-gray-800 dark:text-white text-3xl font-bold text-center pt-12">
                    We are in IT together</br>Conference
                </h1>
            </x-slot>

            <x-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="bg-gray-100 dark:bg-gray-700 mt-1 p-1 grid gap-1 grid-cols-2 content-center rounded">
                    <div
                        class="flow bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center">
                        Participant
                    </div>
                    <div
                        class="flow bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center">
                        Company
                    </div>
                </div>


                <div class="mt-5">
                    <x-label for="name" value="{{ __('Name') }}" class="after:content-['*'] after:text-red-500"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name"/>
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="after:content-['*'] after:text-red-500"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required
                             autocomplete="username"/>
                </div>

                <div id="institutionDiv">
                    <div class="mt-4">
                        <x-label for="institution" value="{{ __('Institution') }}"
                                 class="after:content-['*'] after:text-red-500"/>
                        <x-input id="institution" class="block mt-1 w-full" type="text" name="institution"
                                 :value="old('institution')" required
                                 autofocus autocomplete="institution"/>
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>

                    <div id="password-rules" class="hidden text-sm text-gray-700 dark:text-gray-300 mt-2 pl-2">
                        <p>Password should be of the following format:</p>
                        <ul class="pl-5 pt-0.5">
                            <li>
                                <p id="length-false" class="before:content-['✗_'] text-red-500">length is at least 8
                                                                                                characters</p>

                                <p id="length-true" class="hidden before:content-['✓_'] text-green-500">length is at
                                                                                                        least 8
                                                                                                        characters</p>
                            </li>
                            <li>
                                <p id="number-false" class="before:content-['✗_'] text-red-500">contains at least one
                                                                                                number</p>

                                <p id="number-true" class=" hidden before:content-['✓_'] text-green-500">contains at
                                                                                                         least one
                                                                                                         number</p>
                            </li>
                            <li>
                                <p id="lowercase-false" class="before:content-['✗_'] text-red-500">contains at least one
                                                                                                   lowercase letter</p>

                                <p id="lowercase-true" class=" hidden before:content-['✓_'] text-green-500">contains at
                                                                                                            least one
                                                                                                            lowercase
                                                                                                            letter</p>
                            </li>
                            <li>
                                <p id="uppercase-false" class="before:content-['✗_'] text-red-500">contains at least one
                                                                                                   uppercase letter</p>

                                <p id="uppercase-true" class=" hidden before:content-['✓_'] text-green-500">contains at
                                                                                                            least one
                                                                                                            uppercase
                                                                                                            letter</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
                </div>

                <div id="company">
                    @if(old('company_name'))
                        <div class="mt-4">
                            <x-label for="company_name" value="{{ __('Company Name') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                                     :value="old('company_name')" required
                                     autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_description" value="{{ __('Company Description') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <textarea id="email"
                                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                      name="company_description" required
                            >{{old('company_description')}}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_website" value="{{ __('Company Website') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_website" class="block mt-1 w-full" type="text" name="company_website"
                                     required
                                     autocomplete="company_website" :value="old('company_website')"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_postcode" value="{{ __('Company Postcode') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_postcode" class="block mt-1 w-full" type="text" name="company_postcode"
                                     :value="old('company_postcode')" required
                                     autofocus autocomplete="postcode"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_housenumber" value="{{ __('Company House Number') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_housenumber" class="block mt-1 w-full" type="text"
                                     name="company_housenumber"
                                     :value="old('company_housenumber')" required
                                     autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_street" value="{{ __('Company Street') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_street" class="block mt-1 w-full" type="text" name="company_street"
                                     :value="old('company_street')" required
                                     autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_city" value="{{ __('Company City') }}"
                                     class="after:content-['*'] after:text-red-500"/>
                            <x-input id="company_city" class="block mt-1 w-full" type="text" name="company_city"
                                     :value="old('company_city')" required
                                     autofocus autocomplete="name"/>
                        </div>
                    @endif
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                       href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.flow');
        const companyDiv = document.getElementById('company');
        const institutionDiv = document.getElementById('institutionDiv');
        const passwordRulesDiv = document.getElementById('password-rules');
        const passwordInput = document.getElementById('password');

        if(document.getElementById('company_postcode')) {
            postcodeValidation();
        }

        //show password rules when user clicks on password field
        passwordInput.addEventListener('click', function () {
            passwordRulesDiv.classList.remove('hidden');
        });

        //perform input checks
        passwordInput.addEventListener('input', function () {
            //in case user used 'Tab' to move between fields
            passwordRulesDiv.classList.remove('hidden');

            //check for length
            if (passwordInput.value.length >= 8) {
                document.getElementById('length-true').classList.remove('hidden');
                document.getElementById('length-false').classList.add('hidden');
            } else {
                document.getElementById('length-false').classList.remove('hidden');
                document.getElementById('length-true').classList.add('hidden');
            }

            //check for numbers
            if (/\d/.test(passwordInput.value)) {
                document.getElementById('number-true').classList.remove('hidden');
                document.getElementById('number-false').classList.add('hidden');
            } else {
                document.getElementById('number-false').classList.remove('hidden');
                document.getElementById('number-true').classList.add('hidden');
            }

            //check for lowercase letter
            if (/[a-z]/.test(passwordInput.value)) {
                document.getElementById('lowercase-true').classList.remove('hidden');
                document.getElementById('lowercase-false').classList.add('hidden');
            } else {
                document.getElementById('lowercase-false').classList.remove('hidden');
                document.getElementById('lowercase-true').classList.add('hidden');
            }

            //check for uppercase letter
            if (/[A-Z]/.test(passwordInput.value)) {
                document.getElementById('uppercase-true').classList.remove('hidden');
                document.getElementById('uppercase-false').classList.add('hidden');
            } else {
                document.getElementById('uppercase-false').classList.remove('hidden');
                document.getElementById('uppercase-true').classList.add('hidden');
            }
        });

        switchActiveFlow(buttons[0], buttons[1]);
        if (document.getElementById('company_name')) {
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
            if (!document.getElementById('company_name')) {
                institutionDiv.innerHTML = '';
                const lineBreak = document.createElement('hr');
                lineBreak.className = 'mt-4';

                companyDiv.appendChild(lineBreak);
                companyDiv.appendChild(createField('company_name', 'Company Name', 'input'));
                companyDiv.appendChild(createField('company_description', 'Company Description', 'text'));
                companyDiv.appendChild(createField('company_website', 'Company Website', 'input'));
                companyDiv.appendChild(createField('company_postcode', 'Postcode - format: 1234 AB', 'input'));
                companyDiv.appendChild(createField('company_housenumber', 'House number', 'input'));
                companyDiv.appendChild(createField('company_street', 'Street', 'input'));
                companyDiv.appendChild(createField('company_city', 'City', 'input'));

                document.getElementById('company_housenumber').setAttribute('type', 'number');
                postcodeValidation();
            }
        }

        function postcodeValidation() {
            document.getElementById('company_postcode').addEventListener('keydown', function(event) {
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
                        (position === 4 && event.key === ' ') ||
                        (position >= 5 && position <= 6 && /[A-Za-z]/.test(event.key)))
                ) {
                    event.preventDefault();
                }
            });
        }

        function clearCompanyDetails() {
            companyDiv.innerHTML = '';
            if(institutionDiv.innerHTML == '') {
               institutionDiv.appendChild(createField('institution', 'Institution', 'input'));
            }
        }

        function createField(fieldName, displayName, fieldType) {
            const div = document.createElement('div');
            div.className = 'mt-4';

            let label = document.createElement('label');
            label.className = "block font-medium text-sm text-gray-700 dark:text-gray-300 after:content-['_*'] after:text-red-500";
            label.setAttribute('for', fieldName);
            label.innerHTML = displayName;

            let field;
            if (fieldType == 'input') {
                field = document.createElement('input');
                field.setAttribute('id', fieldName);
                field.setAttribute('type', 'text');
                field.className = 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full';
                field.setAttribute('name', fieldName);
                field.setAttribute('required', '');
            } else {
                field = document.createElement('textarea');
                field.setAttribute('id', fieldName);
                field.className = 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full';
                field.setAttribute('name', fieldName);
                field.setAttribute('required', '');
            }

            div.appendChild(label);
            div.appendChild(field);

            return div;
        }

        function switchActiveFlow(activeFlowElement, inactiveFlowElement) {
            activeFlowElement.className = 'flow bg-indigo-800 text-white font-bold py-2 px-4 rounded text-center';
            activeFlowElement.style.cursor = 'default';
            activeFlowElement.addEventListener('click', clearCompanyDetails);
            inactiveFlowElement.className = 'flow bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center';
            inactiveFlowElement.style.cursor = 'pointer';
            inactiveFlowElement.addEventListener('click', addCompanyDetails);
        }

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










</script>
