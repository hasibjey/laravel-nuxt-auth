import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-input');

    inputs.forEach((input, index) => {

        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9]/g, '');

            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const countdownEl = document.getElementById('countdown');
    const resendEl = document.getElementById('resend');

    if (!countdownEl || !resendEl) return;

    let time = 10; // 1 minute in seconds

    const timer = setInterval(() => {
        const minutes = Math.floor(time / 60);
        const seconds = time % 60;

        countdownEl.textContent = `Resend code after ${minutes}:${seconds.toString().padStart(2, '0')}`;

        time--;

        if (time < 0) {
            clearInterval(timer);
            countdownEl.style.display = 'none';
            resendEl.style.display = 'inline-block';
        }
    }, 1000);
});
