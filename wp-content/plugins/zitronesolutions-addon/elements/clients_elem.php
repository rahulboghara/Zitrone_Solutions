<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_clients extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_clients_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_clients')) {
    class tek_clients extends ZITRONESOLUTIONS_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'zs_clients_init'));
            add_shortcode('tek_clients', array($this, 'zs_clients_container'));
            add_shortcode('tek_clients_single', array($this, 'zs_clients_single'));
        }
        // Element configuration in admin
        function zs_clients_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Logo carousel", "zitronesolutions"),
                    "description" => esc_html__("Carousel with images.", "zitronesolutions"),
                    "base" => "tek_clients",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_clients_single'),
                    "icon" => plugins_url('assets/element_icons/logo-carousel.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","zitronesolutions"),
                            "param_name"    =>  "client_autoplay",
                            "value"         =>  array(
                                    "Off"   => "auto_off",
                                    "On"    => "auto_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Carousel autoplay settings.", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Autoplay speed","zitronesolutions"),
                            "param_name"    =>  "client_autoplay_speed",
                            "value"         =>  array(
                                    "10s"   => "10000",
                                    "9s"   => "9000",
                                    "8s"   => "8000",
                                    "7s"   => "7000",
                                    "6s"   => "6000",
                                    "5s"   => "5000",
                                    "4s"   => "4000",
                                    "3s"   => "3000",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "client_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","zitronesolutions"),
                            "param_name"    =>  "client_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"    => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "client_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description" => esc_html__("Stop sliding carousel on mouse over.", "zitronesolutions")
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Image hover animation", "zitronesolutions"),
                             "param_name" => "client_image_animation",
                             "value" =>	array(
                                    esc_html__( 'None', 'zitronesolutions' ) => 'no-effect',
                                    esc_html__( 'Opacity', 'zitronesolutions' )	=> 'opacity-effect',
                                    esc_html__( 'Gray scale', 'zitronesolutions' )	=> 'grayscale-effect',
                                    esc_html__( 'Zoom in', 'zitronesolutions' )	=> 'zoomin-effect',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("Choose image animation on mouse over.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "client_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        )
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => __("Child image", "zitronesolutions"),
                    "base" => "tek_clients_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_clients'),
                    "icon" => plugins_url('assets/element_icons/child-image.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "vc_link",
	                          "class" => "",
                            "heading" => esc_html__("Image link", "zitronesolutions"),
                            "param_name" => "client_link",
                            "description" => esc_html__("Image link", "zitronesolutions")
                        ),
                        array(
                            "type" => "attach_image",
		                        "class" => "",
                            "heading" => esc_html__("Upload image", "zitronesolutions"),
                            "param_name" => "client_image",
                            "admin_label" => true,
                            "description" => esc_html__("Upload new image here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Image size", "zitronesolutions"),
                            "param_name" => "client_thumb_size",
                            "value" => "",
                            "description" => esc_html__("Enter image size (Example: \"thumbnail\", \"medium\", \"large\", \"full\" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).", "zitronesolutions")
                        ),
                    )
                ));
            }
        }

        public function zs_clients_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'client_autoplay'                    => '',
                'client_autoplay_speed'              => '',
                'client_stoponhover'                 => '',
                'client_image_animation'             => '',
                'client_extra_class'                 => '',
            ), $atts));

            $output = '';

            $zs_clientunique_id = "zs-client-".uniqid();

            $output = '<div class="slider clients '.$client_image_animation.' '.$zs_clientunique_id.' '.$client_extra_class.'">'.do_shortcode($content).'</div>';

            $output .= '<script type="text/javascript">
              jQuery(document).ready(function($){
                if ($(".slider.clients.'.$zs_clientunique_id.'").length) {
                  $(".slider.clients.'.$zs_clientunique_id.'").owlCarousel({
                    navigation: false,
                    pagination: false,';

                    if($client_autoplay == "auto_on" && $client_autoplay_speed !== "") {
                      $output .= 'autoPlay: '.$client_autoplay_speed.',';
                    } else {
                      $output .= 'autoPlay: false,';
                    }

                    if($client_autoplay == "auto_on" && $client_stoponhover == "hover_on") {
                      $output .= 'stopOnHover: true,';
                    } else {
                      $output .= 'stopOnHover: false,';
                    }

                    $output .='
                    items: 6,
                    addClassActive: true,
                  });
                }
              });
            </script>';

            return $output;
        }

        public function zs_clients_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'client_link' => '',
                'client_image' => '',
                'client_thumb_size' => '',
            ), $atts));

			$href_logo = $link_target = $link_title = '';

      if ( ! $client_thumb_size ) {
        $client_thumb_size = 'full';
      }

			$href_logo = vc_build_link($client_link);
			if($href_logo['url'] !== '') {
				$link_target = (isset($href_logo['target'])) ? 'target="'.$href_logo['target'].'"' : '';
				$link_title = (isset($href_logo['title'])) ? 'title="'.$href_logo['title'].'"' : '';
			}

      $image  = wpb_getImageBySize($params = array(
          'post_id' => NULL,
          'attach_id' => $client_image,
          'thumb_size' => $client_thumb_size,
          'class' => ""
      ));

      $output = '<h6 class="clients-content">';
				if(isset($client_link) && $client_link !== '') {
					$output .='<a href="'.$href_logo['url'].'"'.$link_target.''.$link_title.'>'.$image['thumbnail'].'</a>';
				} else {
					$output .= $image['thumbnail'];
				}
		    $output .= '</h6>';
            return $output;
        }
    }
}
if (class_exists('tek_clients')) {
    $tek_clients = new tek_clients;
}
?>
