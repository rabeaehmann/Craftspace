
<?php
/**
 * Partial: Layout Breaker Own
 * ACF Layout: breaker_own
 */

// ACF-Felder auslesen
$text_1 = get_sub_field('text_1');
$text_2 = get_sub_field('text_2');
$text_3 = get_sub_field('text_3');
$image  = get_sub_field('background_image');

// Bild verarbeiten – unterstützt ID, Array und URL
$background_image = '';

if (is_array($image) && !empty($image['url'])) {
    $background_image = $image['url'];
} elseif (is_numeric($image) && $image) {
    $background_image = wp_get_attachment_image_url($image, 'full');
} elseif (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
    $background_image = $image;
}
?>

<section
    class="breaker-own breaker-own-columns"
    <?php if ($background_image): ?>
        style="background-image: url('<?php echo esc_url($background_image); ?>');"
    <?php endif; ?>
>
    <div class="breaker-own-container">

        <div class="breaker-own-row">

            <div class="breaker-own-column">
                <h4><?php echo esc_html($text_1); ?></h4>
            </div>

            <div class="breaker-own-column">
                <h4><?php echo esc_html($text_2); ?></h4>
            </div>

            <div class="breaker-own-column">
                <h4><?php echo esc_html($text_3); ?></h4>
            </div>

        </div>

    </div>
</section>
