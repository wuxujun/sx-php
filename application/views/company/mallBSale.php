<?php 
$content = array (
		'name' => 'content',
		'id' => 'myEditor',
		'value' => set_value ( 'content', isset ( $remark ) ? $remark : '' ),
		'rows' => 10,
		'cols' => 40 
);
?>

<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_mall_sale')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_mall_sale_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_mall_sale_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_mall_sale_id')?></th> 
    				<th><?php echo  lang('v_man_mall_name')?></th>     				
    				<th><?php echo  lang('v_man_mall_sale_name')?></th>				
    				<th><?php echo  lang('v_man_mall_sale_date')?></th>  				
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody> 
			 <?php if(isset($infolist)):
			 	foreach($infolist->result() as $row)
			 	{
			 ?>
				<tr> 
				    <td><?php echo $row->id;?></td> 
    				<td><?php echo $row->mallName;?></td> 
    				<td><?php echo $row->title;?></td>   
    				<td>&nbsp;</td>  
    				<td><?php echo anchor('/mall/mall/updateSale/'.$row->id, lang('v_rpt_el_set'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('mall/mall/addSale',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<div style="width: 100%; padding-left: 20px;padding-bottom:10px;" class="selbox">
							<span><?php echo  lang('v_man_mall_sale_start_time')?></span> <input
								type="text" name="dpMainFrom" id="dpMainFrom" value=""
								class="datainp first_date date"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  lang('v_man_mall_sale_end_time')?></span>
							<input type="text" name="dpMainTo" id="dpMainTo" value=""
								class="datainp last_date date">
				</div>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_mall_name') ?></label><?php echo form_error('city'); ?>

				<select name='mallId' id='mallId'>
					<option value="" Selected><?php echo lang('v_man_floor_mallSelect') ?></option>
				<?php if(isset($malls)):?>
				<?php foreach($malls->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($citys)&&$citys== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_brand_name') ?></label><?php echo form_error('city'); ?>

				<select name='mallId' id='mallId'>
					<option value="" Selected><?php echo lang('v_man_mall_brand_brandSelect') ?></option>
				<?php if(isset($malls)):?>
				<?php foreach($malls->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($citys)&&$citys== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_mall_sale_name')?></label>
					<input type="text" id='name' name='name'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_mall_sale_logo')?></label>
					<input type="text" id='logo' name='logo'>
					<input type="hidden" id='logoEdit' >
					<a href="javascript:void(0);" onclick="upImage();">上传图片</a>
				</fieldset>
				<div class="clear"></div>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
			
			<h3>
				<label><?php echo lang('v_man_mall_remark') ?></label><?php echo form_error('content'); ?>
			</h3>
			<?php echo form_textarea($content); ?> 
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
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
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
<script type="text/javascript">
	var _editor=UE.getEditor('logoEdit');
	_editor.ready(function(){
		_editor.setDisabled();
		_editor.hide();
		_editor.addListener('beforeInsertImage',function(t,arg){
			$("#logo").attr("value",arg[0].src);

		});
	});

	function upImage(){
		var myImage=_editor.getDialog('insertimage');
		myImage.open();
	}

	function checkMall() {
	city=trim(document.getElementById('city').value);
	name = trim(document.getElementById('name').value);
	logo=trim(document.getElementById('logo').value);
	address = trim(document.getElementById('address').value);
	tel = trim(document.getElementById('tel').value);
	contact = trim(document.getElementById('contact').value);
	content = trim(document.getElementById('myEditor').value);
	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
	if(city=='')
	{
		document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_mall_city_codeN')?></font>';
		document.getElementById('msg').style.display="block";
		return;

	}
	if(name=='')
	{
		document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_man_mall_nameN')?></font>';
		document.getElementById('msg').style.display="block";
		return;
	}
	
}
function trim(str){
    return  (str.replace(/(^\s*)|(\s*$)/g,''));
 }
</script>