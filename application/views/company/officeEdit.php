<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($officeInfo)?$officeInfo->id:'0'),'type'=>'hidden');
$cate1=substr($officeInfo->category,0,4);
if (isset($officeInfo->rate)) {
	$hourRate=substr($officeInfo->rate,0,6);
	$dayRate=substr($officeInfo->rate,7,6);
	$monthRate=substr($officeInfo->rate,14,6);
}

$remark = array (
		'name' => 'remark',
		'id' => 'myEditor',
		'value' => set_value ( 'remark', isset ( $officeInfo ) ? $officeInfo->remark : '' ),
		'rows' => 10,
		'cols' => 40 
);

?>
<?php $attributes = array('id' =>'myform');  echo form_open('company/office/modifyOffice',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_mall_sale_update');?></h3>
		</header>
		<div class="module_content">
			<div style="width: 100%; padding-left: 20px;padding-bottom:10px;" class="selbox">
							<span><?php echo  lang('v_man_mall_sale_start_time')?></span> <input
								type="text" name="dpMainFrom" id="dpMainFrom" value='<?php if(isset($officeInfo)) echo $officeInfo->beginDate?>'
								class="datainp first_date date"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  lang('v_man_mall_sale_end_time')?></span>
							<input type="text" name="dpMainTo" id="dpMainTo" value='<?php if(isset($officeInfo)) echo $officeInfo->endDate?>'
								class="datainp last_date date">
				</div>
				<fieldset>
					<label><?php echo  lang('v_man_office_name')?></label>
					<input type="text" id='name' name='name' value="<?php if(isset($officeInfo)) echo $officeInfo->name?>">
				</fieldset>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_office_cid') ?></label><?php echo form_error('company'); ?>
				<select name='company' id='company'>
					<option value="0" Selected><?php echo lang('v_man_office_companySelect') ?></option>
				<?php if(isset($companys)):?>
				<?php foreach($companys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->companyId== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_office_dept') ?></label><?php echo form_error('dept'); ?>
				<select name='dept' id='dept'>
					<option value="0" Selected><?php echo lang('v_man_office_deptSelect') ?></option>
				<?php if(isset($depts)):?>
				<?php foreach($depts->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->dept== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>

				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_office_category')?></label>
					<select name='posts' id='posts'>
					<option value="" Selected><?php echo lang('v_man_office_cateSelect') ?></option>
					<?php if(isset($categorys)):?>
					<?php foreach($categorys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->posts== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
					<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo lang('v_man_office_prop') ?></label><?php echo form_error('prop'); ?>
					<select name='prop' id='prop'>
					<option value="" Selected><?php echo lang('v_man_office_propSelect') ?></option>
				<?php if(isset($props)):?>
				<?php foreach($props->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->prop== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_office_cate1')?></label><?php echo form_error('cates'); ?>
					<select name='cate1' id='cate1'>
					<option value="" Selected><?php echo lang('v_man_office_cate1Select') ?></option>
					<?php if(isset($cates1)):?>
					<?php foreach($cates1->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($cate1)&&$cate1== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
					<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo lang('v_man_office_cate2') ?></label><?php echo form_error('catess'); ?>
					<select name='category' id='category'>
					<option value="" Selected><?php echo lang('v_man_office_cate2Select') ?></option>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_office_exp')?></label>
					<select name='exp' id='exp'>
					<option value="" Selected><?php echo lang('v_man_office_expSelect') ?></option>
					<?php if(isset($exps)):?>
					<?php foreach($exps->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->workExp== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
					<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo lang('v_man_office_ratained') ?></label><?php echo form_error('prop'); ?>
					<select name='ratained' id='ratained'>
					<option value="" Selected><?php echo lang('v_man_office_ratainedSelect') ?></option>
				<?php if(isset($rataineds)):?>
				<?php foreach($rataineds->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->ratained== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<div class="clear"></div>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_office_week') ?></label><?php echo form_error('week'); ?>
				<select name='week' id='week'>
					<option value="0" Selected><?php echo lang('v_man_office_weekSelect') ?></option>
				<?php if(isset($weeks)):?>
				<?php foreach($weeks->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->week== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_office_edu') ?></label><?php echo form_error('edu'); ?>
				<select name='edu' id='edu'>
					<option value="" Selected><?php echo lang('v_man_office_eduSelect') ?></option>
				<?php if(isset($edus)):?>
				<?php foreach($edus->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->edu== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_office_rate') ?></label><?php echo form_error('rate'); ?>
				<select name='rateType' id='rateType' style="width:50%">
					<option value="0" Selected><?php echo lang('v_man_office_rateTypeSelect') ?></option>
					<option value="4010">时薪</option>
					<option value="4020">日薪</option>
					<option value="4030">月薪</option>
				</select>
				<select name='rate' id='rate'>
					<option value="0" Selected><?php echo lang('v_man_office_rateSelect') ?></option>
					<?php if(isset($rates)):?>
				<?php foreach($rates->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->rate== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_office_city') ?></label><?php echo form_error('city'); ?>
				<select name='city' id='city'>
					<option value="" Selected><?php echo lang('v_man_office_citySelect') ?></option>
				<?php if(isset($citys)):?>
				<?php foreach($citys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($officeInfo)&&$officeInfo->workCity== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<div class="clear"></div>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_office_address')?></label>
					<input type="text" id='address' name='address' value="<?php if(isset($officeInfo)) echo $officeInfo->address?>">
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_office_email')?></label>
					<input type="text" id='email' name='email' value="<?php if(isset($officeInfo)) echo $officeInfo->email?>">
				</fieldset>
				<div class="clear"></div>
				<fieldset>
					<label><?php echo  lang('v_man_office_content')?></label>
					<input type="text" id='content' name='content' value="<?php if(isset($officeInfo)) echo $officeInfo->content?>">
				</fieldset>
						
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
			
			<h3>
				<label><?php echo lang('v_man_office_remark') ?></label><?php echo form_error('remark'); ?>
			</h3>
			<?php echo form_textarea($remark); ?> 
			<script type="text/javascript">
				UE.getEditor('myEditor',{
					autoClearinitialContent:false,
					wordCount:false,
					elementPathEnabled:false
				});
			</script>
				
				</div>
				<footer>
			<div class="submit_link">
				<?php if (isset($officeInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/brand/modifyMall' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
	</article>
</section>
<?php echo form_close();?>

<div id="dialog_rate" title="<?php echo lang('v_man_office_rateSelect')?>" style="display:none">
		<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th>时薪</th> 
    				<th>日薪</th>     				
    				<th>月薪</th>	
				</tr> 
			</thead> 
			<tbody> 
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401001" title="10-12" <?php if(isset($hourRate)&&$hourRate=='401001') echo "checked";?>/>10-12</td>
				<td><input id="day" name="dayRate" type="radio" value="402001" title="小于80" <?php if(isset($dayRate)&&$dayRate=='402001') echo "checked";?>/>小于80</td>
				<td><input id="month" name="monthRate" type="radio" value="403001" title="小于800" <?php if(isset($monthRate)&&$monthRate=='403001') echo "checked";?>/>小于800</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401002" title="12-14" <?php if(isset($hourRate)&&$hourRate=='401002') echo "checked";?>/>12-14</td>
				<td><input id="day" name="dayRate" type="radio" value="402002" title="80-100" <?php if(isset($dayRate)&&$dayRate=='402002') echo "checked";?>/>80-100</td>
				<td><input id="month" name="monthRate" type="radio" value="403002" title="800-1500" <?php if(isset($monthRate)&&$monthRate=='403002') echo "checked";?>/>800－1500</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401003" title="14-18" <?php if(isset($hourRate)&&$hourRate=='401003') echo "checked";?>/>14-18</td>
				<td><input id="day" name="dayRate" type="radio" value="402003" title="100-120" <?php if(isset($dayRate)&&$dayRate=='402003') echo "checked";?>/>100-120</td>
				<td><input id="month" name="monthRate" type="radio" value="403003" title="1500-2000" <?php if(isset($monthRate)&&$monthRate=='403003') echo "checked";?>/>1500-2000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401004" title="18-25" <?php if(isset($hourRate)&&$hourRate=='401004') echo "checked";?>/>18-25</td>
				<td><input id="day" name="dayRate" type="radio" value="402004" title="120-150" <?php if(isset($dayRate)&&$dayRate=='402004') echo "checked";?>/>120-150</td>
				<td><input id="month" name="monthRate" type="radio" value="403004" title="2000-3000" <?php if(isset($monthRate)&&$monthRate=='403004') echo "checked";?>/>2000-3000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401005" title="25-50" <?php if(isset($hourRate)&&$hourRate=='401005') echo "checked";?>/>25-50</td>
				<td><input id="day" name="dayRate" type="radio" value="402005" title="150-200" <?php if(isset($dayRate)&&$dayRate=='402005') echo "checked";?>/>150-200</td>
				<td><input id="month" name="monthRate" type="radio" value="403005" title="大于3000" <?php if(isset($monthRate)&&$monthRate=='403005') echo "checked";?>/>大于3000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401006" title="大于50" <?php if(isset($hourRate)&&$hourRate=='401006') echo "checked";?>/>大于50</td>
				<td><input id="day" name="dayRate" type="radio" value="402006" title="大于200" <?php if(isset($dayRate)&&$dayRate=='402006') echo "checked";?>/>大于200</td>
				<td>&nbsp</td>
				</tr>
			</tbody>
		</table>
	</div>
<script type="text/javascript">
	$(function(){
		$("#rateForm").val("时薪:"+$("input[name='hourRate']:checked").attr("title")+" 日薪:"+$("input[name='dayRate']:checked").attr("title")+" 月薪:"+$("input[name='monthRate']:checked").attr("title"));
		$("#category").load("<?php echo base_url();?>index.php?/company/office/cateSel/<?php echo $cate1?>");
		$("#rateForm").click(function(){
			$("#dialog_rate").dialog();
		});

		$("input[name='hourRate']").change(function(){
			 $("#rateValue").val($("input[name='hourRate']:checked").val()+","+$("input[name='dayRate']:checked").val()+","+$("input[name='monthRate']:checked").val());
			 $("#rateForm").val("时薪:"+$("input[name='hourRate']:checked").attr("title")+" 日薪:"+$("input[name='dayRate']:checked").attr("title")+"  月薪:"+$("input[name='monthRate']:checked").attr("title"));
		});
		$("input[name='dayRate']").change(function(){
			 $("#rateValue").val($("input[name='hourRate']:checked").val()+","+$("input[name='dayRate']:checked").val()+","+$("input[name='monthRate']:checked").val());
			 $("#rateForm").val("时薪:"+$("input[name='hourRate']:checked").attr("title")+" 日薪:"+$("input[name='dayRate']:checked").attr("title")+" 月薪:"+$("input[name='monthRate']:checked").attr("title"));
		});
		
		$("input[name='monthRate']").change(function(){
			 $("#rateValue").val($("input[name='hourRate']:checked").val()+","+$("input[name='dayRate']:checked").val()+","+$("input[name='monthRate']:checked").val());
			 $("#rateForm").val("时薪:"+$("input[name='hourRate']:checked").attr("title")+" 日薪:"+$("input[name='dayRate']:checked").attr("title")+" 月薪:"+$("input[name='monthRate']:checked").attr("title"));
		});
		
		$("#rateType").change(function(){
			$("#rate").load("<?php echo base_url();?>index.php?/company/office/rateSel/"+$("#rateType").val());
		});

		$("#cate1").change(function(){
			$("#category").load("<?php echo base_url();?>index.php?/company/office/cateSel/"+$("#cate1").val());
		});
	});
</script>
