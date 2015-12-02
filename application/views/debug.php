<?php
$content = array (
		'name' => 'content',
		'id' => 'content',
		'value'=>'{"umeng_token":"AsjZiHN1i1GmZ7qeO2wH4HRYQq1bXtEbUGpshRxYDEji","start":0,"end":"20","imei":"ffffffffb860166e77d158365b72660a","keyword":"78"}',
		'cols'=>100, 
);

?>
<?php echo form_open('ums/resumeHonor'); ?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>

	<article class="module width_full">
		<header>
			<h3>Debug</h3>
		</header>
		<div class="module_content">
			<fieldset style="width: 98%;">
				<label>ActionName</label>
				<select name='actionName' id='actionName'>
					<option value="login">Login</option>
					<option value="register">Register</option>
					<option value="target">Target</option>
				</select>
			</fieldset>
			<fieldset style="width: 98%; float: left; margin-right: 3%;">
				<label>Content</label><?php echo form_error('mobile'); ?>
			<?php echo form_textarea($content); ?> 
			</fieldset>
			<input type="file" name="image" id="image">
			<div class="clear"></div>
		</div>
		<footer>
			<div class="submit_link">
				<input type='submit' id='submit' class='alt_btn' name="save" value="Test">
			</div>
		</footer>
	</article>
</section>
<?php echo form_close(); ?>