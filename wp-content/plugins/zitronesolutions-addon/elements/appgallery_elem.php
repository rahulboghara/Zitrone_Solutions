<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_appgallery extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_appgallery_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_appgallery')) {
    class tek_appgallery extends ZITRONESOLUTIONS_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'zs_appgallery_init'));
            add_shortcode('tek_appgallery', array($this, 'zs_appgallery_container'));
            add_shortcode('tek_appgallery_single', array($this, 'zs_appgallery_single'));
        }
        // Element configuration in admin
        function zs_appgallery_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("App gallery", "zitronesolutions"),
                    "description" => esc_html__("Mobile app screenshots carousel.", "zitronesolutions"),
                    "base" => "tek_appgallery",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_appgallery_single'),
                    "icon" => plugins_url('assets/element_icons/app-gallery.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Section title", "zitronesolutions"),
                            "param_name" => "ag_title",
                            "value" => "",
                            "description" => esc_html__("Enter section title here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Section description", "zitronesolutions"),
                            "param_name" => "ag_description",
                            "value" => "",
                            "description" => esc_html__("Enter section description here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Upload mockup", "zitronesolutions"),
                            "param_name" => "ag_mockup",
                            "description" => esc_html__("Upload container mockup.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "ag_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("App screenshot", "zitronesolutions"),
                    "base" => "tek_appgallery_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_appgallery'),
                    "icon" => plugins_url('assets/element_icons/child-image.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Upload image", "zitronesolutions"),
                            "param_name" => "ag_screenshot",
                            "admin_label" => true,
                            "description" => esc_html__("Upload mobile app screenshot.", "zitronesolutions")
                        )
                    )
                ));
            }
        }

        public function zs_appgallery_container($atts, $content = null) {
            extract(shortcode_atts(array(
                    'ag_title'                  => '',
                    'ag_description'            => '',
                    'ag_mockup'                 => '',
                    'ag_extra_class'            => ''
                ), $atts));

            $mockup_image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $ag_mockup,
                'thumb_size' => 'full',
                'class' => ""
            ));
            $output = '
            <div class="app-gallery ag-parent '.$ag_extra_class.'">
                <div class="ag-section-desc">
                    <h4>'.$ag_title.'</h4>
                    <p>'.$ag_description.'</p>
                </div>
                <div class="ag-mockup">'.$mockup_image['thumbnail'].'</div>
                <div class="ag-slider">'.do_shortcode($content).'</div>
            </div>';
            return $output;
        }

        public function zs_appgallery_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'ag_screenshot'          => ''
            ), $atts));

            $ss_image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $ag_screenshot,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $output = '<div class="ag-slider-child">
                        '.$ss_image['thumbnail'].'
                      </div>';
            return $output;
        }
    }
}
if (class_exists('tek_appgallery')) {
    $tek_appgallery = new tek_appgallery;
}
?>
