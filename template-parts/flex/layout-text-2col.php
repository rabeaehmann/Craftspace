<?php
$left   = get_sub_field('left');
$link   = get_sub_field('link');
$img_id = get_sub_field('background_image');

$background_image = $img_id
    ? wp_get_attachment_image_url($img_id, 'full')
    : '';
?>

<section
    class="full-width-background"
    <?php if ($background_image): ?>
        style="background-image: url('<?php echo esc_url($background_image); ?>');"
    <?php endif; ?>
>
    <div class="container">
        <div class="row g-5">

            <!-- Linke Spalte -->
            <div class="col-md-9">
                <?php echo wp_kses_post($left); ?>
            </div>

            <!-- Rechte Spalte mit Button -->
            <div class="col-md-3 text-end align-self-center">
                <?php if (!empty($link) && !empty($link['url'])): ?>
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

        </div>
    </div>
</section>