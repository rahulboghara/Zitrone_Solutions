<?php

if (!class_exists('ZS_ELEM_PROGRESSBAR')) {

    class ZS_ELEM_PROGRESSBAR extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_progressbar_init'));
            add_shortcode('tek_progress_bar', array($this, 'zs_progressbar_shrt'));
        }

        // Element configuration in admin

        function zs_progressbar_init() {

            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Progress bar", "zitronesolutions"),
                    "description" => esc_html__("Animated progress bar with counter.", "zitronesolutions"),
                    "base" => "tek_progress_bar",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/progress-bar.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Bar heading","zitronesolutions"),
                            "param_name" => "pb_heading",
                            "value" => array(
                                    "Static text"   => "static_text",
                                    "Counter"       => "counter"
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Select your progress bar heading.", "zitronesolutions")
                        ),

                        array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" => esc_html__("Title", 'zitronesolutions'),
                           "param_name" => "pb_title",
                           "value" => "",
                           "admin_label" => true,
                           "description" => esc_html__("Enter progress bar title.", "zitronesolutions"),
                           "dependency" => array(
                               "element" => "pb_heading",
                               "value" => array("static_text"),
                           ),
                       ),

                       array(
                           "type"			=>	"dropdown",
                           "class"			=>	"",
                           "heading"		=>	esc_html__("Icon source","zitronesolutions"),
                           "param_name"	=>	"pb_icon_type",
                           "value"			=>	array(
                                    "No icon" => "no_icon",
                                    "Icon Browser" => "icon_browser",
                                    "Custom Icon" => "custom_icon",
                               ),
                           "save_always" => true,
                           "description" => esc_html__("Icon will be displayed in front of title.", "zitronesolutions"),
                           "dependency" => array(
                               "element" => "pb_heading",
                               "value" => array("static_text"),
                           ),
                       ),

                         array(
                             "type" => "dropdown",
                             "heading" => esc_html__( "Icon library", "zitronesolutions" ),
                             "value" => array(
                                 esc_html__( "Font Awesome", "zitronesolutions" ) => "fontawesome",
                                 esc_html__( "Linecons", "zitronesolutions" ) => "linecons",
                             ),
                             "param_name" => "pb_icon_library",
                             "dependency" =>	array(
                                 "element" => "pb_icon_type",
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
                               "element" => "pb_icon_library",
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
                                   "element" => "pb_icon_library",
                                   "value" => "linecons",
                             ),
                             "description" => esc_html__( "Select icon from library.", "zitronesolutions" ),
                       ),

                       array(
                           "type" => "attach_image",
                           "class" => "",
                           "heading" => esc_html__("Upload image icon", "zitronesolutions"),
                           "param_name" => "pb_icon_img",
                           "value" => "",
                           "dependency" => array(
                               "element" => "pb_icon_type",
                               "value" => array("custom_icon"),
                           ),
                           "description" => esc_html__("Upload your own custom image.", "zitronesolutions"),
                       ),

                       array(
                           "type" => "dropdown",
                           "class" => "",
                           "heading" => esc_html__("Show value marker", "zitronesolutions"),
                           "param_name"	=> "pb_progress_marker",
                           "value" => array(
                                   "No" => "marker_no",
                                   "Yes" => "marker_yes",
                               ),
                           "save_always" => true,
                           "dependency" => array(
                               "element" => "pb_heading",
                               "value" => array("static_text"),
                           ),
                           "description" => esc_html__("Value marker for your progress bar.", "zitronesolutions")
                       ),

                       array(
                           "type" => "textfield",
                           "class" => "",
                           "heading" =>	esc_html__("Progress bar value", "zitronesolutions"),
                           "param_name"	=>	"pb_progressbar_value",
                           "value" => "",
                           "description" => esc_html__("Progress bar filling value %. Only 1-100 values accepted.", "zitronesolutions"),
                           "save_always" => true,
                       ),

                       array(
                           "type"  => "textfield",
                           "class" => "",
                           "heading" => esc_html__("Progress bar filling time", "zitronesolutions"),
                           "param_name" => "pb_progressbar_filltime",
                           "value" => "",
                           "description" => esc_html__("Filling duration measured in seconds.", "zitronesolutions"),
                           "save_always" => true,
                       ),

                       array(
                           "type" => "textarea",
                           "class" => "",
                           "heading" => esc_html__("Description", "zitronesolutions"),
                           "param_name" => "pb_description",
                           "value" => "",
                           "description" => esc_html__("Displayed under the progress bar.", "zitronesolutions")
                       ),

                       array(
                           "type"			=>	"dropdown",
                           "class"			=>	"",
                           "heading"		=>	esc_html__("Bar line thickness","zitronesolutions"),
                           "param_name"	=>	"pb_thickness",
                           "value"			=>	array(
                                   "Thin line" => "thin-solid",
                                   "Medium line" => "medium-solid",
                                   "Thick line" => "thick-solid"
                               ),
                           "save_always" => true,
                           "description"	=>	esc_html__("Select bar thickness.", "zitronesolutions")
                       ),

                       array(
                           "type" => "colorpicker",
                           "class" => "",
                           "heading" => esc_html__("Element color", "zitronesolutions"),
                           "param_name" => "pb_main_color",
                           "value" => "",
                           "description" => esc_html__("Overwrite default title and active progress bar color.", "zitronesolutions")
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
                           "param_name" => "pb_extra_class",
                           "value" => "",
                           "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                       ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_progressbar_shrt($atts, $content = null)
        {

            // Include required JS files
        		wp_enqueue_script('zs_jquery_appear');
        		wp_enqueue_script('zs_progressbar');

            // Declare empty vars
            $output = $content_icon = $counter_id = $pb_icon_font = $css_class = $animation_delay = '';

            extract(shortcode_atts(array(
                'pb_heading'		                  => '',
                'pb_title'		                    => '',
                'pb_icon_type'		                => '',
                'pb_icon_library'                 => '',
                'icon_fontawesome' 			          => '',
                'icon_linecons' 			            => '',
                'pb_icon_img'		                  => '',
                'pb_progress_marker'		          => '',
                'pb_progressbar_value'		        => '',
                'pb_progressbar_filltime'		      => '',
                'pb_description'		              => '',
                'pb_thickness'		                => '',
                'pb_main_color'		                => '',
                'css_animation'                   => '',
                'elem_animation_delay'            => '',
                'pb_extra_class'                  => '',
            ), $atts));

            $counter_id .= 'zs-counter-'.uniqid();
            if($pb_heading == 'counter') {
                wp_enqueue_script('zs_countto');

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
            }

            if( $pb_icon_type == 'icon_browser' ) {
              // Enqueue needed icon font.
              vc_icon_element_fonts_enqueue( $pb_icon_library );

              if (strlen($icon_fontawesome) > 0) {
                  $pb_icon_font = $icon_fontawesome;
              } elseif (strlen($icon_linecons) > 0) {
                  $pb_icon_font = $icon_linecons;
              }
            }

            if( $pb_icon_type == 'icon_browser' && !empty($pb_icon_font) ) {
		            $content_icon = '<div class="zs-progress-icon"><i class="'.$pb_icon_font .' fa"></i></div>';
            }
      			elseif($pb_icon_type == 'custom_icon' && !empty($pb_icon_img)){
        				$zs_progress_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $pb_icon_img, 'thumb_size' => 'full', 'class' => "" ) );
        				$content_icon = '<div class="zs-progress-customimg">'.$zs_progress_img_array['thumbnail'].'</div>';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            // Fill time init
            if (empty($pb_progressbar_filltime)) {
              $pb_progressbar_filltime = 1;
            }

            $output .= '<div class="zs_progress_bar '.$css_animation.' '.esc_attr( $pb_extra_class ).'" '.$animation_delay.'>';
                $output .= '<div class="zs_progb_head">';
                    if($pb_heading == 'static_text') {
                        $output .= '<div class="zs-progb-static">';
            				$output .= $content_icon;
            				$output .= '<div class="zs-progb-title"><h4 '.(!empty($pb_main_color) ? 'style="color: '.$pb_main_color.';"' : '').'>'.$pb_title.'</h4></div>';
                    if($pb_progress_marker !== 'marker_no' && $pb_heading == 'static_text') {
          						$output .= '<span class="zs_progressbarmarker" '.(!empty($pb_main_color) ? 'style="color: '.$pb_main_color.';"' : '').'>'.$pb_progressbar_value.'%</span>';
          					}
            			$output .= '</div>';
                    } elseif ($pb_heading == 'counter') {
                        $output .= '<div class="zs-progb-counter">';
                            $output .= '<span class="pb_counter_number '.$counter_id.'" '.(!empty($pb_main_color) ? 'style="color: '.$pb_main_color.';"' : '').' data-from="0" data-to="'.$pb_progressbar_value.'" data-speed="'.($pb_progressbar_filltime*1000).'" data-refresh-interval="50">0</span> <span class="pb_counter_units" '.(!empty($pb_main_color) ? 'style="color: '.$pb_main_color.';"' : '').'>%</span>';
                        $output .= '</div>';
                    }
                $output .= '</div>';
                $output .= '<div class="zs_progressbarfull '.$pb_thickness.'">
                  <div class="zs_progressbarfill" '.(!empty($pb_main_color) ? 'style="background-color: '.$pb_main_color.';"' : '').' data-value="'.$pb_progressbar_value.'" data-time="'.($pb_progressbar_filltime*1000).'">
                </div>';
                $output .= '</div>';
                $output .= '<div class="zs_progb_desc">'.$pb_description.'</div>';
        	$output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_PROGRESSBAR')) {
    $ZS_ELEM_PROGRESSBAR = new ZS_ELEM_PROGRESSBAR;
}

?>
