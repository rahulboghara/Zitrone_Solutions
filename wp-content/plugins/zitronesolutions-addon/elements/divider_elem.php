<?php

if (!class_exists('ZS_ELEM_DIVIDER')) {

    class ZS_ELEM_DIVIDER extends ZITRONESOLUTIONS_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'zs_divider_init'));
            add_shortcode('tek_divider', array($this, 'zs_divider_shrt'));
        }

        // Element configuration in admin

        function zs_divider_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Section divider", "zitronesolutions"),
                    "description" => esc_html__("Different divider styles to separate your content.", "zitronesolutions"),
                    "base" => "tek_divider",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/divider.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Divider shape","zitronesolutions"),
                            "param_name"	=>	"div_shape",
                            "value"			=>	array(
                                    "Dotted line"           => "dotted_line",
                                    "Dashed line"           => "dashed_line",
                                    "Solid line"            => "solid_line",
                                    "Double line"           => "double_line",
                                    "Double dotted line"    => "double_dotted",
                                    "Double dashed line"    => "double_dashed",
                                    "Shadow line"           => "shadow_line"
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select divider type.", "zitronesolutions")
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Line width","zitronesolutions"),
                            "param_name"	=>	"div_width",
                            "value"			=>	array(
                                    "Full width"            => "divider_full_width",
                                    "One half"              => "divider_one_half",
                                    "One fourth"            => "divider_one_fourth"
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Select divider width.", "zitronesolutions")
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Line thickness","zitronesolutions"),
                            "param_name"	=>	"div_thickness",
                            "value"			=>	array(
                                    "Thin line"             => "thin_solid",
                                    "Medium line"           => "medium_solid",
                                    "Thick line"            => "thick_solid"
                                ),
                            "save_always" => true,
                            "dependency" => array(
                                "element" => "div_shape",
                                "value" => array("solid_line"),
                            ),
                            "description"	=>	esc_html__("Select divider width.", "zitronesolutions")
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Line Color", "zitronesolutions"),
                            "param_name" => "div_color",
                            "value" => "",
                            "dependency" => array(
                                "element" => "div_shape",
                                "value" => array("dotted_line", "dashed_line", "solid_line", "double_line", "double_dotted", "double_dashed"),
                            ),
                            "description" => esc_html__("Choose divider color.", "zitronesolutions")
                        )
                    )
                ));
            }
        }



		// Render the element on front-end

        public function zs_divider_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'div_shape'         => '',
                'div_width'         => '',
                'div_thickness'     => '',
                'div_color'         => '',
            ), $atts));

            $div_size = "";

            if($div_shape == "solid_line") {
                $div_size = $div_thickness;
            }

            $output = '<div class="zs-divider '.$div_shape.' '.$div_width.' '.$div_size.'">
                <div class="divider-line" style="border-color:'.$div_color.'"></div>
            </div>';

            return $output;

        }
    }
}

if (class_exists('ZS_ELEM_DIVIDER')) {
    $ZS_ELEM_DIVIDER = new ZS_ELEM_DIVIDER;
}

?>
