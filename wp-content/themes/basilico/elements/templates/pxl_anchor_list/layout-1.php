<?php
$default_settings = [
	'anchors' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);
?>

<?php if (isset($anchors) && !empty($anchors) && count($anchors)): ?>
<div class="pxl-anchor-list layout-1">
	<div class="pxl-anchor-list-wrap d-inline-flex">
		<?php foreach ($anchors as $key => $anchor): ?>
			<?php
			$selected_template = esc_attr($anchor['template']);
			if ($selected_template == 'cart-dropdown') {
				$target = '.pxl-cart-dropdown';
				$template = 0;
				$anchor_link = '#';
			}
			else if ($selected_template == 'cart-page') {
				$target = '';
				$template = 0;
				$anchor_link = wc_get_cart_url();
			}
			else if ($selected_template == 'url') {
				$target = '';
				$template = 0;
				$anchor_link = esc_url($anchor['anchor_url']);
			}
			else {
				$template = (int)$anchor['template'];
				$target = '.pxl-hidden-template-'.$template;
				$anchor_link = '#pxl-'.esc_attr($template);
			}
			
			if ($selected_template == 'cart-dropdown')
				$anchor_cls = 'pxl-anchor cart_anchor';
			else if ($selected_template == 'cart-page' || $selected_template == 'url')
				$anchor_cls = 'pxl-anchor';
			else
				$anchor_cls = 'pxl-anchor side-panel';

			$widget->add_render_attribute('anchor'.$key, 'class', esc_attr($anchor_cls));

			if ($template > 0 ){
				if ( !has_action( 'pxl_anchor_target_hidden_panel_'.$template) ){
					add_action( 'pxl_anchor_target_hidden_panel_'.$template, 'basilico_hook_anchor_hidden_panel' );
				}
			} else {
				add_action( 'pxltheme_anchor_target', 'basilico_hook_anchor_custom' );
			}
			?>
			<div class="pxl-anchor-wrapper relative <?php echo esc_attr($selected_template) == 'cart-dropdown' ? 'pxl-anchor-cart' : ''; ?>">
				<a href="<?php echo esc_attr($anchor_link); ?>" <?php pxl_print_html($widget->get_render_attribute_string( 'anchor'.$key )); ?> data-target="<?php echo esc_attr($target)?>">
					<?php \Elementor\Icons_Manager::render_icon( $anchor['selected_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'span' ); ?>
					<?php if ( !\Elementor\Plugin::$instance->editor->is_edit_mode() && isset($anchor['cart_count']) && esc_attr($anchor['cart_count'] == 'true') ): ?>
						<span class="anchor-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
					<?php endif; ?>
				</a>
				<?php if ($selected_template == 'cart-dropdown' && !\Elementor\Plugin::$instance->editor->is_edit_mode()): ?>
					<div class="pxl-cart-dropdown widget_shopping_cart">
						<?php $style = $anchor['cart_style']; ?>
						<div class="pxl-cart-widget <?php echo esc_attr($style) ?>">
							<?php woocommerce_mini_cart(); ?>
							<div class="cart-content-footer">
								<div class="cart-footer-wrap">
									<?php wc_get_template( 'cart/mini-cart-totals.php' ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>