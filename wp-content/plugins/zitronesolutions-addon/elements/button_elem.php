<?php
if (!class_exists('ZS_ELEM_BUTTON')) {
    class ZS_ELEM_BUTTON extends ZITRONESOLUTIONS_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'zs_button_init'));
            add_shortcode('tek_button', array($this, 'zs_button_shrt'));
        }
        // VC Elements render in admin

        function zs_button_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Button", "zitronesolutions"),
                    "description" => esc_html__("Call to action button with extensive settings.", "zitronesolutions"),
                    "base" => "tek_button",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/button.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button icon settings", "zitronesolutions"),
                            "param_name" => "button_icon_bool",
                            "value" => array(
                                "Display icon" 	=> "yes",
                                "No icon" 		=> "no"
                            ),
                            "description" => esc_html__("Choose to display icon or not.", "zitronesolutions")
                        ),
                         array(
                             "type" => "iconpicker",
                             "class" => "",
                             "heading" => esc_html__("Icon database:", "zitronesolutions"),
                             "param_name" => "icons",
                             "dependency" => array(
                                 "element"  => "button_icon_bool",
                                 "value"    => array("yes")
                                 ),
                             "description" => esc_html__("Select your icon.", "zitronesolutions")
                         ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button icon position", "zitronesolutions"),
                            "param_name" => "button_icon_position",
                            "value" => array(
                                "Left" 	=> "button-left",
                                "Right" => "button-right"
                            ),
                            "description" => esc_html__("Choose icon position inside the button.", "zitronesolutions"),
                            "dependency" =>	array("element" => "button_icon_bool", "value"	=> array( "yes" )),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "zitronesolutions"),
                            "param_name" => "button_text",
                            "admin_label" => true,
                            "value" => "",
                            "description" => esc_html__("Enter button text.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Secondary button text", "zitronesolutions"),
                            "param_name" => "button_sec_text",
                            "value" => "",
                            "description" => esc_html__("This text will be displayed above the primary button text.", "zitronesolutions")
                        ),
                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Link settings", "zitronesolutions"),
            							 "param_name" => "button_link",
            							 "value" => "",
            							 "description" => esc_html__("Set link address and target.", "zitronesolutions"),
            						),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button width", "zitronesolutions"),
                            "param_name" => "button_width",
                            "value" => "",
                            "description" => esc_html__("Button width in pixels", "zitronesolutions")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button Style", "zitronesolutions"),
                            "param_name" => "button_style",
                            "value" => array(
                                "Primary Color"  => "",
                                "Secondary Color"       => "tt_secondary_button"
                            ),
                            "description" => esc_html__("Choose button style", "zitronesolutions")
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
                            "description" => esc_html__("Enter animation delay in ms", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "button_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }

        // Render the element on front-end
        public function zs_button_shrt($atts, $content = null)
        {
			$output = $icons = $link_target = $link_title = $button_link = $second_style = $animation_delay = '';

            extract(shortcode_atts(array(
                'button_icon_bool' 			      => 'yes',
                'icons' 					            => '',
                'button_icon_position' 		    => '',
                'button_target' 		        	=> '_self',
                'button_text' 				        => '',
                'button_sec_text' 			      => '',
                'button_link'                 => '',
                'button_style'                => '',
                'button_width' 				        => '',
                'css_animation'	              => '',
                'elem_animation_delay'        => '',
                'button_extra_class' 		      => '',
            ), $atts));

            $href = vc_build_link($button_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (trim($href['target']) !== '') ? ' target="' . trim($href['target']) . '"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}


            if(!empty($button_sec_text)) {
                $second_style = "second-style";
            } else {
                $second_style = "";
            }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            if ($button_icon_position == 'button-right') {
                $output .= '<a '.(!empty($button_width) ? 'style="width: '.$button_width.'px;"' : '').' href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$button_icon_position.' '.$button_style.' '.$second_style.' '.$css_animation.' '.$button_extra_class.'" '.$animation_delay.'>';
                if(!empty($button_sec_text)) {
                    $output .= '<span class="sec_text">'.$button_sec_text.'</span>';
                }
                $output .= '<span class="prim_text">'.$button_text.'</span>';
                if ($button_icon_bool == "yes") {
                    $output .= '<span class="'.$icons.' iconita"></span>';
                }
                $output .= '</a>';
            }
            else {
                $output .= '<a '.(!empty($button_width) ? 'style="width: '.$button_width.'px;"' : '').' href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$button_style.' '.$second_style.' '.$css_animation.' '.$button_extra_class.'" '.$animation_delay.'>';
                if ($button_icon_bool == "yes") {
                    $output .= '<span class="'.$icons.' iconita"></span>';
                }
                if(!empty($button_sec_text)) {
                    $output .= '<span class="sec_text">'.$button_sec_text.'</span>';
                }
                $output .= '<span class="prim_text">'.$button_text.'</span>';
                $output .= '</a>';
            }


            return $output;
        }
    }
}

if (class_exists('ZS_ELEM_BUTTON')) {
    $ZS_ELEM_BUTTON = new ZS_ELEM_BUTTON;
}
?>
