
<?php
$selected_workshop = isset($_GET['workshop'])
    ? sanitize_text_field(wp_unslash($_GET['workshop']))
    : '';
?>

<div class="booking-form-wrapper">

    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">

        <input type="hidden" name="action" value="submit_workshop_booking">

        <?php wp_nonce_field('workshop_booking', 'booking_nonce'); ?>

        <!-- Selected workshop -->
        <div class="form-workshop-selected">
            <label>Selected Workshop</label>
            <input
                type="text"
                name="workshop"
                value="<?php echo esc_attr($selected_workshop); ?>"
                readonly
            >
        </div>

        <!-- First name -->
        <div class="form-field">
            <label for="first_name">First Name</label>
            <input
                type="text"
                id="first_name"
                name="first_name"
                required
            >
        </div>

        <!-- Last name -->
        <div class="form-field">
            <label for="last_name">Last Name</label>
            <input
                type="text"
                id="last_name"
                name="last_name"
                required
            >
        </div>

        <!-- Email -->
        <div class="form-field">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                required
            >
        </div>

        <!-- Participants -->
        <div class="form-field">
            <label for="participants">
                Number of Participants:
                <span id="participant-value">1</span>
            </label>

            <input
                type="range"
                id="participants"
                name="participants"
                min="1"
                max="6"
                value="1"
                step="1"
            >
        </div>

        <!-- Questions -->
        <div class="form-field">
            <label for="questions">Questions</label>
            <textarea
                id="questions"
                name="questions"
                rows="5"
                placeholder="Do you have any questions or special requests?"
            ></textarea>
        </div>

        <button type="submit" class="btn-form">
            Send Booking Request
        </button>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('participants');
    const output = document.getElementById('participant-value');

    if (slider && output) {
        slider.addEventListener('input', function () {
            output.textContent = this.value;
        });
    }
});
</script>
