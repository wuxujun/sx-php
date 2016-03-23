<?php 
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($configsInfo)?$configsInfo->id:'0'),'type'=>'hidden');
?>
<?php $attributes = array('id' =>'myform');  echo form_open('configs/configs/modifyConfigs',$attributes)?>
<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_configs_update')?></h3>
		</header>

		<div class="tab_container">
				<div class="module_content">
					<fieldset >
					<label><?php echo lang('v_man_configs_type') ?></label><?php echo form_error('type'); ?>
					<select name='type' id='type'>
						<option value=""><?php echo lang('v_man_configs_typeSelect') ?></option>
							<option value="1" <?php if(isset($configsInfo)&&$configsInfo->type=='1'){ echo "selected";}?>>工作性质</option>
							<option value="2" <?php if(isset($configsInfo)&&$configsInfo->type=='2'){ echo "selected";}?>>每周至少</option>
							<option value="3" <?php if(isset($configsInfo)&&$configsInfo->type=='3'){ echo "selected";}?>>学历要求</option>
							<option value="4" <?php if(isset($configsInfo)&&$configsInfo->type=='4'){ echo "selected";}?>>企业性质</option>
							<option value="5" <?php if(isset($configsInfo)&&$configsInfo->type=='5'){ echo "selected";}?>>工作经验</option>
							<option value="6" <?php if(isset($configsInfo)&&$configsInfo->type=='6'){ echo "selected";}?>>是否留用</option>
							<option value="7" <?php if(isset($configsInfo)&&$configsInfo->type=='7'){ echo "selected";}?>>排序参数</option>
							<option value="8" <?php if(isset($configsInfo)&&$configsInfo->type=='8'){ echo "selected";}?>>语言水平</option>
							<option value="9" <?php if(isset($configsInfo)&&$configsInfo->type=='9'){ echo "selected";}?>>距离参数</option>
					</select>
					</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_configs_code')?></label>
							<input type="text" name="code" id='code' value='<?php if(isset($configsInfo)) echo $configsInfo->code?>'>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_configs_name')?></label>
							<input type="text" name="name" id='name' value='<?php if(isset($configsInfo)) echo $configsInfo->name?>'>
						</fieldset>
				</div>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<?php if (isset($configsInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='configs/city/modifyCity' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>

<?php echo form_close();?>