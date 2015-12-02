<?php 
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($nearbyInfo)?$nearbyInfo->id:'0'),'type'=>'hidden');
?>
<?php $attributes = array('id' =>'myform');  echo form_open('configs/nearby/modifyNearby',$attributes)?>
<section id="main" class="column">
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_nearby_update')?></h3>
		</header>

		<div class="tab_container">
				<div class="module_content">
						<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_edu_province') ?></label>
				<select name='province' id='province'>
					<option value="0" Selected><?php echo lang('v_man_edu_provinceSelect') ?></option>
				<?php if(isset($provinces)):?>
				<?php foreach($provinces->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($nearbyInfo)&&$nearbyInfo->province== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_edu_city') ?></label>
				<select name='cityId' id='cityId'>
					<option value="0" Selected><?php echo lang('v_man_edu_citySelect') ?></option>
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_nearby_type') ?></label>
				<select name='type' id='type'>
					<option value="0" Selected>默认</option>
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_nearby_supname') ?></label>
				<select name='pId' id='pId'>
					<option value="0" Selected><?php echo lang('v_man_nearby_nearbySelect') ?></option>
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_nearby_code')?></label>
					<input type="text" id='code' name="code" value='<?php if(isset($nearbyInfo)) echo $nearbyInfo->code?>' readonly>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_nearby_name')?></label>
					<input type="text" id='name'  name="name" value='<?php if(isset($nearbyInfo)) echo $nearbyInfo->title?>'>
				</fieldset>
				<div class="clear"></div>
				</div>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<?php if (isset($nearbyInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='configs/nearby/modifyNearby' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
<?php echo form_close();?>
	<script type="text/javascript">
	$(function(){
		$("#province").change(function(){
			$("#cityId").load("<?php echo base_url();?>index.php?/configs/nearby/citySel/"+$("#province").val());
		});

		$("#cityId").load("<?php echo base_url();?>index.php?/configs/nearby/citySel/"+$("#province").val());
	});
</script>