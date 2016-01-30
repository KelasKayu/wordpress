<?php
/**
 * the view for the debug page
 */
?><div class="wrap">
    <h1><?php _e( 'Debug Page', 'advanced-ads' ); ?></h1>
    <p><?php _e( 'Work in progress', 'advanced-ads' ); ?></p>
    <p><?php _e( 'This screen is work in progress. You can use the information if you understand them, but there is nothing to do here yet.', 'advanced-ads' ); ?></p>
    <?php screen_icon(); ?>

    <h2><?php _e( 'Settings', 'advanced-ads' ); ?></h2>
    <pre><?php print_r( $plugin_options ); ?></pre>

    <h2><?php _e( 'Ad Placements', 'advanced-ads' ); ?></h2>
    <pre><?php print_r( $ad_placements ); ?></pre>

    <?php do_action('advanced-ads-debug-after', $plugin_options); ?>
</div>