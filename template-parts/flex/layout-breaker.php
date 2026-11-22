
<?php
/**
 * Partial: Breaker
 *
 * ACF-Felder:
 * - text_1 (Text)
 * - text_2 (Text)
 * - text_3 (Text)
 * - background_image (Image ID)
 * - style (line|space|headline|columns)
 */

$text_1 = get_sub_field('text_1');
$text_2 = get_sub_field('text_2');
$text_3 = get_sub_field('text_3');

$style  = get_sub_field('style') ?: 'space';
$img_id = get_sub_field('background_image');

$background_image = $img_id
    ? wp_get_attachment_image_url($img_id, 'full')
    : '';

switch ($style) {

    /* =============================================
       LINE
    ============================================= */

    case 'line':
        ?>
        <section class="breaker section section--bg-none py-5">
            <div class="container-lg">
                <hr class="my-5" />
            </div>
        </section>
        <?php
        break;


    /* =============================================
       HEADLINE
    ============================================= */

    case 'headline':
        ?>
        <section class="breaker section section--bg-none py-5">
            <div class="container-lg">
                <h4 class="section-breaker text-center my-5">
                    <?php echo esc_html($text_1); ?>
                </h4>
            </div>
        </section>
        <?php
        break;


    /* =============================================
       THREE COLUMNS – FULL WIDTH
    ============================================= */

    case 'columns':
        ?>

        <section
            class="breaker-columns"
            <?php if ($background_image): ?>
                style="background-image: url('<?php echo esc_url($background_image); ?>');"
            <?php endif; ?>
        >
            <div class="container-lg">
                <div class="row g-5 align-items-center">

                    <div class="col-md-4 text-center">
                        <?php echo esc_html($text_1); ?>
                    </div>

                    <div class="col-md-4 text-center">
                        <?php echo esc_html($text_2); ?>
                    </div>

                    <div class="col-md-4 text-center">
                        <?php echo esc_html($text_3); ?>
                    </div>

                </div>
            </div>
        </section>

        <?php
        break;


    /* =============================================
       SPACE
    ============================================= */

    case 'space':
    default:
        ?>
        <section class="breaker section section--bg-none py-5">
            <div class="container-lg">
                <div class="my-5"></div>
            </div>
        </section>
        <?php
        break;
}
