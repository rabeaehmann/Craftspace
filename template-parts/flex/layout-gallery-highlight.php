<?php
/**
 * Gallery Highlight – Bild oben, Text darunter
 * ACF-Felder: image (ID), title, text
 */

$img_id = get_sub_field('image');
$title  = get_sub_field('title');
$body   = get_sub_field('text');
?>

<div class="gallery-highlight">

    <?php if ($img_id): ?>
        <?php
        echo wp_get_attachment_image($img_id, 'large', false, [
            'class'    => 'gallery-highlight-image',
            'loading'  => 'lazy',
            'decoding' => 'async',
        ]);
        ?>
    <?php endif; ?>

    <?php if ($title): ?>
        <h2 class="mb-3">
            <?php echo esc_html($title); ?>
        </h2>
    <?php endif; ?>

    <?php if ($body): ?>
        <div class="rte">
            <?php echo wp_kses_post($body); ?>
        </div>
    <?php endif; ?>

</div>