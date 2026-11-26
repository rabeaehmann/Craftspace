
<?php
/**
 * Website Footer
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">

    <div class="footer-content">

        <!-- Footer Bild -->
            <div class="footer-image">
                <picture>
                    <source
                        media="(max-width: 767px)"
                        srcset="<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer_small.svg'); ?>"
                    >

                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer-image.svg'); ?>"
                        alt=""
                        loading="lazy"
                    >
                </picture>
            </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom container-lg">     

            <!-- Logo links: Verlinkung zur Homepage -->
            <div class="footer-logo">

                <a href="<?php echo esc_url(home_url('/')); ?>"
                aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">

                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>"
                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                    >

                    </a>
            </div>


            <!-- Rechte Seite: Menü und Zurück-nach-oben -->
            <div class="footer-right">

                <nav
                    class="footer-navigation"
                    aria-label="<?php esc_attr_e('Footer Navigation', 'projecttheme'); ?>"
                >
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'menu-footer',
                        'menu_id'        => 'menu-footer',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]);
                    ?>
                </nav>

                <!-- Back to Top -->
                <a href="#page"
                   class="back-to-top"
                   aria-label="<?php esc_attr_e('Nach oben scrollen', 'projecttheme'); ?>"
                   title="<?php esc_attr_e('Nach oben', 'projecttheme'); ?>">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 19V5"/>
                        <path d="M5 12l7-7 7 7"/>
                    </svg>

                </a>

            </div>

        </div>

        <!-- Copyright -->
        <div class="footer-copyright container-lg">
            <p>
                &copy; <?php echo esc_html(wp_date('Y')); ?> Rabea Ehmann
            </p>
        </div>

    </div>

</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
