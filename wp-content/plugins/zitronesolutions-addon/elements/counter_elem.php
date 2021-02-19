<?php

if (!class_exists('ZS_ELEM_COUNTER')) {

    class ZS_ELEM_COUNTER extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_counter_init'));
            add_shortcode('tek_counter', array($this, 'zs_counter_shrt'));
        }

        // Element configuration in admin

        function zs_counter_init() {

            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Counter", "zitronesolutions"),
                    "description" => esc_html__("Animated counter.", "zitronesolutions"),
                    "base" => "tek_counter",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/counter.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display icon","zitronesolutions"),
                            "param_name"	=>	"count_icon_type",
                            "value"			=>	array(
                                    "No" => "no_icon",
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
                      					esc_html__( "Mono Social", "zitronesolutions" ) => "monosocial",
                    				),
                    				"param_name" => "count_icon_library",
                            "dependency" =>	array(
                                "element" => "count_icon_type",
                                "value" => array("icon_browser")
                            ),
                    				"description" => esc_html__( "Select icon library.", "zitronesolutions" ),
          			        ),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_fontawesome",
                      				"settings" => array(
                  					     "emptyIcon" => false,
                  					     "iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                      					"element" => "count_icon_library",
                      					"value" => "fontawesome",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_linecons",
                      				"settings" => array(
                          					"emptyIcon" => false,
                          					"type" => "linecons",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "count_icon_library",
                          					"value" => "linecons",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),

                  			array(
                      				"type" => "iconpicker",
                      				"heading" => esc_html__( "Icon", "zitronesolutions" ),
                      				"param_name" => "icon_monosocial",
                      				"settings" => array(
                          					"emptyIcon" => false,
                          					"type" => "monosocial",
                          					"iconsPerPage" => 100,
                      				),
                      				"dependency" => array(
                          					"element" => "count_icon_library",
                          					"value" => "monosocial",
                      				),
                      				"description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                  			),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Icon color", "zitronesolutions"),
                            "param_name" => "count_icon_color",
                            "value" => "",
                            "dependency" =>	array(
                                "element" => "count_icon_type",
                                "value" => array("icon_browser")
                            ),
                            "description" => esc_html__("Choose counter description color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image icon", "zitronesolutions"),
                            "param_name" => "count_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                            "dependency" => array(
                                "element" => "count_icon_type",
                                "value" => array("custom_icon"),
                            ),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Counter Size", "zitronesolutions"),
                            "param_name"	=>	"count_size",
                            "value"			=>	array(
                                    "Normal"			=>	"normal-counter",
                                    "Large"			=>	"large-counter",
                                ),
                            "description"	=>	esc_html__("Select counter size","zitronesolutions"),
                            "save_always" 	=>	true,
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter number", "zitronesolutions"),
                            "param_name" => "count_number",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Only numerical values allowed.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter number color", "zitronesolutions"),
                            "param_name" => "count_number_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter number color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter units", "zitronesolutions"),
                            "param_name" => "count_units",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Ex: coffees, projects, clients.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter units color", "zitronesolutions"),
                            "param_name" => "count_units_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter units color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Counter description", "zitronesolutions"),
                            "param_name" => "count_description",
                            "value" => "",
                            "description" => esc_html__("This additional text will be displayed near the counter.", "zitronesolutions")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Counter description color", "zitronesolutions"),
                            "param_name" => "count_description_color",
                            "value" => "",
                            "description" => esc_html__("Choose counter description color. If none selected, the default theme color will be used.", "zitronesolutions"),
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
                           "param_name" => "count_extra_class",
                           "value" => "",
                           "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                       ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_counter_shrt($atts, $content = null)
        {

            // Include required JS files
    		wp_enqueue_script('zs_jquery_appear');
    		wp_enqueue_script('zs_countto');

            // Declare empty vars
            $output = $content_icon = $counter_id = $zs_counter_img_array = $js = $animation_delay = '';

            extract(shortcode_atts(array(
                'count_icon_type'                   => '',
                'count_icon_library'                => '',
                'icon_fontawesome' 			            => '',
                'icon_linecons' 			              => '',
                'icon_monosocial' 			            => '',
                'count_icon_color'                  => '',
                'count_image'                       => '',
                'count_size'          			        => '',
                'count_number'                      => '',
                'count_number_color'                => '',
                'count_units'                       => '',
                'count_units_color'                 => '',
                'count_description'                 => '',
                'count_description_color'           => '',
                'css_animation'                     => '',
                'elem_animation_delay'              => '',
                'count_extra_class'                 => '',
            ), $atts));

            // Enqueue needed icon font.
            vc_icon_element_fonts_enqueue( $count_icon_library );

            if (strlen($icon_fontawesome) > 0) {
                $count_icon = $icon_fontawesome;
            } elseif (strlen($icon_linecons) > 0) {
                $count_icon = $icon_linecons;
            } elseif (strlen($icon_monosocial) > 0) {
                $count_icon = $icon_monosocial;
            }

            $counter_id .= 'zs-counterelem-'.uniqid();
            $js = '<script type="text/javascript">
            				jQuery(document).ready(function() {
            					jQuery(function($) {
            						$(".'.$counter_id.'").appear(function() {
            							$(this).countTo();
            						});
            					});
            				});
            			</script>';

        		$output .= $js;

            if( $count_icon_type == 'icon_browser' && !empty($count_icon) ) {
      				$content_icon = '<div class="zs-counter-icon"><i class="'.$count_icon.' fa"></i></div>';
      			}	elseif($count_icon_type == 'custom_icon' && !empty($count_image)){
      				$zs_counter_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $count_image, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_icon = '<div class="zs-counter-customimg">'.$zs_counter_img_array['thumbnail'].'</div>';
    			  }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            switch($count_size){

      				case 'large-counter':
      					$output .= '<div class="zs_counter '. $count_size . (!empty($count_extra_class) ? $count_extra_class : '').' '.$css_animation.'" '.$animation_delay.'>';
      						$output .= '<div class="zs_counter_content">';
      							$output .= '<h4 class="zs_counter_number">';
      							$output .= '<span class="zs_number_string '.$counter_id.'" '.(!empty($count_number_color) ? 'style="color: '.$count_number_color.';"' : '').' data-from="0" data-to="'.$count_number.'" data-refresh-interval="50">0</span>
                                  <span class="zs_counter_units" '.(!empty($count_units_color) ? 'style="color: '.$count_units_color.';"' : '').'>'.$count_units.'</span>';
      							$output .= '</h4>';
      							$output .= '<div class="zs_counter_text" '.(!empty($count_description_color) ? 'style="color: '.$count_description_color.';"' : '').'>'.$count_description.'</div>';
      						$output .= '</div>';
      						if(!empty($content_icon)) {
      							$output .= '<div class="zs_counter_icon">';
      							$output .= $content_icon;
      							$output .= '</div>';
      						}
      					$output .= '</div>';
      				break;

      				case 'normal-counter':
      					$output .= '<div class="zs_counter '.(!empty($count_extra_class) ? $count_extra_class : '').' '.$css_animation.'" '.$animation_delay.'>';
      						$output .= '<div class="zs_counter_content">';
      								if(!empty($content_icon)) {
      								$output .= '<div class="zs_counter_icon">';
      								$output .= $content_icon;
      								$output .= '</div>';
      								}
      							$output .= '<h4 class="zs_counter_number">';
      							$output .= '<span class="zs_number_string '.$counter_id.'" '.(!empty($count_number_color) ? 'style="color: '.$count_number_color.';"' : '').' data-from="0" data-to="'.$count_number.'" data-refresh-interval="50">0</span>
                                  <span class="zs_counter_units" '.(!empty($count_units_color) ? 'style="color: '.$count_units_color.';"' : '').'>'.$count_units.'</span>';
      							$output .= '</h4>';
      							$output .= '<div class="zs_counter_text" '.(!empty($count_description_color) ? 'style="color: '.$count_description_color.';"' : '').'>'.$count_description.'</div>';
      						$output .= '</div>';
      					$output .= '</div>';
      				break;
	         }

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_COUNTER')) {
    $ZS_ELEM_COUNTER = new ZS_ELEM_COUNTER;
}

?>
