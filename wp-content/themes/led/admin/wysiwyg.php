<?php
// Get WYSIWYG styles
add_editor_style('css/wysiwyg.css');

// Insert Specific Styles
add_filter( 'mce_buttons_2', 'jbu_mce_buttons_2' );

function jbu_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'jbu_mce_before_init' );

function jbu_mce_before_init( $settings ) {

    $style_formats = array(
        array( // Horizontal Rule
            'title' => 'Horizontal Rule',
            'block' => 'hr'
        ),
		array( // Horizontal Rule
            'title' => 'First Paragraph',
            'inline' => 'span',
			'classes' => 'first-paragraph'
        ),
		array( // Horizontal Rule
            'title' => 'Quote Style',
            'inline' => 'span',
			'classes' => 'quote-style'
        ),
        array( // Pink Colouring
            'title' => 'Pink',
            'inline' => 'span',
            'classes' => 'pink'
        ),
        array( // Blue Colouring
            'title' => 'Blue',
            'inline' => 'span',
            'classes' => 'blue'
        )          
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
?>