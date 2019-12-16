<?php

class ClassLoginSetting {

    public function __construct( ) {
    	add_action( 'admin_init', array( $this, 'sp_wp_cust_login_logo_option_settings' ) );
        add_action( 'admin_menu', array( $this, 'sp_wp_cust_login_logo_setting_page' ) );
        add_action( 'login_head', array( $this, 'sp_wp_cust_login_logo_frontend_display' ) );
        add_filter( 'plugin_action_links_wp-custom-login-logo/wp-custom-login-logo.php', array( $this, 'sp_wp_cust_login_logo_settings_link' ) );
    }

    /* Add action links to plugin list*/
	
	public function sp_wp_cust_login_logo_settings_link( $links ) {
		# Build and escape the URL.
		$url = esc_url( add_query_arg(
			'page',
			'sp-wp-cust-login-logo',
			get_admin_url() . 'options-general.php'
		) );

		# Create the link.
		$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';

		# Adds the link to the end of the array.
		array_push(
			$links,
			$settings_link
		);

		return $links;
	}

    public function sp_wp_cust_login_logo_option_settings() 
	{
	   register_setting( 'sp_wp_cust_logo_options', 'sp_wp_cust_login_logo');
	}

    public function sp_wp_cust_login_logo_setting_page() {
	 	add_options_page('Wp Login Logo', 'Wp Login Logo', 'manage_options', 'sp-wp-cust-login-logo', array( $this, 'sp_wp_cust_login_logo_setting_page_html' ));
	 	
	}

	public function sp_wp_cust_login_logo_setting_page_html(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'custom-js' );
		wp_enqueue_media();
		?>
		<div class="wrap">
			<!-- <h1>Wp Login Logo Settings</h1> -->
			<h3>Logo Settings</h3>
			<form method="post" action="options.php">
				<?php settings_fields( 'sp_wp_cust_logo_options' ); ?>
				<?php do_settings_sections( 'sp_wp_cust_logo_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Custom Logo</th>
						<td>
							<input type="text" id="sp_wp_cust_login_logo" name="sp_wp_cust_login_logo" value="<?php echo esc_attr( get_option('sp_wp_cust_login_logo') ); ?>" readonly=""/>
							<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Change Logo" >
							<p class="description"><i>Appear Wp-admin login page.</i></p>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function sp_wp_cust_login_logo_frontend_display() {
	    $cust_logo_url = get_option( 'sp_wp_cust_login_logo' );

		if( !empty( $cust_logo_url ) )
		{
			echo '<style type="text/css">'.'h1 a { background-image:url('.$cust_logo_url.') !important;height:100px !important;width:100px !important;background-size:100% !important;
					line-height:inherit !important; }'.'</style>';
		}
	}

}

$ClassLoginSetting = new ClassLoginSetting();