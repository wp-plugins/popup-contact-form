<?php

/*
Plugin Name: Popup contact form
Description: Plugin allows user to creat and add the popup contact forms easily on the website. That popup contact form let user to send the emails to site admin.
Author: Gopi.R
Version: 3.0
Plugin URI: http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/
Author URI: http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/
Donate link: http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function PopupContact()
{
	$display = "dontshow";
	if(is_home() && get_option('PopupContact_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('PopupContact_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('PopupContact_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('PopupContact_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('PopupContact_On_Search') == 'YES') {	$display = "show";	}
	
	if($display == "show")
	{
		?>
<a href='javascript:PopupContact_OpenForm("PopupContact_BoxContainer","PopupContact_BoxContainerBody","PopupContact_BoxContainerFooter");'><?php echo get_option('PopupContact_Caption'); ?></a>
<div style="display: none;" id="PopupContact_BoxContainer">
  <div id="PopupContact_BoxContainerHeader">
    <div id="PopupContact_BoxTitle"><?php echo get_option('PopupContact_title'); ?></div>
    <div id="PopupContact_BoxClose"><a href="javascript:PopupContact_HideForm('PopupContact_BoxContainer','PopupContact_BoxContainerFooter');">Close</a></div>
  </div>
  <div id="PopupContact_BoxContainerBody">
    <form action="#" name="PopupContact_Form" id="PopupContact_Form">
      <div id="PopupContact_BoxAlert"> <span id="PopupContact_alertmessage"></span> </div>
      <div id="PopupContact_BoxLabel"> Your Name </div>
      <div id="PopupContact_BoxLabel">
        <input name="PopupContact_name" class="PopupContact_TextBox" type="text" id="PopupContact_name" maxlength="120">
      </div>
      <div id="PopupContact_BoxLabel"> Your Email </div>
      <div id="PopupContact_BoxLabel">
        <input name="PopupContact_email" class="PopupContact_TextBox" type="text" id="PopupContact_email" maxlength="120">
      </div>
      <div id="PopupContact_BoxLabel"> Enter Your Message </div>
      <div id="PopupContact_BoxLabel">
        <textarea name="PopupContact_message" class="PopupContact_TextArea" rows="3" id="PopupContact_message"></textarea>
      </div>
      <div id="PopupContact_BoxLabel">
        <input type="button" name="button" class="PopupContact_Button" value="Submit" onClick="javascript:PopupContact_Submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/popup-contact-form/');">
      </div>
    </form>
  </div>
</div>
<div style="display: none;" id="PopupContact_BoxContainerFooter"></div>
<?php
	}
}

function PopupContact_install() 
{
	global $wpdb, $wp_version;
	add_option('PopupContact_title', "Contact Us");
	add_option('PopupContact_fromemail', "admin@contactform.com");
	add_option('PopupContact_On_Homepage', "YES");
	add_option('PopupContact_On_Posts', "YES");
	add_option('PopupContact_On_Pages', "YES");
	add_option('PopupContact_On_Archives', "NO");
	add_option('PopupContact_On_Search', "NO");
	add_option('PopupContact_On_SendEmail', "YES");
	add_option('PopupContact_On_MyEmail', "YOUR-EMAIL-ADDRESS-TO-RECEIVE-MAILS");
	add_option('PopupContact_On_Subject', "EMAIL-SUBJECT");
	add_option('PopupContact_On_Captcha', "YES");
	add_option('PopupContact_Caption', "<img src='".get_option('siteurl')."/wp-content/plugins/popup-contact-form/popup-contact-form.jpg' />");
}

function PopupContact_widget($args) 
{
	$display = "dontshow";
	if(is_home() && get_option('PopupContact_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('PopupContact_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('PopupContact_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('PopupContact_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('PopupContact_On_Search') == 'YES') {	$display = "show";	}
	
	$title = get_option('PopupContact_title');
	if($display == "show")
	{
		extract($args);
	    echo $before_widget;
		PopupContact();
		echo $after_widget;
	}
}
	
function PopupContact_control() 
{
	echo 'To change the setting goto Popup contact form link on Setting menu.';
	echo '<br><a href="options-general.php?page=popup-contact-form/popup-contact-form.php">';
	echo 'click here</a></p>';
}

function PopupContact_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('Popup contact form', 'Popup contact form', 'PopupContact_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('Popup contact form', array('Popup contact form', 'widgets'), 'PopupContact_control');
	} 
}

function PopupContact_deactivation() 
{

}

function PopupContact_admin()
{
	echo '<div class="wrap">';
	echo '<h2>Popup contact form</h2>';
	global $wpdb, $wp_version;
	$PopupContact_title = get_option('PopupContact_title');
	$PopupContact_On_Homepage = get_option('PopupContact_On_Homepage');
	$PopupContact_On_Posts = get_option('PopupContact_On_Posts');
	$PopupContact_On_Pages = get_option('PopupContact_On_Pages');
	$PopupContact_On_Search = get_option('PopupContact_On_Search');
	$PopupContact_On_Archives = get_option('PopupContact_On_Archives');
	$PopupContact_On_MyEmail = get_option('PopupContact_On_MyEmail');
	$PopupContact_On_Subject = get_option('PopupContact_On_Subject');
	$PopupContact_Caption = get_option('PopupContact_Caption');
	
	if (@$_POST['PopupContact_submit']) 
	{
		$PopupContact_title = stripslashes($_POST['PopupContact_title']);
		$PopupContact_On_Homepage = stripslashes($_POST['PopupContact_On_Homepage']);
		$PopupContact_On_Posts = stripslashes($_POST['PopupContact_On_Posts']);
		$PopupContact_On_Pages = stripslashes($_POST['PopupContact_On_Pages']);
		$PopupContact_On_Search = stripslashes($_POST['PopupContact_On_Search']);
		$PopupContact_On_Archives = stripslashes($_POST['PopupContact_On_Archives']);
		$PopupContact_On_MyEmail = stripslashes($_POST['PopupContact_On_MyEmail']);
		$PopupContact_On_Subject = stripslashes($_POST['PopupContact_On_Subject']);
		$PopupContact_Caption = stripslashes($_POST['PopupContact_Caption']);
		
		update_option('PopupContact_title', $PopupContact_title );
		update_option('PopupContact_On_Homepage', $PopupContact_On_Homepage );
		update_option('PopupContact_On_Posts', $PopupContact_On_Posts );
		update_option('PopupContact_On_Pages', $PopupContact_On_Pages );
		update_option('PopupContact_On_Search', $PopupContact_On_Search );
		update_option('PopupContact_On_Archives', $PopupContact_On_Archives );
		update_option('PopupContact_On_MyEmail', $PopupContact_On_MyEmail );
		update_option('PopupContact_On_Subject', $PopupContact_On_Subject );
		update_option('PopupContact_Caption', $PopupContact_Caption );
	}
	
	echo '<form name="form_gCF" method="post" action="">';
	
	echo '<p>Title:<br><input  style="width: 350px;" type="text" value="';
	echo $PopupContact_title . '" name="PopupContact_title" id="PopupContact_title" /></p>';
	
	echo '<p>On Homepage Display:<br><input  style="width: 100px;" type="text" value="';
	echo $PopupContact_On_Homepage . '" name="PopupContact_On_Homepage" maxlength="3" id="PopupContact_On_Homepage" /> (YES/NO)</p>';
	
	echo '<p>On Posts Display:<br><input  style="width: 100px;" type="text" value="';
	echo $PopupContact_On_Posts . '" name="PopupContact_On_Posts" maxlength="3" id="PopupContact_On_Posts" /> (YES/NO)</p>';
	
	echo '<p>On Pages Display:<br><input  style="width: 100px;" type="text" value="';
	echo $PopupContact_On_Pages . '" name="PopupContact_On_Pages" maxlength="3" id="PopupContact_On_Pages" /> (YES/NO)</p>';
	
	echo '<p>On Search Display:<br><input  style="width: 100px;" type="text" value="';
	echo $PopupContact_On_Search . '" name="PopupContact_On_Search" maxlength="3" id="PopupContact_On_Search" /> (YES/NO)</p>';
	
	echo '<p>On Archives Display:<br><input  style="width: 100px;" type="text" value="';
	echo $PopupContact_On_Archives . '" name="PopupContact_On_Archives" maxlength="3" id="PopupContact_On_Archives" /> (YES/NO)</p>';
	
	echo '<p>Email Address:<br><input style="width: 350px;" type="text" value="';
	echo $PopupContact_On_MyEmail . '" name="PopupContact_On_MyEmail" maxlength="200" id="PopupContact_On_MyEmail" /><br />';
	echo '<span style="font-size:0.8em;">Enter your email address to receive the contact mails</span></p>';
	
	echo '<p>Email Subject:<br><input style="width: 350px;" type="text" value="';
	echo $PopupContact_On_Subject . '" name="PopupContact_On_Subject" maxlength="200" id="PopupContact_On_Subject" /><br />';
	echo '<span style="font-size:0.8em;">Enter contact mails subject</span></p>';
	
	echo '<p>Link Button/Text:<br><input style="width: 700px;" type="text" value="';
	echo $PopupContact_Caption . '" name="PopupContact_Caption" id="PopupContact_Caption" /><br />';
	echo '<span style="font-size:0.8em;">This box is to add the contact us Image or text, Entered value will display in the front end.</span></p>';
	
	echo '<input type="submit" id="PopupContact_submit" name="PopupContact_submit" lang="publish" class="button-primary" value="Update Setting" value="1" />';
	
	$help = "'http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/'";
	echo '&nbsp;&nbsp;&nbsp;<input name="Help" lang="publish" class="button-primary" onclick="window.open('.$help.');" value="Help" type="button" />';
	
	echo '</form>';
	
	echo '<br /><strong>Plugin configuration</strong>';
	echo '<ol>';
	echo '<li>Drag and drop the widget</li>';
	echo '<li>Paste the php code to your desired template location</li>';
	echo '<li>Short code for pages and posts</li>';
	echo '</ol>';
	echo 'Note: Check official website for more info <a href="http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/" target="_blank">click here</a>';

	echo '</div>';
}


function PopupContact_add_to_menu() 
{
	add_options_page('Popup contact form', 'Popup contact form', 'manage_options', __FILE__, 'PopupContact_admin' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'PopupContact_add_to_menu');
}

function PopupContact_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_style( 'popup-contact-form', get_option('siteurl').'/wp-content/plugins/popup-contact-form/popup-contact-form.css');
		wp_enqueue_script( 'popup-contact-form', get_option('siteurl').'/wp-content/plugins/popup-contact-form/popup-contact-form.js');
		wp_enqueue_script( 'popup-contact-popup', get_option('siteurl').'/wp-content/plugins/popup-contact-form/popup-contact-popup.js');
	}
}   



//[popup-contact-form id="1" title="Contact Us"]
function PopupContact_shortcode( $atts ) 
{
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	
	$id = $atts['id'];
	$title = $atts['title'];
	
	$PopupContact_Caption = get_option('PopupContact_Caption');
	$PopupContact_title = $title;
	$siteurl = "'".get_option('siteurl') . "/wp-content/plugins/popup-contact-form/'";
	$close = "javascript:PopupContact_HideForm('PopupContact_BoxContainer','PopupContact_BoxContainerFooter');";
	$open = 'javascript:PopupContact_OpenForm("PopupContact_BoxContainer","PopupContact_BoxContainerBody","PopupContact_BoxContainerFooter");';
	
	$html = "<a href='".$open."'>".$PopupContact_Caption."</a>";
	$html .= '<div style="display: none;" id="PopupContact_BoxContainer">';
	  $html .= '<div id="PopupContact_BoxContainerHeader">';
		$html .= '<div id="PopupContact_BoxTitle">'.$PopupContact_title.'</div>';
		$html .= '<div id="PopupContact_BoxClose"><a href="'.$close.'">Close</a></div>';
	  $html .= '</div>';
	  $html .= '<div id="PopupContact_BoxContainerBody">';
		$html .= '<form action="#" name="PopupContact_Form" id="PopupContact_Form">';
		  $html .= '<div id="PopupContact_BoxAlert"> <span id="PopupContact_alertmessage"></span> </div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page"> Your Name </div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page">';
			$html .= '<input name="PopupContact_name" class="PopupContact_TextBox" type="text" id="PopupContact_name" maxlength="120">';
		  $html .= '</div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page"> Your Email </div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page">';
			$html .= '<input name="PopupContact_email" class="PopupContact_TextBox" type="text" id="PopupContact_email" maxlength="120">';
		  $html .= '</div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page"> Enter Your Message </div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page">';
			$html .= '<textarea name="PopupContact_message" class="PopupContact_TextArea" rows="3" id="PopupContact_message"></textarea>';
		  $html .= '</div>';
		  $html .= '<div id="PopupContact_BoxLabel_Page">';
			$html .= '<input type="button" name="button" class="PopupContact_Button" value="Submit" onClick="javascript:PopupContact_Submit(this.parentNode,'.$siteurl.');">';
		  $html .= '</div>';
		$html .= '</form>';
	  $html .= '</div>';
	$html .= '</div>';
	$html .= '<div style="display: none;" id="PopupContact_BoxContainerFooter"></div>';
	
	return $html;
}

add_shortcode( 'popup-contact-form', 'PopupContact_shortcode' );
add_action('wp_enqueue_scripts', 'PopupContact_add_javascript_files');
add_action("plugins_loaded", "PopupContact_widget_init");
register_activation_hook(__FILE__, 'PopupContact_install');
register_deactivation_hook(__FILE__, 'PopupContact_deactivation');
add_action('init', 'PopupContact_widget_init');
?>
