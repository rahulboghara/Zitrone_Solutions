<?php

if (!class_exists('ZS_ELEM_CALL_TO_ACTION')) {

    class ZS_ELEM_CALL_TO_ACTION extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_calltoaction_init'));
            add_shortcode('tek_calltoaction', array($this, 'zs_calltoaction_shrt'));
        }

        // Element configuration in admin

        function zs_calltoaction_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Call to Action Box", "zitronesolutions"),
                    "description" => esc_html__("Call to action section with button.", "zitronesolutions"),
                    "base" => "tek_calltoaction",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/calltoaction-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","zitronesolutions"),
                            "param_name"	=>	"cta_icon_type",
                            "value"			=>	array(
                                    "No" => "no_icon",
                                    "Icon Browser" => "icon_browser",
                                    "Custom Icon" => "custom_image",
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
                      					esc_html__( "Mono Social", "zitronesolutions" ) => "monosocial",
                    				),
                    				"param_name" => "icon_library",
                            "dependency" =>	array(
                                "element" => "cta_icon_type",
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
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_monosocial",
                      				"settings" => array(
                          					"type" => "monosocial",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "icon_library",
                          					"value" => "monosocial",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "zitronesolutions"),
                            "param_name" => "cta_icon_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "cta_icon_type",
                                "value" => array("icon_browser")
                            ),
                            "description" => esc_html__("Select icon color.", "zitronesolutions")
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload custom image", "zitronesolutions"),
                            "param_name" => "cta_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "cta_icon_type",
                                "value" => array("custom_image"),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Title", "zitronesolutions"),
                            "param_name" => "cta_title",
                            "value" => "",
                            "description" => esc_html__("Enter call to action title here.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Subtitle", "zitronesolutions"),
                            "param_name" => "cta_subtitle",
                            "value" => "",
                            "description" => esc_html__("This text will be displayed under the title.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Title color", "zitronesolutions"),
                            "param_name" => "cta_text_color",
                            "value" => "",
                            "description" => esc_html__("Select title color.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Subtitle color", "zitronesolutions"),
                            "param_name" => "cta_subtitle_color",
                            "value" => "",
                            "description" => esc_html__("Select subtitle color.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Box color", "zitronesolutions"),
                            "param_name" => "cta_box_color",
                            "value" => "",
                            "description" => esc_html__("Choose box color.", "zitronesolutions")
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Button link", "zitronesolutions"),
                             "param_name" => "cta_button_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "cta_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "zitronesolutions")
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Button style","zitronesolutions"),
                            "param_name"	=>	"cta_button_style",
                            "value"			=>	array(
                                    "Primary color" => "tt_primary_button",
                                    "Secondary color" => "tt_secondary_button"
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select button color style.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "cta_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_calltoaction_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'cta_icon_type' => '',
                'icon_library' => '',
                'icon_fontawesome' => '',
                'icon_linecons' => '',
                'icon_monosocial' => '',
                'cta_icon_color' => '',
                'cta_image' => '',
                'cta_title' => '',
                'cta_subtitle'=> '',
                'cta_text_color' => '',
                'cta_subtitle_color' => '',
                'cta_box_color' => '',
                'cta_button_link' => '',
                'cta_button_text' => '',
                'cta_button_style' => '',
                'cta_extra_class' => '',
            ), $atts));

            $content_icon = $cta_img_array = $href = $link_target = $link_title = '';

            // Enqueue needed icon font.
            vc_icon_element_fonts_enqueue( $icon_library );

            if (strlen($icon_fontawesome) > 0) {
                $cta_icon = $icon_fontawesome;
            } elseif (strlen($icon_linecons) > 0) {
                $cta_icon = $icon_linecons;
            } elseif (strlen($icon_monosocial) > 0) {
                $cta_icon = $icon_monosocial;
            }

            if( $cta_icon_type == 'icon_browser' && !empty($cta_icon) ) {
		            $content_icon = '<i class="'.$cta_icon.' fa" '.(!empty($cta_icon_color) ? 'style="color: '.$cta_icon_color.';"' : '').'></i> ';
			      }
      			elseif($cta_icon_type == 'custom_image' && !empty($cta_image)){
        				$cta_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $cta_image, 'thumb_size' => 'full', 'class' => "" ) );
        				$content_icon = $cta_img_array['thumbnail'];
      			}

            $href = vc_build_link($cta_button_link);
      			if($href['url'] !== '') {
                $link_target = (trim($href['target']) !== '') ? ' target="' . trim($href['target']) . '"' : 'target="_self"';
        				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            $output = '<div class="zs-calltoaction '.$cta_icon_type.' '.$cta_extra_class.'" style="background-color: '.$cta_box_color.';">
                <div class="container">';
                if ($cta_icon_type != "no_icon") {
                    $output .= '<div class="cta-icon">'.$content_icon.'</div>';
                }
                    $output .= '<div class="cta-text">
                        <h4 '.(!empty($cta_text_color) ? 'style="color: '.$cta_text_color.';"' : '').'>'.$cta_title.'</h4>
                        <p '.(!empty($cta_subtitle_color) ? 'style="color: '.$cta_subtitle_color.';"' : '').'>'.$cta_subtitle.'</p>
                    </div>
                    <div class="cta-btncontainer">
                        <a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$cta_button_style.' zs-animated zoomIn" data-animation-delay="200">'.$cta_button_text.'</a>
                    </div>
                </div>
            </div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_CALL_TO_ACTION')) {
    $ZS_ELEM_CALL_TO_ACTION = new ZS_ELEM_CALL_TO_ACTION;
}

?>
