<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
	<?php if ( isset( $show_title ) ) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php _e( 'Downloads', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<table class="woocommerce-table woocommerce-table--order-downloads shop_table order_details">
        <?php $previousValue = null ?>
		<?php foreach ( $downloads as $download ) : ?>
	        <?php if( $download['product_id'] != $previousValue['product_id'] ): ?>
                <tr class="download-title">
                    <td colspan="4">
                        <a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>"><?php echo esc_html( $download['product_name'] ); ?></a>
                    </td>
                </tr>
	        <?php endif; ?>

			<tr>
        <?php
        $product = wc_get_product($download['product_id']);

        // ASK USER TO LOOK AT EMAIL DOWNLOAD LINK TO MAKE SURE THEY GAVE A VALID EMAIL
        if ($product->get_price() == 0) {
          if( $download['product_id'] != $previousValue['product_id'] ):
            echo "<td class='please-see-email'>" . __('See email for download links.') . "</td>";
          endif;
          $previousValue = $download;
        } else {

          foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
            <td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>"><?php

                if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
                  do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
                } else {
//                    var_dump($download);
                  switch ( $column_id ) {
                    case 'download-product' : ?>
                      <?php $previousValue = $download; ?>
                      <span>- <?php echo esc_html( $download['download_name'] ); ?></span>
                      <?php
                    break;
                    case 'download-file' : ?>
                        <?php
                        if ( strpos( $download['file']['file'], 'youtu' ) ) {
	                        ?>
                            <a href="<?php echo esc_url( $download['file']['file'] ); ?>" class="woocommerce-MyAccount-downloads-file button alt">Watch</a>
	                        <?php
                        } else {
                            ?>
                            <a href="<?php echo esc_url( $download['download_url'] ); ?>" class="woocommerce-MyAccount-downloads-file button alt">Download</a>
                            <?php
                        }
                        ?>

                      <?php
                    break;
                  }
                }

            ?></td><?php
          endforeach;

        }
        ?>
			</tr>
		<?php endforeach; ?>
	</table>
</section>
