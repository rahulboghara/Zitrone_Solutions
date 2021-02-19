<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_process extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_process_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_process')) {
    class tek_process extends ZITRONESOLUTIONS_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'zs_process_init'));
            add_shortcode('tek_process', array($this, 'zs_process_container'));
            add_shortcode('tek_process_single', array($this, 'zs_process_single'));
        }
        // Element configuration in admin
        function zs_process_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Process steps", "zitronesolutions"),
                    "description" => esc_html__("Process builder with 3 to 5 steps.", "zitronesolutions"),
                    "base" => "tek_process",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_process_single'),
                    "icon" => plugins_url('assets/element_icons/process-steps.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Number of elements","zitronesolutions"),
                            "param_name"	=>	"ps_elements",
                            "value"			=>	array(
                                    "Three elements" => "process_three_elem",
                                    "Four elements" => "process_four_elem",
                                    "Five elements" => "process_five_elem"
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Select number of elements in this process.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "ps_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Single process step", "zitronesolutions"),
                    "base" => "tek_process_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_process'),
                    "icon" => plugins_url('assets/element_icons/child-tabs.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Step number", "zitronesolutions"),
                            "param_name" => "pss_number",
                            "value" => "",
                            "description" => esc_html__("Enter the step number.", "zitronesolutions")
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","zitronesolutions"),
                            "param_name"	=>	"pss_icon_type",
                            "value"			=>	array(
                                    "Icon browser" => "icon_browser",
                                    "Custom image" => "custom_image",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Select icon source.", "zitronesolutions")
                        ),
                        array(
                    				"type" => "dropdown",
                    				"heading" => esc_html__( "Icon library", "zitronesolutions" ),
                    				"value" => array(
                      					esc_html__( "Font Awesome", "zitronesolutions" ) => "fontawesome",
                      					esc_html__( "Linecons", "zitronesolutions" ) => "linecons",
                    				),
                    				"param_name" => "pss_icon_library",
                            "dependency" =>	array(
                                "element" => "pss_icon_type",
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
                      					"element" => "pss_icon_library",
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
                          					"element" => "pss_icon_library",
                          					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "zitronesolutions"),
                            "param_name" => "pss_icon_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "pss_icon_type",
                                "value" => array("icon_browser")
                            ),
                            "description" => esc_html__("Choose icon color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image", "zitronesolutions"),
                            "param_name" => "pss_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "pss_icon_type",
                                "value" => array("custom_image"),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Title", "zitronesolutions"),
                            "param_name" => "pss_title",
		                        "admin_label" => true,
                            "value" => "",
                            "description" => esc_html__("Enter step title.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Title color", "zitronesolutions"),
                            "param_name" => "pss_title_color",
                            "value" => "",
                            "description" => esc_html__("Choose title color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Description", "zitronesolutions"),
                            "param_name" => "pss_description",
                            "value" => "",
                            "description" => esc_html__("Enter step description.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Description color", "zitronesolutions"),
                            "param_name" => "pss_description_color",
                            "value" => "",
                            "description" => esc_html__("Choose title color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Link type", "zitronesolutions"),
                             "param_name" => "pss_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'zitronesolutions' ) => '#',
                                    esc_html__( 'Add a custom link', 'zitronesolutions' )	=> '1',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add/remove custom link", "zitronesolutions"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Link text", "zitronesolutions"),
                            "param_name" => "pss_link_text",
                            "value" => "",
                            "description" => esc_html__("Enter link text here.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "pss_custom_link",
                               "value"	=> array( "1" ),
                           ),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "pss_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "pss_custom_link",
                                "value"	=> array( "1" ),
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
                            "dependency" =>	array(
                                "element" => "css_animation",
                                "value" => array("zs-animated fadeIn", "zs-animated fadeInDown", "zs-animated fadeInLeft", "zs-animated fadeInRight", "zs-animated fadeInUp", "zs-animated zoomIn")
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "pss_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }

        public function zs_process_container($atts, $content = null) {
            extract(shortcode_atts(array(
                    'ps_elements'                   => '',
                    'ps_extra_class'                => ''
                ), $atts));

            $output = '
            <div class="zs-process-steps '.$ps_elements.' '.$ps_extra_class.'">
                <ul>'.do_shortcode($content).'</ul>
            </div>';
            return $output;
        }

        public function zs_process_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'pss_number'            => '',
                'pss_icon_type'         => '',
                'pss_icon_library'      => '',
                'icon_fontawesome' 			=> '',
                'icon_linecons' 			  => '',
                'pss_icon_color'        => '',
                'pss_image'             => '',
                'pss_title'             => '',
                'pss_title_color'       => '',
                'pss_description'       => '',
                'pss_description_color' => '',
                'pss_custom_link'       => '',
                'pss_link_text'         => '',
                'pss_link'              => '',
                'css_animation'         => '',
                'elem_animation_delay'  => '',
                'pss_extra_class'       => '',
            ), $atts));

            $content_icon = $link_title = $link_target = $pss_icon = $animation_delay = '';

            if( $pss_icon_type == 'icon_browser' ) {
              // Enqueue needed icon font.
              vc_icon_element_fonts_enqueue( $pss_icon_library );

              if (strlen($icon_fontawesome) > 0) {
                  $pss_icon = $icon_fontawesome;
              } elseif (strlen($icon_linecons) > 0) {
                  $pss_icon = $icon_linecons;
              }
            }

            $href = vc_build_link($pss_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}

            if( $pss_icon_type == 'icon_browser' && !empty($pss_icon) ) {
      				$content_icon = '<div class="process-icon"><i class="'.$pss_icon .' fa" '.(!empty($pss_icon_color) ? 'style="color: '.$pss_icon_color.';"' : '').'></i></div>';
      			}
      			elseif($pss_icon_type == 'custom_image' && !empty($pss_image)){
      				$ps_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $pss_image, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_icon = '<div class="process-customimg">'.$ps_img_array['thumbnail'].'</div>';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '
                <li>
                    <div class="pss-container '.$css_animation.' '.$pss_extra_class.'" '.$animation_delay.'>';
                        if ($pss_number) {
                          $output .= '<div class="pss-step-number"><span>'.$pss_number.'</span></div>';
                        }
                        $output .= '<div class="pss-img-area">'.$content_icon.'</div>
                        <div class="pss-text-area">
                            <h4 '.(!empty($pss_title_color) ? 'style="color: '.$pss_title_color.';"' : '').'>'.$pss_title.'</h4>
                            <p '.(!empty($pss_description_color) ? 'style="color: '.$pss_description_color.';"' : '').'>'.$pss_description.'</p>';
                            if ($pss_custom_link == "1") {
                              $output .= '<p class="pss-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$pss_link_text.'</a></p>';
                            }
                        $output .= '</div>
                    </div>
                </li>';
            return $output;
        }
    }
}
if (class_exists('tek_process')) {
    $tek_process = new tek_process;
}
?>
