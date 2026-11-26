
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.querySelector('[data-booking-modal]');

    if (!modal) return;

    const dialog = modal.querySelector('.booking-modal-content');
    const form = modal.querySelector('[data-booking-form]');
    const workshopInput = modal.querySelector('#booking-workshop');
    const closeButtons = modal.querySelectorAll('[data-booking-close]');
    const slider = modal.querySelector('#booking-participants');
    const participantValue = modal.querySelector('[data-participant-value]');
    const message = modal.querySelector('[data-booking-message]');
    const submitButton = modal.querySelector('.booking-submit');

    let previousFocus = null;

    // Open popup

    document.addEventListener('click', function (event) {

        const button = event.target.closest('[data-book-workshop]');

        if (!button) return;

        event.preventDefault();

        previousFocus = document.activeElement;

        const workshop = button.dataset.workshop || '';

        form.reset();

        workshopInput.value = workshop;
        participantValue.textContent = '1';

        message.textContent = '';
        message.className = 'booking-message';

        submitButton.disabled = false;
        submitButton.textContent = 'Send Booking Request';

        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('booking-modal-open');

        dialog.focus();

        const firstInput = modal.querySelector('#booking-first-name');

        if (firstInput) {
            firstInput.focus({ preventScroll: true });
        }
    });

    // Close popup

    function closeModal() {

        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('booking-modal-open');

        if (previousFocus) {
            previousFocus.focus();
        }
    }

    closeButtons.forEach(function (button) {
        button.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {

        if (modal.hidden) return;

        if (event.key === 'Escape') {
            closeModal();
        }

        // Basic keyboard focus containment

        if (event.key === 'Tab') {

            const focusable = Array.from(
                modal.querySelectorAll(
                    'button:not(:disabled), input:not(:disabled), textarea:not(:disabled)'
                )
            ).filter(function (element) {
                return element.offsetParent !== null;
            });

            if (!focusable.length) return;

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    // Participant slider

    slider.addEventListener('input', function () {
        participantValue.textContent = slider.value;
    });

    // Submit booking

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        if (!form.reportValidity()) return;

        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';

        message.textContent = '';
        message.className = 'booking-message';

        try {

            const response = await fetch(modal.dataset.ajaxUrl, {
                method: 'POST',
                body: new FormData(form),
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(
                    result.data?.message || 'Something went wrong.'
                );
            }

            message.textContent =
                'Thank you! Your booking request has been sent successfully.';

            message.classList.add('is-success');

            submitButton.textContent = 'Request Sent';

            form.reset();
            participantValue.textContent = '1';

        } catch (error) {

            message.textContent =
                error.message || 'Unable to send your request. Please try again.';

            message.classList.add('is-error');

            submitButton.disabled = false;
            submitButton.textContent = 'Send Booking Request';
        }

    });

});
