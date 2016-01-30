<?php
define("FBLS_NAME","Facebook Comments");
define("FBLS_TAGLINE","Insert the Facebook Like and/or Send button to any post, page or template!");
define("FBLS_URL","http://peadig.com/wordpress-plugins/facebook-like-share-button/");
define("FBLS_EXTEND_URL","https://wordpress.org/plugins/facebook-like-send-button/");
define("FBLS_AUTHOR_TWITTER","alexmoss");
define("FBLS_DONATE_LINK","https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WFVJMCGGZTDY4");

add_action('admin_init', 'fbls_init' );
function fbls_init(){
	register_setting( 'fbls_options', 'fbls' );
	$new_options = array(
		'fbml' => 'on',
		'opengraph' => 'off',
		'fbns' => 'off',
		'like' => 'on',
		'share' => 'on',
		'verb' => 'like',
		'html5' => 'on',
		'faces' => 'true',
		'language' => 'en_US',
		'posts' => 'on',
		'pages' => 'off',
		'homepage' => 'off',
		'width' => '',
		'layout' => 'standard',
		'linklove' => 'off'
	);
	add_option( 'fbls', $new_options );
}


add_action('admin_menu', 'show_fbls_options');
function show_fbls_options() {
	add_options_page('Facebook Like & Send Options', 'Facebook Like & Send', 'manage_options', 'fblikesend', 'fbls_options');
}


function fbls_fetch_rss_feed() {
    include_once(ABSPATH . WPINC . '/feed.php');
	$rss = fetch_feed("http://peadig.com/feed");	
	if ( is_wp_error($rss) ) { return false; }	
	$rss_items = $rss->get_items(0, 3);
    return $rss_items;
}   


// ADMIN PAGE
function fbls_options() {
$domain = get_option('siteurl');
$domain = str_replace('http://', '', $domain);
$domain = str_replace('www.', '', $domain);
?>
    <link href="<?php echo plugins_url( 'admin.css' , __FILE__ ); ?>" rel="stylesheet" type="text/css">
    <div class="pea_admin_wrap">
        <div class="pea_admin_top">
            <h1><?php echo FBLS_NAME?> <small> - <?php echo FBLS_TAGLINE?></small></h1>
        </div>

        <div class="pea_admin_main_wrap">
            <div class="pea_admin_main_left">
                <div class="pea_admin_signup">
                    Want to know about updates to this plugin without having to log into your site every time? Want to know about other cool plugins we've made? Add your email and we'll add you to our very rare mail outs.

                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                    <form action="http://peadig.us5.list-manage2.com/subscribe/post?u=e16b7a214b2d8a69e134e5b70&amp;id=eb50326bdf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <div class="mc-field-group">
                        <label for="mce-EMAIL">Email Address
                    </label>
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL"><button type="submit" name="subscribe" id="mc-embedded-subscribe" class="pea_admin_green">Sign Up!</button>
                    </div>
                        <div id="mce-responses" class="clear">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>	<div class="clear"></div>
                    </form>
                    </div>

                    <!--End mc_embed_signup-->
                </div>

		<form method="post" action="options.php" id="options">
			<?php settings_fields('fbls_options'); ?>
			<?php $options = get_option('fbls'); 
				if (!isset($options['font'])) {$options['font'] = "";}
			?>

			<h3 class="title">Main Settings</h3>
			<table class="form-table">
<?php if ($options['appID']!="") { ?>
				<tr valign="top"><th scope="row"><label for="appID">Facebook App ID</label></th>
					<td><input id="appID" type="text" name="fbls[appID]" value="<?php echo $options['appID']; ?>" /></td>
				</tr>
<?php } ?>
				<tr valign="top"><th scope="row"><label for="fbml">Enable FBML</label></th>
					<td><input id="fbml" name="fbls[fbml]" type="checkbox" value="on" <?php checked('on', $options['fbml']); ?> /> <small>only disable this if you already have XFBML enabled elsewhere</small></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="fbns">Use Facebook NameServer</label></th>
					<td><input id="fbns" name="fbls[fbns]" type="checkbox" value="on" <?php checked('on', $options['fbml']); ?> /> <small>only enable this if Facebook Comments do not appear</small></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="opengraph">Use Open Graph NameServer</label></th>
					<td><input id="opengraph" name="fbls[opengraph]" type="checkbox" value="on" <?php checked('on', $options['opengraph']); ?> /> <small>only enable this if Facebook comments are not appearing, not all information is being passed to Facebook or if you have not enabled Open Graph elsewhere within WordPress</small></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="html5">Use HTML5</label></th>
					<td><input id="html5" name="fbls[html5]" type="checkbox" value="on" <?php checked('on', $options['html5']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="linklove">Credit</label></th>
					<td><input id="credit" name="fbls[linklove]" type="checkbox" value="on" <?php checked('on', $options['linklove']); ?> /></td>
				</tr>
			</table>

			<h3 class="title">Display Settings</h3>
			<table class="form-table">
				<tr valign="top"><th scope="row"><label for="posts">Posts</label></th>
					<td><input id="posts" name="fbls[posts]" type="checkbox" value="on" <?php checked('on', $options['posts']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="pages">Pages</label></th>
					<td><input id="pages" name="fbls[pages]" type="checkbox" value="on" <?php checked('on', $options['pages']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="homepage">Homepage</label></th>
					<td><input id="homepage" name="fbls[homepage]" type="checkbox" value="on" <?php checked('on', $options['homepage']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="width">Width</label></th>
					<td><input id="width" type="text" name="fbls[width]" value="<?php echo $options['width']; ?>" /></small></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="language">Language</label></th>
					<td>
						<select name="fbls[language]">
							<option value="af_ZA" <?php selected( $options['language'], 'af_ZA' ); ?>>Afrikaans</option>
							<option value="ar_AR" <?php selected( $options['language'], 'ar_AR' ); ?>>Arabic</option>
							<option value="az_AZ" <?php selected( $options['language'], 'az_AZ' ); ?>>Azerbaijani</option>
							<option value="be_BY" <?php selected( $options['language'], 'be_BY' ); ?>>Belarusian</option>
							<option value="bg_BG" <?php selected( $options['language'], 'bg_BG' ); ?>>Bulgarian</option>
							<option value="bn_IN" <?php selected( $options['language'], 'bn_IN' ); ?>>Bengali</option>
							<option value="bs_BA" <?php selected( $options['language'], 'bs_BA' ); ?>>Bosnian</option>
							<option value="ca_ES" <?php selected( $options['language'], 'ca_ES' ); ?>>Catalan</option>
							<option value="cs_CZ" <?php selected( $options['language'], 'cs_CZ' ); ?>>Czech</option>
							<option value="cy_GB" <?php selected( $options['language'], 'cy_GB' ); ?>>Welsh</option>
							<option value="da_DK" <?php selected( $options['language'], 'da_DK' ); ?>>Danish</option>
							<option value="de_DE" <?php selected( $options['language'], 'de_DE' ); ?>>German</option>
							<option value="el_GR" <?php selected( $options['language'], 'el_GR' ); ?>>Greek</option>
							<option value="en_GB" <?php selected( $options['language'], 'en_GB' ); ?>>English (UK)</option>
							<option value="en_PI" <?php selected( $options['language'], 'en_PI' ); ?>>English (Pirate)</option>
							<option value="en_UD" <?php selected( $options['language'], 'en_UD' ); ?>>English (Upside Down)</option>
							<option value="en_US" <?php selected( $options['language'], 'en_US' ); ?>>English (US)</option>
							<option value="eo_EO" <?php selected( $options['language'], 'eo_EO' ); ?>>Esperanto</option>
							<option value="es_ES" <?php selected( $options['language'], 'es_ES' ); ?>>Spanish (Spain)</option>
							<option value="es_LA" <?php selected( $options['language'], 'es_LA' ); ?>>Spanish</option>
							<option value="et_EE" <?php selected( $options['language'], 'et_EE' ); ?>>Estonian</option>
							<option value="eu_ES" <?php selected( $options['language'], 'eu_ES' ); ?>>Basque</option>
							<option value="fa_IR" <?php selected( $options['language'], 'fa_IR' ); ?>>Persian</option>
							<option value="fb_LT" <?php selected( $options['language'], 'fb_LT' ); ?>>Leet Speak</option>
							<option value="fi_FI" <?php selected( $options['language'], 'fi_FI' ); ?>>Finnish</option>
							<option value="fo_FO" <?php selected( $options['language'], 'fo_FO' ); ?>>Faroese</option>
							<option value="fr_CA" <?php selected( $options['language'], 'fr_CA' ); ?>>French (Canada)</option>
							<option value="fr_FR" <?php selected( $options['language'], 'fr_FR' ); ?>>French (France)</option>
							<option value="fy_NL" <?php selected( $options['language'], 'fy_NL' ); ?>>Frisian</option>
							<option value="ga_IE" <?php selected( $options['language'], 'ga_IE' ); ?>>Irish</option>
							<option value="gl_ES" <?php selected( $options['language'], 'gl_ES' ); ?>>Galician</option>
							<option value="he_IL" <?php selected( $options['language'], 'he_IL' ); ?>>Hebrew</option>
							<option value="hi_IN" <?php selected( $options['language'], 'hi_IN' ); ?>>Hindi</option>
							<option value="hr_HR" <?php selected( $options['language'], 'hr_HR' ); ?>>Croatian</option>
							<option value="hu_HU" <?php selected( $options['language'], 'hu_HU' ); ?>>Hungarian</option>
							<option value="hy_AM" <?php selected( $options['language'], 'hy_AM' ); ?>>Armenian</option>
							<option value="id_ID" <?php selected( $options['language'], 'id_ID' ); ?>>Indonesian</option>
							<option value="is_IS" <?php selected( $options['language'], 'is_IS' ); ?>>Icelandic</option>
							<option value="it_IT" <?php selected( $options['language'], 'it_IT' ); ?>>Italian</option>
							<option value="ja_JP" <?php selected( $options['language'], 'ja_JP' ); ?>>Japanese</option>
							<option value="ka_GE" <?php selected( $options['language'], 'ka_GE' ); ?>>Georgian</option>
							<option value="km_KH" <?php selected( $options['language'], 'km_KH' ); ?>>Khmer</option>
							<option value="ko_KR" <?php selected( $options['language'], 'ko_KR' ); ?>>Korean</option>
							<option value="ku_TR" <?php selected( $options['language'], 'ku_TR' ); ?>>Kurdish</option>
							<option value="la_VA" <?php selected( $options['language'], 'la_VA' ); ?>>Latin</option>
							<option value="lt_LT" <?php selected( $options['language'], 'lt_LT' ); ?>>Lithuanian</option>
							<option value="lv_LV" <?php selected( $options['language'], 'lv_LV' ); ?>>Latvian</option>
							<option value="mk_MK" <?php selected( $options['language'], 'mk_MK' ); ?>>Macedonian</option>
							<option value="ml_IN" <?php selected( $options['language'], 'ml_IN' ); ?>>Malayalam</option>
							<option value="ms_MY" <?php selected( $options['language'], 'ms_MY' ); ?>>Malay</option>
							<option value="nb_NO" <?php selected( $options['language'], 'nb_NO' ); ?>>Norwegian (bokmal)</option>
							<option value="ne_NP" <?php selected( $options['language'], 'ne_NP' ); ?>>Nepali</option>
							<option value="nl_NL" <?php selected( $options['language'], 'nl_NL' ); ?>>Dutch</option>
							<option value="nn_NO" <?php selected( $options['language'], 'nn_NO' ); ?>>Norwegian (nynorsk)</option>
							<option value="pa_IN" <?php selected( $options['language'], 'pa_IN' ); ?>>Punjabi</option>
							<option value="pl_PL" <?php selected( $options['language'], 'pl_PL' ); ?>>Polish</option>
							<option value="ps_AF" <?php selected( $options['language'], 'ps_AF' ); ?>>Pashto</option>
							<option value="pt_BR" <?php selected( $options['language'], 'pt_BR' ); ?>>Portuguese (Brazil)</option>
							<option value="pt_PT" <?php selected( $options['language'], 'pt_PT' ); ?>>Portuguese (Portugal)</option>
							<option value="ro_RO" <?php selected( $options['language'], 'ro_RO' ); ?>>Romanian</option>
							<option value="ru_RU" <?php selected( $options['language'], 'ru_RU' ); ?>>Russian</option>
							<option value="sk_SK" <?php selected( $options['language'], 'sk_SK' ); ?>>Slovak</option>
							<option value="sl_SI" <?php selected( $options['language'], 'sl_SI' ); ?>>Slovenian</option>
							<option value="sq_AL" <?php selected( $options['language'], 'sq_AL' ); ?>>Albanian</option>
							<option value="sr_RS" <?php selected( $options['language'], 'sr_RS' ); ?>>Serbian</option>
							<option value="sv_SE" <?php selected( $options['language'], 'sv_SE' ); ?>>Swedish</option>
							<option value="sw_KE" <?php selected( $options['language'], 'sw_KE' ); ?>>Swahili</option>
							<option value="ta_IN" <?php selected( $options['language'], 'ta_IN' ); ?>>Tamil</option>
							<option value="te_IN" <?php selected( $options['language'], 'te_IN' ); ?>>Telugu</option>
							<option value="th_TH" <?php selected( $options['language'], 'th_TH' ); ?>>Thai</option>
							<option value="tl_PH" <?php selected( $options['language'], 'tl_PH' ); ?>>Filipino</option>
							<option value="tr_TR" <?php selected( $options['language'], 'tr_TR' ); ?>>Turkish</option>
							<option value="uk_UA" <?php selected( $options['language'], 'uk_UA' ); ?>>Ukrainian</option>
							<option value="vi_VN" <?php selected( $options['language'], 'vi_VN' ); ?>>Vietnamese</option>
							<option value="zh_CN" <?php selected( $options['language'], 'zh_CN' ); ?>>Simplified Chinese (China)</option>
							<option value="zh_HK" <?php selected( $options['language'], 'zh_HK' ); ?>>Traditional Chinese (Hong Kong)</option>
							<option value="zh_TW" <?php selected( $options['language'], 'zh_TW' ); ?>>Traditional Chinese (Taiwan)</option>
						</select>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><label for="layout">Button Layout</label></th>
					<td>
						<select name="fbls[layout]">
							  <option value="standard"<?php if ($options['layout'] == 'standard') { echo ' selected="selected"'; } ?>>Standard</option>
							  <option value="box_count"<?php if ($options['layout'] == 'box_count') { echo ' selected="selected"'; } ?>>Box Count</option>
							  <option value="button_count"<?php if ($options['layout'] == 'button_count') { echo ' selected="selected"'; } ?>>Button Count</option>
							  <option value="button"<?php if ($options['layout'] == 'button') { echo ' selected="selected"'; } ?>>Button</option>
						</select>
					</td>
				</tr>
				<tr valign="top"><th scope="share"><label for="share">Display Share Button</label></th>
					<td><input id="posts" name="fbls[share]" type="checkbox" value="true" <?php checked('true', $options['share']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="faces">Show Faces</label></th>
					<td><input id="posts" name="fbls[faces]" type="checkbox" value="true" <?php checked('true', $options['faces']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="verb">Action Type</label></th>
					<td>
						<select name="fbls[verb]">
							  <option value="like"<?php if ($options['verb'] == 'like') { echo ' selected="selected"'; } ?>>Like</option>
							  <option value="recommend"<?php if ($options['verb'] == 'recommend') { echo ' selected="selected"'; } ?>>Recommend</option>
						</select>
					</td>
				</tr>
			</table>

			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>

               <div class="pea_admin_box">
			<h3 class="title">Using the Shortcode</h3>
			<table class="form-table">
				<tr valign="top"><td>
<p>The settings above are for automatic insertion of the Facebook Comment box.</p>
<p>You can insert the comment box manually in any page or post or template by simply using the shortcode <strong>[fbls]</strong>. To enter the shortcode directly into templates using PHP, enter <strong>echo do_shortcode('[fbls]');</strong></p>
<p>You can also use the options below to override the the settings above.</p>
<ul>
<li><strong>url</strong> - leave blank for current URL</li>
<li><strong>width</strong> -  minimum must be <strong>350</strong></li>
<li><strong>verb</strong> -  options are <strong>like</strong> or <strong>recommend</strong></li>
<li><strong>scheme</strong> - colour scheme: light/dark</li>
<li><strong>linklove</strong> - enter "on" to link to the plugin</li>
</ul>
<p>Here's an example of using the shortcode:<br><code>[fbls url="http://peadig.com/wordpress-plugins/facebook-comments/" width="375"]</code></p>
<p>You can also insert the shortcode directly into your theme with PHP:<br><code>&lt;?php echo do_shortcode('[fbls][fbls url="http://peadig.com/wordpress-plugins/facebook-comments/"]'); ?&gt;</code>

					</td>
				</tr>
			</table>
</div>

</div>
            <div class="pea_admin_main_right">
                 <div class="pea_admin_box">

            <center><a href="http://peadig.com/?utm_source=<?php echo $domain; ?>&utm_medium=referral&utm_campaign=Facebook%2BComments%2BAdmin" target="_blank"><img src="<?php echo plugins_url( 'images/peadig-landscape-300.png' , __FILE__ ); ?>" width="220" height="69" title="Peadig">
            <strong>Peadig: the WordPress framework that Integrates Bootstrap</strong></a><br /><br />
            <a href="https://twitter.com/peadig" class="twitter-follow-button">Follow @peadig</a>
			<div class="fb-like" data-href="http://www.facebook.com/peadig" data-layout="button_count" data-action="like" data-show-faces="false"></div>
<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/116387945649998056474" data-rel="publisher"></div>
<br /><br /><br />


                </div>


                   <center> <h2>Share the plugin love!</h2>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="<?php echo FBLS_URL; ?>" data-layout="button_count" data-show-faces="true"></div>

                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo FBLS_URL; ?>" data-text="Just been using <?php echo FBLS_NAME; ?> #WordPress plugin" data-via="<?php echo FBLS_AUTHOR_TWITTER; ?>" data-related="WPBrewers">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<a href="http://bufferapp.com/add" class="buffer-add-button" data-text="Just been using <?php echo FBLS_NAME; ?> #WordPress plugin" data-url="<?php echo FBLS_URL; ?>" data-count="horizontal" data-via="<?php echo FBLS_AUTHOR_TWITTER; ?>">Buffer</a><script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
                    <div class="g-plusone" data-size="medium" data-href="<?php echo FBLS_URL; ?>"></div>
                    <script type="text/javascript">
                      window.___gcfg = {lang: 'en-GB'};

                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                    <su:badge layout="3" location="<?php echo FBLS_URL?>"></su:badge>
                    <script type="text/javascript">
                      (function() {
                        var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                        li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
                      })();
                    </script>
<br /><br />
<a href="<?php echo FBLS_DONATE_LINK; ?>" target="_blank"><img class="paypal" src="<?php echo plugins_url( 'images/paypal.gif' , __FILE__ ); ?>" width="147" height="47" title="Please Donate - it helps support this plugin!"></a></center>

                <div class="pea_admin_box">
                    <h2>About the Author</h2>

                    <?php
                    $default = "http://reviews.evanscycles.com/static/0924-en_gb/noAvatar.gif";
                    $size = 70;
                    $alex_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( "alex@peadig.com" ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    ?>

                    <p class="pea_admin_clear"><img class="pea_admin_fl" src="<?php echo $alex_url; ?>" alt="Alex Moss" /> <h3>Alex Moss</h3><br />Alex Moss is the Co-Founder of <a href="http://peadig.com/" target="_blank">Peadig</a>, a WordPress framework built with Bootstrap. He has also developed several WordPress plugins (which you can <a href="http://peadig.com/wordpress-plugins/?utm_source=<?php echo $domain; ?>&utm_medium=referral&utm_campaign=Facebook%2BComments%2BPro%2BAdmin" target="_blank">view here</a>) totalling over 500,000 downloads.</p>
<center><br><a href="https://twitter.com/alexmoss" class="twitter-follow-button">Follow @alexmoss</a>
<div class="fb-subscribe" data-href="https://www.facebook.com/alexmoss1" data-layout="button_count" data-show-faces="false" data-width="220"></div>
<div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/116608702739714446873" data-rel="author"></div>
</div>

                    <h2>More from Peadig</h2>
    <p class="pea_admin_clear">
                    <?php
				$FBLS_feed = fbls_fetch_rss_feed();
                echo '<ul>';
                foreach ( $FBLS_feed as $item ) {
			    	$url = preg_replace( '/#.*/', '', esc_url( $item->get_permalink(), $protocolls=null, 'display' ) );
					echo '<li>';
					echo '<a href="'.$url.'?utm_source='.$domain.'&utm_medium=RSS&utm_campaign=Facebook%2BComments%2BPro%2BAdmin" target="_blank">'. esc_html( $item->get_title() ) .'</a> ';
					echo '</li>';
			    }
                echo '</ul>';
                    ?></p>


            </div>
        </div>
    </div>



<?php
}

?>