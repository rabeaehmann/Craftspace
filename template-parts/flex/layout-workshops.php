<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <div class="booking-success">
        Thank you! Your booking request has been sent successfully.
    </div>
<?php endif; ?>
<?php
/**
 * Workshop directory
 *
 * ACF-Struktur:
 * workshop_element (Repeater)
 *   title (Text)
 *   description (Text)
 *   image (Image ID)
 *   time (Select: one, two, three)
 *   budget (Select: one, two, three)
 *   difficulty (Select: one, two, three)
 *   bottom_text (WYSIWYG)
 */


$workshops = get_sub_field('workshop_element') ?: [];

if (!empty($workshops)): ?>

    <div class="workshop-directory" data-workshop-directory>

        <div class="workshop-filter" aria-label="Workshop filters">
            <span class="workshop-filter-label">Filter</span>

            <div class="workshop-filter-controls">
                <label class="workshop-filter-control">
                    
                    <select data-workshop-filter="difficulty">
                        <option value="">Difficulty · All</option>
                        <option value="one">Difficulty · 1</option>
                        <option value="two">Difficulty · 2</option>
                        <option value="three">Difficulty · 3</option>
                    </select>
                </label>

                <label class="workshop-filter-control">
                    
                    <select data-workshop-filter="time">
                        <option value="">Time · All</option>
                        <option value="one">Time · 1</option>
                        <option value="two">Time · 2</option>
                        <option value="three">Time · 3</option>
                    </select>
                </label>

                <label class="workshop-filter-control">
                    
                    <select data-workshop-filter="budget">
                        <option value="">Budget · All</option>
                        <option value="one">Budget · 1</option>
                        <option value="two">Budget · 2</option>
                        <option value="three">Budget · 3</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="workshop-listing-information">
            <p class="workshop-count" data-workshop-count aria-live="polite">
                All workshops · <?php echo esc_html(count($workshops)); ?> crafts to explore
            </p>
            <p class="workshop-rating-note">
                Ratings run from 1 (lower) to 3 (higher), not hours or prices.
            </p>
        </div>

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

                $time_filter = $time_level === 2 ? 'two' : ($time_level === 3 ? 'three' : 'one');
                $budget_filter = $budget_level === 2 ? 'two' : ($budget_level === 3 ? 'three' : 'one');
                $difficulty_filter = $difficulty_level === 2 ? 'two' : ($difficulty_level === 3 ? 'three' : 'one');

            ?>

                <article
                    class="workshop-card"
                    data-workshop-card
                    data-difficulty="<?php echo esc_attr($difficulty_filter); ?>"
                    data-time="<?php echo esc_attr($time_filter); ?>"
                    data-budget="<?php echo esc_attr($budget_filter); ?>"
                >

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
                                    <?php if ($difficulty): ?><div class="workshop-category">Difficulty</div><?php endif; ?>
                                    <?php if ($budget): ?><div class="workshop-category">Budget</div><?php endif; ?>
                                    <?php if ($time): ?><div class="workshop-category">Time</div><?php endif; ?>
                                </div>

                                <div class="workshop-right">
                                    <?php if ($difficulty): ?>
                                        <div class="workshop-meta-row">
                                            <div class="workshop-icons" aria-label="Difficulty level <?php echo esc_attr($difficulty_level); ?> of 3">
                                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/difficulty.svg'); ?>" class="<?php echo $i <= $difficulty_level ? 'active' : 'inactive'; ?>" alt="">
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($budget): ?>
                                        <div class="workshop-meta-row">
                                            <div class="workshop-icons" aria-label="Budget level <?php echo esc_attr($budget_level); ?> of 3">
                                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/budget.svg'); ?>" class="<?php echo $i <= $budget_level ? 'active' : 'inactive'; ?>" alt="">
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($time): ?>
                                        <div class="workshop-meta-row">
                                            <div class="workshop-icons" aria-label="Time level <?php echo esc_attr($time_level); ?> of 3">
                                                <?php for ($i = 1; $i <= 3; $i++): ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/time.svg'); ?>" class="<?php echo $i <= $time_level ? 'active' : 'inactive'; ?>" alt="">
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
                        <button
                            type="button"
                            class="btn-form"
                            data-book-workshop
                            data-workshop="<?php echo esc_attr($title); ?>">
                            Book it
                        </button>
                    </div>

                </article>

            <?php endforeach; ?>

        </div>

        <div class="workshop-listing-end">
            <p>You’ve explored all <?php echo esc_html(count($workshops)); ?> crafts. Which one sparked your curiosity?</p>
            <p data-workshop-summary><?php echo esc_html(count($workshops)); ?> of <?php echo esc_html(count($workshops)); ?> workshops</p>
        </div>

    </div>

<!-- Workshop Booking Popup -->
<div
    class="booking-modal"
    data-booking-modal
    data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
    aria-hidden="true"
    hidden
>
    <div class="booking-modal-backdrop" data-booking-close></div>

    <div
        class="booking-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="booking-modal-title"
        tabindex="-1"
    >

        <button
            type="button"
            class="booking-modal-close"
            data-booking-close
            aria-label="Close booking form"
        >
            &times;
        </button>

        <div class="booking-modal-header">
            <span class="booking-eyebrow">WORKSHOP BOOKING</span>
            <h2 id="booking-modal-title">Book your workshop</h2>
            <p>We’re looking forward to crafting with you!</p>
        </div>

        <form class="booking-form" data-booking-form>

            <input type="hidden" name="action"
                   value="submit_workshop_booking">

            <?php wp_nonce_field(
                'workshop_booking',
                'booking_nonce'
            ); ?>

            <div class="form-field">
                <label for="booking-workshop">
                    Selected Workshop
                </label>

                <input
                    type="text"
                    id="booking-workshop"
                    name="workshop"
                    readonly
                    required
                >
            </div>

            <div class="booking-name-fields">

                <div class="form-field">
                    <label for="booking-first-name">
                        First Name
                    </label>

                    <input
                        type="text"
                        id="booking-first-name"
                        name="first_name"
                        placeholder="Your first name"
                        autocomplete="given-name"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="booking-last-name">
                        Last Name
                    </label>

                    <input
                        type="text"
                        id="booking-last-name"
                        name="last_name"
                        placeholder="Your last name"
                        autocomplete="family-name"
                        required
                    >
                </div>

            </div>

            <div class="form-field">
                <label for="booking-email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="booking-email"
                    name="email"
                    placeholder="Your email address"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-field booking-participants">

                <label for="booking-participants">
                    Number of Participants
                    <span data-participant-value>1</span>
                </label>

                <input
                    type="range"
                    id="booking-participants"
                    name="participants"
                    min="1"
                    max="6"
                    value="1"
                    step="1"
                >

                <div class="range-labels">
                    <span>1</span>
                    <span>6</span>
                </div>

            </div>

            <div class="form-field">
                <label for="booking-questions">
                    Questions
                </label>

                <textarea
                    id="booking-questions"
                    name="questions"
                    rows="4"
                    placeholder="Any questions or special requests?"
                ></textarea>
            </div>

            <!-- Honeypot spam protection -->
            <div class="booking-honeypot" aria-hidden="true">
                <label for="booking-website">Website</label>
                <input
                    type="text"
                    id="booking-website"
                    name="website"
                    tabindex="-1"
                    autocomplete="off"
                >
            </div>

            <div
                class="booking-message"
                data-booking-message
                role="status"
                aria-live="polite"
            ></div>

            <button type="submit" class="booking-submit">
                Send Request
            </button>

        </form>

    </div>
</div>


<?php endif; ?>
