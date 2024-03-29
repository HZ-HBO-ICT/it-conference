<div id="parent" class="grid grid-cols-5 text-gray-200">
</div>

@push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const countDownDate = new Date("Nov 17, 2023 9:00:00").getTime();
                const timeUnits = ['months', 'days', 'hours', 'minutes', 'seconds'];
                let valueElements = [];
                let labelElements = [];
                let value = [0, 0, 0, 0, 0];

                const parent = document.getElementById('parent');
                timeUnits.forEach((unit) => {
                    let div = document.createElement('div');

                    let value = document.createElement('h2');
                    value.className = 'text-2xl font-bold text-center md:text-left';
                    value.style.textShadow = "1px 1px 2px rgba(0, 0, 0, 0.3)";
                    valueElements.push(value);

                    let label = document.createElement('p');
                    label.innerHTML = unit.charAt(0).toUpperCase() + unit.slice(1);
                    label.className = 'text-xs sm:text-base text-center md:text-left';
                    label.style.textShadow = "1px 1px 2px rgba(0, 0, 0, 0.3)";
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
            });
    </script>
@endpush
