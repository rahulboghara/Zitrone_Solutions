<?php

if (!class_exists('ZS_ELEM_ALERT_BOX')) {

    class ZS_ELEM_ALERT_BOX extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_alertbox_init'));
            add_shortcode('tek_alertbox', array($this, 'zs_alertbox_shrt'));
        }

        // Element configuration in admin

        function zs_alertbox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Alert Box", "zitronesolutions"),
                    "description" => esc_html__("Easily display warning, error, info and success messages.", "zitronesolutions"),
                    "base" => "tek_alertbox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/alert-box.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Box type","zitronesolutions"),
                            "param_name"	=>	"ab_type",
                            "value"			=>	array(
                                    "Warning" => "ab_warning",
                                    "Error" => "ab_error",
                                    "Info" => "ab_info",
                                    "Success" => "ab_success",
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select box type.", "zitronesolutions")
                        ),
                        array(
                            "type" => "textarea_html",
                            "class" => "",
                            "heading" => esc_html__("Box message", "zitronesolutions"),
                            "param_name" => "ab_message",
                            "value" => "",
                            "save_always" => true,
                            "description" => esc_html__("Enter box message here.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_alertbox_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'ab_type'               => '',
                'ab_message'            => '',
            ), $atts));

            $ab_icon = "";

            switch($ab_type){
				case 'ab_warning':
					$ab_icon = "fa-bell-o";
				break;

                case 'ab_error':
					$ab_icon = "fa-exclamation-triangle";
				break;

                case 'ab_info':
					$ab_icon = "fa-question";
				break;

                case 'ab_success':
					$ab_icon = "fa-check";
				break;

				default:
			}

            $output = '<div class="zs-alertbox '.$ab_type.'">
                <div class="ab-icon"><i class="'.$ab_icon.' iconita"></i></div>
                <div class="ab-message">'.$ab_message.'</div>
                <a href="#" class="ab-close"><i class="fa-times iconita"></i></a>
            </div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_ALERT_BOX')) {
    $ZS_ELEM_ALERT_BOX = new ZS_ELEM_ALERT_BOX;
}

?>
