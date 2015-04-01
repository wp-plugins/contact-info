<?php 
/*
Plugin Name: Contact Info
Plugin URI: http://avifoujdar.wordpress.com/category/my-wp-plugins/
Description: This Plugin will allow the admin user to update the contact information and display them using functions and shortcodes. This includes Phone no, Email, and Address.
Version: 2.1a
Author: avimegladon
Author URI: avifoujdar.wordpress.com/
*/	


class contact_info {
	public static $title = 'Contact Info Settings';
	public static $phone_text = 'Phone';
	public static $email_text = 'Email';
	public static $address_text = 'Address';
	
	function __construct() {
		$this->plug_settings();
	}
	
	function contact_info_sc($atts){
		 $codes = array('phone' => 'cph', 'email' => 'cmail', 'address' => 'cadd' );
		 $atts = shortcode_atts( array(
			  'show' => '',
		  ), $atts );
		
		$ret = get_option($codes[$atts['show']]);
      	return $ret;
	}
	
	function plug_install_contact_info(){
		delete_option("cph");
		delete_option("cmail");
		delete_option("cadd");
		add_option("cph", '');
		add_option("cmail", '');
		add_option("cadd", '');
	}

	function plug_unins_contact_info(){              
		delete_option("cph");
		delete_option("cmail");
		delete_option("cadd");
	}

	function contact_info_save_data(){
		if(isset($_POST) && $_POST['update_contact'] == "update_contact"){
			$cph = $_POST['cph'];
			$cmail = $_POST['cmail'];
			$cadd = $_POST['cadd'];
			update_option("cph",$cph , '', '');
			update_option("cmail",$cmail , '', '');
			update_option("cadd",$cadd , '', '');
			$GLOBALS['msg'] = "Data Updated Successfully";
		}
	}
	
	function contact_info_afo_plugin_menu () {
		add_options_page('contact_info_options', 'Contact Info', 'manage_options', 'created_by_AFO',  array( $this, 'contact_info_options' ) );
	}
	
	function contact_help(){?>
		<h3>Usage Help</h3>
			<p><strong>This plugin automatically allows you to write shortcodes to wordpress text widgets.</strong></p>
			<p><strong>For Phone No :</strong> <strong>&lt;?php echo ci("phone"); ?&gt;</strong> Or Shortcode <strong>[ci show="phone"]</strong><br />
			<strong>For Email Address :</strong> <strong>&lt;?php echo ci("email");?&gt;</strong> Or Shortcode <strong>[ci show="email"]</strong><br />
			<strong>For Address/Any Text :</strong> <strong>&lt;?php echo ci("address");?&gt; </strong> Or Shortcode <strong>[ci show="address"]</strong></p>
	<?php }
	
	function plug_settings(){
		register_activation_hook(__FILE__, array( $this, 'plug_install_contact_info' ) );
		register_deactivation_hook(__FILE__, array( $this, 'plug_unins_contact_info' ) );
		add_action('admin_menu',  array( $this, 'contact_info_afo_plugin_menu' ) );
		add_action('init',  array( $this, 'contact_info_save_data' ) );
		add_shortcode( 'ci', array( $this, 'contact_info_sc' ) );	
		add_filter('widget_text', 'do_shortcode');
	}
	
	function load_script(){?>
	<script type="text/javascript">
	function Usage(){if(document.getElementById('usg').style.display == 'none'){document.getElementById('usg').style.display='block';document.getElementById('utxt').innerHTML='<strong>Hide Usage</strong>';} else {document.getElementById('usg').style.display='none';document.getElementById('utxt').innerHTML='<strong>Show Usage</strong>';}}
	</script>
	<?php }
	
	function  contact_info_options () {
	global $wpdb;
	$cph = get_option('cph');
	$cmail = get_option('cmail');
	$cadd = get_option('cadd');
	?>
	<?php $this->load_script();?>
	<table width="100%" border="0">
	<form id="form1" name="form1" method="post" action="">
	  <tr>
		<td colspan="2" align="center"><font color="#FF0000"><?= $GLOBALS['msg'];?></font></td>
		</tr>
	  <tr>
		<td colspan="2"><h2><?php echo self::$title;?></h2></td>
		</tr>
	  <tr>
		<td width="45%"><?php echo self::$phone_text;?>:</td>
		<td width="55%"><label>
		  <input name="cph" type="text" size="45" value="<?= $cph;?>" />
		</label></td>
	  </tr>
	  <tr>
		<td><?php echo self::$email_text;?>: </td>
		<td><label>
		<input name="cmail" type="text" size="45" value="<?= $cmail;?>" />
		</label></td>
	  </tr>
	  <tr>
		<td><?php echo self::$address_text;?>:</td>
		<td>
		  <label></label>    <label>
		  <input name="cadd" type="text" size="45" value="<?= $cadd;?>" />
		  </label></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>
		  <label>
		  <input type="hidden" value="update_contact" name="update_contact" />
			<input type="submit" name="Submit" value="Save" class="button" />
			</label>    </td>
	  </tr>
	  <tr>
		<td colspan="2" align="left"><div id="utxt" onclick="Usage()" style="cursor:pointer;"><strong>Show Usage</strong></div></td>
	  </tr> 
	  <tr>
		<td colspan="2" align="left"><div id="usg" style="display:none;"><?php $this->contact_help();?></div></td>
	  </tr>
	  </form>
	</table>
	<?php
	}
}
new contact_info;

function ci($show){
	$codes = array('phone' => 'cph', 'email' => 'cmail', 'address' => 'cadd' );
	$ret = get_option($codes[$show]);
	echo $ret;
}