=== contact info ===
Contributors: afo
Tags: contact, email, phone, address
Requires at least: 2.0.2
Tested up to: 3.2.1
Stable tag: 4.3

Use these codes in the theme where you want to show the contact informations to appear.

== Description ==

For Phone No : <?= get_option('cph');?>
For Mail Address : <a href="mailto:<?= get_option('cmail');?>"><?= get_option('cmail');?></a>
For Address/Any Text : <?= get_option('cmod');?>

== Installation ==


1. Upload `contact_info` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Changelog ==

= 1.0 =
* this is the first release.
* 

= 0.1 =
* version 0.1

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.
