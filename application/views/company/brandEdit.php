<?php
$pid = array (
		'name' => 'id',
		'id' => 'id',
		'value' => set_value ( 'id',isset($brandInfo)?$brandInfo->id:'0'),
		'type'=>'hidden'
);

$content = array (
		'name' => 'content',
		'id' => 'myEditor',
		'value' => set_value ( 'content', isset ( $brandInfo ) ? $brandInfo->remark : '' ),
		'rows' => 10,
		'cols' => 40 
);

?>
<?php $attributes = array('id' =>'myform'); echo form_open('mall/brand/modifyBrand',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>

	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_brand_update') ?></h3>
		</header>
		<div class="module_content">
			<fieldset >
				<label><?php echo lang('v_man_brand_cate') ?></label><?php echo form_error('city'); ?>

				<select name='cate' id='cate'>
					<option value="" Selected><?php echo lang('v_man_brand_cateSelect') ?></option>
				<?php if(isset($cates)):?>
				<?php foreach($cates->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($brandInfo)&&$brandInfo->brandCate== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_brand_name')?></label>
							<input type="text" id='name' name='name' value='<?php if(isset($brandInfo)) echo $brandInfo->brandName?>'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_brand_logo')?></label>
							<input type="text" id='logo' name='logo' value='<?php if(isset($brandInfo)) echo $brandInfo->brandLogo?>'>
							<input type="hidden" id='logoEdit' >
							<a href="javascript:void(0);" onclick="upImage();">上传图片</a>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_search_key')?></label>
							<input type="text" id='searchKey' name='searchKey' value='<?php if(isset($brandInfo)) echo $brandInfo->searchKey?>'>
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
				<?php if (isset($brandInfo)) echo form_input($pid)?>
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
			//$.each(arg[0],function(key,value){
			//		alert(key+": "+value);
			//});
			$("#logo").attr("value",arg[0].src);

		});
	});

	function upImage(){
		var myImage=_editor.getDialog('insertimage');
		myImage.open();
	}
</script>
<?php echo form_close(); ?>