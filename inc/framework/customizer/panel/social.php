<?php
/**
 * Theme Customizer Social Panel
 *
 * @package yugen
 */

if ( ! function_exists( 'yugen_customizer_social_controls_init' ) ) :

    function yugen_customizer_social_controls_init() {
        /*--------------------------------------------------------------
        # Social Panel
        --------------------------------------------------------------*/
        Kirki::add_panel( 'yugen_social_panel', array(
            'priority'      => 102,
            'title'         => esc_html__( 'Social', 'yugen' ),
        ));

        /*--------------------------------------------------------------
        # Sections
        --------------------------------------------------------------*/
        $sections = array(
            'yugen_social_profile_section'      => array( esc_attr__( 'Social Profiles', 'yugen' ), '' ),
        );
        foreach ( $sections as $section_id => $section ) {
            $section_args = array(
                'title'       => $section[0],
                'description' => $section[1],
                'panel'       => 'yugen_social_panel',
            );
            if ( isset( $section[2] ) ) {
                $section_args['type'] = $section[2];
            }
            Kirki::add_section( $section_id, $section_args );
        }

        /*--------------------------------------------------------------
        # Repeatable Social Profile Setting & Control
        --------------------------------------------------------------*/
        yugen_add_field(
            array(
                'type'                  => 'repeater',
                'label'                 => esc_html__( 'Add Social Profile', 'yugen' ),
                'description'           => esc_html__( 'Drag & Drop items to re-arrange order of appearance.', 'yugen' ),
                'section'               => 'yugen_social_profile_section',
                'row_label'             => array(
                    'type'              => 'field',
                    'value'             => esc_html__('Social', 'yugen' ),
                    'field'             => 'social_name',
                ),
                'settings'              => 'yugen_social_repeatable_social_profiles',
                'default'               => array(
                    array(
                        'social_name'   => esc_html__( 'Facebook', 'yugen' ),
                        'social_url'    => 'https://facebook.com/',
                        'social_icon'   => 'fa-facebook',
                        'social_image'  => '',

                    ),
                ),
                'fields'                => array(
                    'social_name'       => array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Profile Name', 'yugen' ),
                        'default'       => '',
                    ),
                    'social_url'        => array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'URL', 'yugen' ),
                        'default'       => '',
                    ),
                    'social_icon'       => array(
                        'label'         => esc_html__( 'Icon', 'yugen' ),
                        'type'          => 'select',
                        'default'       => 'fa-facebook',
                        'choices'       => yugen_social_profiles()
                    ),
                    'social_image'      => array(
                        'type'          => 'image',
                        'label'         => esc_html__( 'Custom Icon', 'yugen' ),
                        'default'       => '',
                    ),
                ),
            )
        );

        /*--------------------------------------------------------------
        # Social Profile Icon: Border Radius
        --------------------------------------------------------------*/
//        yugen_add_field(
//            array(
//                'type'        => 'slider',
//                'settings'    => 'yugen_social_profile_button_border_radius',
//                'label'       => esc_attr__( 'Border Radius', 'yugen' ),
//                'section'     => 'yugen_social_profile_section',
//                'default'     => 3,
//                'choices'     => array(
//                    'min'  => '0',
//                    'max'  => '30',
//                ),
//                'transport'        =>  'postMessage',
//                'js_vars' => array(
//                    array(
//                        'element'  => '.social-profiles-widget ul li',
//                        'property' => 'border-radius',
//                        'units'    => 'px',
//                    ),
//                ),
//                'output' => array(
//                    array(
//                        'element'  => '.social-profiles-widget ul li',
//                        'property' => 'border-radius',
//                        'units'    => 'px',
//                    ),
//                ),
//            )
//        );

    }
endif;
add_action( 'init', 'yugen_customizer_social_controls_init', 999 );

