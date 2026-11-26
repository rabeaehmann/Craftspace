<?php
$headline = get_sub_field('headline');
$text     = get_sub_field('text');
$image_id = get_sub_field('image');
$link     = get_sub_field('link');
?>

<div class="row align-items-center g-5">

    <div class="col-md-6">

        <?php if ($headline): ?>
            <h2><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>

        <?php if ($text): ?>
            <div class="rte">
                <?php echo wp_kses_post($text); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($link['url'])): ?>
            <a
                class="btn btn-secondary"
                href="<?php echo esc_url($link['url']); ?>"
                target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                rel="<?php echo $link['target'] === '_blank' ? 'noopener noreferrer' : ''; ?>"
            >
                <?php echo esc_html($link['title'] ?: 'Mehr erfahren'); ?>
            </a>
        <?php endif; ?>

    </div>

    <div class="col-md-6">
        <?php
        if ($image_id) {
            $image_url = wp_get_attachment_url($image_id);
            $mime_type = get_post_mime_type($image_id);

            if ($mime_type === 'image/svg+xml') {
                echo '<img src="' . esc_url($image_url) . '" class="img-fluid rounded fixed-image" alt="">';
            } else {
                echo wp_get_attachment_image(
                    $image_id,
                    'large',
                    false,
                    ['class' => 'img-fluid rounded fixed-image']
                );
            }
        }
        ?>
    </div>

</div>