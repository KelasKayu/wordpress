<?php

class Advanced_Ads_Module_Display_By_Query {

    protected $query_var_keys = array(
        'is_single',
        'is_archive',
        'is_search',
        'is_home',
        'is_404',
        'is_attachment',
        'is_singular',
        'is_front_page',
    );

    public function __construct() {
        // register filter
        add_filter( 'advanced-ads-ad-select-args', array( $this, 'ad_select_args_callback' ) );
        add_filter( 'advanced-ads-can-display', array( $this, 'can_display' ), 10, 2 );
    }

    /**
     * On demand provide current query arguments to ads.
     *
     * Existing arguments must not be overridden.
     * Some arguments might be cachable.
     *
     * @param array $args
     *
     * @return array
     */
    public function ad_select_args_callback( $args ) {
        global $post, $wp_the_query, $wp_query;

        if ( isset( $post ) ) {
            if ( ! isset( $args['post'] ) ) {
                $args['post'] = array();
            }
            if ( ! isset( $args['post']['id'] ) ) {
                $args['post']['id'] = $post->ID;
            }
            if ( ! isset( $args['post']['post_type'] ) ) {
                $args['post']['post_type'] = $post->post_type;
            }
        }

        // pass query arguments
        if ( isset( $wp_the_query ) ) {
            if ( ! isset( $args['wp_the_query'] ) ) {
                $args['wp_the_query'] = array();
            }
            $query = $wp_the_query->get_queried_object();
	    // term_id exists only for taxonomy archive pages
            if ( ! isset( $args['wp_the_query']['term_id'] ) && $query ) {
                $args['wp_the_query']['term_id'] = isset( $query->term_id ) ? $query->term_id : '';
            }

            // query type/ context
            if ( ! isset( $args['wp_the_query']['is_main_query'] )) {
                $args['wp_the_query']['is_main_query'] = $wp_query->is_main_query();
            }

            // query vars
            foreach ($this->query_var_keys as $key) {
                if ( ! isset( $args['wp_the_query'][ $key ] ) ) {
                    $args['wp_the_query'][ $key ] = $wp_the_query->$key();
                }
            }
        }

        return $args;
    }

    /**
     *
     * @param mixed $id  scalar (key) or array of keys as needle
     * @param array $ids haystack
     *
     * @return boolean void if either argument is empty
     */
    protected function in_array( $id, $ids ) {
        // empty?
        if ( ! isset( $id ) || $id === array() ) {
            return ;
        }

        // need to explode?
        if ( is_string( $ids) ) {
            $ids = explode( ',', $ids );
        }

        // invalid?
        if ( ! is_array( $ids ) ) {
            return ;
        }

        return is_array( $id ) ? array_intersect( $id, $ids ) !== array() : in_array( $id, $ids );
    }

    protected function can_display_postids( $post, $_cond_value ) {
        // this check is deprecated
        if ( ! $this->can_display_ids( $post, $_cond_value ) ) {
            return false;
        }

        // included posts
        if ( isset( $_cond_value['method'] ) && is_array( $_cond_value['ids'] ) ) {
            switch ( $_cond_value['method'] ) {
                case 'include' :
                    if ( $this->in_array( $post, $_cond_value['ids'] ) === false ) {
                        return false;
                    }
                    break;

                case 'exclude' :
                    if ( $this->in_array( $post, $_cond_value['ids'] ) === true ) {
                        return false;
                    }
                    break ;
            }
        }

        return true;
    }

    protected function can_display_categoryids( $post, $post_type, $_cond_value ) {
        // get all taxonomies of the post
        $term_ids = $this->get_object_terms( $post, $post_type );

        return $this->can_display_ids( $term_ids, $_cond_value );
    }

    /**
     * get all terms of a specific post or post type
     *
     * @param int    $post      id of the post
     * @param string $post_type name of the post type
     *
     * @return arr $out ids of terms this post belongs to
     */
    protected function get_object_terms( $post, $post_type ) {

        $post = (int) $post;
        if ( ! $post ) {
            return array();
        }

        // get post type taxonomies
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );

        $term_ids = array();
        foreach ( array_keys( $taxonomies ) as $taxonomy_slug ){

            // get the terms related to post
            $terms = get_the_terms( $post, $taxonomy_slug );

            if ( ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $term_ids[] = $term->term_id;
                }
            }
        }

        return $term_ids;
    }

    protected function can_display_ids( $ids, $_cond_value ) {
        if ( isset( $_cond_value['include'] ) && ! empty( $_cond_value['include'] ) && $this->in_array( $ids, $_cond_value['include'] ) === false ){
            return false;
        }

        if ( isset( $_cond_value['exclude'] ) && ! empty( $_cond_value['exclude'] ) && $this->in_array( $ids, $_cond_value['exclude'] ) === true ){
            return false;
        }

        return true;
    }

    /**
     * check display conditions
     *
     * @since 1.1.0 moved here from can_display()
     * @return bool $can_display true if can be displayed in frontend
     */
    public function can_display( $can_display, $ad ) {
        if ( ! $can_display ) {
            return false;
        }

        $options = $ad->options();
        if (
            // test if anything is to be limited at all
            ! isset( $options['conditions'] )
            || ! is_array( $options['conditions'] )
            // query arguments required
            || ! isset( $options['wp_the_query'] )
            // display ad if conditions are explicitely disabled
            || ( isset( $options['conditions']['enabled'] ) && ! $options['conditions']['enabled'] )
        ) {
            return true;
        }
        $conditions = $options['conditions'];
        $query = $options['wp_the_query'];
        $post = isset( $options['post'] ) ? $options['post'] : null;

        foreach ( $conditions as $_cond_key => $_cond_value ) {
            $is_not_cond_all = ! isset( $_cond_value['all'] ) || empty( $_cond_value['all'] );
            switch ( $_cond_key ){
                // check for post ids
                case 'postids' :
                    if (
                        isset( $post ) && isset( $post['id'] ) && $is_not_cond_all
                        && isset( $query['is_singular'] ) && $query['is_singular']
                        && ! $this->can_display_postids( $post['id'], $_cond_value )
                    ) {
                        return false;
                    }
                    break;

                // check for category ids
                case 'categoryids' :
                    // included
                    if (
                        isset( $post ) && isset( $post['id'] ) && $is_not_cond_all
                        && isset( $query['is_singular'] ) && $query['is_singular']
                        && ! $this->can_display_categoryids( $post['id'], $post['post_type'], $_cond_value )
                    ) {
                        return false;
                    }
                    break;

                // check for included category archive ids
                // @link http://codex.wordpress.org/Conditional_Tags#A_Category_Page
                case 'categoryarchiveids' :
                    if (
                        isset( $query['term_id'] ) && $is_not_cond_all
                        && isset( $query['is_archive'] ) && $query['is_archive']
                        && ! $this->can_display_ids( $query['term_id'], $_cond_value )
                    ) {
                        return false;
                    }
                    break;

                // check for included post types
                case 'posttypes' :
                    // display everywhere, if include not set (= all is checked)
                    $post_type = isset( $post['post_type'] ) ? $post['post_type'] : false;
                    // TODO remove condition check for string; deprecated since 1.2.2
                    if ( $is_not_cond_all && ! $this->can_display_ids( $post_type, $_cond_value ) ) {
                        return false;
                    }
                    break;

                // check is_front_page
                // @link https://codex.wordpress.org/Conditional_Tags#The_Front_Page
                case 'is_front_page' :
                // check is_singular
                // @link https://codex.wordpress.org/Conditional_Tags#A_Post_Type
                case 'is_singular' :
                // check is_archive
                // @link https://codex.wordpress.org/Conditional_Tags#Any_Archive_Page
                case 'is_archive' :
                // check is_search
                // @link https://codex.wordpress.org/Conditional_Tags#A_Search_Result_Page
                case 'is_search' :
                // check is_404
                // @link https://codex.wordpress.org/Conditional_Tags#A_404_Not_Found_Page
                case 'is_404' :
                // check is_attachment
                // @link https://codex.wordpress.org/Conditional_Tags#An_Attachment
                case 'is_attachment' :
                    if ( $_cond_value == 0 && isset( $query[ $_cond_key ] ) && $query[ $_cond_key ] ) {
                        return false;
                    }
                    break;
                // check !is_main_query
                // @link https://codex.wordpress.org/Function_Reference/is_main_query
                case 'is_main_query' :
                    // the usage is reversed for this: if this is not main query reject when off
                    if ( $_cond_value == 0 && isset( $query[ $_cond_key ] ) && ! $query[ $_cond_key ] ) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }
}
