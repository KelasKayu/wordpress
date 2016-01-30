<fieldset class="inline-edit-col-left">
	<div class="inline-edit-col <?php echo $html_classes; ?>">
		<?php if ( $post_future ) : ?>
			<p><?php printf( __( 'starts %s', 'advanced-ads' ), date( $expiry_date_format, $post_future ) ); ?></p>
		<?php endif;
		if ( $expiry && $expiry > time() ) : ?>
			<p><?php printf( __( 'expires %s', 'advanced-ads' ), date( $expiry_date_format, $expiry ) ); ?></p>
		<?php elseif( $expiry && $expiry <= time() ) : ?>
			<p><?php printf( __( '<strong>expired</strong> %s', 'advanced-ads' ), date( $expiry_date_format, $expiry ) ); ?></p>
		<?php endif;
		/* if ( ! empty( $size) ) : ?>
			<p><?php echo $size; ?></p>
		<?php endif; */
		do_action( 'advanced-ads-ad-list-timing-column-after', $ad ); ?>
	</div>
</fieldset>