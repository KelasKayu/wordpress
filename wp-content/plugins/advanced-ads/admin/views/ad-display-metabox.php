<?php
// include callback file
require_once(ADVADS_BASE_PATH . 'admin/includes/class-display-condition-callbacks.php');
$types = Advanced_Ads::get_instance()->ad_types;
$jquery_ui_buttons = array();
$conditions_enabled = isset( $ad->conditions['enabled'] ) && $ad->conditions['enabled'];
?>
<p class="description"><?php _e( 'Choose where to display the ad and where to hide it.', 'advanced-ads' ); ?></p>
<div id="advanced-ad-conditions-enable">
    <input id="advads-condition-display-disabled" type="radio" name="advanced_ad[conditions][enabled]" value="0" <?php checked( ! $conditions_enabled ); ?>/><label for="advads-condition-display-disabled"><?php _e( 'Display ad everywhere', 'advanced-ads' ); ?></label>
    <input id="advads-condition-display-enabled" type="radio" name="advanced_ad[conditions][enabled]" value="1" <?php checked( $conditions_enabled ); ?>/><label for="advads-condition-display-enabled"><?php _e( 'Set display conditions', 'advanced-ads' ); ?></label>
</div>
<div id="advanced-ad-conditions">
    <ul id="advads-how-it-works">
        <li><?php _e( 'If you want to display the ad everywhere, don\'t do anything here. ', 'advanced-ads' ); ?></li>
        <li><?php _e( 'The fewer conditions you enter, the better the performance will be.', 'advanced-ads' ); ?></li>
        <li><?php printf( __( 'Learn more about display conditions from the <a href="%s" target="_blank">manual</a>.', 'advanced-ads' ), ADVADS_URL . 'manual/display-conditions/' ); ?></li>
    </ul>
    <?php
	// -TODO use model
	$advanced_ads_ad_conditions = Advanced_Ads::get_ad_conditions();
	if ( is_array( $advanced_ads_ad_conditions ) ) :
		foreach ( $advanced_ads_ad_conditions as $_key => $_condition ) :
			if ( ! isset($_condition['callback']) ) {
				continue; }
			?><div class="advanced-ad-display-condition">
            <?php
			if ( is_array( $_condition['callback'] ) && method_exists( $_condition['callback'][0], $_condition['callback'][1] ) ) {
				call_user_func( array($_condition['callback'][0], $_condition['callback'][1]), $ad ); // works also in php below 5.3
				// $_condition['callback'][0]::$_condition['callback'][1]($ad); // works only in php 5.3 and above
			}
				?></div><?php
			endforeach;
			?><h4><?php _e( 'Other conditions', 'advanced-ads' ); ?></h4><br/>
        <table>
            <tbody><?php
			foreach ( $advanced_ads_ad_conditions as $_key => $_condition ) :
				if ( isset($_condition['callback']) || empty($_condition['label']) ) {
					continue; }
				?><tr>
				<th><?php echo $_condition['label']; ?>
					</th>
        <?php if ( empty($_condition['type']) ) : continue; ?>
                        <?php elseif ( $_condition['type'] == 'idfield' || $_condition['type'] == 'textvalues' ) : ?>
                            <td><input type="text" name="advanced_ad[conditions][<?php echo $_key; ?>][include]" value="<?php if ( isset($ad->conditions[$_key]['include']) ) { echo $ad->conditions[$_key]['include']; } ?>"/></td>
                            <td><input type="text" name="advanced_ad[conditions][<?php echo $_key; ?>][exclude]" value="<?php if ( isset($ad->conditions[$_key]['exclude']) ) { echo $ad->conditions[$_key]['exclude']; } ?>"/></td>
                    <?php elseif ( $_condition['type'] == 'radio' ) : ?>
                            <td class="advanced-ads-display-condition-set advads-buttonset">
                                <input type="radio" name="advanced_ad[conditions][<?php
									echo $_key; ?>]" id="advanced-ads-display-condition-<?php
									echo $_key; ?>-1" value="1" <?php if ( ! isset($ad->conditions[$_key]) || $ad->conditions[$_key] ) { checked( 1 ); } ?>/>
                                <label for="advanced-ads-display-condition-<?php echo $_key; ?>-1"><?php _ex( 'on', 'button label', 'advanced-ads' ); ?></label>
                                <input type="radio" name="advanced_ad[conditions][<?php
									echo $_key; ?>]" id="advanced-ads-display-condition-<?php
									echo $_key; ?>-0" value="0" <?php if ( isset($ad->conditions[$_key]) ) { checked( $ad->conditions[$_key], 0 ); } ?>/>
                                <label for="advanced-ads-display-condition-<?php echo $_key; ?>-0"><?php _ex( 'off', 'button label', 'advanced-ads' ); ?></label>
                            </td>
                            <td>
									<?php if ( ! empty($_condition['description']) ) : ?>
                                <p class="description on-hover"><?php echo $_condition['description']; ?></p>
                                <?php endif; ?>
                            </td>
        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
		if ( WP_DEBUG ) : ?>
        <fieldset class="advads-debug-output advads-debug-output-conditions"><legend onclick="advads_toggle('.advads-debug-output-conditions .inner')"><?php
		_e( 'show debug output', 'advanced-ads' ); ?></legend><div class="inner" style="display:none;">
                <p class="description"><?php _e( 'Values saved for this ad in the database (post metas)', 'advanced-ads' ); ?></p><?php
				echo '<pre>';
				print_r( $ad->conditions );
				echo '</pre>';
	?></div></fieldset>
        <?php endif; ?>
    </div>
    <?php
	endif;
