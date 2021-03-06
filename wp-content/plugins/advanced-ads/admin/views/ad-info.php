<div id="advads-ad-info">
    <span><?php printf( __( 'Ad Id: %s', 'advanced-ads' ), "<strong>$post->ID</strong>" ); ?></span>
    <label><span><?php _e( 'shortcode', 'advanced-ads' ); ?></span>
	<pre><input type="text" onclick="this.select();" value='[the_ad id="<?php echo $post->ID; ?>"]'/></pre></label>
    <label><span><?php _e( 'theme function', 'advanced-ads' ); ?></span>
	<pre><input type="text" onclick="this.select();" value="&lt;?php the_ad(<?php echo $post->ID; ?>); ?&gt;"/></pre></label>
    <span><?php printf( __( 'Find more display options in the <a href="%s" target="_blank">manual</a>.', 'advanced-ads' ), ADVADS_URL . 'manual/display-ads/' ); ?></span>
</div>
</p>
<div id="advads-ad-description">
    <?php if ( ! empty($ad->description) ) : ?>
    <p title="<?php _e( 'click to change', 'advanced-ads' ); ?>"
       onclick="advads_toggle('#advads-ad-description textarea'); advads_toggle('#advads-ad-description p')"><?php
		echo nl2br( $ad->description ); ?></p>
    <?php else : ?>
    <button type="button" onclick="advads_toggle('#advads-ad-description textarea'); advads_toggle('#advads-ad-description button')"><?php _e( 'Add a description', 'advanced-ads' ); ?></button>
    <?php endif; ?>
    <textarea name="advanced_ad[description]" placeholder="<?php
		_e( 'Internal description or your own notes about this ad.', 'advanced-ads' ); ?>"><?php echo $ad->description; ?></textarea>
</div>