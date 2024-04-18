<div class="slideshow-container h-full rounded-md" style="overflow: clip">
    <div class="slide relative h-full">
        <img class="h-full object-cover" src="/img/slideshows/market.jpg" alt="market">
        <div class="gradient absolute inset-0"
             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
        <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
            <h2 class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
        </div>
    </div>
    <div class="slide relative h-full" style="display:none">
        <img class="h-full object-cover" src="/img/slideshows/guinea-pigs-and-data-science.jpg" alt="market">
        <div class="gradient absolute inset-0"
             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
        <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
            <h2 class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
        </div>
    </div>
    <div class="slide relative h-full" style="display:none">
        <img class="h-full object-cover" src="/img/slideshows/aws.jpg" alt="market">
        <div class="gradient absolute inset-0"
             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
        <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
            <h2 class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
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
        transition: opacity 1s ease;
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
