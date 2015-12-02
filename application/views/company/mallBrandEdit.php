<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($mallBrandInfo)?$mallBrandInfo->id:'0'),'type'=>'hidden');
$mallId = array('name' =>'mallId' ,'id'=>'mallId','value'=>set_value('mallId',isset($mallInfo)?$mallInfo->id:'0'),'type'=>'hidden');
$content = array (
		'name' => 'content',
		'id' => 'myEditor',
		'value' => set_value ( 'content', isset ( $mallBrandInfo ) ? $mallBrandInfo->content : '' ),
		'rows' => 10,
		'cols' => 40 
);
?>
<?php $attributes = array('id' =>'myform');  echo form_open('mall/mall/modifyBrand',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_mall_brand_update');?></h3>
		</header>
		<div class="module_content">
			<fieldset style="width: 48%; float: left;">
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
			<fieldset style="width: 48%; float: right;">
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
			<fieldset style="width: 48%; float: left;">
				<label><?php echo  lang('v_man_mall_brand_site')?></label>
					<input type="text" id='site' name='site' value='<?php if(isset($mallBrandInfo)) echo $mallBrandInfo->site?>'>
			</fieldset>
			<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_image')?></label>
							<input type="text" id='image' name='image' class="logo-value" value='<?php if(isset($mallBrandInfo)) echo $mallBrandInfo->image?>'>
							<input type="hidden" id='imageEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
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
				<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
				<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
				<h3>
					<label><?php echo lang('v_man_brand_remark') ?></label><?php echo form_error('content'); ?>
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
				<?php if (isset($mallInfo)) echo form_input($mallId)?>
				<?php if (isset($mallBrandInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
	</article>
</section>
<script type="text/javascript">
	var _editor=UE.getEditor('imageEdit');
	_editor.ready(function(){
		_editor.setDisabled();
		_editor.hide();
		_editor.addListener('beforeInsertImage',function(t,arg){
			$(".upload-image-cur .logo-value").attr("value",arg[0].src);
			$(".upload-image-cur").removeClass();
		});
	});

	function upImage(o){
		$(o).parent().addClass("upload-image-cur");
		var myImage=_editor.getDialog('insertimage');
		myImage.open();
	}
</script>
<?php echo form_close();?>
