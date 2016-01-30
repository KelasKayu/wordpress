<?php
/**
 * array with admin notices
 */
$advanced_ads_admin_notices = array(
    // if users updated from a previous version to 1.4.5
    '1.4.5' => array(
	'type' => 'update',
	'text' => 'Advanced Ads 1.4.5 changes the behavior of some display conditions. Please read this <a href="http://wpadvancedads.com/advanced-ads-1-4-5/" target="_blank">update post</a> to learn if this change should concern you.',
    ),
    // email tutorial
    'nl_intro' => array(
	'type' => 'info',
	'text' => sprintf(__( 'Advanced Ads successfully installed. Take a look at the <a href="%s">First Steps</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-intro' )),
    ),
    // email tutorial
    'nl_first_steps' => array(
	'type' => 'subscribe',
	'text' => __( 'Thank you for activating <strong>Advanced Ads</strong>. Would you like to receive the first steps via email?', 'advanced-ads' ),
	'confirm_text' => __( 'Yes, send it', 'advanced-ads' )
    ),
    // free add-ons
    'nl_free_addons' => array(
	'type' => 'subscribe',
	'text' => __( 'Thank you for using <strong>Advanced Ads</strong>. Stay informed and receive <strong>2 free add-ons</strong> for joining the newsletter.', 'advanced-ads' ),
	'confirm_text' => __( 'Add me now', 'advanced-ads' )
    ),
    // adsense newsletter group
    'nl_adsense' => array(
	'type' => 'subscribe',
	'text' => __( 'Learn more about how and <strong>how much you can earn with AdSense</strong> and Advanced Ads from my dedicated newsletter.', 'advanced-ads' ),
	'confirm_text' => __( 'Subscribe me now', 'advanced-ads' )
    ),
    // if users updated from a previous version to 1.5.4
    '1.5.4' => array(
	'type' => 'update',
	'text' => 'With Advanced Ads 1.5.4 the handling of <strong>visitor conditions</strong> became more consistent, flexible, and hopefully easier to use too. Please read this <a href="http://wpadvancedads.com/advanced-ads-1-5-4/" target="_blank">update post</a> to learn if this change should concern you.',
    ),
    // if users updated from a previous version to 1.6
    '1.6' => array(
	'type' => 'update',
	'text' => 'Advanced Ads 1.6 contains important <strong>fixes for ad groups</strong>. Please read the <a href="https://wpadvancedads.com/advanced-ads-1-6/" target="_blank">update post</a>.',
    ),
    // if users updated from a previous version to 1.6.6
    '1.6.6' => array(
	'type' => 'update',
	'text' => 'Advanced Ads 1.6.6 changed <a href="/wp-admin/admin.php?page=advanced-ads-placements">placements</a> completely. Take a look at the <a href="https://wpadvancedads.com/advanced-ads-1-6-6/" target="_blank">update post</a> to find out why I am so excited about it.',
    ),
    // missing license codes
    'license_invalid' => array(
	'type' => 'plugin_error',
	'text' => sprintf( __( 'One or more license keys for <strong>Advanced Ads add-ons are invalid or missing</strong>. Please add valid license keys <a href="%s">here</a>.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) )
    ),
    // license expires
    'license_expires' => array(
	'type' => 'plugin_error',
	'text' => sprintf( __( 'One or more licenses for your <strong>Advanced Ads add-ons are expiring soon</strong>. Don’t risk to lose support and updates and renew your license before it expires with a significant discount on <a href="%s" target="_blank">the add-on page</a>.', 'advanced-ads' ), 'https://wpadvancedads.com/add-ons/' ),
    ),
    // license expired
    'license_expired' => array(
	'type' => 'plugin_error',
	'text' => sprintf( __( '<strong>Advanced Ads</strong> license(s) expired. Support and updates are disabled. Please visit <a href="%s"> the license page</a> for more information.', 'advanced-ads' ), admin_url( 'admin.php?page=advanced-ads-settings#top#licenses' ) ),
    ),
);