<?php
if (!class_exists('ZS_ELEM_VIDEO')) {
    class ZS_ELEM_VIDEO extends ZITRONESOLUTIONS_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'zs_video_init'));
            add_shortcode('tek_video', array($this, 'zs_video_shrt'));
        }
        // Element configuration in admin
        function zs_video_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Video Modal", "zitronesolutions"),
                    "description" => esc_html__("Video modal", "zitronesolutions"),
                    "base" => "tek_video",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/video-modal.png', dirname(__FILE__)),
                    "category" => esc_html__("ZitroneSolutions Elements", "zitronesolutions"),
                    "params" => array(
                      array(
                          "type" => "dropdown",
                          "class" => "",
                          "heading" => esc_html__("Video source", "zitronesolutions"),
                          "param_name" => "video_source",
                          "value" => array(
                              "YouTube/Vimeo" => "yt-vimeo-video",
                              "HTML5 Video" => "html-video",
                          ),
                          "save_always" => true,
                      ),
                      array(
                        "type" => "zs_param_notice",
                        "text" => "<span style='display: block;'>Please use the YouTube embed link for the video - see the following <a href='".plugins_url('assets/img/youtube-embed.png', dirname(__FILE__))."' target='_blank'>image</a>.</span>",
                        "param_name" => "notification",
                        "edit_field_class" => "vc_column vc_col-sm-12",
                        "dependency" =>	array(
                            "element" => "video_source",
                            "value" => array("yt-vimeo-video")
                        ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video link", "zitronesolutions"),
                          "param_name" => "video_url",
                          "value" => "",
                          "description" => esc_html__("Enter link to video.", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("yt-vimeo-video")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video title", "zitronesolutions"),
                          "param_name" => "video_title",
                          "value" => "",
                          "description" => esc_html__("Enter video title.", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("html-video")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video URL MP4", "zitronesolutions"),
                          "param_name" => "video_url_mp4",
                          "value" => "",
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("html-video")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video URL OGG", "zitronesolutions"),
                          "param_name" => "video_url_ogg",
                          "value" => "",
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("html-video")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video URL WEBM", "zitronesolutions"),
                          "param_name" => "video_url_webm",
                          "value" => "",
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("html-video")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Video height", "zitronesolutions"),
                          "param_name" => "video_height",
                          "value" => "",
                          "description" => esc_html__("Enter video height. Default value is 400 pixels.", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_source",
                              "value" => array("html-video")
                          ),
                      ),
                      array(
                          "type" => "dropdown",
                          "class" => "",
                          "heading" => esc_html__("Cover image", "zitronesolutions"),
                          "param_name" => "video_image_source",
                          "value" => array(
                              "Media library" => "media_library",
                              "External link" => "external_link",
                          ),
                          "description" => esc_html__("Select video preview image source.", "zitronesolutions"),
                          "save_always" => true,
                      ),
                      array(
                          "type" => "attach_image",
                          "heading" => esc_html__("Image", "zitronesolutions"),
                          "param_name" => "video_image",
                          "description" => esc_html__("Select image from media library.", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_image_source",
                              "value" => array("media_library")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Image external link", "zitronesolutions"),
                          "param_name" => "video_image_ext",
                          "value" => "",
                          "description" => esc_html__("Enter image external link.", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_image_source",
                              "value" => array("external_link")
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Image size", "zitronesolutions"),
                          "param_name" => "ext_image_size",
                          "value" => "",
                          "description" => esc_html__("Enter image size in pixels. Example: 1050x600 (Width x Height).", "zitronesolutions"),
                          "dependency" =>	array(
                              "element" => "video_image_source",
                              "value" => array("external_link")
                          ),
                      ),
                      array(
                          "type" => "dropdown",
                          "class" => "",
                          "heading" => esc_html__("Open video in", "zitronesolutions"),
                          "param_name" => "video_location",
                          "value" => array(
                              "Modal" => "",
                              "New window" => "video_location_new",
                          ),
                          "save_always" => true,
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Extra class name", "zitronesolutions"),
                          "param_name" => "video_extra_class",
                          "value" => "",
                          "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "zitronesolutions")
                      ),
                    )
                ));
            }
        }

		// Render the element on front-end
        public function zs_video_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'video_source' => '',
                'video_title' => '',
                'video_url' => '',
                'video_url_mp4' => '',
                'video_url_ogg' => '',
                'video_url_webm' => '',
                'video_height' => '',
                'video_image_source' => '',
                'video_image' => '',
                'video_image_ext' => '',
                'ext_image_size' => '',
                'video_play_align' => '',
                'video_location' => '',
                'video_extra_class' => '',
            ), $atts));

            $video_id = $dimensions = $hwstring = $default_src = $img = $image_media = $image_html = '';

            $image = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $video_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $default_src = vc_asset_url( 'vc/no_image.png' );

            $video_id .= 'zs-video-modal-'.uniqid();
            $vheight = ! empty( $video_height ) ? $video_height : '400px';

            if ($video_image_source == 'external_link') {
              $dimensions = vcExtractDimensions( $ext_image_size );
          		$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';

          		$video_image_ext = $video_image_ext ? esc_attr( $video_image_ext ) : $default_src;

          		$image_media .= '<img src="'.$video_image_ext.'" '.$hwstring.' />';
              $image_html = wp_get_attachment_url( $video_image );
            } else {
              $image_media .= $image["thumbnail"];
              $image_html = $video_image_ext;
            }

            $output = '<div class="video-container '.$video_play_align.' '.$video_extra_class.'">';
            $output .= $image_media;
            if ($video_location == 'video_location_new')  {
              $output .='<a href="'.$video_url.'" target="_blank">';
            } else {
              $output .='<a data-toggle="modal" data-target="#video-modal-'.$video_id.'" data-src="'.$video_url.'" data-backdrop="true">';
            }

            $output .='<span class="play-video"><span class="fa fa-play"></span></span></a></div>';
			$output .='<h6 class="video-socials">
				<span class="share-icon"></span>
				<a href="https://www.facebook.com/sharer.php?u='.$video_url.'" target="_blank"><span class="video-social-text">Facebook</span><span class="fa fa-facebook"></span></a>
				<a href="https://twitter.com/share?url='.$video_url.'" target="_blank"><span class="video-social-text">Twitter</span><span class="fa fa-twitter"></span></a>
				<a href="https://plusone.google.com/_/+1/confirm?hl=en&url='.$video_url.'" target="_blank"><span class="video-social-text">Google Plus</span><span class="fa fa-google-plus"></span></a>
			</h6>';

            if ($video_location != 'video_location_new')  {
            $output .= '<div class="modal fade video-modal" id="video-modal-'.$video_id.'" role="dialog">
                            <div class="modal-content">
                            <div class="row">';
                            if ( $video_source == "html-video" && !empty($video_url_mp4) ) {
                              $output .= '<video class="video-modal-local" title="'.$video_title.'" poster="'.$image_html.'" height="'.$vheight.'" controls>
                              <source src="'.$video_url_mp4.'" type="video/mp4">';
                              if (!empty($video_url_ogg)) {
                                $output .= '<source src="'.$video_url_ogg.'" type="video/ogg">';
                              }
                              if (!empty($video_url_webm)) {
                                $output .= '<source src="'.$video_url_webm.'" type="video/webm">';
                              }
                              $output .= '<img alt="" src="'.$image_html.'" title="Video playback is not supported by your browser" />
                              </video>';
                            } else {
                             $output .= '<iframe width="667" height="375" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                           }
                            $output .= '</div>
                            </div>
                        </div>';
            }
            return $output;
        }
    }
}
if (class_exists('ZS_ELEM_VIDEO')) {
    $ZS_ELEM_VIDEO = new ZS_ELEM_VIDEO;
}
?>
