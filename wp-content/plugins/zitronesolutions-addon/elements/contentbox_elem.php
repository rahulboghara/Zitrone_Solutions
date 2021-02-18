<?php

if (!class_exists('ZS_ELEM_CONTENT_BOX')) {

    class ZS_ELEM_CONTENT_BOX extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_contentbox_init'));
            add_shortcode('tek_contentbox', array($this, 'zs_contentbox_shrt'));
        }

        // Element configuration in admin

        function zs_contentbox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Content Box", "zitronesolutions"),
                    "description" => esc_html__("Content box with icon or custom image.", "zitronesolutions"),
                    "base" => "tek_contentbox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/content-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","zitronesolutions"),
                            "param_name"	=>	"icon_type",
                            "value"			=>	array(
                                "Icon Browser" => "icon_browser",
                                "Custom Icon" => "custom_icon",
                            ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select icon source.", "zitronesolutions")
                        ),

                        array(
                    				"type" => "dropdown",
                    				"heading" => esc_html__( "Icon library", "zitronesolutions" ),
                    				"value" => array(
                      					esc_html__( "Font Awesome", "zitronesolutions" ) => "fontawesome",
                      					esc_html__( "Linecons", "zitronesolutions" ) => "linecons",
                    				),
                    				"param_name" => "icon_library",
                            "dependency" =>	array(
                                "element" => "icon_type",
                                "value" => array("icon_browser")
                            ),
                    				"description" => esc_html__( "Select icon library.", "zitronesolutions" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_fontawesome",
                      				"settings" => array(
					                        "iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                        					"element" => "icon_library",
                        					"value" => "fontawesome",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),
                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_linecons",
                      				"settings" => array(
                        					"type" => "linecons",
                        					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                        					"element" => "icon_library",
                        					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image icon", "zitronesolutions"),
                            "param_name" => "icon_img",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "icon_type",
                                "value" => array("custom_icon"),
                            ),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box title", "zitronesolutions"),
                            "param_name" => "cb_title",
                            "value" => "",
                            "description" => esc_html__("Enter a box title text.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box subtitle", "zitronesolutions"),
                            "param_name" => "cb_subtitle",
                            "value" => "",
                            "description" => esc_html__("Enter a box subtitle text.", "zitronesolutions")
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Box content text", "zitronesolutions"),
                            "param_name" => "cb_content_text",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "zitronesolutions")
                        ),

                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Box link type", "zitronesolutions"),
                             "param_name" => "cb_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'zitronesolutions' ) => '#',
                                    esc_html__( 'Button link', 'zitronesolutions' )	=> 'box-button-link',
                                    esc_html__( 'Full box link', 'zitronesolutions' )	=> 'box-link',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add or remove the custom link.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "cb_box_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "cb_custom_link",
                                "value"	=> array( "box-button-link", "box-link" ),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "cb_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "cb_custom_link",
                               "value"	=> array( "box-button-link" ),
                           ),
                        ),

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("CSS Animation", "zitronesolutions"),
                            "param_name" => "css_animation",
                            "value" => array(
                                "No"              => "no_animation",
                                "Fade In"         => "zs-animated fadeIn",
                                "Fade In Down"    => "zs-animated fadeInDown",
                                "Fade In Left"    => "zs-animated fadeInLeft",
                                "Fade In Right"   => "zs-animated fadeInRight",
                                "Fade In Up"      => "zs-animated fadeInUp",
                                "Zoom In"         => "zs-animated zoomIn",
                            ),
                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "zitronesolutions"),
                         ),

                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Animation Delay:", "zitronesolutions"),
                            "param_name" => "elem_animation_delay",
                            "value" => array(
                                  "0s"              => "",
                                  "0.2s"            => "200",
                                  "0.4s"            => "400",
                                  "0.6s"            => "600",
                                  "0.8s"            => "800",
                                  "1s"              => "1000",
                            ),
                            "dependency" => array(
                                  "element" => "css_animation",
                                  "value" => array ("zs-animated fadeIn", "zs-animated fadeInDown", "zs-animated fadeInLeft", "zs-animated fadeInRight", "zs-animated fadeInUp", "zs-animated zoomIn"),
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "cb_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_contentbox_shrt($atts, $content = null)
        {
            // Declare empty vars
            $output = $content_icon = $cb_img_array = $animation_delay = $icons = $href = $link_target = $link_title = '';

            extract(shortcode_atts(array(
                'icon_type'		                          => '',
                'icon_library'                          => '',
                'icon_fontawesome' 			                => '',
                'icon_linecons' 			                  => '',
                'icon_img'			                        => '',
                'cb_title'			                        => '',
                'cb_subtitle'			                      => '',
                'cb_content_text'			                  => '',
                'cb_custom_link'                        => '',
                'cb_box_link'                           => '',
                'cb_button_text'                        => '',
                'css_animation'                         => '',
                'elem_animation_delay'                  => '',
                'cb_extra_class'		                    => ''
            ), $atts));

            if( $icon_type == 'icon_browser' ) {
              // Enqueue needed icon font.
              vc_icon_element_fonts_enqueue( $icon_library );

              if (strlen($icon_fontawesome) > 0) {
                  $icons = $icon_fontawesome;
              } elseif (strlen($icon_linecons) > 0) {
                  $icons = $icon_linecons;
              }
            }

            if( $icon_type == 'icon_browser' && !empty($icons) ) {
      				$content_icon = '<i class="'.$icons .' fa"></i> ';
      			}
      			elseif($icon_type == 'custom_icon' && !empty($icon_img)){
      				$cb_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_icon = '<div class="cb-customimg">'.$cb_img_array['thumbnail'].'</div>';
      			}

            $href = vc_build_link($cb_box_link);
      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
      				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            if ($cb_custom_link == "box-link") {
              $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
            }
            $output .= '<div class="cb-container '.$css_animation.' '.$cb_extra_class.'" '.$animation_delay.'>';
                $output .= '<div class="cb-img-area">'.$content_icon.'</div>
                <div class="cb-text-area">
                    <h4 class="cb-heading"><span class="cb-highlighted">'.$cb_title.'</span>'.$cb_subtitle.'</h4>
                    <p>'.$cb_content_text.'</p>';
                    if ($cb_custom_link == "box-button-link") {
                        $output .= '<div class="cb-btncontainer">
                            <a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="cb-button">'.$cb_button_text.'</a>
                        </div>';
                    }
                $output .= '</div>';
            $output .= '</div>';
            if ($cb_custom_link == "box-link") {
                $output .= '</a>';
            }

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_CONTENT_BOX')) {
    $ZS_ELEM_CONTENT_BOX = new ZS_ELEM_CONTENT_BOX;
}

?>
