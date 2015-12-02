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
		<header><h3 class="tabs_involved"><?php echo  lang('m_company')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_company_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_company_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_company_id')?></th> 
    				<th><?php echo  lang('v_man_company_city')?></th>     				
    				<th><?php echo  lang('v_man_company_name')?></th>  				
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody> 
			 <?php if(isset($companylist)):
			 	foreach($companylist->result() as $row)
			 	{
			 ?>
				<tr> 
				    <td><?php echo $row->id;?></td> 
    				<td><?php echo $row->cityName;?></td> 
    				<td><?php echo $row->title;?></td>  
    				<td><?php echo anchor('/company/company/update/'.$row->id, lang('v_man_company_update'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('company/company/addCompany',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
					<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_name')?></label>
							<input type="text" id='name' name='name'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_name_s')?></label>
							<input type="text" id='title' name='title'>
						</fieldset>
					<fieldset style="width: 48%; float: left;">
					<label><?php echo lang('v_man_company_city') ?></label><?php echo form_error('city'); ?>
						<select name='city' id='city'>
							<option value="" Selected><?php echo lang('v_man_company_citySelect') ?></option>
							<?php if(isset($citys)):?>
							<?php foreach($citys->result() as $row) {?>
							<option value="<?php echo $row->code; ?>"
							<?php if(isset($citys)&&$citys== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
							<?php if(isset($companyInfo)&&$companyInfo== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
						</select>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_logo')?></label>
							<input type="text" id='logo' name='logo' class="logo-value">
							<input type="hidden" id='logoEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_image')?></label>
							<input type="text" id='image' name='image' class="logo-value">
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
							<?php if(isset($scale)&&$scale== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
							<?php } endif;?>	
						</select>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_address')?></label>
							<input type="text" id='address' name='address'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_tel')?></label>
							<input type="text" id='tel' name='tel'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_website')?></label>
							<input type="text" name='website' id='website'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo  lang('v_man_company_contact')?></label>
							<input type="text" id='contact' name='contact'>
						</fieldset>
						<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_company_email')?></label>
							<input type="text" name='email' id='email'>
						</fieldset>
						<div class="clear"></div>
						<fieldset>
							<label><?php echo  lang('v_man_company_content')?></label>
							<input type="text" id='content' name='content'>
						</fieldset>
						
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.config.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>ueditor/ueditor.all.min.js"></script>
			
			<h3>
				<label><?php echo lang('v_man_company_remark') ?></label><?php echo form_error('remark'); ?>
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
				<input type='submit' id='submit' class='alt_btn' name='company/company/modifyCompany' value="<?php echo lang('v_man_submit')?>">
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

	function checkCompany() {
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
			document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_man_city_codeN')?></font>';
			document.getElementById('msg').style.display="block";
			return;

		}
		if(name=='')
		{
			document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_man_company_nameN')?></font>';
			document.getElementById('msg').style.display="block";
			return;
		}
	}
	function trim(str){
    	return  (str.replace(/(^\s*)|(\s*$)/g,''));
 	}
</script>