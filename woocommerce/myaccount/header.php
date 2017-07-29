<?php
$is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
$is_google_login = in_array( 'nextend-google-connect/nextend-google-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

$login_text = flatsome_option('facebook_login_text');
$login_bg = flatsome_option('facebook_login_bg');
$login_bg = $login_bg ? 'style="background-image:url('.do_shortcode($login_bg).')"' : '';
?>

<div class="my-account-header page-title normal-title
	<?php if($login_bg) echo 'dark featured-title'; ?>">

	<?php if($login_bg) { ?>
	<div class="page-title-bg fill bg-fill" <?php echo $login_bg; ?>>
		<div class="page-title-bg-overlay fill"></div>
	</div>
	<?php } ?>

	<div class="page-title-inner flex-row  container">
	  <div class="flex-col flex-grow <?php if(get_theme_mod('logo_position') == 'center') { echo 'text-center'; } else {echo 'medium-text-center'; } ?>">
	  		<?php if(is_user_logged_in()){?>
  				<h1 class="text-center">My Account / Dashboard</h1>
			<?php } // Loggeed In
			else { ?>

			<!-- custom end -->
			<div class="text-center social-login">
				<h1>My Account / Dashboard</h1>
		 	</div>

		 	<!-- custom end -->

		 	<?php }?>
	  </div><!-- .flex-left -->
	</div><!-- flex-row -->
</div><!-- .page-title -->
