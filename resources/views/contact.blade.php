<x-app-layout>
    <div class="relative min-h-screen flex items-center justify-center">
        <section class="container mx-auto px-5 py-12">
            <div class="grid md:grid-cols-2 gap-40 rounded-lg px-45 text-black md dark:text-white -mt-50">

                <!-- Left Side: Contact Info -->
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold">Contact Us</h1>
                    <p >Feel free to use the form or drop us an email.</p>

                    <div class="space-y-2">
                            <p class="flex items-center space-x-2">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABOUlEQVR4nK3WvyuucRjH8ZefnUFKh8mkMyiFDBYju4mI84+cRVEyitEZFCXTKcVqlCKykM2A8iNZRB16dNetnh7f2/147u+nru3q/a6r63v15XO6sYMNtImcYTyglNY+mmLBh/BcBv+o2RjwZpwH4CW8oKuo4HcGvJTWclHBRo7goKggazyltNaLCq6+gB+jo6jgJAO+iRYRshaA36JRpEwHBJex4NIxPAYkQzEl8wHBHupjCVpxHZDMiJipgOANozElKwHJM0Yy+gfTLfyLgWoEP3AUkDxhsqJ3PD2GHz2v+IO6PMkv3GQ8vn+YwBz+Z/SsoiFP0ou7nBv1VS1VM65+3NcoSJbjZzWSPlzUIDj9zqlpx9Y34Mnx7KwWXp4xnOXAk5VNHm3NSU5H8vtYxC4OsY0F9FR2vwOf5b7VdrzvfgAAAABJRU5ErkJggg==" alt="phone" class="w-5 h-5 block dark:hidden">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABMElEQVR4nK3WvStGYRgH4NdnBilhMsmgFDJYjOwmIvwjFkXJKEYGRcmkFKtRishCNgPKR7KIQpdOHdHrOd7jPec33+d31XOe7p5CoSjowC420FjIMxjAo+8coCav8n68+J2ZPMprcSGcV7RlBSb9naWsQPRD/8phViDpeL6ynhW4lpwTtGQFThPKN1GfqTwG1gLld6jOXB4DEwHgKpfyGKjHUwDpzxOZCwD7qMwLaMBNAJnOBYiR8QDwgaE8keUA8oLBhPm++BauoDcNUIfjAPKMsaLZkXgZfuUdU6gohbTjNoBE2cIoZvGWMLOKqlJIF+6Vn8U0x9WDhzKB6HI0pUG6cVkGcJZ61aAZ2/8oj5Zna6ryImgY5yXKoyvb8O/yH0hl/PpYwB6OsIN5dBZ/8Al5SoY4EbwjIQAAAABJRU5ErkJggg==" alt="phone" class="w-5 h-5 hidden dark:block">

                                <a href="tel:0118489890">+31 0118 489 890</a>
                            </p>

                            <p class="flex items-center space-x-2">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA+klEQVR4nO3SsS4EURjF8R+iIKJG4wk04gGUhIR4AKVC4xWUWuW2Co1oxDNohFopuzYaBYVCkCuT3Ekmk7ubO3YTijnJydzcb77zv/PNpdV/0jb6CCO6j60U4HIM4SH6KgWYwD5eRgh+xRGmUoD5+FzA+S/CL7AUM+ZSgOf4BaXW8ZAR/IS92r98TAHKhmssx70ZHOMjEfyJ08ppF3FWqQ8EFH6PwdOxtoKbSv0Oa7E2iQO81TKGAkrf14IOo4t1oVXcDujNAgR8o1O5BIVmcYKvIX3ZgBDdwy520M14vzEgNHQL0HhEvTHOv5sCbGbejpARvpECtPob/QDxBg3jzCOyTQAAAABJRU5ErkJggg==" alt="mail" class="w-5 h-5 block dark:hidden">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA9ElEQVR4nO3Svy5EQRiH4bWiIKJG4wo04gKUhIS4AKVC4xaUWuW2Co1oxDVohFopy0ajoNhCkEcmmUlO1tg9e3YTivMmk8mZb87vnX+NRs2/AVvoGJ0ONnOCC+PjMieYwB5eRgh+xSEmc4K52M/jrEL4ORZjxmxO8Bx2UPhew32J4Cfs9tzlQ06QuMJSHJvGEd4zwR84SavFAk5TsZ8g0I3BU7G2jOtC/RarsdbEPt6KAYMEibueoIPYmnFsBTe5H8sKAl9opUcQ587gGJ9+YRhB4hE72EbbAKoIhqIWVDqicInjop0TbJR5HSUIGes/BDV/xjdMMqB67dFBPAAAAABJRU5ErkJggg==" alt="mail" class="w-5 h-5 hidden dark:block">

                                <a href="mailto:{{ trim((string)env('MAIL_FROM_ADDRESS')) }}">{{ trim((string)env('MAIL_FROM_ADDRESS')) }}</a>
                            </p>

                            <p class="flex items-center space-x-2">

                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA7klEQVR4nOWUPQrCQBCFvyMIYhCsjIIHsLDwGnoFwWuod5DoBbSw9gS26g0sbAV/KwsjAyuEMMbdJFb54EHgzbxJdpJAEfCACbADHkZbYGy8TPSBGxB+kXi9LOGvhPCPXmmGeD/uPIzpClRcBkyUkDMQGF0Uf+QyYK+E1yO+rwyRxVtzjzVPlZpAWbg1p1hzoNTMYzXSY81GOSI/4jeUI5Iea8bKEi/AzEhbsvRY07T8BsKIWjiydgiXWmfaDk/RISVLi3CpSU3VvEFJv4gaGRkkDBAvFxZK+IocKQGHSPgRKJMzXeBpJNd/YWhUIN7UbagHV+DHjAAAAABJRU5ErkJggg==" alt="marker" class="w-5 h-5 block dark:hidden">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABCElEQVR4nN2UQWrCQBSGc4SCWAquagUP0EUXXqO9guA1TO8g1gs0i65zgmxTb+CiW6ExuuoiXxl40HF4pnkmheIHb/Vm/i/zkkkUXTzANfAMvAMHqRyIXa9t+BNQchrXe2wTXvE7lVkiY6l78pAd0LcI3MxDPoGlVKH05xbBWgm/9fpDRZJbBPtg80JZ407iU1oE22DzUlmzCtZsLYJMGdHQ698pI8osAneJQgrgRUp7ybFFMGp4B3zGjQUiSY+215OawkVwbzjFg1kgkqRBeHJWuAhu5Auq+0UMzhaIZFojmLYK9ySvSvhbJ+EO4ArYeOEfQC/qEmACfElNOg2PfiQzV38S/m/5Bil5/c3t0QWhAAAAAElFTkSuQmCC" alt="marker" class="w-5 h-5 hidden dark:block">

                                <a target="_blank" href="https://www.google.com/maps/place/HZ+University+of+Applied+Sciences/...">HZ UAS, Middelburg</a>
                            </p>
                    </div>

                    {{--  map  --}}
                    <div>
                        <x-map/>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <form action="{{ route('contact.send') }}" method="post" class="space-y-4">
                    @csrf
                    @method('POST')

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name" >Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="dark:text-black w-full rounded border-gray-300 focus:ring-black focus:border-black">
                            @error('name')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="dark:text-black w-full rounded border-gray-300 focus:ring-black focus:border-black">
                            @error('email')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject"
                                class="dark:text-black w-full rounded border-gray-300 focus:ring-black focus:border-black">
                            <option disabled selected>Select a subject</option>
                            @foreach (['Program Inquiry', 'Booth Inquiry', 'Speaker Inquiry', 'Sponsorship', 'General Question'] as $option)
                                <option value="{{ $option }}" {{ old('subject') == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('subject')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="message">Message</label>
                        <textarea id="message" name="message"
                                  class="dark:text-black w-full rounded border-gray-300 focus:ring-black focus:border-black h-32 resize-none">{{ old('message') }}</textarea>
                        @error('message')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-900">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
