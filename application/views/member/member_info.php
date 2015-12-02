<?php
$pid = array (
		'name' => 'id',
		'id' => 'id',
		'value' => set_value ( 'id',isset($id)?$id:'0'),
		'type'=>'hidden'
);

$mobile = array (
		'name' => 'mobile',
		'id' => 'mobile',
		'value' => set_value ( 'mobile',isset($mobile)?$mobile:''),
		'maxlength' => 20,
		'size' => 20,
		'readonly'=>'readonly' 
);
$pass = array (
		'name' => 'pass',
		'id' => 'pass',
		'value' => set_value ( 'pass',isset($pass)?$pass:''),
		'maxlength' => 20,
		'size' => 20,
		'readonly'=>'readonly' 
);

$name = array (
		'name' => 'name',
		'id' => 'name',
		'value' => set_value ( 'name',isset($name)?$name:''),
		'maxlength' => 20,
		'size' => 20,
		'readonly'=>'readonly' 
);
$cardno = array (
		'name' => 'cardno',
		'id' => 'cardno',
		'value' => set_value ( 'cardno',isset($cardno)?$cardno:''),
		'maxlength' => 10,
		'size' => 30,
		'readonly'=>'readonly' 
);
$email = array (
		'name' => 'email',
		'id' => 'email',
		'value' => set_value ( 'email',isset($email)?$email:''),
		'maxlength' => 10,
		'size' => 30,
		'readonly'=>'readonly' 
);
$phone = array (
		'name' => 'phone',
		'id' => 'phone',
		'value' => set_value('phone',isset($phone)?$phone:''),
		'maxlenght'=>100,
		'size'=>30,
		'readonly'=>'readonly'
);
$address = array (
		'name' => 'address',
		'id' => 'address',
		'value' => set_value('address',isset($address)?$address:''),
		'maxlenght'=>100,
		'size'=>30,
		'readonly'=>'readonly'
);

$postcode = array (
		'name' => 'postcode',
		'id' => 'postcode',
		'value' => set_value('postcode',isset($postcode)?$postcode:''),
		'maxlenght'=>100,
		'size'=>30,
		'readonly'=>'readonly'
);
$system_category = array (
		'name' => 'system_category',
		'id' => 'system_category',
		'value' => set_value('system_category',isset($system_category)?$system_category:''),
		'maxlenght'=>100,
		'size'=>30,
		'readonly'=>'readonly'
);
$system_cardno = array (
		'name' => 'system_cardno',
		'id' => 'system_cardno',
		'value' => set_value('system_cardno',isset($system_cardno)?$system_cardno:''),
		'maxlenght'=>100,
		'size'=>30,
		'readonly'=>'readonly'
);

$system_vip_level = array (
		'name' => 'system_vip_level',
		'id' => 'system_vip_level',
		'value' => set_value('system_vip_level',isset($system_vip_level)?$system_vip_level:''),
		'maxlenght'=>100,
		'size'=>30
);
$card_validtime = array (
		'name' => 'card_validtime',
		'id' => 'card_validtime',
		'value' => set_value('card_validtime',isset($card_validtime)?$card_validtime:''),
		'maxlenght'=>100,
		'size'=>30
);
$driving_date = array (
		'name' => 'driving_date',
		'id' => 'driving_date',
		'value' => set_value('driving_date',isset($driving_date)?$driving_date:''),
		'maxlenght'=>100,
		'size'=>30
);

?>
<?php if(isset($id)){ echo form_open('member/member/changeInfo');}else{ echo form_open('member/member/saveInfo');} ?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>

	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_member_info');?></h3>
		</header>
		<div class="module_content">
			<fieldset style="width: 48%; float: left; margin-right: 3%;">
				<label><?php echo lang('v_man_member_mobile_l') ?></label><?php echo form_error('mobile'); ?>
			<?php echo form_input($mobile); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_pass') ?></label><?php echo form_error('pass'); ?>
				<?php echo form_input($pass); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left; margin-right: 3%;">
				<label><?php echo lang('v_man_member_name') ?></label><?php echo form_error('name'); ?>
			<?php echo form_input($name); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_sex') ?></label><?php echo form_error('area'); ?>
				<select name='sex' id='sex'>
					<option value="" Selected><?php echo lang('v_man_member_sexSelect') ?></option>
					<option value="0" <?php if(isset($sex)&&$sex=='0'){echo "Selected";} ?>>女</option>
					<option value="1" <?php if(isset($sex)&&$sex=='1'){echo "Selected";} ?>>男</option>
				</select>
			</fieldset>
			<div class="clear"></div>
			<fieldset >
				<label><?php echo lang('v_man_member_cardno') ?></label><?php echo form_error('cardno'); ?>
				<?php echo form_input($cardno); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left; margin-right: 3%;"> 
				<label><?php echo lang('v_man_member_email') ?></label><?php echo form_error('email'); ?>
			<?php echo form_input($email); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_phone') ?></label><?php echo form_error('phone'); ?>
				<?php echo form_input($phone); ?> 
			</fieldset>
			
			<fieldset style="width: 48%; float: left; margin-right: 3%;"> 
				<label><?php echo lang('v_man_member_address') ?></label><?php echo form_error('address'); ?>
				<?php echo form_input($address); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_postcode') ?></label><?php echo form_error('postcode'); ?>
				<?php echo form_input($postcode); ?> 
			</fieldset>
			
			<fieldset style="width: 48%; float: left; margin-right: 3%;"> 
				<label><?php echo lang('v_man_member_system_category') ?></label><?php echo form_error('category'); ?>
				<select name='category' id='category'>
					<option value="" Selected><?php echo lang('v_man_member_categorySelect') ?></option>
				<?php if(isset($categorys)):?>
				<?php foreach($categorys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($category)&&$category== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
			<fieldset  style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_system_cardno') ?></label><?php echo form_error('system_cardno'); ?>
				<?php echo form_input($system_cardno); ?> 
			</fieldset>
			
			<fieldset style="width: 48%; float: left; margin-right: 3%;"> 
				<label><?php echo lang('v_man_member_card_validtime') ?></label><?php echo form_error('card_validtime'); ?>
				<?php echo form_input($card_validtime); ?> 
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_member_driving_date') ?></label><?php echo form_error('driving_date'); ?>
				<?php echo form_input($driving_date); ?> 
			</fieldset>
			<div class="clear"></div>
			
		</div>
		<footer>
			<div class="submit_link">

			</div>
		</footer>
	</article>
</section>
<?php echo form_close(); ?>