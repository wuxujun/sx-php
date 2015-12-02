<?php 
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($categoryInfo)?$categoryInfo->id:'0'),'type'=>'hidden');
?>
<?php $attributes = array('id' =>'myform');  echo form_open('company/category/modifyCategory',$attributes)?>
<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_category_edit')?></h3>
		</header>
		<div class="tab_container">
				<div class="module_content">
						<fieldset>
							<label><?php echo  lang('v_man_category_supid')?></label><?php echo form_error('mall'); ?>
							<select name='parent_code' id='parent_code'>
							<option value="0" Selected><?php echo lang('v_man_category_codeSelect') ?></option>
							<?php if(isset($cates)):?>
							<?php foreach($cates->result() as $row) {?>
							<option value="<?php echo $row->code; ?>"
							<?php if(isset($categoryInfo)&&$categoryInfo->parent_code== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
							</select>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_category_code')?></label>
							<input type="text" id='code' value='<?php if(isset($categoryInfo)) echo $categoryInfo->code?>'>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_category_name')?></label>
							<input type="text" id='name' value='<?php if(isset($categoryInfo)) echo $categoryInfo->category?>'>
						</fieldset>
				</div>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<?php if (isset($categoryInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='company/category/modifyCategory' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
<?php echo form_close();?>