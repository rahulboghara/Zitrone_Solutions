<?php
// ------------------------------------------------------------------------
// Register widgetized areas
// ------------------------------------------------------------------------
    function zitronesolutions_sidebars_register() {
		register_sidebar( array(
            'name' => esc_html__( 'Blog Sidebar', 'zitronesolutions' ),
            'id' => 'blog-sidebar',
            'description' => esc_html__( 'Add widgets for the blog sidebar area. If none added, default sidebar widgets will be used.', 'zitronesolutions' ),
            'before_widget' => '<div class="blog_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );
        register_sidebar( array(
            'name' => esc_html__( 'Shop Sidebar', 'zitronesolutions' ),
            'id' => 'shop-sidebar',
            'description' => esc_html__( 'Add widgets for the shop sidebar area.', 'zitronesolutions' ),
            'before_widget' => '<div class="blog_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Footer first widget area', 'zitronesolutions' ),
            'id' => 'footer-first-widget-area',
            'description' => esc_html__( 'Add one widget for the first footer widget area.', 'zitronesolutions' ),
            'before_widget' => '<div class="footer_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Footer second widget area', 'zitronesolutions' ),
            'id' => 'footer-second-widget-area',
            'description' => esc_html__( 'Add one widget for the second footer widget area.', 'zitronesolutions' ),
            'before_widget' => '<div class="footer_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Footer third widget area', 'zitronesolutions' ),
            'id' => 'footer-third-widget-area',
            'description' => esc_html__( 'Add one widget for the third footer widget area.', 'zitronesolutions' ),
            'before_widget' => '<div class="footer_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Footer fourth widget area', 'zitronesolutions' ),
            'id' => 'footer-fourth-widget-area',
            'description' => esc_html__( 'Add one widget for the fourth footer widget area.', 'zitronesolutions' ),
            'before_widget' => '<div class="footer_widget">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5>',
        ) );
    }

    add_action( 'widgets_init', 'zitronesolutions_sidebars_register' );
?>
