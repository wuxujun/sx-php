<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($mallBrandInfo)?$mallBrandInfo->id:'0'),'type'=>'hidden');
$mallId = array('name' =>'mallId' ,'id'=>'mallId','value'=>set_value('mallId',isset($mallInfo)?$mallInfo->id:'0'),'type'=>'hidden');

?>
<?php $attributes = array('id' =>'myform');  echo form_open('mall/mall/modifyBrand',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_mall_brand_update');?></h3>
		</header>
		<div class="module_content">
			<fieldset >
				<label><?php echo lang('v_man_brand_name') ?></label><?php echo form_error('city'); ?>
				<select name='brandId' id='brandId'>
					<option value="" Selected><?php echo lang('v_man_mall_brand_brandSelect') ?></option>
				<?php if(isset($brands)):?>
				<?php foreach($brands->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($mallBrandInfo)&&$mallBrandInfo->brandId== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
			<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_floor_name') ?></label><?php echo form_error('city'); ?>
				<select name='floorId' id='floorId'>
					<option value="" Selected><?php echo lang('v_man_mall_brand_floorSelect') ?></option>
				<?php if(isset($floors)):?>
				<?php foreach($floors->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($mallBrandInfo)&&$mallBrandInfo->floorId== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
			<fieldset style="width: 48%; float: right;">
				<label><?php echo  lang('v_man_mall_brand_site')?></label>
					<input type="text" id='site' name='site' value='<?php if(isset($mallBrandInfo)) echo $mallBrandInfo->site?>'>
			</fieldset>
			<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_mall_tel')?></label>
					<input type="text" id='tel' name='tel' value='<?php if(isset($mallBrandInfo)) echo $mallBrandInfo->tel?>'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_mall_contact')?></label>
					<input type="text" name='contact' id='contact' value='<?php if(isset($mallBrandInfo)) echo $mallBrandInfo->contact?>'>
				</fieldset>
				<div class="clear"></div>
				</div>
				<footer>
			<div class="submit_link">
				<?php if (isset($mallInfo)) echo form_input($mallId)?>
				<?php if (isset($mallBrandInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
	</article>
</section>
<?php echo form_close();?>
