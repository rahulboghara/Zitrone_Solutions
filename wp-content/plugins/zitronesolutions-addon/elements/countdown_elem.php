<?php
if (!class_exists('ZS_ELEM_COUNTDOWN')) {
    class ZS_ELEM_COUNTDOWN extends ZITRONESOLUTIONS_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'zs_countdown_init'));
            add_shortcode('tek_countdown', array($this, 'zs_countdown_shrt'));
        }
        // Element configuration in admin
        function zs_countdown_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Countdown", "zitronesolutions"),
                    "description" => esc_html__("Countdown", "zitronesolutions"),
                    "base" => "tek_countdown",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/countdown.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Starting Year", "zitronesolutions"),
                            "param_name" => "starting_year",
                            "value" => "",
		                        "description" => esc_html__("Enter event starting year", "zitronesolutions")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Starting Month", "zitronesolutions"),
                            "param_name"    =>  "starting_month",
                            "value"         =>  array(
                                    "January" => "1",
                                    "February" => "2",
                                    "March" => "3",
                                    "April" => "4",
                                    "May" => "5",
                                    "June" => "6",
                                    "July" => "7",
                                    "August" => "8",
                                    "September" => "9",
                                    "October" => "10",
                                    "November" => "11",
                                    "December" => "12",
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Enter event starting month", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Starting Day", "zitronesolutions"),
                            "param_name" => "starting_day",
                            "value" => "",
                            "description" => esc_html__("Enter event starting day", "zitronesolutions")
                        ),


                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("DAYS Counter Text", "zitronesolutions"),
                            "param_name" => "cd_text_days",
                            "value" => "DAYS",
                            "description" => esc_html__("Use this field to translate DAYS text", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("HOURS Counter Text", "zitronesolutions"),
                            "param_name" => "cd_text_hours",
                            "value" => "HOURS",
                            "description" => esc_html__("Use this field to translate HOURS text", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("MINUTES Counter Text", "zitronesolutions"),
                            "param_name" => "cd_text_minutes",
                            "value" => "MINUTES",
                            "description" => esc_html__("Use this field to translate MINUTES text", "zitronesolutions")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("SECONDS Counter Text", "zitronesolutions"),
                            "param_name" => "cd_text_seconds",
                            "value" => "SECONDS",
                            "description" => esc_html__("Use this field to translate SECONDS text", "zitronesolutions")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "zitronesolutions"),
                            "param_name" => "cd_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                        ),
                    )
                ));
            }
        }

		// Render the element on front-end
        public function zs_countdown_shrt($atts, $content = null)
        {

          // Include required JS files
          wp_enqueue_script('zs_countdown_script');

            extract(shortcode_atts(array(
                'starting_year'         => '',
                'starting_month'        => '',
                'starting_day'          => '',
                'cd_text_days'          => '',
                'cd_text_hours'          => '',
                'cd_text_minutes'          => '',
                'cd_text_seconds' 			=> '',
                'cd_extra_class'        => '',
            ), $atts));

            $output = '<div class="countdown '.$cd_extra_class.'" data-count-year="'.$starting_year.'" data-count-month="'.$starting_month.'" data-count-day="'.$starting_day.'" data-text-days="'.$cd_text_days.'" data-text-hours="'.$cd_text_hours.'" data-text-minutes="'.$cd_text_minutes.'" data-text-seconds="'.$cd_text_seconds.'"></div>';
            return $output;
        }
    }
}
if (class_exists('ZS_ELEM_COUNTDOWN')) {
    $ZS_ELEM_COUNTDOWN = new ZS_ELEM_COUNTDOWN;
}
?>
