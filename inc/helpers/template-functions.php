<?php
/**
 * Functions which enhance the theme by hooking into WordPress and Core theme Functions.
 *
 * @package yugen
 */

/*----------------------------------------------------------------------
# Exit if accessed directly
-------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------
# Adds custom classes to the array of body classes.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_body_classes' ) ) {
    /**
     * @param array $classes Classes for the body element.
     * @return array
     */
    function yugen_body_classes( $classes ) {
        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        return apply_filters( 'yugen_post_author', $classes );
    }
}
add_filter( 'body_class', 'yugen_body_classes' );

/*----------------------------------------------------------------------
# Add a pingback url auto-discovery header for single posts, pages, or attachments.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_pingback_header' ) ) {

    function yugen_pingback_header() {
        if ( is_singular() && pings_open() ) {
            echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
        }
    }
}
add_action( 'wp_head', 'yugen_pingback_header' );

/*----------------------------------------------------------------------
# Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
-------------------------------------------------------------------------*/
if ( !function_exists( 'page_menu_args' ) ) {
    function page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    };
}
add_filter( 'wp_page_menu_args', 'page_menu_args', 10, 1 );

/*----------------------------------------------------------------------
# Prints HTML with meta information for the categories.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_cat_links' ) ) {

    function yugen_cat_links( $before='', $after='', $cat_sep= '' ) {
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $cat_sep = $cat_sep ? $cat_sep : esc_html__( ', ', 'yugen' );
            $categories_list = get_the_category_list( $cat_sep );
            $output = '';
            if ( $categories_list ) {
                $output .= '<div class="cat-links post-meta-item d-flex flex-wrap align-items-center mr-24">';
                $output .= '<span class="pt-icon icon-list"></span>';
                $output .= $categories_list;
                $output .= '</div>';
            }

            // Filter
            $output = apply_filters( 'yugen_cat_links', $output );

            if ( ! empty( $output ) ) {
                echo $before . $output . $after;
            }
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information for the tags.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_tags_links' ) ) {

    function yugen_tags_links( $before='', $after='' ) {
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list  = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'yugen' ) );
            $output     = '';
            if ( $tags_list ) {

                $output .= '<div class="tags-links post-meta-item d-flex flex-wrap align-items-center mr-24">';
                $output .= '<span class="pt-icon icon-tags"></span>';
                $output .= $tags_list;
                $output .= '</div>';
            }
            // Filter
            $output = apply_filters( 'yugen_tags_links', $output );

            if ( ! empty( $output ) ) {
                echo $before . $output . $after;
            }
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information for the author.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_post_author' ) ) {

    function yugen_post_author( $before = '', $after = '' ) {

        $output = '';
        $output .= '<div class="post-author post-meta-item d-flex flex-wrap align-items-center mr-24">';
        $output .= '<span class="pt-icon icon-user-alt"></span>';
        $output .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';
        $output .= '</div>';

        // Filter
        $output = apply_filters( 'yugen_post_author', $output );

        if ( ! empty( $output ) ) {
            echo $before . $output . $after;
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information for the comments.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_post_comments' ) ) {

    function yugen_post_comments( $before='', $after='') {

        $count      = (int) get_comments_number( yugen_get_the_ID() );
        $output     = '';
        $output     .= '<div class="comments-count post-meta-item d-flex flex-wrap align-items-center mr-24">';

        $output     .= '<span class="pt-icon icon-comments"></span>';
        $output     .= '<a href="' . esc_url( get_comments_link( yugen_get_the_ID() ) ) . '">';

        $output     .= '<span class="total-post-comments">';

        $output     .= absint( $count );
        $output     .= '</span>';
        $output     .= '</a>';
        $output     .= '</div>';

        // Filter
        $output = apply_filters( 'yugen_post_comments', $output );

        if ( ! empty( $output ) ) {
            echo $before . $output . $after;
        }

    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information for the date.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_posted_date' ) ) {

    function yugen_posted_date( $before='', $after='' ) {

        $time_string = '<time class="entry-date post-meta-item published updated mr-24" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( ' %s', 'post date', 'yugen' ),
            '<a href="' . esc_url( get_month_link(get_the_time('Y'), get_the_time('m')) ) . '" rel="bookmark">' . $time_string . '</a>'
        );
        $output = '';
        $output .= '<div class="posted-on post-meta-item d-flex flex-wrap align-items-center mr-24">';
        $output .= '<span class="pt-icon icon-calendar-1"></span>';
        $output .= $posted_on;
        $output .= '</div>';

        // Filter
        $output = apply_filters( 'yugen_posted_date', $output );

        if ( ! empty( $output ) ) {
            echo $before . $output . $after;
        }
    }
}

/*----------------------------------------------------------------------
# Prints HTML with meta information read more button
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_read_more' ) ) {
    function yugen_read_more( $before='', $after='', $btn_text = '' ) {

        // Get Btn Text
        $btn_text   = $btn_text ? $btn_text : get_theme_mod( 'yugen_global_read_more_text', 'Read More' ) ;

        $output     = '';
        $output     .= '<div class="read-more trail transition-35s">';
        $output     .= '<a class="td-none" href="'.esc_url( get_the_permalink() ).'">' . esc_html( $btn_text ) . '</a>';
        $output .= '</div>';

        // Filter
        $output = apply_filters( 'yugen_read_more', $output );

        if ( ! empty( $output ) ) {
            echo $before . $output . $after;
        }
    }
}

/*----------------------------------------------------------------------
# Add Action for the copyright information.
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_footer_copyright_information' ) ) {
    /**
     * Function to show the copyright information
     */
    function yugen_footer_copyright_information() {
        ?>
        <div class="site-info">
            <?php
            printf( __( 'Copyright &copy; %1$s %3$s. %2$s.', 'yugen' ), date('Y'), esc_html__('All rights reserved','yugen'), '<a href="'.esc_url( home_url( '/' ) ) .'">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>' );
            echo '<span class="sep"> | </span>';
            printf( __( 'Designed by %2$s', 'yugen' ), '', '<a href="'.esc_url( __('http://precisethemes.com/','yugen' ) ) .'" rel="designer" target="_blank">Precise Themes</a>' );
            ?>
        </div><!-- .site-info -->
        <?php
    }
}
add_action( 'yugen_footer_copyright', 'yugen_footer_copyright_information', 5 );

/*----------------------------------------------------------------------
#  Returns correct ID
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_get_the_ID' ) ) {
    function yugen_get_the_ID() {

        // Default value is empty
        $id = get_the_ID();

        // Posts page
        if ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
            $id = $page_for_posts;
        }

        // Apply filters and return
        return apply_filters( 'yugen_post_id', $id );

    }
}

/*----------------------------------------------------------------------
# Display the archive title based on the queried object.
-------------------------------------------------------------------------*/
if ( !function_exists( 'yugen_archive_get_title' ) ) {
    function yugen_archive_get_title( $before = '', $after = '' ) {
        if ( is_category() ) {
            $title = sprintf( __( '<label>Category %s', 'yugen' ), '</label>'.single_cat_title( '', false ) );
        } elseif ( is_tag() ) {
            $title = sprintf( __( '<label>Tag %s', 'yugen' ), '</label>'.single_tag_title( '', false ) );
        } elseif ( is_author() ) {
            $title = sprintf( __( '<label>Author %s', 'yugen' ), '</label>'.get_the_author() );
        } elseif ( is_year() ) {
            $title = sprintf( __( '<label>Year %s', 'yugen' ), '</label>'.get_the_date( _x( 'Y', 'yearly archives date format', 'yugen' ) ) );
        } elseif ( is_month() ) {
            $title = sprintf( __( '<label>Month %s', 'yugen' ), '</label>'.get_the_date( _x( 'F Y', 'monthly archives date format', 'yugen' ) ) );
        } elseif ( is_day() ) {
            $title = sprintf( __( '<label>Day %s', 'yugen' ), '</label>'.get_the_date( _x( 'F j, Y', 'daily archives date format', 'yugen' ) ) );
        } elseif ( is_tax( 'post_format' ) ) {
            if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                $title = _x( 'Asides', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                $title = _x( 'Galleries', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                $title = _x( 'Images', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                $title = _x( 'Videos', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                $title = _x( 'Quotes', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                $title = _x( 'Links', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                $title = _x( 'Statuses', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                $title = _x( 'Audio', 'post format archive title', 'yugen' );
            } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                $title = _x( 'Chats', 'post format archive title', 'yugen' );
            }
        } elseif ( is_post_type_archive() ) {
            $title = sprintf( __( '<label>Archives %s', 'yugen' ), '</label>'.post_type_archive_title( '', false ) );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf( __( '%1$s: %2$s', 'yugen' ), $tax->labels->singular_name, '<span>' . single_term_title( '', false ) . '</span>' );
        } else {
            $title = __( 'Archives', 'yugen' );
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters( 'get_the_archive_title', $title );

        if ( ! empty( $title ) ) {
            echo $before . $title . $after;
        }
    }
}

/*----------------------------------------------------------------------
# Returns sidebar layout
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_get_sidebar_layout' ) ) {
    function yugen_get_sidebar_layout() {

        // Get post ID
        $post_id = yugen_get_the_ID();

        // Global Sidebar Layout
        $global_layout = get_theme_mod( 'yugen_global_sidebar_layout', 'right-sidebar' );

        // Bail if front page or home
        if ( ( is_front_page() && is_home() ) || is_front_page() ) {

            $home_layout = get_theme_mod( 'yugen_home_sidebar_layout', 'full-width' );

            if ( $home_layout !== 'default' ) {

                $global_layout = $home_layout;
            }

        }

        // Bail if single page
        elseif ( is_404() ) {

            $global_layout = 'full-width';
        }

        // Bail if single page
        elseif ( is_page() ) {

            $page_layout    = get_theme_mod( 'yugen_page_sidebar_layout', 'default' );

            // Check meta first to override and return (prevents filters from overriding meta)
            if ( $post_id && $meta = get_post_meta( $post_id, 'yugen_sidebar_layout', true ) ) {

                $global_layout = $meta;

            } elseif( $page_layout !== 'default' ) {

                $global_layout = $page_layout;

            }

        }

        // Bail if single post
        elseif ( is_single() ) {

            $post_layout = get_theme_mod( 'yugen_post_sidebar_layout', 'default' );

            // Check meta first to override and return (prevents filters from overriding meta)
            if ( $post_id && $meta = get_post_meta( $post_id, 'yugen_sidebar_layout', true ) ) {

                $global_layout = $meta;

            } elseif( $post_layout !== 'default' ) {

                $global_layout = $post_layout;

            }

        }

        // Bail if archive page
        elseif ( is_archive() ) {

            // For all Archive Page
            $archive_layout = get_theme_mod( 'yugen_archive_page_sidebar_layout', 'full-width' );

            if ( $archive_layout !== 'default' ) {

                $global_layout = $archive_layout;

            }

        }

        // Apply filters and return
        return apply_filters( 'yugen_get_sidebar_layout', esc_attr( $global_layout ) );

    }
}

/*----------------------------------------------------------------------
# Primary Class
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_has_primary_content_class' ) ) {
    function yugen_has_primary_content_class() {

        $sidebar_layout = yugen_get_sidebar_layout();

        if ( $sidebar_layout == 'right-sidebar' ) {
            $primary_class = 'order-1';
        }
        elseif ( $sidebar_layout == 'left-sidebar' ) {
            $primary_class = 'order-2';
        }
        else {
            $primary_class = 'full-width col-12';
        }
        // Apply filters and return
        return apply_filters( 'yugen_has_primary_content_class', $primary_class );

    }
}

/*----------------------------------------------------------------------
# Secondary Class
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_has_secondary_content_class' ) ) {
    function yugen_has_secondary_content_class() {

        $sidebar_layout = yugen_get_sidebar_layout();

        if ( $sidebar_layout == 'right-sidebar' ) {
            $secondary_class = 'order-2';
        } elseif ( $sidebar_layout == 'left-sidebar' ) {
            $secondary_class = 'order-1';
        } else {
            $secondary_class = $sidebar_layout;
        }
        // Apply filters and return
        return apply_filters( 'yugen_has_secondary_content_class', $secondary_class );

    }
}

/*----------------------------------------------------------------------
# Get menu list
# @return array of menu list with menu id as index and menu name as value
-------------------------------------------------------------------------*/
if ( ! function_exists( 'yugen_get_menus' ) ) {
    /**
     * Get menu list
     * @return array of menu list with menu id as index and menu name as value
     */
    function yugen_get_menus() {
        $menu_list = array();
        $nav_menus = wp_get_nav_menus();
        if ( count( $nav_menus ) ) {
            $menu_list[''] = sprintf( '&mdash; %s &mdash;', esc_html__( 'Choose a Menu', 'yugen' ) );
            foreach ( $nav_menus as $nav ) {
                $menu_list[ $nav->slug ] = esc_html( $nav->name );
            }
        } else {
            $menu_list = array( '' => esc_html__( 'No Menu set yet', 'yugen' ) );
        }
        // Apply filters and return
        return apply_filters( 'yugen_get_menus', $menu_list );
    }
}
