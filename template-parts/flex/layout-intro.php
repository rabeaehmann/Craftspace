
<?php
/**
 * Partial: Intro (Hero)
 * ACF-Felder:
 * - text (wysiwyg)
 * - background_image (image id)
 * - cta (link array)
 */

$body   = get_sub_field('text');
$img_id = get_sub_field('background_image');
$cta    = get_sub_field('cta');

// Hintergrundbild aufbereiten
$background_image = $img_id
    ? wp_get_attachment_image_url($img_id, 'full')
    : '';

// CTA aufbereiten
$cta_url    = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title  = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel    = $cta_target === '_blank' ? 'noopener noreferrer' : '';

?>

<section
    class="intro"
    <?php if ($background_image): ?>
        style="background-image: url('<?php echo esc_url($background_image); ?>');"
    <?php endif; ?>
>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-12">

                <?php if ($body): ?>
                    <div class="intro-text rte mb-3">
                        <?php echo wp_kses_post($body); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_url): ?>
                    <a
                        class="btn btn-secondary"
                        href="<?php echo esc_url($cta_url); ?>"
                        target="<?php echo esc_attr($cta_target); ?>"
                        rel="<?php echo esc_attr($cta_rel); ?>"
                    >
                        <?php echo esc_html($cta_title ?: __('Mehr', 'projecttheme')); ?>
                    </a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>
