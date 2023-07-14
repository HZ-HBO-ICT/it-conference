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
                    <x-label for="name" value="{{ __('Name') }}"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name"/>
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}"/>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required
                             autocomplete="username"/>
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
                </div>

                <div id="company">
                    @if(old('company_name'))
                        <div class="mt-4">
                            <x-label for="company_name" value="{{ __('Company Name') }}"/>
                            <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                                     :value="old('company_name')" required
                                     autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_description" value="{{ __('Company Description') }}"/>
                            <textarea id="email"
                                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                      name="company_description" required
                            >{{old('company_description')}}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_website" value="{{ __('Company Website') }}"/>
                            <x-input id="company_website" class="block mt-1 w-full" type="text" name="company_website"
                                     required
                                     autocomplete="company_website" :value="old('company_website')"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="company_address" value="{{ __('Company Address') }}"/>
                            <x-input id="company_address" class="block mt-1 w-full" type="text"
                                     name="company_address" required autocomplete="company_address"
                                     :value="old('company_address')"/>
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
                const lineBreak = document.createElement('hr');
                lineBreak.className = 'mt-4';

                companyDiv.appendChild(lineBreak);
                companyDiv.appendChild(createField('company_name', 'Company Name', 'input'));
                companyDiv.appendChild(createField('company_description', 'Company Description', 'text'));
                companyDiv.appendChild(createField('company_website', 'Company Website', 'input'));
                companyDiv.appendChild(createField('company_address', 'Company Address', 'input'));
            }
        }

        function clearCompanyDetails() {
            companyDiv.innerHTML = '';
        }

        function createField(fieldName, displayName, fieldType) {
            const div = document.createElement('div');
            div.className = 'mt-4';

            let label = document.createElement('label');
            label.className = 'block font-medium text-sm text-gray-700 dark:text-gray-300';
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
    });


</script>
