<?php 
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($eduInfo)?$eduInfo->id:'0'),'type'=>'hidden');
?>
<?php $attributes = array('id' =>'myform');  echo form_open('configs/edu/modifyEdu',$attributes)?>
<section id="main" class="column">
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_edu_update')?></h3>
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
						<?php if(isset($eduInfo)&&$eduInfo->province== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
				<label><?php echo lang('v_man_edu_type') ?></label>
				<select name='type' id='type'>
					<option value="0" Selected>学校信息</option>
					<option value="1">学校下属分院</option>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_edu_supname') ?></label>
				<select name='eduId' id='eduId'>
					<option value="0" Selected><?php echo lang('v_man_edu_eduSelect') ?></option>
				<?php if(isset($edus)):?>
				<?php foreach($edus->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($edus)&&$edus== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_edu_code')?></label>
					<input type="text" id='code' name="code" value='<?php if(isset($eduInfo)) echo $eduInfo->eduCode?>' readonly>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_edu_name')?></label>
					<input type="text" id='name'  name="name" value='<?php if(isset($eduInfo)) echo $eduInfo->eduName?>'>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_edu_address')?></label>
					<input type="text" id='address' name="address" value='<?php if(isset($eduInfo)) echo $eduInfo->eduAddress?>'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_edu_tel')?></label>
					<input type="text" id='tel'  name="tel" value='<?php if(isset($eduInfo)) echo $eduInfo->eduTel?>'>
				</fieldset>
				<div class="clear"></div>
				</div>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<?php if (isset($eduInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='configs/edu/modifyEdu' value="<?php echo lang('v_man_submit')?>">
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
			$("#cityId").load("<?php echo base_url();?>index.php?/configs/edu/citySel/"+$("#province").val());
		});

		$("#type").change(function(){
			if($('#type').val()=='1'){
				$("#eduId").load("<?php echo base_url();?>index.php?/configs/edu/typeSel/"+$("#cityId").val());
			}
		});
		$("#cityId").load("<?php echo base_url();?>index.php?/configs/edu/citySel/"+$("#province").val());
	});
</script>