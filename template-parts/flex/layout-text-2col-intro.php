
<?php
$left  = get_sub_field('left');
$right = get_sub_field('right');
?>

<section>
    <div class="container-intro">
        <div class="row g-5 align-items-center">

            <!-- Linke Spalte -->
            <div class="col-md-6">
                <?php echo wp_kses_post($left); ?>
            </div>

            <!-- Rechte Spalte -->
            <div class="col-md-6">
                <?php echo wp_kses_post($right); ?>
            </div>

        </div>
    </div>
</section>
