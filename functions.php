<?php

// CPT TAXONOMY

include( 'configure/cpt-taxonomy.php' );

// Utilities

include( 'configure/utilities.php' );

// CONFIG

include( 'configure/configure.php' );

// EDITOR

include( 'configure/editor.php' );

// JAVASCRIPT & CSS

include( 'configure/js-css.php' );

// SHORTCODES

include( 'configure/shortcodes.php' );

// ACF

include( 'configure/acf.php' );

// PLUGIN SETUP

include( 'configure/plugins.php' );

// HOOKS ADMIN

if(is_admin()) {
	include( 'configure/admin.php' );
}

add_action('wp_enqueue_scripts', function () {

    $script_path = get_stylesheet_directory()
        . '/assets/js/workshop-booking.js';

    if (file_exists($script_path)) {

        wp_enqueue_script(
            'workshop-booking',
            get_stylesheet_directory_uri()
                . '/assets/js/workshop-booking.js',
            [],
            filemtime($script_path),
            true
        );

    }

});


add_action(
    'wp_ajax_submit_workshop_booking',
    'handle_workshop_booking'
);

add_action(
    'wp_ajax_nopriv_submit_workshop_booking',
    'handle_workshop_booking'
);

function handle_workshop_booking() {

    // Verify nonce
    $nonce = sanitize_text_field(
        wp_unslash($_POST['booking_nonce'] ?? '')
    );

    if (!wp_verify_nonce($nonce, 'workshop_booking')) {
        wp_send_json_error([
            'message' => 'Security verification failed. Please reload the page.'
        ], 403);
    }

    // Honeypot
    if (!empty($_POST['website'])) {
        wp_send_json_error([
            'message' => 'Invalid submission.'
        ], 400);
    }

    // Collect form data
    $workshop = sanitize_text_field(
        wp_unslash($_POST['workshop'] ?? '')
    );

    $first_name = sanitize_text_field(
        wp_unslash($_POST['first_name'] ?? '')
    );

    $last_name = sanitize_text_field(
        wp_unslash($_POST['last_name'] ?? '')
    );

    $email = sanitize_email(
        wp_unslash($_POST['email'] ?? '')
    );

    $participants = absint(
        $_POST['participants'] ?? 0
    );

    $questions = sanitize_textarea_field(
        wp_unslash($_POST['questions'] ?? '')
    );

    // Validate
    if (
        !$workshop ||
        !$first_name ||
        !$last_name ||
        !is_email($email) ||
        $participants < 1 ||
        $participants > 6
    ) {
        wp_send_json_error([
            'message' => 'Please check all required fields.'
        ], 400);
    }

    // Email
    $to = get_option('admin_email');

    $subject = 'New Workshop Booking: ' . $workshop;

    $message = "
New Workshop Booking

Workshop: $workshop

First Name: $first_name
Last Name: $last_name
Email: $email

Participants: $participants

Questions:
$questions
";

    $headers = [
        'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>'
    ];

    $sent = wp_mail(
        $to,
        $subject,
        $message,
        $headers
    );

    if (!$sent) {
        wp_send_json_error([
            'message' => 'Your request could not be sent. Please try again later.'
        ], 500);
    }

    wp_send_json_success([
        'message' => 'Your booking request was sent successfully.'
    ]);

}
