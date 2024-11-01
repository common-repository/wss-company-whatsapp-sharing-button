<?php
define("WSS_NAME","WhatsApp Share");
define("WSS_TAGLINE","Add button of WhatsApp to your post and pages!");

add_action('admin_init', 'wa_btn_init' );
function wa_btn_init(){
  register_setting( 'wa_btn_options', 'wa_btn' );
  $new_options = array(
    'top' => 'on',
    'btm' => 'on',
    'posts' => 'on',
    'pages' => 'off',
    'homepage' => 'off',
	'btn_text' => 'Share This in WhatsApp',
	'button_bg_color' => '#5cbe4a',
    'tracking' => 'off'
  );
  add_option( 'wa_btn', $new_options );
}


add_action('admin_menu', 'show_wa_btn_options');
function show_wa_btn_options() {
   
   add_menu_page('WhatsApp Share Settings', 'WhatsApp Share', 'administrator', 'wa_btn', 'wa_btn_options',plugins_url('/images/icon.png' , __FILE__ ));
  
}
 

// ADMIN PAGE
function wa_btn_options() {
?>
    <link href="<?php echo plugins_url( 'admin.css' , __FILE__ ); ?>" rel="stylesheet" type="text/css">
    <div class="wss_admin_wrap">
        <div class="wss_admin_top">
            <h1><?php echo WSS_NAME?> <small> - <?php echo WSS_TAGLINE?></small></h1>
        </div>

        <div class="wss_admin_main_wrap">
            <div class="wss_admin_main_left">
          <script type="text/javascript">
		  jQuery(document).ready(function($){
				$('.button_bg_color').wpColorPicker();
			});
		  </script>       

    <form method="post" action="options.php" id="options">
      <?php settings_fields('wa_btn_options'); ?>
      <?php $options = get_option('wa_btn'); 
        if (!isset($options['posts'])) {$options['posts'] = "";}
        if (!isset($options['pages'])) {$options['pages'] = "";}
        if (!isset($options['homepage'])) {$options['homepage'] = "";}
        if (!isset($options['top'])) {$options['top'] = "";}
        if (!isset($options['btm'])) {$options['btm'] = "";}
		if (!isset($options['btn_text'])) {$options['btn_text'] = "";}
		if (!isset($options['button_bg_color'])) {$options['button_bg_color'] = "#5cbe4a";}
        if (!isset($options['tracking'])) {$options['tracking'] = "";}
      ?>
      <table class="form-table">
        <tr valign="top"><th scope="row"><label for="posts"><?php _e('Post','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="posts" name="wa_btn[posts]" type="checkbox" value="on" <?php checked('on', $options['posts']); ?> /><small><?php _e('This is included in all post, custom post and attachments.','wss-company-whatsapp-sharing-button') ?></small></td>
        </tr>
        <tr valign="top"><th scope="row"><label for="pages"><?php _e('Pages','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="pages" name="wa_btn[pages]" type="checkbox" value="on" <?php checked('on', $options['pages']); ?> /></td>
        </tr>
        <tr valign="top"><th scope="row"><label for="homepage"><?php _e('Homepage','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="home" name="wa_btn[homepage]" type="checkbox" value="on" <?php checked('on', $options['homepage']); ?> /></td>
        </tr>
        <tr valign="top"><th scope="row"><label for="top"><?php _e('Top content','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="top" name="wa_btn[top]" type="checkbox" value="on" <?php checked('on', $options['top']); ?> /></td>
        </tr>
        <tr valign="top"><th scope="row"><label for="btm"><?php _e('Bottom content','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="btm" name="wa_btn[btm]" type="checkbox" value="on" <?php checked('on', $options['btm']); ?> /></td>
        </tr>
		<tr valign="top"><th scope="row"><label for="btm"><?php _e('Button text','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="btm" name="wa_btn[btn_text]" type="text" value="<?php echo $options['btn_text']; ?>" /></td>
        </tr>
		<tr valign="top"><th scope="row"><label for="btm"><?php _e('Button color','wss-company-whatsapp-sharing-button') ?></label></th>
          <td> <input name="wa_btn[button_bg_color]" class="button_bg_color" id="link-color" type="text" value="<?php echo $options['button_bg_color']; ?>" />
		  </td>
        </tr>
        <tr valign="top"><th scope="row"><label for="tracking"><?php _e('Add tracking','wss-company-whatsapp-sharing-button') ?></label></th>
          <td><input id="tracking" name="wa_btn[tracking]" type="checkbox" value="on" <?php checked('on', $options['tracking']); ?> /> <small><?php _e('Activate this to add UTM data on shared URL. It does not look nice, but helps you follow the visits in Google Analytics from WhatsApp. Source: WhatsApp. Medium: Messenger.','wss-company-whatsapp-sharing-button') ?></small></td>
        </tr>
      </table>

      <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
      </p>
    </form>

               <div class="wss_admin_box">
      <h3 class="title"><?php _e('Using the "shortcode"','wss-company-whatsapp-sharing-button') ?></h3>
      <table class="form-table">
        <tr valign="top"><td>
<p><?php _e('You can insert the button manually anywhere on your site using the "shortcode"','wss-company-whatsapp-sharing-button')?> <strong>[whatsapp_share]</strong>. </p>
<p><?php _e('You can use the following options to replace the previous settings','wss-company-whatsapp-sharing-button')?></p>
<ul>
<li><strong>url</strong><?php _e(' - leave blank for using the url from post','wss-company-whatsapp-sharing-button')?></li>
<li><strong>title</strong><?php _e(' - leave blank to display the current title','wss-company-whatsapp-sharing-button')?></li>
</ul>
<p><?php _e('This is an example of using the short code:','wss-company-whatsapp-sharing-button')?><br><code>[whatsapp_share url="https://www.wss.com.ve/whatsapp-share-plugin-para-wordpress/" title="<?php _e('Check this!','wss-company-whatsapp-sharing-button')?>"]</code></p>
<p><?php _e('You can also insert the code directly to your topic using PHP:','wss-company-whatsapp-sharing-button')?><br><code>&lt;?php echo do_shortcode('[whatsapp_share]'); ?&gt;</code>

          </td>
        </tr>
      </table>
</div>

</div>
            <div class="wss_admin_main_right">
                 <div class="wss_admin_box">

            <center><img src="<?php echo plugins_url( 'images/wss.png' , __FILE__ ); ?>"><a href="https://www.wss.com.ve" target="_blank"><img src="<?php echo plugins_url( 'images/wsscompanynew.png' , __FILE__ ); ?>" width="208" height="103" title="WSS Company, C.A."></a><br /><br /> </center>
            <a href="https://twitter.com/WSSCompany" class="twitter-follow-button" target="_blank">Twitter</a>
	    <a href="https://www.facebook.com/WSSCompany" class="facebook-follow-button" target="_blank">Facebook</a>
       
 
<br /><br />


                </div>

            </div>
        </div>
    </div>



<?php
}

?>