<?php

if (!class_exists('ZS_ELEM_EVENT_SESSION')) {

    class ZS_ELEM_EVENT_SESSION extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_eventsession_init'));
            add_shortcode('tek_eventsession', array($this, 'zs_eventsession_shrt'));
        }

        // Element configuration in admin

        function zs_eventsession_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Event session", "zitronesolutions"),
                    "description" => esc_html__("Event schedule session.", "zitronesolutions"),
                    "base" => "tek_eventsession",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/schedule.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Session time", "zitronesolutions"),
                            "param_name" => "es_session_time",
                            "admin_label" => true,
                            "value" => "",
		                        "description" => esc_html__("Event session time.", "zitronesolutions"),
                         ),
                         array(
                             "type" => "textfield",
                             "class" => "",
                             "heading" => esc_html__("Session title", "zitronesolutions"),
                             "param_name" => "es_session_title",
                             "admin_label" => true,
                             "value" => "",
		                         "description" => esc_html__("Event session title.", "zitronesolutions"),
                          ),
                          array(
                              "type" => "textfield",
                              "class" => "",
                              "heading" => esc_html__("Session subtitle", "zitronesolutions"),
                              "param_name" => "es_session_subtitle",
                              "value" => "",
 		                          "description" => esc_html__("Event session subtitle. This text will be displayed in the session description area.", "zitronesolutions"),
                           ),
                          array(
                              "type" => "textarea",
                              "class" => "",
                              "heading" => esc_html__("Session description", "zitronesolutions"),
                              "param_name" => "es_session_description",
                              "value" => "",
                              "description" => esc_html__("Event session description.", "zitronesolutions")
                              ),
                          array(
                              "type" => "textfield",
                              "class" => "",
                              "heading" => esc_html__("Speaker name", "zitronesolutions"),
                              "param_name" => "es_speaker_name",
                              "admin_label" => true,
                              "value" => "",
		                          "description" => esc_html__("Write the speaker name for this event session.", "zitronesolutions"),
                              ),
                          array(
                              "type" => "textfield",
                              "class" => "",
                              "heading" => esc_html__("Speaker position", "zitronesolutions"),
                              "param_name" => "es_speaker_position",
                              "value" => "",
		                          "description" => esc_html__("Write the speaker position.", "zitronesolutions"),
                              ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Speaker photo", "zitronesolutions"),
                            "param_name" => "es_speaker_photo",
                            "value" => "",
                            "description" => esc_html__("Upload speaker photo.", "zitronesolutions"),
                            ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Link type", "zitronesolutions"),
                             "param_name" => "es_custom_link",
                             "value" =>	array(
                                    esc_html__( "No link", "zitronesolutions" ) => "#",
                                    esc_html__( "Add a custom link", "zitronesolutions" )	=> "1",
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add/remove custom link", "zitronesolutions"),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Link text", "zitronesolutions"),
                            "param_name" => "es_link_text",
                            "value" => "",
                            "description" => esc_html__("Enter link text here.", "zitronesolutions"),
                            "dependency" => array(
                               "element" => "es_custom_link",
                               "value"	=> array( "1" ),
                           ),
                        ),

                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "zitronesolutions"),
                             "param_name" => "es_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "zitronesolutions"),
                             "dependency" => array(
                                "element" => "es_custom_link",
                                "value"	=> array( "1" ),
                            ),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Expand element","zitronesolutions"),
                            "param_name"	=>	"es_expanded",
                            "value"			=>	array(
                                    "No" => "es_collapsed",
                                    "Yes" => "es_expand",
                                ),
                            "save_always" => true
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Box background color", "zitronesolutions"),
                            "param_name" => "es_background_color",
                            "value" => "",
                            "description" => esc_html__("Select box background color. If none selected, the default theme color will be used.", "zitronesolutions"),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "es_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_eventsession_shrt($atts, $content = null)
        {

            // Include required JS and CSS files
            wp_enqueue_script('zs_jquery_appear');

            // Declare empty vars
            $output = $speaker_image = $href = $link_target = $link_title = $es_unique_id = $expand_class = '';

            extract(shortcode_atts(array(
                'es_session_time'		             => '',
                'es_session_title'		           => '',
                'es_session_subtitle'            => '',
                'es_session_description'	       => '',
                'es_speaker_name'		             => '',
                'es_speaker_position'		         => '',
                'es_speaker_photo'		           => '',
                'es_custom_link'		             => '',
                'es_link_text'		               => '',
                'es_link'		                     => '',
                'es_expanded'		                 => '',
                'es_background_color'            => '',
                'es_extra_class'                 => '',
            ), $atts));

            $es_unique_id = 'esaccid'.mt_rand(999, 9999999);

            if(!empty($es_speaker_photo)){
                $rw_speaker_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $es_speaker_photo, 'thumb_size' => 'full', 'class' => "" ) );
                $speaker_image = $rw_speaker_img_array['thumbnail'];
            }

            $href = vc_build_link($es_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}

            $es_no_description ='';
            if($es_session_description == '') {
                $es_no_description = 'es_no_description';
            }


            switch($es_expanded){
      				case 'es_collapsed':
      					$expand_class = "es-collapsed";
      				break;

                      case 'es_expand':
      					$expand_class = "es-expanded";
      				break;

      				default:
      			}


            $output = '<div class="es-accordion '.$es_extra_class.' '.$es_no_description.'" id="'.$es_unique_id.'" '.(!empty($es_background_color) ? 'style="background-color: '.$es_background_color.';"' : '').'>
                            <div class="es-heading '.$expand_class.'">';
                                if ($es_session_time != "") {
                                    $output .= '<span class="es-time"><i class="fa fa-clock-o"></i>'.$es_session_time.'</span>';
                                }
                                $output .= '<h4>';
                                if ($es_expanded == 'es_expand') {
                                    $output .= '<a data-toggle="collapse" data-parent="#'.$es_unique_id.'" href="#tabid'.strtolower(md5($es_session_title)).'" aria-expanded="true">'.$es_session_title.' <i class="fa fa-angle-down"></i></a>';
                                } elseif ($es_expanded == 'es_collapsed')  {
                                    $output .= '<a class="collapsed" data-toggle="collapse" data-parent="#'.$es_unique_id.'" href="#tabid'.strtolower(md5($es_session_title)).'">'.$es_session_title.' <i class="fa fa-angle-down"></i></a>';
                                }
                                $output .= '</h4>
                            </div>';
                            if ($es_expanded == 'es_expand') {
                                $output .= '<div id="tabid'.strtolower(md5($es_session_title)).'" class="panel-collapse collapse in" aria-expanded="true" role="tabpanel">';
                            } elseif ($es_expanded == 'es_collapsed')  {
                                $output .= '<div id="tabid'.strtolower(md5($es_session_title)).'" class="panel-collapse collapse" role="tabpanel">';
                            }
						    $output .= '<div class="es-speaker-container">
                                <div class="es-speaker-img">'.$speaker_image.'</div>
                                <div class="es-speaker-name">'.$es_speaker_name.'</div>
                                <div class="es-speaker-position">'.$es_speaker_position.'</div>
                            </div>
                            <div class="es-session-desc">
                                <div class="es-desc-wrapper">';
                                if ($es_session_subtitle != '') {
                                    $output .= '<div class="es-session-subtitle">'.$es_session_subtitle.'</div>';
                                }
                                $output .= wpb_js_remove_wpautop($es_session_description, true).'
                                </div>';
                                if ($es_custom_link == "1") {
                                  $output .= '<div class="es-link"><a href="'.$href['url'].'"'.$link_target.''.$link_title.'>'.$es_link_text.'</a></div>';
                                }
                            $output .= '</div>
                          </div>
                    </div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_EVENT_SESSION')) {
    $ZS_ELEM_EVENT_SESSION = new ZS_ELEM_EVENT_SESSION;
}

?>
