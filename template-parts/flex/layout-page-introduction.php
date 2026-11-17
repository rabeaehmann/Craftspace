<?php
$eyebrow = get_field('eyebrow');
$title = get_field('title');
$text = get_field('text');
$background_image = get_field('background_image');

$background_url = '';

if (is_array($background_image)) {
    $background_url = $background_image['url'];
} elseif (is_numeric($background_image)) {
    $background_url = wp_get_attachment_image_url($background_image, 'full');
} elseif (is_string($background_image)) {
    $background_url = $background_image;
}
?>

<section class="page-introduction"
    <?php if ($background_url) : ?>
        style="background-image: url('<?php echo esc_url($background_url); ?>');"
    <?php endif; ?>
>
    <?php if ($eyebrow) : ?>
        <p class="page-introduction__eyebrow">
            <?php echo esc_html($eyebrow); ?>
        </p>
    <?php endif; ?>

    <?php if ($title) : ?>
        <h1 class="page-introduction__title">
            <?php echo esc_html($title); ?>
        </h1>
    <?php endif; ?>

    <?php if ($text) : ?>
        <div class="page-introduction__text">
            <?php echo wp_kses_post($text); ?>
        </div>
    <?php endif; ?>
</section>