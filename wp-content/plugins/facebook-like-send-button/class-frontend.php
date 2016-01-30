<?php

//ADD XFBML
add_filter('language_attributes', 'fbls_schema');
function fbls_schema($attr) {
	$options = get_option('fbls');
if (!isset($options['fbns'])) {$options['fbns'] = "";}
if (!isset($options['opengraph'])) {$options['opengraph'] = "";}
	if ($options['opengraph'] == 'on') {$attr .= "\n xmlns:og=\"http://ogp.me/ns#\"";}
	if ($options['fbns'] == 'on') {$attr .= "\n xmlns:fb=\"http://ogp.me/ns/fb#\"";}
	return $attr;
}

//ADD OPEN GRAPH META
function fblsgraphinfo() {
	$options = get_option('fbls'); ?>
<meta property="fb:app_id" content="<?php echo $options['appID']; ?>"/>
<meta property="fb:admins" content="<?php echo $options['mods']; ?>"/>
<?php
}
add_action('wp_head', 'fblsgraphinfo');


function fbmllssetup() {
$options = get_option('fbls');
if (!isset($options['fbml'])) {$options['fbml'] = "";}
if ($options['fbml'] == 'on') {
?>
<!-- Facebook Like & Share Button: http://peadig.com/wordpress-plugins/facebook-like-share-button/ -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $options['language']; ?>/sdk.js#xfbml=1&appId=<?php echo $options['appID']; ?>&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }}
add_action('wp_footer', 'fbmllssetup', 100);



//COMMENT BOX
function fbls_button($content) {
	$options = get_option('fbls');
if (!isset($options['html5'])) {$options['html5'] = "off";}
if (!isset($options['linklove'])) {$options['linklove'] = "off";}
if (!isset($options['posts'])) {$options['posts'] = "off";}
if (!isset($options['pages'])) {$options['pages'] = "off";}
if (!isset($options['homepage'])) {$options['homepage'] = "off";}
	if (
	   (is_single() && $options['posts'] == 'on') ||
       (is_page() && $options['pages'] == 'on') ||
       ((is_home() || is_front_page()) && $options['homepage'] == 'on')) {
		$content .= "<!-- Facebook Like & Share Button: http://peadig.com/wordpress-plugins/facebook-like-share-button/ -->";

      	if ($options['html5'] == 'on') {
			$content .=	'<div class="fb-like" data-href="'.get_permalink().'" data-layout="'.$options['layout'].'" data-action="'.$options['verb'].'" data-show-faces="'.$options['faces'].'" data-share="'.$options['share'].'"></div>';
    } else {
    		$content .= '<fb:like href="'.get_permalink().'" layout="'.$options['layout'].'" action="'.$options['verb'].'" show_faces="'.$options['faces'].'" share="'.$options['share'].'"></fb:like>';
     }

    if ($options['linklove'] != 'no') {
        if ($options['linklove'] != 'off') {
            if (empty($fbls[linklove])) {
      $content .= '<p>Powered by <a href="http://peadig.com/wordpress-plugins/facebook-like-share-button/">Facebook Like</a></p>';
    }}}
  }
return $content;
}
add_filter ('the_content', 'fbls_button', 100);


function fbls_shortcode($fbatts) {
    extract(shortcode_atts(array(
		"options" => get_option('fbls'),
		"url" => get_permalink(),
    ), $fbatts));
    if (!empty($fbatts)) {
        foreach ($fbatts as $key => $option)
            $fbls[$key] = $option;
	}
		$fbls_sc = "<!-- Facebook Like & Share Button: http://peadig.com/wordpress-plugins/facebook-like-share-button/ -->";

      	if ($fbls[html5] == 'on') {
			$fbls_sc .= '<div class="fb-like" data-href="'.$url.'" data-layout="'.$options['layout'].'" data-action="'.$options['verb'].'" data-show-faces="'.$options['faces'].'" data-share="'.$options['share'].'"></div>';


			"<div class=\"fb-comments\" data-href=\"".$url."\" data-num-posts=\"".$fbls[num]."\" data-width=\"".$fbls[width]."\" data-colorscheme=\"".$fbls[scheme]."\"></div>";

    } else {
    $fbls_sc .= '<fb:like href="'.$url.'" layout="'.$options['layout'].'" action="'.$options['verb'].'" show_faces="'.$options['faces'].'" share="'.$options['share'].'"></fb:like>';
     }

	if (!empty($fbls[linklove])) {
      $fbls_sc .= '<p>Powered by <a href="http://peadig.com/wordpress-plugins/facebook-like-share-button/">Facebook Like</a></p>';
	}
  return $fbls_sc;
}
add_filter('widget_text', 'do_shortcode');
add_shortcode('fbls', 'fbls_shortcode');

function my_styles_method() {
	wp_enqueue_style(
		'custom-style',
		get_template_directory_uri() . '/style.css'
	);
        $width= '450px !important'; //E.g. #FF0000
        $custom_css = "
                .fb-like span{
                        width: {$width};
                }";
        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'my_styles_method' );


?>