
<?php
/**
 * Bildboxen (Cards Grid)
 * ACF-Felder:
 * boxes (Repeater: image, background_image, title, text, link)
 * columns (Anzahl Spalten)
 */

$boxes   = get_sub_field('boxes') ?: [];
$columns = (int) (get_sub_field('columns') ?: 3);

$columns = max(1, min(12, $columns));
?>

<?php if (!empty($boxes)): ?>

<div class="cards-grid" style="--cards-columns: <?php echo esc_attr($columns); ?>;">

    <?php foreach ($boxes as $box):

        $img = $box['image'] ?? 0;
        $bg  = $box['background_image'] ?? 0;
        $ttl = $box['title'] ?? '';
        $txt = $box['text'] ?? '';
        $lnk = $box['link'] ?? [];

        $url    = is_array($lnk) ? ($lnk['url'] ?? '') : '';
        $label  = is_array($lnk) ? ($lnk['title'] ?? '') : '';
        $target = is_array($lnk) ? ($lnk['target'] ?? '_self') : '_self';

        $bg_url = $bg ? wp_get_attachment_image_url($bg, 'large') : '';

    ?>

    <div class="cards-grid-item">

        <div class="card">

            <?php if ($bg_url): ?>
                <div class="card-background"
                     style="background-image: url('<?php echo esc_url($bg_url); ?>');">
                </div>
            <?php endif; ?>

            <div class="card-body">

                <?php if ($img): ?>
                    <?php
                    echo wp_get_attachment_image(
                        $img,
                        'medium_large',
                        false,
                        [
                            'class' => 'card-img-top',
                            'alt'   => esc_attr($ttl)
                        ]
                    );
                    ?>
                <?php endif; ?>

                <?php if ($ttl): ?>
                    <h2 class="card-title">
                        <?php echo esc_html(wp_strip_all_tags($ttl)); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($txt): ?>
                    <p class="card-text">
                        <?php echo esc_html($txt); ?>
                    </p>
                <?php endif; ?>

                <?php if ($url): ?>
                    <div class="card-button">
                        <a class="btn btn-primary"
                           href="<?php echo esc_url($url); ?>"
                           target="<?php echo esc_attr($target); ?>"
                           <?php if ($target === '_blank'): ?>
                               rel="noopener noreferrer"
                           <?php endif; ?>>
                            <?php echo esc_html($label ?: __('Mehr', 'projecttheme')); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <?php endforeach; ?>

</div>

<?php endif; ?>
