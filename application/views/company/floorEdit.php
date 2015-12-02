<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($floorInfo)?$floorInfo->id:'0'),'type'=>'hidden');
$content = array (
		'name' => 'content',
		'id' => 'myEditor',
		'value' => set_value ( 'content', isset ( $floorInfo ) ? $floorInfo->remark : '' ),
		'rows' => 10,
		'cols' => 40 
);

?>
<?php $attributes = array('id' =>'myform');  echo form_open('mall/floor/modifyFloor',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_floor_update');?></h3>
		</header>
		<div class="module_content">
			<fieldset >
				<label><?php echo lang('v_man_floor_mall') ?></label><?php echo form_error('mall'); ?>
				<select name='mid' id='mid'>
					<option value="" Selected><?php echo lang('v_man_floor_mallSelect') ?></option>
				<?php if(isset($malls)):?>
				<?php foreach($malls->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($floorInfo)&&$floorInfo->mid== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
			</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_floor_name')?></label>
							<input type="text" name='name' id='name' value='<?php if(isset($floorInfo)) echo $floorInfo->floorName?>'>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_floor_image')?></label>
							<input type="text" name='image' id='image' value='<?php if(isset($floorInfo)) echo $floorInfo->image?>'>
							<input type="hidden" id='imageEdit' >
							<a href="javascript:void(0);" onclick="uploadImage();">上传图片</a>
						</fieldset>
						<div class="clear"></div>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
			
			<h3>
				<label><?php echo lang('v_man_floor_remark') ?></label><?php echo form_error('content'); ?>
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
				<?php if (isset($floorInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
	</article>
</section>
<script type="text/javascript">
var imageEditor=UE.getEditor('imageEdit');
	imageEditor.ready(function(){
		imageEditor.setDisabled();
		imageEditor.hide();
		imageEditor.addListener('beforeInsertImage',function(t,arg){
			$("#image").attr("value",arg[0].src);

		});
	});
	function uploadImage(){
		var myImage=imageEditor.getDialog('insertimage');
		myImage.open();
	}
	</script>
<?php echo form_close();?>
