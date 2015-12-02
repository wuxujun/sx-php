<?php
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($companyInfo)?$companyInfo->id:'0'),'type'=>'hidden');
$remark = array (
		'name' => 'remark',
		'id' => 'myEditor',
		'value' => set_value ( 'remark', isset ( $companyInfo ) ? $companyInfo->remark : '' ),
		'rows' => 10,
		'cols' => 40 
);

?>
<?php $attributes = array('id' =>'myform');  echo form_open('company/company/modifyCompany',$attributes)?>
<section id="main" class="column">
	<h4 class="alert_info" id='msg' style="display: none"></h4>
	<article class="module width_full">
		<header>
			<h3><?php echo lang('v_man_mall_update');?></h3>
		</header>
		<div class="module_content">
			<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_name')?></label>
							<input type="text" id='name' name='name'  value='<?php if(isset($companyInfo)) echo $companyInfo->name;?>'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_name_s')?></label>
							<input type="text" id='title' name='title'  value='<?php if(isset($companyInfo)) echo $companyInfo->title;?>'>
						</fieldset>
					<fieldset style="width: 48%; float: left;">
					<label><?php echo lang('v_man_company_city') ?></label><?php echo form_error('city'); ?>
						<select name='city' id='city'>
							<option value="" Selected><?php echo lang('v_man_company_citySelect') ?></option>
							<?php if(isset($citys)):?>
							<?php foreach($citys->result() as $row) {?>
							<option value="<?php echo $row->code; ?>"
							<?php if(isset($companyInfo)&&$companyInfo->cityId== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
						</select>
					</fieldset>
						<fieldset style="width: 48%; float: right;">
						<label><?php echo lang('v_man_company_category') ?></label><?php echo form_error('category'); ?>
						<select name='category' id='category'>
							<option value="" Selected><?php echo lang('v_man_company_categorySelect') ?></option>
							<?php if(isset($cates)):?>
							<?php foreach($cates->result() as $row) {?>
							<option value="<?php echo $row->code; ?>"
							<?php if(isset($companyInfo)&&$companyInfo->category== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
						</select>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_logo')?></label>
							<input type="text" id='logo' name='logo' class="logo-value"  value='<?php if(isset($companyInfo)) echo $companyInfo->logo;?>'>
							<input type="hidden" id='logoEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_image')?></label>
							<input type="text" id='image' name='image' class="logo-value"  value='<?php if(isset($companyInfo)) echo $companyInfo->image;?>'>
							<input type="hidden" id='imageEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
						<label><?php echo lang('v_man_company_scale') ?></label><?php echo form_error('city'); ?>
						<select name='scale' id='scale'>
							<option value="" Selected><?php echo lang('v_man_company_scaleSelect') ?></option>
							<?php if(isset($scales)):?>
							<?php foreach($scales->result() as $row) {?>
							<option value="<?php echo $row->code; ?>"
							<?php if(isset($companyInfo)&&$companyInfo->scale== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
						</select>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_address')?></label>
							<input type="text" id='address' name='address' value='<?php if(isset($companyInfo)) echo $companyInfo->address;?>'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_tel')?></label>
							<input type="text" id='tel' name='tel'  value='<?php if(isset($companyInfo)) echo $companyInfo->tel;?>'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_website')?></label>
							<input type="text" name='website' id='website'  value='<?php if(isset($companyInfo)) echo $companyInfo->website;?>'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_contact')?></label>
							<input type="text" id='contact' name='contact'  value='<?php if(isset($companyInfo)) echo $companyInfo->contact;?>'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_email')?></label>
							<input type="text" name='email' id='email'  value='<?php if(isset($companyInfo)) echo $companyInfo->email;?>'>
						</fieldset>
						<div class="clear"></div>
						<fieldset>
							<label><?php echo  lang('v_man_company_content')?></label>
							<input type="text" id='content' name='content'  value='<?php if(isset($companyInfo)) echo $companyInfo->content;?>'>
						</fieldset>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
			
			<h3>
				<label><?php echo lang('v_man_mall_remark') ?></label><?php echo form_error('remark'); ?>
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
				<?php if (isset($companyInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='company/company/modifyCompany' value="<?php echo lang('v_man_submit')?>">
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
			$(".upload-image-cur .logo-value").attr("value",arg[0].src);
			$(".upload-image-cur").removeClass();
		});
	});
	function upImage(o){
		$(o).parent().addClass("upload-image-cur");
		var myImage=_editor.getDialog('insertimage');
		myImage.open();
	}

	var imageEditor=UE.getEditor('imageEdit');
	imageEditor.ready(function(){
		imageEditor.setDisabled();
		imageEditor.hide();
		imageEditor.addListener('beforeInsertImage',function(t,arg){
			$(".image-cur .param-value").attr("value",arg[0].src);
			$(".image-cur .img-src").attr("src",arg[0].src);
			$('.image-cur .upload-btn').remove();
			$("#img").removeClass("image-cur");
		});
	});
	function upload(o){
		$(o).parent().parent().addClass("image-cur");
		var myImage=imageEditor.getDialog('insertimage');
		myImage.open();
	}

	function addImage()
	{
		var num=$("#imageNo").val();
		$("#imageNo").val(parseInt(num)+1);
		var item="<tr id='img'><td><img class='img-src'  width='100px' height='80px'/></td><td><input class='param-value' name='param_value[]' type='hidden' value='' style='width:200px;'/></td><td class='upload-btn'><a href='javascript:;' onclick='upload(this);' title='上传'>上传</a></td><td><a href='javascript:;' onclick='deleteImage(this)' style='margin-top:10px;'  title='删除'>&nbsp;&nbsp;删除</a></td></tr>";
		$('#images-items').append(item);
	}
 	function deleteImage(o) {
 		var num=$("#imageNo").val();
 		$("#imageNo").val(parseInt(num)-1);
        $(o).parent().parent().remove();
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
