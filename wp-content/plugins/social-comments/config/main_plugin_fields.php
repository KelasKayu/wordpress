<?php 
/* section main */
if ( !defined('ABSPATH')) exit;
$setting = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'social_comments', 
	'title'             => __('Social Comments', 'social-comments')
	)
);
//select field
$p->add_field(array(
	'label'   => __('How To display Social Comments', 'social-comments'),
	'std'     => 'tabbed',
	'id'      => 'how',
	'type'    => 'select',
	'section' => $setting,
	'options' => array(
		'Stacked' => 'Stacked',
		'Tabbed'  => 'Tabbed',
	),
	'desc'    => __('<strong>Stacked</strong> will place the each comment system under another based on the order below,<br/><strong>Tabbed</strong> will palce each comment system in its own tab based on the oder bellow', 'social-comments')
	)
);
//select field
$p->add_field(array(
	'label'   => __('How To Trigger tabs?', 'social-comments'),
	'std'     => 'Click',
	'id'      => 'tabsTrigger',
	'type'    => 'select',
	'section' => $setting,
	'options' => array(
		'Click' => 'Click',
		'Hover'  => 'Hover',
	),
	'desc'    => __('<strong>Click</strong> will switch between Tabs on label click,<br/><strong>Hover</strong> will switch between Tabs on label hover<br /> Only used in tabbbed view.', 'social-comments')
	)
);
//sortable field
$p->add_field(array(
	'label'   => __('Social Comments display order', 'social-comments'),
	'std'     => 'tabbed',
	'id'      => 'order',
	'type'    => 'sortable',
	'section' => $setting,
	'options' => array(
		'WordPress Comments'   => 'wp',
		'Disqus comments'      => 'disqus',
		'Google plus comments' => 'gplus',
		'Facebook comments'    => 'facebook',
	),
	'desc'    => __('Drag and drop to set the order of the comment systems.', 'social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting,
	'label'   => __('Label Before tabs', 'social-comments'),
	'std'     => NULL,
	'id'      => 'pre_tabs_label',
	'type'    => 'text',
	'desc'    => __('Enter a label to show above the tabs something like <em>"&lt;h2&gt;Comment Here&lt;/h2&gt;"</em> (optional) leave lank for none.', 'social-comments')
	)
);
//checkbox field
$p->add_field(array(
	'section' => $setting,
	'label'   => __('Show count', 'social-comments'),
	'std'     => false,
	'id'      => 'count_enabled',
	'type'    => 'checkbox',
	'desc'    => __('Show comment Count for each comment system', 'social-comments')
	)
);

//WordPress
$setting4 = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'wp_social_comments', 
	'title'             => __('WordPress Comments settings', 'social-comments')
	)
);
//checkbox field
$saved = get_option('social_comments',array());
if (count($saved) > 0 && !isset($saved['wp_comments_enabled']) )
	$saved = FALSE;
else
	$saved = TRUE;
$p->add_field(array(
	'section' => $setting4,
	'label'   => __('Enable native WordPress comments', 'social-comments'),
	'std'     => $saved,
	'id'      => 'wp_comments_enabled',
	'type'    => 'checkbox',
	'desc'    => __('UnCheck to disable the Native Comments', 'social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting4,
	'label'   => __('WordPress Comments tab label', 'social-comments'),
	'std'     => __('WordPress', 'social-comments'),
	'id'      => 'wp_comments_label',
	'type'    => 'text',
	'desc'    => __('Enter WordPress Comments Tab label', 'social-comments')
	)
);
//image field
$p->add_field(array(
	'section' => $setting4,
	'label'   => __('WordPress Comments tab icon', 'social-comments'),
	'id'      => 'wp_comments_img',
	'type'    => 'image',
	'desc'    => __('You can upload a custom WordPress Tab icon', 'social-comments')
	)
);

//Disqus
$setting5 = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'disqus_social_comments', 
	'title'             => __('Disqus Comments settings', 'social-comments')
	)
);
//checkbox field
$p->add_field(array(
	'section' => $setting5,
	'label'   => __('Enable Disqus comments', 'social-comments'),
	'std'     => false,
	'id'      => 'disqus_comments_enabled',
	'type'    => 'checkbox',
	'desc'    => __('Check to enabled Disqus Comments', 'social-comments')
	)
);

//text field
$p->add_field(array(
	'section' => $setting5,
	'label'   => __('Disqus Shortname', 'social-comments'),
	'std'     => '',
	'id'      => 'disqus_shortname',
	'type'    => 'text',
	'desc'    => __('Enter Disqus short name', 'social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting5,
	'label'   => __('Disqus Comments tab label', 'social-comments'),
	'std'     => __('Disqus', 'social-comments'),
	'id'      => 'disqus_comments_label',
	'type'    => 'text',
	'desc'    => __('Enter Disqus Comments Tab label', 'social-comments')
	)
);
//image field
$p->add_field(array(
	'section' => $setting5,
	'label'   => __('Disqus Comments tab icon', 'social-comments'),
	'id'      => 'disqus_comments_img',
	'type'    => 'image',
	'desc'    => __('You can upload a custom Disqus Tab icon', 'social-comments')
	)
);

//text field
$p->add_field(array(
	'section' => $setting5,
	'label'   => __('Disqus API KEY', 'social-comments'),
	'std'     => '',
	'id'      => 'disqus_api_key',
	'type'    => 'text',
	'desc'    => __('This is used for comment count, you can get one for free at <a href="http://disqus.com/api/applications/register/" target="_blank">here</a>', 'social-comments')
	)
);


//google plus
$setting2 = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'google_social_comments', 
	'title'             => __('Google Plus Comments settings', 'social-comments')
	)
);
//checkbox field
$p->add_field(array(
	'section' => $setting2,
	'label'   => __('Enable Google Plus comments', 'social-comments'),
	'std'     => FALSE,
	'id'      => 'gplus_comments_enabled',
	'type'    => 'checkbox',
	'desc'    => __('Check to enable Google Plus Comments', 'social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting2,
	'label'   => __('Google Plus tab label', 'social-comments'),
	'std'     => __('Google + ', 'social-comments'),
	'id'      => 'gplus_comments_label',
	'type'    => 'text',
	'desc'    => __('Enter Google Plus Tab label', 'social-comments')
	)
);
//image field
$p->add_field(array(
	'section' => $setting2,
	'label'   => __('Google Plus tab icon', 'social-comments'),
	'id'      => 'gplus_comments_img',
	'type'    => 'image',
	'desc'    => __('You can upload a custom Google Plus Tab icon', 'social-comments')
	)
);

//facebook commnets
$setting3 = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'facebook_social_comments', 
	'title'             => __('Facebook Comments settings', 'social-comments')
	)
);
//checkbox field
$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Enable Facebook comments', 'social-comments'),
	'std'     => FALSE,
	'id'      => 'facebook_comments_enabled',
	'type'    => 'checkbox',
	'desc'    => __('Check to enable Facebook Comments', 'social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Facebook App ID', 'social-comments'),
	'std'     => FALSE,
	'id'      => 'facebook_appID',
	'type'    => 'text',
	'desc'    => __('Enter Your Facebook App ID, (optional) this field is optional and is only used if you wish to moderate the comments', 'social-comments')
	)
);
//select field
$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Facebook Color Scheme', 'social-comments'),
	'std'     => 'light',
	'id'      => 'facebook_colorScheme',
	'type'    => 'select',
	'options'  => array(
		'Light' => 'light',
		'Dark'  => 'dark'
	),
	'desc'    => __('Select Facebook Comments color scheme', 'social-comments')
	)
);

$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Facebook Comments language','social-comments'),
	'std'     => 'en_US',
	'id'      => 'facebook_lang',
	'type'    => 'select',
	'options' => array(
		"Afrikaans"                       => "af_ZA",
		"Arabic"                          => "ar_AR",
		"Azerbaijani"                     => "az_AZ",
		"Belarusian"                      => "be_BY",
		"Bulgarian"                       => "bg_BG",
		"Bengali"                         => "bn_IN",
		"Bosnian"                         => "bs_BA",
		"Catalan"                         => "ca_ES",
		"Czech"                           => "cs_CZ",
		"Cebuano"                         => "cx_PH",
		"Welsh"                           => "cy_GB",
		"Danish"                          => "da_DK",
		"German"                          => "de_DE",
		"Greek"                           => "el_GR",
		"English (UK)"                    => "en_GB",
		"English (Pirate)"                => "en_PI",
		"English (Upside Down)"           => "en_UD",
		"English (US)"                    => "en_US",
		"Esperanto"                       => "eo_EO",
		"Spanish (Spain)"                 => "es_ES",
		"Spanish"                         => "es_LA",
		"Estonian"                        => "et_EE",
		"Basque"                          => "eu_ES",
		"Persian"                         => "fa_IR",
		"Leet Speak"                      => "fb_LT",
		"Finnish"                         => "fi_FI",
		"Faroese"                         => "fo_FO",
		"French (Canada)"                 => "fr_CA",
		"French (France)"                 => "fr_FR",
		"Frisian"                         => "fy_NL",
		"Irish"                           => "ga_IE",
		"Galician"                        => "gl_ES",
		"Guarani"                         => "gn_PY",
		"Hebrew"                          => "he_IL",
		"Hindi"                           => "hi_IN",
		"Croatian"                        => "hr_HR",
		"Hungarian"                       => "hu_HU",
		"Armenian"                        => "hy_AM",
		"Indonesian"                      => "id_ID",
		"Icelandic"                       => "is_IS",
		"Italian"                         => "it_IT",
		"Japanese"                        => "ja_JP",
		"Georgian"                        => "ka_GE",
		"Khmer"                           => "km_KH",
		"Korean"                          => "ko_KR",
		"Kurdish"                         => "ku_TR",
		"Latin"                           => "la_VA",
		"Lithuanian"                      => "lt_LT",
		"Latvian"                         => "lv_LV",
		"Macedonian"                      => "mk_MK",
		"Malayalam"                       => "ml_IN",
		"Malay"                           => "ms_MY",
		"Norwegian (bokmal)"              => "nb_NO",
		"Nepali"                          => "ne_NP",
		"Dutch"                           => "nl_NL",
		"Norwegian (nynorsk)"             => "nn_NO",
		"Punjabi"                         => "pa_IN",
		"Polish"                          => "pl_PL",
		"Pashto"                          => "ps_AF",
		"Portuguese (Brazil)"             => "pt_BR",
		"Portuguese (Portugal)"           => "pt_PT",
		"Romanian"                        => "ro_RO",
		"Russian"                         => "ru_RU",
		"Slovak"                          => "sk_SK",
		"Slovenian"                       => "sl_SI",
		"Albanian"                        => "sq_AL",
		"Serbian"                         => "sr_RS",
		"Swedish"                         => "sv_SE",
		"Swahili"                         => "sw_KE",
		"Tamil"                           => "ta_IN",
		"Telugu"                          => "te_IN",
		"Thai"                            => "th_TH",
		"Filipino"                        => "tl_PH",
		"Turkish"                         => "tr_TR",
		"Ukrainian"                       => "uk_UA",
		"Urdu"                            => "ur_PK",
		"Vietnamese"                      => "vi_VN",
		"Simplified Chinese (China)"      => "zh_CN",
		"Traditional Chinese (Hong Kong)" => "zh_HK",
		"Traditional Chinese (Taiwan)"    => "zh_TW"
	),
	'desc'=> __('Facebook comments user interface language','social-comments')
	)
);
//text field
$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Facebook label', 'social-comments'),
	'std'     => __('Facebook', 'social-comments'),
	'id'      => 'facebook_comments_label',
	'type'    => 'text',
	'desc'    => __('Enter Facebook Tab label', 'social-comments')
	)
);
//image field
$p->add_field(array(
	'section' => $setting3,
	'label'   => __('Facebook tab icon', 'social-comments'),
	'id'      => 'facebook_comments_img',
	'type'    => 'image',
	'desc'    => __('You can upload a custom Facebook Tab icon', 'social-comments')
	)
);

//iconset
$setting6 = $p->add_section(array(
	'option_group'      =>  'social_comments',
	'sanitize_callback' => null,
	'id'                => 'icon_social_comments', 
	'title'             => __('Tabs Icon set', 'social-comments')
	)
);
//checkboxImages field
$p->add_field(array(
	'section' => $setting6,
	'label'   => __('Select Icon Set for tabs', 'social-comments'),
	'std'     => 'cleanlight',
	'id'      => 'iconset',
	'uri'	  => plugins_url('assets/images/icons/', dirname(__FILE__) ),
	'type'    => 'radioImage',
	'options' => array('apricum' , 'cleandark', 'cleanlight','creamycolor', 'creamysilver', 'denimdark', 'denimlight' , 'glossydark', 'glossylight', 'labels','neon', 'retro','retrobadge','somicro'),
	'desc'    => __('Select the Icon set you want to use when using tabs, as you can see not all sets have disqus icon so you can use the upload option at the disqus settings bellow', 'social-comments')
	)
);

//custom css
$p->inject['after_wrap'] = <<<CSS
<style type="text/css">
	li[id=ordergplus]{
		padding: 10px;
  		background-color: Red;
  		cursor: move;
  		color: #fff;
  		text-align: center;
  		width: 50%;
  		font-weight: bolder;
	}
	li[id=orderdisqus]{
		padding: 10px;
  		background-color: #2e9fff;
  		cursor: move;
  		color: #fff;
  		text-align: center;
  		width: 50%;
  		font-weight: bolder;
	}
	li[id=orderwp]{ 
		padding: 10px;
  		background-color: black;
  		font-weight: bolder;
  		cursor: move;
  		text-align: center;
  		width: 50%;
  		color: #fff;
	}
	li[id=orderfacebook]{ 
		padding: 10px;
		font-weight: bolder;
  		background-color: blue;
  		cursor: move;
  		text-align: center;
  		width: 50%;
  		color: #fff;
	}
</style>
CSS
;