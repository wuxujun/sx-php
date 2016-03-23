<?php 
$remark = array (
		'name' => 'remark',
		'id' => 'myEditor',
		'value' => set_value ( 'remark', isset ( $remark ) ? $remark : '' ),
		'rows' => 10,
		'cols' => 40 
);
?>

<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('m_company_office')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_office_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_office_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_office_id')?></th> 
    				<th><?php echo  lang('v_man_office_cid')?></th>     				
    				<th><?php echo  lang('v_man_office_name')?></th>				
    				<th><?php echo  lang('v_man_office_dept')?></th> 			
    				<th><?php echo  lang('g_updateTops')?></th>  				
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody> 
			 <?php if(isset($officeList)):
			 	foreach($officeList->result() as $row)
			 	{
			 ?>
				<tr> 
				    <td><?php echo $row->id;?></td> 
    				<td><?php echo $row->companyId;?></td> 
    				<td><?php echo $row->name;?></td>   
    				<td><?php echo $row->dept;?></td>  
    				<td>
    				<select style="width:92%;" onchange="changeTops(this.value,<?php echo $row->id?>)" id='select_'<?php echo $row->id?> >
							<?php foreach ($configTops->result() as $row2)
							{
								?>
								<option value='<?php  echo $row2->code ?>' <?php 
								    if($row2->code==$row->tops)
								    echo 'selected'
								?>><?php echo $row2->title?></option>
								<?php 
							}
							?>
						</select>
    				</td>
    				<td><?php echo anchor('/company/office/update/'.$row->id, lang('v_rpt_el_set'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('company/office/addOffice',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<div style="width: 100%; padding-left: 20px;padding-bottom:10px;" class="selbox">
							<span><?php echo  lang('v_man_mall_sale_start_time')?></span> <input
								type="text" name="dpMainFrom" id="dpMainFrom" value=""
								class="datainp first_date date"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  lang('v_man_brand_sale_end_time')?></span>
							<input type="text" name="dpMainTo" id="dpMainTo" value=""
								class="datainp last_date date">
				</div>
				<fieldset>
					<label><?php echo  lang('v_man_office_name')?></label>
					<input type="text" id='name' name='name'>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_office_cid') ?></label><?php echo form_error('company'); ?>
				<select name='company' id='company'>
					<option value="0" Selected><?php echo lang('v_man_office_companySelect') ?></option>
				<?php if(isset($companys)):?>
				<?php foreach($companys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($company)&&$company== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($depts)&&$depts== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($categorys)&&$categorys== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($prop)&&$prop== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($cates1)&&$cates1== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($exps)&&$exps== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($rataineds)&&$rataineds== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($week)&&$week== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
						<?php if(isset($edu)&&$edu== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_office_city') ?></label><?php echo form_error('city'); ?>
				<select name='city' id='city'>
					<option value="" Selected><?php echo lang('v_man_office_citySelect') ?></option>
				<?php if(isset($citys)):?>
				<?php foreach($citys->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($city)&&$city== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<div class="clear"></div>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_office_address')?></label>
					<input type="text" id='address' name='address'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_office_email')?></label>
					<input type="text" id='email' name='email'>
				</fieldset>
				<div class="clear"></div>
				<fieldset>
					<label><?php echo  lang('v_man_office_content')?></label>
					<input type="text" id='content' name='content'>
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
				<input type='submit' id='submit' class='alt_btn' name='company/office/modifyOffice' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
			
		<!-- end of post new article -->
			</div><!-- end of #tab2 -->
<?php echo form_close();?>
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
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
				<td><input id="hour" name="hourRate" type="radio" value="401001" title="10-12" />10-12</td>
				<td><input id="day" name="dayRate" type="radio" value="402001" title="小于80" />小于80</td>
				<td><input id="month" name="monthRate" type="radio" value="403001" title="小于800" />小于800</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401002" title="12-14" />12-14</td>
				<td><input id="day" name="dayRate" type="radio" value="402002" title="80-100" />80-100</td>
				<td><input id="month" name="monthRate" type="radio" value="403002" title="800-1500" />800－1500</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401003" title="14-18" />14-18</td>
				<td><input id="day" name="dayRate" type="radio" value="402003" title="100-120" />100-120</td>
				<td><input id="month" name="monthRate" type="radio" value="403003" title="1500-2000" />1500-2000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401004" title="18-25" />18-25</td>
				<td><input id="day" name="dayRate" type="radio" value="402004" title="120-150" />120-150</td>
				<td><input id="month" name="monthRate" type="radio" value="403004" title="2000-3000" />2000-3000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401005" title="25-50" />25-50</td>
				<td><input id="day" name="dayRate" type="radio" value="402005" title="150-200" />150-200</td>
				<td><input id="month" name="monthRate" type="radio" value="403005" title="大于3000" />大于3000</td>
				</tr>
				<tr>
				<td><input id="hour" name="hourRate" type="radio" value="401006" title="大于50" />大于50</td>
				<td><input id="day" name="dayRate" type="radio" value="402006" title="大于200" />大于200</td>
				<td>&nbsp</td>
				</tr>
			</tbody>
		</table>
	</div>
<script type="text/javascript">
	$(function(){
		$("#rateForm").click(function(){
			$("#dialog_rate").dialog();
			$("input[name='hourRate']:eq(0)").attr("checked","checked");
			$("input[name='dayRate']:eq(0)").attr("checked","checked");
			$("input[name='monthRate']:eq(0)").attr("checked","checked");
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