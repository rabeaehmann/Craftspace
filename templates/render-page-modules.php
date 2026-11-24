<?php
/**
 * Rendert die ACF Flexible-Content-Felder aus `page_modules`
 * Gallery Highlights werden automatisch gemeinsam gruppiert.
 */

if (!function_exists('have_rows') || !have_rows('page_modules')) {
    return;
}

$gallery_wrapper_open = false;

while (have_rows('page_modules')) : the_row();

    $layout = get_row_layout();

    // Gemeinsamen Gallery-Wrapper öffnen
    if ($layout === 'gallery_highlight' && !$gallery_wrapper_open) {
        echo '<div class="gallery-highlight-wrapper">';
        $gallery_wrapper_open = true;
    }

    // Gallery-Wrapper schließen, sobald ein anderes Layout kommt
    if ($layout !== 'gallery_highlight' && $gallery_wrapper_open) {
        echo '</div>';
        $gallery_wrapper_open = false;
    }

    // Section-Optionen
    $opts = [
        'name'      => $layout,
        'container' => get_sub_field('container') ?: 'container-lg',
        'padding_y' => get_sub_field('padding_y') ?: 'py-5',
        'bg'        => get_sub_field('background') ?: 'none',
        'id'        => get_sub_field('id-anchor') ?: '',
        'show_on'   => get_sub_field('show-on') ?: 'everywhere',
    ];

    // Section öffnen
    if (function_exists('section_open')) {
        section_open($opts);
    } else {
        $id   = $opts['id'] ? ' id="' . esc_attr($opts['id']) . '"' : '';
        $cont = $opts['container'];

        echo '<section' . $id . ' class="' . esc_attr($layout . ' ' . $opts['padding_y']) . '">';

        if ($cont !== 'none') {
            echo '<div class="' . esc_attr($cont) . '">';
        }
    }

    // Layouts ausgeben
    switch ($layout) {

        case 'intro':
            get_template_part('template-parts/flex/layout', 'intro');
            break;

        case 'text_1col':
            get_template_part('template-parts/flex/layout', 'text-1col');
            break;

        case 'text_2col':
            get_template_part('template-parts/flex/layout', 'text-2col');
            break;

        case 'text_3col':
            get_template_part('template-parts/flex/layout', 'text-3col');
            break;

        case 'text_4col':
            get_template_part('template-parts/flex/layout', 'text-4col');
            break;

        case 'text_left_image_right':
            get_template_part('template-parts/flex/layout', 'text-left-image-right');
            break;

        case 'image_left_text_right':
            get_template_part('template-parts/flex/layout', 'image-left-text-right');
            break;

        case 'image_slider':
            get_template_part('template-parts/flex/layout', 'image-slider');
            break;

        case 'bildboxen':
            get_template_part('template-parts/flex/layout', 'bildboxen');
            break;

        case 'galerie':
            get_template_part('template-parts/flex/layout', 'galerie');
            break;

        case 'tabs':
            get_template_part('template-parts/flex/layout', 'tabs');
            break;

        case 'akkordeon':
            get_template_part('template-parts/flex/layout', 'akkordeon');
            break;

        case 'breaker':
            get_template_part('template-parts/flex/layout', 'breaker');
            break;

        case 'code_editor':
            get_template_part('template-parts/flex/layout', 'code-editor');
            break;

        case 'project_highlight':
            get_template_part('template-parts/flex/layout', 'project-highlight');
            break;

        case 'gallery_highlight':
            get_template_part('template-parts/flex/layout', 'gallery-highlight');
            break;

        case 'page_introduction':
            get_template_part('template-parts/flex/layout', 'page-introduction');
            break;

        case 'footer':
            get_template_part('template-parts/flex/layout', 'footer');
            break;

        case 'breaker_own':
            get_template_part('template-parts/flex/layout', 'breaker-own');
            break;
        
        case 'text_2col_intro':
            get_template_part('template-parts/flex/layout', 'text-2col-intro');
            break;
        
        case 'workshops':
            get_template_part('template-parts/flex/layout', 'workshops');
            break;
    }

    // Section schließen
    if (function_exists('section_close')) {
        section_close($opts);
    } else {
        if ($opts['container'] !== 'none') {
            echo '</div>';
        }

        echo '</section>';
    }

endwhile;

// Gallery-Wrapper am Ende schließen
if ($gallery_wrapper_open) {
    echo '</div>';
}
