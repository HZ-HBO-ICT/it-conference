@props(['time'])

<div class="flex justify-center w-full">
    <div id="parent" class="grid grid-cols-5 gap-4 md:gap-8 max-w-5xl">
        <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center">
            <div class="text-4xl md:text-5xl font-bold text-white">00</div>
            <div class="text-xs md:text-sm text-gray-400 mt-2">MONTHS</div>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center">
            <div class="text-4xl md:text-5xl font-bold text-white">00</div>
            <div class="text-xs md:text-sm text-gray-400 mt-2">DAYS</div>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center">
            <div class="text-4xl md:text-5xl font-bold text-white">00</div>
            <div class="text-xs md:text-sm text-gray-400 mt-2">HOURS</div>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center">
            <div class="text-4xl md:text-5xl font-bold text-white">00</div>
            <div class="text-xs md:text-sm text-gray-400 mt-2">MINUTES</div>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center">
            <div class="text-4xl md:text-5xl font-bold text-white">00</div>
            <div class="text-xs md:text-sm text-gray-400 mt-2">SECONDS</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function initializeCountdown() {
        const parent = document.getElementById('parent');
        // Clear existing content
        parent.innerHTML = '';

        const countDownDate = new Date(@json($time->toIso8601String())).getTime();
        const timeUnits = ['months', 'days', 'hours', 'minutes', 'seconds'];
        let valueElements = [];
        let labelElements = [];

        timeUnits.forEach((unit) => {
            let div = document.createElement('div');
            div.className = 'bg-white/5 backdrop-blur-sm rounded-lg p-4 md:p-6 text-center';

            let value = document.createElement('div');
            value.className = 'text-4xl md:text-5xl font-bold text-white';
            valueElements.push(value);

            let label = document.createElement('div');
            label.className = 'text-xs md:text-sm text-gray-400 mt-2';
            labelElements.push(label);

            div.appendChild(value);
            div.appendChild(label);
            parent.appendChild(div);
        });

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance < 0) {
                valueElements.forEach((el, i) => {
                    el.innerHTML = "0";
                    labelElements[i].innerHTML = timeUnits[i].toUpperCase();
                });
                return;
            }

            // Calculate time
            const months = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
            const days = Math.floor((distance % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const values = [months, days, hours, minutes, seconds];

            values.forEach((value, i) => {
                valueElements[i].innerHTML = String(value).padStart(2, '0');
                labelElements[i].innerHTML = timeUnits[i].toUpperCase();
            });
        }

        // Update immediately and start interval
        updateCountdown();
        return setInterval(updateCountdown, 1000);
    }

    // Initialize on page load
    let countdownInterval = initializeCountdown();

    // Handle Livewire navigation
    document.addEventListener('livewire:navigated', () => {
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
        countdownInterval = initializeCountdown();
    });
</script>
@endpush
