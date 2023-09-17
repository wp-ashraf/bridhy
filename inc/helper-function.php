<?php

/**
 * Get Pages
 *
 * @since 1.0
 *
 * @return array
 */


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'stor_woocommerce_header_add_to_cart_fragment');

function stor_woocommerce_header_add_to_cart_fragment($fragments)
{

    ob_start();

?>
     <span class="cart-contents"><?php if ( !is_null(WC()->cart) ) {
         echo WC()->cart->get_cart_contents_count();
     } ?></span>

<?php
    $fragments['.cart-contents'] = ob_get_clean();
    return $fragments;
}





if ( ! function_exists( 'fbth_get_all_pages' ) ) {
    function fbth_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );

        $page_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return  $page_list;
    }
}

/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'fbth_get_meta' ) ) {
    function fbth_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

/**
 * Get a list of all CF7 forms
 *
 * @return array
 */
if ( ! function_exists( 'fbth_get_cf7_forms' ) ) {
    function fbth_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}
 /**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( ! function_exists( 'fbth_is_cf7_activated' ) ) {

    function fbth_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}

if ( ! function_exists( 'fbth_do_shortcode' ) ) {
    function fbth_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( ! isset( $shortcode_tags[ $tag ] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
    }
}

function fbth_layout_content( $post_id ) {

    return Elementor\Plugin::instance()->frontend->get_builder_content( $post_id, true );
}

function fbth_cpt_slug_and_id( $post_type ) {
    $the_query = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ) );
    $cpt_posts = [];
    while ( $the_query->have_posts() ): $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}

/**
 * Strip all the tags except allowed html tags
 */

function scalo_kses_basic( $string = '' ) {
	return wp_kses( $string, scalo_get_allowed_html_tags( 'basic' ) );
}

function scalo_get_allowed_html_tags( $level = 'basic' ) {
	$allowed_html = [
		'b' => [],
		'i' => [],
		'u' => [],
		's' => [],
		'br' => [],
		'em' => [],
		'del' => [],
		'ins' => [],
		'sub' => [],
		'sup' => [],
		'code' => [],
		'mark' => [],
		'small' => [],
		'strike' => [],
		'abbr' => [
			'title' => [],
		],
		'span' => [
			'class' => [],
		],
		'strong' => [],
	];
	return $allowed_html;
}


//  Blog post helper function 




/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_cpt_taxonomy_slug_and_name')) {

    function fbth_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
}

if (!function_exists('fbth_cpt_taxonomy_id_and_name')) {
    function fbth_cpt_taxonomy_id_and_name($taxonomy_name)
    {
        $taxonomyies = get_terms($taxonomy_name);
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            $cpt_terms[$category->term_id] = $category->name;
        }
        return $cpt_terms;
    }
}

if (!function_exists('fbth_cpt_author_slug_and_id')) {
    function fbth_cpt_author_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $author_meta = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
        endwhile;
        wp_reset_postdata();
        return array_unique($author_meta);
    }
}

if (!function_exists('fbth_cpt_slug_and_id')) {
    function fbth_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
}

if (!function_exists('fbth_get_meta_field_keys')) {

    function fbth_get_meta_field_keys($post_type, $field_name, $fild_type = "choices")
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => 1,
            'post_type' => $post_type,
        ));

        $field_object = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $field_object = get_field_object($field_name)[$fild_type];
        endwhile;
        return $field_object;
        wp_reset_postdata();
    }
}

/**
 * Post orderby list
 */
if (!function_exists('fbth_get_post_orderby_options')) {
    function fbth_get_post_orderby_options()
    {
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
        $orderby = apply_filters('it_post_orderby', $orderby);
        return $orderby;
    }
}

/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_get_all_posts')) {
    function fbth_get_all_posts($posttype)
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $post_list = array();
        if ($data = get_posts($args)) {
            foreach ($data as $key) {
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}

/**
 * Get Author list
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('fbth_get_authors')) {
    function fbth_get_authors()
    {
        $user_query = new \WP_User_Query(
            [
                'who' => 'authors',
                'has_published_posts' => true,
                'fields' => [
                    'ID',
                    'display_name',
                ],
            ]
        );
        $authors = [];
        foreach ($user_query->get_results() as $result) {
            $authors[$result->ID] = $result->display_name;
        }
        return $authors;
    }
}

/* FBTH Blog Post widget */

function fbth_get_current_user_display_name()
{
    $user = wp_get_current_user();
    $name = 'user';
    if ($user->exists() && $user->display_name) {
        $name = $user->display_name;
    }
    return $name;
}

function fbth_addons_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if (true == $option_tag) {
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' . $category->name . '</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if (isset($category->slug) && isset($category->name)) {
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}
function fbth_addons_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}
function fbth_addons_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}


if (!function_exists('fbth_addons_comment_count')) :
    /**
     * Comment count
     */
    function fbth_addons_comment_count($clabel = 'Comment', $icon = '')
    {
        if (post_password_required() || !(comments_open() || get_comments_number())) {
            return;
        }
        ob_start();
?>
        <span class="fbth-addons-comment">
            <a href="<?php comments_link(); ?>">
                <span><?php  printf($icon) ?> <?php comments_number('0', '1', '%'); ?> <?php printf( $clabel) ?></span>
            </a>
        </span>


<?php
        return ob_get_clean();
    }
endif;
if (!function_exists('fbth_addons_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function fbth_addons_posted_by($label = 'by')
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('%s', 'post author', 'fbth-addons'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        return '<span class="byline"> ' . $label . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;
if (!function_exists('fbth_addons_posted_date')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function fbth_addons_posted_date($icon = '')
    {
        $date_html = sprintf('<span class="post-date"> %s %s</span>', $icon, get_the_date());
        return $date_html;
    }
endif;
if (!function_exists('fbth_addons_posted_category')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function fbth_addons_posted_category($icon = '')
    {
        $post_cat = get_the_terms(get_the_ID(), 'category');
        $post_cat = join(', ', wp_list_pluck($post_cat, 'name'));
        $post_category = sprintf('<span class="category-list"> %s %s</span>', $icon, $post_cat);
        return $post_category;
    }
endif;
if (!function_exists('fbth_cpt_slug_and_id')) :
    function fbth_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
endif;
if (!function_exists('fbth_cpt_taxonomy_slug_and_name')) :
    function fbth_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
endif;
