<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($saleInfo)?$saleInfo->id:'0'),'type'=>'hidden');
$content = array (
		'name' => 'content',
		'id' => 'myEditor',
		'value' => set_value ( 'content', isset ( $saleInfo ) ? $saleInfo->content : '' ),
		'rows' => 10,
		'cols' => 40 
);

?>
<?php $attributes = array('id' =>'myform');  echo form_open('mall/mall/modifySale',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_mall_sale_update');?></h3>
		</header>
		<div class="module_content">
			<div style="width: 100%; padding-left: 20px;padding-bottom:10px;" class="selbox">
							<span><?php echo  lang('v_man_mall_sale_start_time')?></span> <input
								type="text" name="dpMainFrom" id="dpMainFrom" value=""
								class="datainp first_date date"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  lang('v_man_mall_sale_end_time')?></span>
							<input type="text" name="dpMainTo" id="dpMainTo" value=""
								class="datainp last_date date">
				</div>
				<fieldset >
				<label><?php echo lang('v_man_mall_name') ?></label><?php echo form_error('city'); ?>

				<select name='mallId' id='mallId'>
					<option value="" Selected><?php echo lang('v_man_floor_mallSelect') ?></option>
				<?php if(isset($malls)):?>
				<?php foreach($malls->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($saleInfo)&&$saleInfo->sid== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_mall_sale_name')?></label>
							<input type="text" id='name' name='name' value='<?php if(isset($saleInfo)) echo $saleInfo->title?>'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_mall_sale_logo')?></label>
							<input type="text" id='logo' name='logo' value='<?php if(isset($saleInfo)) echo $saleInfo->image?>'>
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
				<?php if (isset($saleInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
	</article>
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

	function modifyMall() {
		city=trim(document.getElementById('city').value);
		name = trim(document.getElementById('name').value);
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
		document.getElementById("myform").submit()
	}
	function trim(str){
  	  return  (str.replace(/(^\s*)|(\s*$)/g,''));
 	}

</script>
<?php echo form_close();?>
