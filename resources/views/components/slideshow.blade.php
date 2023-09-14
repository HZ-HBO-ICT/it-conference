<div class="slideshow-container h-full" style="overflow: clip">
    <div class="slide relative h-full">
        <div class="arrows absolute flex justify-between w-full mt-60 hidden md:block">
            <a class="prev" onclick="prevSlide()">&#10094;</a>
            <a class="next" onclick="nextSlide()">&#10095;</a>
        </div>
        <img class="h-full object-cover lg:h-fit lg:object-scale-down" src="/img/speakers-min.jpg" alt="Speakers">
        <div class="gradient absolute inset-0 bg-blue-500 opacity-80"></div>
        <div class="absolute inset-0 flex flex-col items-center mt-48" style="z-index: 3">
            <div>
                <h2 class="title text-4xl font-bold text-white">Speakers</h2>
            </div>
            <div>
                <h2 class="title text-md md:text-lg lg:text-xl text-white text-center py-2">During the conference you will have the chance to meet and speak to our speakers. <br> You can learn more about them <a href="{{ route('speakers.index') }}" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all"> here</a>! </h2>
            </div>
        </div>
    </div>
    <div class="slide relative h-full" style="display: none">
        <div class="arrows absolute flex justify-between w-full mt-60">
            <a class="prev" onclick="prevSlide()">&#10094;</a>
            <a class="next" onclick="nextSlide()">&#10095;</a>
        </div>
        <img class="h-full object-cover lg:h-fit lg:object-scale-down" src="/img/companies-min.jpg" alt="Companies">
        <div class="gradient absolute inset-0 bg-blue-500 opacity-80"></div>
        <div class="absolute inset-0 flex flex-col items-center mt-48" style="z-index: 3">
            <div>
                <h2 class="title text-4xl font-bold text-white">Companies</h2>
            </div>
            <div>
                <h2 class="title text-md md:text-lg lg:text-xl text-white text-center py-2">During the conference you will have the chance to meet different companies. <br> You can learn more about them <a href="{{ route('speakers.index') }}" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all"> here</a>! </h2>
            </div>
        </div>
    </div>
    <div class="slide relative h-full" style="display: none">
        <div class="arrows absolute flex justify-between w-full mt-60">
            <a class="prev" onclick="prevSlide()">&#10094;</a>
            <a class="next" onclick="nextSlide()">&#10095;</a>
        </div>
        <img class="h-full object-cover lg:h-fit lg:object-scale-down" src="/img/lectures-min.jpg" alt="Lectures and workshops">
        <div class="gradient absolute inset-0 bg-blue-500 opacity-80"></div>
        <div class="absolute inset-0 flex flex-col items-center mt-48" style="z-index: 3">
            <div>
                <h2 class="title text-4xl font-bold text-white">Lectures & Workshops</h2>
            </div>
            <div>
                <h2 class="title text-md md:text-lg lg:text-xl text-white text-center py-2">During the conference you can visit a lot of different workshops and lectures. <br> You can learn more about them <a href="{{ route('speakers.index') }}" class="text-yellow-300 hover:text-yellow-500 hover:border-b-2 hover:border-yellow-500 transition-all"> here</a>! </h2>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    let timerId;

    // Function that allows the slide change
    function showSlide() {
        slides.forEach((slide) => {
            slide.style.display = 'none';
        });

        if (currentSlide < 0) {
            currentSlide = 2;
        }
        if (currentSlide > 2) {
            currentSlide = 0;
        }

        slides[currentSlide].style.display = 'block';
    }

    function prevSlide() {
        currentSlide -= 1;
        resetTimer();

        showSlide();
    }

    function nextSlide() {
        currentSlide += 1;
        resetTimer();

        showSlide();
    }

    // Resets the timer (happens either when the user slides manually or when 10 seconds have passed)
    function resetTimer() {
        clearInterval(timerId);
        timerId = setInterval(nextSlide, 10000);
    }

    resetTimer();

</script>
@endpush

<style>
    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev:hover, .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .slide {
        animation-name: fade;
        animation-duration: 1.5s;
        transition: opacity 0.5s ease;
    }

    .arrows {
        z-index: 5;
    }

    @keyframes fade {
        from {
            opacity: .4
        }
        to {
            opacity: 1
        }
    }

    .gradient {
        z-index: 2;
    }
</style>
