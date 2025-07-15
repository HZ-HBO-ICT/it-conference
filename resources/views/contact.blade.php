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
                            <a href="https://www.linkedin.com/company/we-are-in-it-together-conference/" class="text-waitt-pink hover:text-pink-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/weareinittogetherhz/" class="text-waitt-pink hover:text-pink-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
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
