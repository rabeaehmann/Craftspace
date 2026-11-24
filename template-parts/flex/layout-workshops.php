<?php
/**
 * Workshops
 *
 * ACF-Struktur:
 * workshop_element (Repeater)
 *   title (Text)
 *   description (Text)
 *   image (Image ID)
 *   time (Select)
 *   budget (Select)
 *   difficulty (Select)
 *   bottom_text (WYSIWYG)
 */

$workshops = get_sub_field('workshop_element') ?: [];

if (!empty($workshops)): ?>

    <div class="workshops-grid">

        <?php foreach ($workshops as $workshop):

            $title       = $workshop['title'] ?? '';
            $description = $workshop['description'] ?? '';
            $image_id    = $workshop['image'] ?? 0;
            $time        = $workshop['time'] ?? '';
            $budget      = $workshop['budget'] ?? '';
            $difficulty  = $workshop['difficulty'] ?? '';
            $bottom_text = $workshop['bottom_text'] ?? '';

            $time_level = 1;
            if ($time === 'two') {
                $time_level = 2;
            } elseif ($time === 'three') {
                $time_level = 3;
            } elseif (is_numeric($time)) {
                $time_level = max(1, min(3, (int) $time));
            }

            $budget_level = 1;
            if ($budget === 'two') {
                $budget_level = 2;
            } elseif ($budget === 'three') {
                $budget_level = 3;
            } elseif (is_numeric($budget)) {
                $budget_level = max(1, min(3, (int) $budget));
            }

            $difficulty_level = 1;
            if ($difficulty === 'two') {
                $difficulty_level = 2;
            } elseif ($difficulty === 'three') {
                $difficulty_level = 3;
            } elseif (is_numeric($difficulty)) {
                $difficulty_level = max(1, min(3, (int) $difficulty));
            }

        ?>

            <article class="workshop-card">

                <?php if ($image_id): ?>
                    <div class="workshop-image-wrapper">
                        <?php
                        echo wp_get_attachment_image(
                            $image_id,
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

                    <?php if ($title): ?>
                        <h2 class="workshop-title">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <div class="workshop-description">
                            <?php echo esc_html($description); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($time || $budget || $difficulty): ?>
                        <div class="workshop-columns">

                            <div class="workshop-left">
                                <?php if ($time): ?>
                                    <div class="workshop-category">Time</div>
                                <?php endif; ?>

                                <?php if ($budget): ?>
                                    <div class="workshop-category">Budget</div>
                                <?php endif; ?>

                                <?php if ($difficulty): ?>
                                    <div class="workshop-category">Difficulty</div>
                                <?php endif; ?>
                            </div>

                            <div class="workshop-right">

                                <?php if ($time): ?>
                                    <div class="workshop-meta-row">
                                        <div class="workshop-icons" aria-label="<?php echo esc_attr($time); ?>">
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                                <img
                                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/time.svg'); ?>"
                                                    class="<?php echo $i <= $time_level ? 'active' : 'inactive'; ?>"
                                                    alt=""
                                                >
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($budget): ?>
                                    <div class="workshop-meta-row">
                                        <div class="workshop-icons" aria-label="<?php echo esc_attr($budget); ?>">
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                                <img
                                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/budget.svg'); ?>"
                                                    class="<?php echo $i <= $budget_level ? 'active' : 'inactive'; ?>"
                                                    alt=""
                                                >
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($difficulty): ?>
                                    <div class="workshop-meta-row">
                                        <div class="workshop-icons" aria-label="<?php echo esc_attr($difficulty); ?>">
                                            <?php for ($i = 1; $i <= 3; $i++): ?>
                                                <img
                                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/difficulty.svg'); ?>"
                                                    class="<?php echo $i <= $difficulty_level ? 'active' : 'inactive'; ?>"
                                                    alt=""
                                                >
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    <?php endif; ?>

                    <?php if ($bottom_text): ?>
                        <div class="workshop-bottom">
                            <?php echo wp_kses_post($bottom_text); ?>
                        </div>
                    <?php endif; ?>

                </div>

            </article>

        <?php endforeach; ?>

    </div>

<?php endif; ?>
