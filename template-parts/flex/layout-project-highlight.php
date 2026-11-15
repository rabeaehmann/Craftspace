
<?php
/**
 * Bild oben – Text darunter
 * image (Bild-ID)
 * title (Text)
 * text (WYSIWYG)
 */

$img_id  = get_sub_field('image');
$title   = get_sub_field('title');
$body    = get_sub_field('text');
?>

<div class="row g-4">

  <!-- Bild oben -->
  <div class="col-12">
    <?php if ($img_id): ?>
      <?php
      echo wp_get_attachment_image($img_id, 'large', false, [
        'class'    => 'img-fluid rounded w-100',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
      ?>
    <?php endif; ?>
  </div>

  <!-- Text darunter -->
  <div class="col-12">

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

</div>
