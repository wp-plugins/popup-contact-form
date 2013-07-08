<div class="wrap">
  <div class="form-wrap">
    <div id="icon-plugins" class="icon32 icon32-posts-post"><br>
    </div>
    <h2>Popup contact form</h2>
    <?php
	$PopupContact_title = get_option('PopupContact_title');
	$PopupContact_On_Homepage = get_option('PopupContact_On_Homepage');
	$PopupContact_On_Posts = get_option('PopupContact_On_Posts');
	$PopupContact_On_Pages = get_option('PopupContact_On_Pages');
	$PopupContact_On_Search = get_option('PopupContact_On_Search');
	$PopupContact_On_Archives = get_option('PopupContact_On_Archives');
	$PopupContact_On_MyEmail = get_option('PopupContact_On_MyEmail');
	$PopupContact_On_Subject = get_option('PopupContact_On_Subject');
	$PopupContact_Caption = get_option('PopupContact_Caption');
	
	if (isset($_POST['PopupContact_form_submit']) && $_POST['PopupContact_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('PopupContact_form_setting');
			
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
		
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	<h3>Popup email setting</h3>
	<form name="sdp_form" method="post" action="">
	
		<label for="tag-image">Email address</label>
		<input name="PopupContact_On_MyEmail" type="text" id="PopupContact_On_MyEmail" value="<?php echo $PopupContact_On_MyEmail; ?>" size="75" />
		<p>Please enter admin email address to receive mails.</p>
		
		<label for="tag-image">Email subject</label>
		<input name="PopupContact_On_Subject" type="text" id="PopupContact_On_Subject" value="<?php echo $PopupContact_On_Subject; ?>" size="75"  />
		<p>Please enter mail subject.</p>
		
		<label for="tag-image">Link Button / Text</label>
		<input name="PopupContact_Caption" type="text" id="PopupContact_Caption" value="<?php echo $PopupContact_Caption; ?>" size="150"  />
		<p>This box is to add the contact us Image Button or Text, Entered value will display in the front end..</p>
	
		<div style="height:5px;"></div>
		<h3>Popup widget setting</h3>
		
		<label for="tag-title">Popup title</label>
		<input name="PopupContact_title" type="text" id="PopupContact_title" value="<?php echo $PopupContact_title; ?>" />
		<p>Please enter popup box title.</p>
		
		<label for="tag-title">On home page display</label>
		<select name="PopupContact_On_Homepage" id="PopupContact_On_Homepage">
			<option value='YES' <?php if($PopupContact_On_Homepage == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupContact_On_Homepage == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p>Select YES if you need to display on home page.</p>
		
		<label for="tag-title">On posts display</label>
		<select name="PopupContact_On_Posts" id="PopupContact_On_Posts">
			<option value='YES' <?php if($PopupContact_On_Posts == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupContact_On_Posts == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p>Select YES if you need to display on posts.</p>
		
		<label for="tag-title">On pages display</label>
		<select name="PopupContact_On_Pages" id="PopupContact_On_Pages">
			<option value='YES' <?php if($PopupContact_On_Pages == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupContact_On_Pages == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p>Select YES if you need to display on wordpress pages.</p>
		
		<label for="tag-title">On search page display</label>
		<select name="PopupContact_On_Search" id="PopupContact_On_Search">
			<option value='YES' <?php if($PopupContact_On_Search == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupContact_On_Search == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p>Select YES if you need to display on search pages.</p>
		
		<label for="tag-title">On archive page display</label>
		<select name="PopupContact_On_Archives" id="PopupContact_On_Archives">
			<option value='YES' <?php if($PopupContact_On_Archives == 'YES') { echo 'selected' ; } ?>>YES</option>
			<option value='NO' <?php if($PopupContact_On_Archives == 'NO') { echo 'selected' ; } ?>>NO</option>
		</select>
		<p>Select YES if you need to display on archive pages.</p>
		
		<br />		
		<input type="hidden" name="PopupContact_form_submit" value="yes"/>
		<input name="PopupContact_submit" id="PopupContact_submit" class="button add-new-h2" value="Update All Details" type="submit" />
		<input name="Help" lang="publish" class="button add-new-h2" onclick="window.open('http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/');" value="Help" type="button" />
		<?php wp_nonce_field('PopupContact_form_setting'); ?>
	</form>
  </div>
  <h3>Plugin configuration option</h3>
	<ol>
		<li>Drag and drop the plugin widget to your sidebar.</li>
		<li>Add plugin in the posts or pages using short code.</li>
		<li>Add directly in to the theme using PHP code.</li>
	</ol>
  <p class="description">Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2012/05/18/popup-contact-form-wordpress-plugin/">click here</a></p>
</div>
