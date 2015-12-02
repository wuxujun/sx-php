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
		}?>--> <?php echo  lang('v_man_mall_map')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_mall_map_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_mall_map_add')?></a></li>
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
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
		  	
			<?php  $attributes = array('id' =>'myform'); echo form_open('mall/mall/addBrand',$attributes)?>
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<fieldset>
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
				<fieldset style="width: 48%; float: left;">
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
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_mall_brand_site')?></label>
					<input type="text" id='site' name='site'>
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
			</div>
			<footer>
				<div class="submit_link">
				<?php if (isset($mallInfo)) echo form_input($mallId)?>
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