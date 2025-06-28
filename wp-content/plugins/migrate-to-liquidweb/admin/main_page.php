<header class="header-container">
	<img class="liquidweb-logo" src="<?php echo esc_url(plugins_url("/../img/liquidweb-logo.png", __FILE__)); ?>">
	<img class="blogvault-logo" src="<?php echo esc_url(plugins_url("/../img/blogvault-logo.png", __FILE__)); ?>">
</header>
<main class="text-center">
	<div class="card">
		<form action="<?php echo esc_url($this->bvinfo->appUrl()); ?>/migration/migrate" method="post" name="signup">
			<h1 class="card-title">Migrate My Site to Liquid Web / Nexcess</h1>
			<p class="card-description">
				The Liquid Web & Nexcess WP Migrate plugin makes it very easy to migrate your entire site from your previous hosting provider to Liquid Web &
					Nexcess. For detailed instructions on how to migrate your site, please visit our Knowledgebase Articles for 
				<a href="https://help.nexcess.net/74095-wordpress/migrating-to-nexcess-with-managed-wordpress-and-managed-woocommerce-hosting"
					target="_blank" rel="noreferrer">
					Nexcess
				</a> or <a href="https://www.liquidweb.com/kb/migrating-to-liquid-web-with-managed-wordpress-portal/" target="_blank" rel="noreferrer">
					Liquid Web
				</a>
			</p>
			<hr class="my-4">
			<div class="form-content">
				<label class="email-label" required>Email</label>
				<br>
				<input type="email" name="email" placeholder="Email address" class="email-input">
				<div class="tnc-check text-center mt-2">
					<label class="normal-text horizontal">
						<input type="hidden" name="bvsrc" value="wpplugin" />
						<input type="hidden" name="migrate" value="nexcess" />
						<input type="checkbox" name="consent" onchange="document.getElementById('migratesubmit').disabled = !this.checked;" value="1" autocomplete='off'>
						<span class="checkmark"></span>&nbsp;
						I agree to BlogVault's <a href="https://blogvault.net/tos/">Terms &amp; Conditions</a> and <a href="https://blogvault.net/privacy/">Privacy&nbsp;Policy</a>
					</label>
				</div>
			</div>
			<?php echo $this->siteInfoTags(); ?>
			<input type="submit" name="submit" id="migratesubmit" class="button button-primary" value="Migrate" disabled>
		</form>
	</div>
</main>