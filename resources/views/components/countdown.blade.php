<div id="parent" class="grid grid-cols-5 text-black dark:text-white">
</div>

@push('scripts')
        <script>
            document.addEventListener('livewire:navigated', () => {
                // Livewire seems to be messing up with the clearing of the DOM
                const parent = document.getElementById('parent');
                while (parent.firstChild) {
                    parent.removeChild(parent.firstChild);
                }

                const countDownDate = new Date(@json($time->toIso8601String())).getTime();
                const timeUnits = ['months', 'days', 'hours', 'minutes', 'seconds'];
                let valueElements = [];
                let labelElements = [];
                let value = [0, 0, 0, 0, 0];

                timeUnits.forEach((unit) => {
                    let div = document.createElement('div');
                    div.className = 'flex flex-col items-center justify-center mr-5';

                    let value = document.createElement('h2');
                    value.className = 'lg:text-5xl sm:text-3xl font-bold text-center text-white';
                    valueElements.push(value);

                    let label = document.createElement('p');
                    label.innerHTML = unit.charAt(0).toUpperCase() + unit.slice(1);
                    label.className = 'text-xs sm:text-base text-center md:text-left font-bold text-white';
                    labelElements.push(label);

                    div.appendChild(value);
                    div.appendChild(label);

                    parent.appendChild(div);
                });

                countdownInterval = setInterval(function() {
                    let now = new Date().getTime();
                    let interval = countDownDate - now;

                    value[0] = Math.floor(interval / (1000 * 60 * 60 * 24 * 30));
                    value[1] = Math.floor(interval / (1000 * 60 * 60 * 24)) % 30;
                    value[2] = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    value[3] = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
                    value[4] = Math.floor((interval % (1000 * 60)) / 1000);

                    for (let i = 0; i < 5; i++) {
                        valueElements[i].innerHTML = value[i];
                        labelElements[i].innerHTML = timeUnits[i].charAt(0).toUpperCase() + timeUnits[i].slice(1);

                        if (value[i] === 1) {
                            labelElements[i].innerHTML = (timeUnits[i].charAt(0).toUpperCase() + timeUnits[i].slice(1)).slice(0, -1);
                        }
                    }

                    if (value.every(v => v <= 0)) {
                        clearInterval(countdownInterval);

                        for (let i = 0; i < 5; i++) {
                          valueElements[i].innerHTML = 0;
                          labelElements[i].innerHTML = timeUnits[i].charAt(0).toUpperCase() + timeUnits[i].slice(1);
                        }
                    }

                }, 1000);
            }, { once: true });
    </script>
@endpush
