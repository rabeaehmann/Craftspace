
<?php
/**
 * Workshops
 *
 * ACF-Struktur:
 *
 * levels (Repeater)
 *   level_title (Text)
 *   level_description (WYSIWYG)
 *
 *   workshops (Repeater)
 *     image (Image ID)
 *     intro_text (WYSIWYG)
 *     time (Text)
 *     budget (Text)
 *     difficulty (Select: 1, 2, 3)
 *     bottom_text (WYSIWYG)
 */


$levels = get_sub_field('levels') ?: [];

?>

<?php if (!empty($levels)): ?>

<div class="workshops-levels">


    <?php foreach ($levels as $level):

        $level_title = $level['level_title'] ?? '';
        $level_description = $level['level_description'] ?? '';
        $workshops = $level['workshops'] ?? [];

    ?>

        <section class="workshop-level">


            <!-- LEVEL TITEL -->

            <?php if ($level_title): ?>
                <h2 class="level-title">
                    <?php echo esc_html($level_title); ?>
                </h2>
            <?php endif; ?>


            <!-- LEVEL BESCHREIBUNG -->

            <?php if ($level_description): ?>
                <div class="level-description">
                    <?php echo wp_kses_post($level_description); ?>
                </div>
            <?php endif; ?>


            <!-- WORKSHOPS -->

            <?php if (!empty($workshops)): ?>

                <div class="workshops-grid">


                    <?php foreach ($workshops as $workshop):

                        $img = $workshop['image'] ?? 0;
                        $intro = $workshop['intro_text'] ?? '';

                        $time = $workshop['time'] ?? '';
                        $budget = $workshop['budget'] ?? '';

                        $difficulty = (int) ($workshop['difficulty'] ?? 1);
                        $difficulty = max(1, min(3, $difficulty));

                        $bottom = $workshop['bottom_text'] ?? '';

                    ?>


                        <article class="workshop-card">


                            <!-- BILD -->

                            <?php if ($img): ?>

                                <div class="workshop-image-wrapper">

                                    <?php
                                    echo wp_get_attachment_image(
                                        $img,
                                        'large',
                                        false,
                                        [
                                            'class' => 'workshop-image',
                                        ]
                                    );
                                    ?>

                                </div>

                            <?php endif; ?>


                            <div class="workshop-body">


                                <!-- INTRO WYSIWYG -->

                                <?php if ($intro): ?>

                                    <div class="workshop-intro">
                                        <?php echo wp_kses_post($intro); ?>
                                    </div>

                                <?php endif; ?>


                                <!-- ZWEI SPALTEN -->

                                <div class="workshop-columns">


                                    <!-- LINKE SPALTE: KATEGORIEN -->

                                    <div class="workshop-left">

                                        <div class="workshop-category">
                                            Time
                                        </div>

                                        <div class="workshop-category">
                                            Budget
                                        </div>

                                        <div class="workshop-category">
                                            Difficulty
                                        </div>

                                    </div>


                                    <!-- RECHTE SPALTE: WERTE / ICONS -->

                                    <div class="workshop-right">


                                        <!-- TIME -->

                                        <div class="workshop-meta-row">

                                            <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/time.svg'); ?>"
                                                alt=""
                                            >

                                            <span>
                                                <?php echo esc_html($time); ?>
                                            </span>

                                        </div>


                                        <!-- BUDGET -->

                                        <div class="workshop-meta-row">

                                            <img
                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/budget.svg'); ?>"
                                                alt=""
                                            >

                                            <span>
                                                <?php echo esc_html($budget); ?>
                                            </span>

                                        </div>


                                        <!-- DIFFICULTY -->

                                        <div class="workshop-meta-row">

                                            <div class="difficulty-icons">

                                                <?php for ($i = 1; $i <= 3; $i++): ?>

                                                    <img
                                                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/difficulty.svg'); ?>"
                                                        class="<?php echo $i <= $difficulty ? 'active' : 'inactive'; ?>"
                                                        alt=""
                                                    >

                                                <?php endfor; ?>

                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <!-- BOTTOM WYSIWYG -->

                                <?php if ($bottom): ?>

                                    <div class="workshop-bottom">
                                        <?php echo wp_kses_post($bottom); ?>
                                    </div>

                                <?php endif; ?>


                            </div>

                        </article>


                    <?php endforeach; ?>


                </div>

            <?php endif; ?>


        </section>

    <?php endforeach; ?>


</div>

<?php endif; ?>
