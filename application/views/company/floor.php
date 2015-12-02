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
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_floorInfo')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_floor_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_floor_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_floor_id')?></th> 
    				<th><?php echo  lang('v_man_floor_mall')?></th>     				
    				<th><?php echo  lang('v_man_floor_name')?></th>  				
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
    				<td><?php echo $row->floorName;?></td>  
    				<td><?php echo anchor('/mall/floor/update/'.$row->id, lang('v_man_floor_update'));?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('mall/floor/addFloor',$attributes)?>
			<div id="tab2" class="tab_content">
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
						<fieldset >
							<label><?php echo  lang('v_man_floor_name')?></label>
							<input type="text" name='name' id='name'>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_floor_image')?></label>
							<input type="text" id='image' name='image'>
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
				<input type='submit' id='submit' class='alt_btn' name='mall/floor/addFloor' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
			
		<!-- end of post new article -->
			</div><!-- end of #tab2 -->
			
<?php echo form_close();?>
		</div><!-- end of .tab_container -->
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
		
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>