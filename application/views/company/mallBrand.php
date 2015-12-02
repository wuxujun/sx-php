<?php 
$mallId = array('name' =>'mallId' ,'id'=>'mallId','value'=>set_value('mallId',isset($mallInfo)?$mallInfo->id:'0'),'type'=>'hidden');

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
		<header><h3 class="tabs_involved"><?php if (isset($mallInfo)) {
			echo $mallInfo->mallName;
		}?>--> <?php echo  lang('v_man_mall_brand')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_mall_brand_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_mall_brand_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_mall_brand_id')?></th> 
    				<th><?php echo  lang('v_man_brand_name')?></th>     				
    				<th><?php echo  lang('v_man_mall_brand_site')?></th>     				
    				<th><?php echo  lang('v_man_mall_brand_contact')?></th>      				
    				<th><?php echo  lang('v_man_mall_brand_tel')?></th> 				
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
    				<td><?php echo $row->brandName;?></td> 
    				<td><?php echo $row->site;?></td>  
    				<td><?php echo $row->contact;?></td>  
    				<td><?php echo $row->tel;?></td>  
    				<td><?php echo anchor('/mall/mall/updateBrand/'.$row->id, lang('v_man_mall_brand_update'));?>
    				<?php echo anchor('/mall/mall/brandTop/'.$row->id, lang('v_man_mall_brand_top'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('mall/mall/addBrand',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<fieldset  style="width: 48%; float: left;">
					<label><?php echo lang('v_man_brand_name') ?></label><?php echo form_error('city'); ?>
					<select name='brandId' id='brandId'>
					<option value="" Selected><?php echo lang('v_man_mall_brand_brandSelect') ?></option>
					<?php if(isset($brands)):?>
					<?php foreach($brands->result() as $row) {?>
						<option value="<?php echo $row->code; ?>"
						<?php if(isset($citys)&&$citys== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
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
				<fieldset  style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_mall_brand_site')?></label>
					<input type="text" id='site' name='site'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_image')?></label>
							<input type="text" id='image' name='image' class="logo-value">
							<input type="hidden" id='imageEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
						</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_mall_tel')?></label>
					<input type="text" id='tel' name='tel'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_mall_contact')?></label>
					<input type="text" name='contact' id='contact'>
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
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/modifyMall' value="<?php echo lang('v_man_submit')?>">
				</div>
			</footer>
			
		<!-- end of post new article -->
			</div><!-- end of #tab2 -->
			
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
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
