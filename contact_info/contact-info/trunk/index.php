<?php 
/*
Plugin Name: Contact Info
Plugin URI: http://afoweb.zxq.net/
Description: This Plugin will allow the admin to update the contact information. This includes phone no, email address, and address.
Version: 1.1a
Author: AFO 
Author URI: http://afoweb.zxq.net/
*/	


add_action('admin_menu', 'contact_info_afo_plugin_menu');

function contact_info_afo_plugin_menu() {

  add_options_page('contact_info_options', 'Contact Info', 'manage_options', 'created_by_AFO', 'contact_info_options');

}

function contact_info_options() {
global $wpdb;
$cph = get_option('cph');
$cmail = get_option('cmail');
$cmod = get_option('cmod');
?>
<script type="text/javascript">
function Usage(){
	if(document.getElementById('usg').style.display == 'none'){
	document.getElementById('usg').style.display='block';
	document.getElementById('utxt').innerHTML='Hide Usage';
	} else {
	document.getElementById('usg').style.display='none';
	document.getElementById('utxt').innerHTML='Show Usage';
	}
}

</script>
<table width="50%" border="1">
<form id="form1" name="form1" method="post" action="">
  <tr>
    <td colspan="2" align="left"><div id="utxt" onclick="Usage()" style="cursor:pointer;">Show Usage</div></td>
  </tr> 
  <tr>
    <td colspan="2" align="left"><div id="usg" style="display:none;">
      <p><strong>Use these codes in the theme where you want to show the contact informations to appear.</strong><br />
        <br />
        <strong>For Phone No :</strong> &lt;?= get_option('cph');?&gt;<br />
        <strong>For Mail Address :</strong> &lt;a href=&quot;mailto:&lt;?= get_option('cmail');?&gt;&quot;&gt;&lt;?= get_option('cmail');?&gt;&lt;/a&gt;<br />
        <strong>For Address/Any Text :</strong> &lt;?= get_option('cmod');?&gt;</p>
      </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><font color="#FF0000"><?= $GLOBALS['msg'];?></font></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Update Contact </strong></td>
    </tr>
  <tr>
    <td width="45%">Ph:</td>
    <td width="55%"><label>
      <input name="cph" type="text" size="45" value="<?= $cph;?>" />
    </label></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><label>
    <input name="cmail" type="text" size="45" value="<?= $cmail;?>" />
    </label></td>
  </tr>
  <tr>
    <td>Address:</td>
    <td>
      <label></label>    <label>
      <input name="cmod" type="text" size="45" value="<?= $cmod;?>" />
      </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <label>
	  <input type="hidden" value="update_contact" name="update_contact" />
        <input type="submit" name="Submit" value="Update" />
        </label>    </td>
  </tr>
  </form>
</table>
<?php

}


register_activation_hook(__FILE__,'plug_install');

register_deactivation_hook(__FILE__,'plug_unins');

function plug_install()
{
   // delete options //
    delete_option("cph");
	delete_option("cmail");
	delete_option("cmod");
	
	// add default option //
    add_option("cph", '1234 4321', '', '');
	add_option("cmail", 'admin@admin.com', '', '');
	add_option("cmod", 'Lorem Ipsum is simply dummy text of the printing and typesetting ', '', '');

}

function plug_unins()
{              
   // delete options //
    delete_option("cph");
	delete_option("cmail");
	delete_option("cmod");
}

if(isset($_POST) && $_POST['update_contact'] == "update_contact")
{
$cph =$_POST['cph'];
$cmail =$_POST['cmail'];
$cmod =$_POST['cmod'];

update_option("cph",$cph , '', '');
update_option("cmail",$cmail , '', '');
update_option("cmod",$cmod , '', '');
$GLOBALS['msg'] = "Information Updated Successfully";
}
?>