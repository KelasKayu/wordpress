<?php
$visitor_conditions = Advanced_Ads_Visitor_Conditions::get_instance()->conditions;
$options = $ad->options( 'visitors' );
?><p class="description"><?php _e( 'Display conditions that are based on the user. Use with caution on cached websites.', 'advanced-ads' ); ?></p>
<div id="advads-visitor-conditions">
	<table><tbody><?php
    if ( isset( $options ) ) :
	$i = 0;
foreach ( $options as $_options ) :
	if ( isset( $visitor_conditions[ $_options['type'] ]['metabox'] ) ) {
	    $metabox = $visitor_conditions[ $_options['type'] ]['metabox'];
	} else {
	    continue;
	}
	if ( method_exists( $metabox[0], $metabox[1] ) ) {
	    $_connector = isset( $_options['connector'] ) ? esc_attr( $_options['connector'] ) : 'and';
	    ?><tr><td colspan="4" class="advads-visitor-conditions-connector-<?php echo $_connector; ?>"><?php echo $_connector ?><hr/></td></tr><?php
	    ?><tr><td></td><td><?php echo $visitor_conditions[ $_options['type'] ]['label']; ?></td><td><?php
		call_user_func( array( $metabox[0], $metabox[1] ), $_options, $i++ );
		?></td><td><button type="button" class="advads-visitor-conditions-remove button">x</button></td></tr><?php
	}
	endforeach;
	endif;
	?></tbody></table>
    <input type="hidden" id="advads-visitor-conditions-index" value="<?php echo isset( $options ) ? count( $options ) : 0; ?>"/>
</div>
<?php if( ! isset( $options ) || count( $options ) == 0 ) :
    ?><p><?php _e( 'Visitor conditions limit the number of users who can see your ad. There is no need to set visitor conditions if you want all users to see the ad.', 'advanced-ads' ); ?></p><?php
elseif( Advanced_Ads_Checks::cache() && ! defined('AAP_VERSION') ) :
    ?><p><?php printf(__( 'Check out cache-busting in <a href="%s" target="_blank">Advanced Ads Pro</a> if dynamic features get cached.', 'advanced-ads' ), ADVADS_URL . 'add-ons/advanced-ads-pro' ); ?></p><?php
endif;
?><hr/>
<fieldset>
    <legend><?php _e( 'New condition', 'advanced-ads' ); ?></legend>
<div id="advads-visitor-conditions-new">
    <div class="advads-buttonset"<?php if ( ! isset( $options ) || 0 === count( $options ) ) { echo ' style="display: none;"'; } ?>>
	<input type="radio" name="advads-visitor-conditions-new-andor" id="advads-visitor-conditions-new-and" value="and"/><label for="advads-visitor-conditions-new-and"><?php _ex( 'and', 'visitor condition connector', 'advanced-ads' ); ?></label>
	<input type="radio" name="advads-visitor-conditions-new-andor" id="advads-visitor-conditions-new-or" value="or"/><label for="advads-visitor-conditions-new-or"><?php _ex( 'or', 'visitor condition connector', 'advanced-ads' ); ?></label>
    </div>
<select>
    <option value=""><?php _e( '-- choose a condition --', 'advanced-ads' ); ?></option>
    <?php foreach ( $visitor_conditions as $_condition_id => $_condition ) : ?>
	<option value="<?php echo $_condition_id; ?>"><?php echo $_condition['label']; ?></option>
    <?php endforeach; ?>
</select>
<button type="button" class="button"><?php _e( 'add', 'advanced-ads' ); ?></button>
</div>
</fieldset>
<?php if ( ! defined( 'AAR_SLUG' ) ) : ?>
<p><?php printf( __( 'Define the exact browser width for which an ad should be visible using the <a href="%s" target="_blank">Responsive add-on</a>.', 'advanced-ads' ), ADVADS_URL . 'add-ons/responsive-ads/' ); ?></p>
<?php endif;
?><script>
jQuery( document ).ready(function ($) {
    $('#advads-visitor-conditions-new button').click(function(){
	    var visitor_condition_type = $('#advads-visitor-conditions-new select').val();
	    var visitor_condition_title = $('#advads-visitor-conditions-new select option:selected').text();
	    if ( $('#advads-visitor-conditions-new .advads-buttonset :checked').length ){
		    var visitor_condition_connector = $('#advads-visitor-conditions-new .advads-buttonset :checked').val();
	    } else {
		    var visitor_condition_connector = 'and';
	    }
	    var visitor_condition_index = parseInt( $('#advads-visitor-conditions-index').val() );
	    if( ! visitor_condition_type ) return;
	    $.ajax({
		    type: 'POST',
		    url: ajaxurl,
		    data: {
			    action: 'load_visitor_conditions_metabox',
			    type: visitor_condition_type,
			    connector: visitor_condition_connector,
			    index: visitor_condition_index
		    },
		    success: function (r, textStatus, XMLHttpRequest) {
			    // add
			    if (r) {
				    var newline = '<tr class="advads-visitor-conditions-connector"><td colspan="4" class="advads-visitor-conditions-connector-' + visitor_condition_connector + '">' + visitor_condition_connector + '<hr/></td></tr>' +
					    '<tr><td></td><td>' + visitor_condition_title + '</td><td>' + r + '</td><td><button type="button" class="advads-visitor-conditions-remove button">x</button></td></tr>';
				    $( '#advads-visitor-conditions table tbody' ).append( newline );
				    // increase count
				    visitor_condition_index++;
				    $('#advads-visitor-conditions-index').val( visitor_condition_index );
				    advads_toogle_visitor_conditions_connector();
			    }
		    },
		    error: function (MLHttpRequest, textStatus, errorThrown) {
			    $( '#advads-visitor-conditions-new' ).append( errorThrown );
		    }
	    });
    });
    $(document).on('click', '.advads-visitor-conditions-remove', function(){
	var row = $(this).parents('#advads-visitor-conditions table tr');
	row.prev('tr').remove();
	row.remove();
	advads_toogle_visitor_conditions_connector();
    });
});
// show / hide connector
function advads_toogle_visitor_conditions_connector(){
    if( jQuery('#advads-visitor-conditions table tr').length ) {
	jQuery('#advads-visitor-conditions-new .advads-buttonset').show();
    } else {
	jQuery('#advads-visitor-conditions-new .advads-buttonset').hide();
    }
}
</script>
<?php $options = $ad->options( 'visitor' );
if ( isset( $options['mobile'] ) && '' !== $options['mobile'] ) :
	?><p style="color: red;"><?php _e( 'The visitor conditions below are deprecated. Please use the new version of visitor conditions to replace it.', 'advanced-ads' ); ?></p>
<ul id="advanced-ad-visitor-mobile">
    <li>
        <input type="radio" name="advanced_ad[visitor][mobile]"
               id="advanced-ad-visitor-mobile-all" value=""
				<?php checked( empty($options['mobile']), 1 ); ?>/>
        <label for="advanced-ad-visitor-mobile-all"><?php _e( 'Display on all devices', 'advanced-ads' ); ?></label>
        <input type="radio" name="advanced_ad[visitor][mobile]"
               id="advanced-ad-visitor-mobile-only" value="only"
				<?php checked( $options['mobile'], 'only' ); ?>/>
        <label for="advanced-ad-visitor-mobile-only"><?php _e( 'only on mobile devices', 'advanced-ads' ); ?></label>
        <input type="radio" name="advanced_ad[visitor][mobile]"
               id="advanced-ad-visitor-mobile-no" value="no"
				<?php checked( $options['mobile'], 'no' ); ?>/>
        <label for="advanced-ad-visitor-mobile-no"><?php _e( 'not on mobile devices', 'advanced-ads' ); ?></label>
    </li>
</ul>
<?php endif; ?>
<?php do_action( 'advanced-ads-visitor-conditions-after', $ad ); ?>