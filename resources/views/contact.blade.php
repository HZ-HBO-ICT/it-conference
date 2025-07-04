<x-app-layout>
    <div class="min-h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <!-- Decorative Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4">
            <h1 class="text-6xl font-extrabold text-left mb-12 uppercase tracking-wide text-waitt-yellow">
                Contact
            </h1>
            <p class="text-left text-lg text-gray-200 mx-auto mb-7">
                Have a question or want to get in touch? We're here to help — reach out and we'll get back to you as soon as possible.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Get in Touch Section -->
                    <div class="bg-waitt-dark/70 backdrop-blur-sm border border-slate-900 rounded-2xl p-8">
                        <h2 class="text-2xl font-bold text-white mb-4">Get in Touch</h2>
                        <p class="text-gray-400 mb-8">Have questions about the conference? We're here to help!</p>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-waitt-pink mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <h3 class="text-white text-sm font-medium">Email</h3>
                                    <a href="mailto:info@weareinittogether.nl?body=Hey%2C%20team!%0A%0AI%20have%20a%20question%20regarding..." class="text-waitt-pink hover:text-pink-600 transition-colors">
                                        info@weareinittogether.nl
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-waitt-pink mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <h3 class="text-white text-sm font-medium">Address</h3>
                                    <p class="text-gray-400">
                                        HZ University of Applied Sciences<br>
                                        Het Groene Woud 1-3<br>
                                        4331 NB Middelburg
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Follow Us Section -->
                    <div class="bg-waitt-dark/70 backdrop-blur-sm border border-slate-900 rounded-2xl p-8">
                        <h2 class="text-2xl font-bold text-white mb-4">Follow Us</h2>
                        <p class="text-gray-400 mb-6">Stay updated with the latest news and announcements.</p>
                        <div class="flex space-x-6">
                            <a href="#" class="text-waitt-pink hover:text-pink-600 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.289a1.486 1.486 0 0 0-.679.678c-.163.311-.229.771-.229 1.373v1.64h3.818l-.929 3.667h-2.889v7.98H9.101z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-waitt-pink hover:text-pink-600 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733a4.67 4.67 0 0 0 2.048-2.578 9.3 9.3 0 0 1-2.958 1.13 4.66 4.66 0 0 0-7.938 4.25 13.229 13.229 0 0 1-9.602-4.868c-.4.69-.63 1.49-.63 2.342A4.66 4.66 0 0 0 3.96 9.824a4.647 4.647 0 0 1-2.11-.583v.06a4.66 4.66 0 0 0 3.737 4.568 4.692 4.692 0 0 1-2.104.08 4.661 4.661 0 0 0 4.352 3.234 9.348 9.348 0 0 1-5.786 1.995 9.5 9.5 0 0 1-1.112-.065 13.175 13.175 0 0 0 7.14 2.093c8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602a9.47 9.47 0 0 0 2.323-2.41z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Right Column - Contact Form -->
                <div class="bg-waitt-dark/70 backdrop-blur-sm border border-slate-900 rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-4">Send us a Message</h2>
                    <p class="text-gray-400 mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(session('success'))
                            <div class="bg-green-500/10 text-green-400 p-4 rounded-lg mb-6">
                                {{ session( 'success' ) }}
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg bg-[#1a1f2e]/50 border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#9333EA] @error('name') ring-2 ring-red-500 @enderror" placeholder="Your name" value="{{ old('name') }}">
                                @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg bg-[#1a1f2e]/50 border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#9333EA] @error('email') ring-2 ring-red-500 @enderror" placeholder="Your email" value="{{ old('email') }}">
                                @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-400 mb-2">Subject</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 rounded-lg bg-[#1a1f2e]/50 border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#9333EA] @error('subject') ring-2 ring-red-500 @enderror">
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a subject</option>
                                <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="registration" {{ old('subject') == 'registration' ? 'selected' : '' }}>Registration</option>
                                <option value="sponsorship" {{ old('subject') == 'sponsorship' ? 'selected' : '' }}>Sponsorship</option>
                                <option value="speaking" {{ old('subject') == 'speaking' ? 'selected' : '' }}>Speaking Opportunity</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-400 mb-2">Message</label>
                            <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 rounded-lg bg-[#1a1f2e]/50 border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#9333EA] @error('message') ring-2 ring-red-500 @enderror" placeholder="Your message">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-waitt-pink hover:bg-pink-600 hover:cursor-pointer text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
