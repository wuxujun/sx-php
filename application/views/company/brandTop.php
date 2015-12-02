<?php 
$mallId = array('name' =>'mallId' ,'id'=>'mallId','value'=>set_value('mallId',isset($mallId)?$mallId:'0'),'type'=>'hidden');
$brandId = array('name' =>'brandId' ,'id'=>'brandId','value'=>set_value('brandId',isset($brandId)?$brandId:'0'),'type'=>'hidden');
$mbId = array('name' =>'mbId' ,'id'=>'mbId','value'=>set_value('mbId',isset($mbId)?$mbId:'0'),'type'=>'hidden');

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
		<header><h3 class="tabs_involved"><?php if (isset($brandInfo)) {
			echo $brandInfo->brandName;
		}?>--> <?php echo  lang('v_man_mall_brand_top')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_mall_brand_top')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_mall_brand_top_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_mall_brand_id')?></th> 
    				<th><?php echo  lang('v_man_brand_name')?></th>     				
    				<th><?php echo  lang('m_title')?></th>     				
    				<th><?php echo  lang('v_man_au_updateTime')?></th>      			
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
    				<td><?php echo $brandInfo->brandName;?></td> 
    				<td><?php echo $row->title;?></td>  
    				<td><?php echo $row->addtime;?></td>  
    				<td><?php echo anchor('/mall/mall/updateBrandTop/'.$row->id, lang('m_modify'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('mall/mall/addBrandTop',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<fieldset  style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_mall_name')?></label>
					<input type="text" id='mallName' name='mallName' value="<?php echo $mallInfo->mallName;?>" readonly>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
						<label><?php echo  lang('v_man_brand_name')?></label>
						<input type="text" id='brandName' name='brandName' value="<?php echo $brandInfo->brandName;?>" readonly>
				</fieldset>
				<fieldset  style="width: 48%; float: left;">
					<label><?php echo  lang('m_title')?></label>
					<input type="text" id='title' name='title'>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
							<label><?php echo  lang('v_man_image')?></label>
							<input type="text" id='image' name='image' class="logo-value">
							<input type="hidden" id='imageEdit' >
							<a href="javascript:void(0);" onclick="upImage(this);">上传图片</a>
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
				<?php if (isset($mallId)) echo form_input($mallId)?>
				<?php if (isset($brandId)) echo form_input($brandId)?>
				<?php if (isset($mbId)) echo form_input($mbId)?>
				<input type='submit' id='submit' class='alt_btn' name='mall/mall/addBrandTop' value="<?php echo lang('v_man_submit')?>">
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
