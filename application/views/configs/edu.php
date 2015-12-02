<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('m_configs_edu')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_edu_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_edu_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_no')?></th> 
    				<th><?php echo  lang('v_man_edu_type')?></th>
    				<th><?php echo  lang('v_man_edu_code')?></th>     				
    				<th><?php echo  lang('v_man_edu_name')?></th>  				
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody id="infolist">
			<?php $num = count($edulist->result());?>
			</table>
			<footer>
			<div id="pagination" class="submit_link"></div>
			</footer>
			</div><!-- end of #tab1 -->
		  	<?php  $attributes = array('id' =>'myform'); echo form_open('configs/edu/addEdu',$attributes)?>
			
			<div id="tab2" class="tab_content">
				<div class="module_content">
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_edu_province') ?></label>
				<select name='province' id='province'>
					<option value="0" Selected><?php echo lang('v_man_edu_provinceSelect') ?></option>
				<?php if(isset($provinces)):?>
				<?php foreach($provinces->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($provinces)&&$provinces== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_edu_city') ?></label>
				<select name='cityId' id='cityId'>
					<option value="0" Selected><?php echo lang('v_man_edu_citySelect') ?></option>
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
				<label><?php echo lang('v_man_edu_type') ?></label>
				<select name='type' id='type'>
					<option value="0" Selected>学校信息</option>
					<option value="1">学校下属分院</option>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: right;">
				<label><?php echo lang('v_man_edu_supname') ?></label>
				<select name='eduId' id='eduId'>
					<option value="0" Selected><?php echo lang('v_man_edu_eduSelect') ?></option>
				<?php if(isset($edus)):?>
				<?php foreach($edus->result() as $row) {?>
					<option value="<?php echo $row->code; ?>"
						<?php if(isset($edus)&&$edus== $row->code){echo "Selected";} ?>><?php echo $row->title;?></option>
				<?php } endif;?>	
				</select>
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_edu_code')?></label>
					<input type="text" id='code' name="code">
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_edu_name')?></label>
					<input type="text" id='name'  name="name">
				</fieldset>
				<fieldset style="width: 48%; float: left;">
					<label><?php echo  lang('v_man_edu_address')?></label>
					<input type="text" id='address' name="address">
				</fieldset>
				<fieldset style="width: 48%; float: right;">
					<label><?php echo  lang('v_man_edu_tel')?></label>
					<input type="text" id='tel'  name="tel">
				</fieldset>
				<div class="clear"></div>

				</div>
				<footer>
			<div class="submit_link">
				<input type='submit' id='submit' class='alt_btn' name='configs/edu/addEdu' value="<?php echo lang('v_man_submit')?>">
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
$(document).ready(function() {
	initPagination();
	pageselectCallback(0,null);
});
var infos = eval(<?php echo "'".json_encode($edulist->result())."'"?>);

function pageselectCallback(page_index, jq){
	page_index = arguments[0] ? arguments[0] : "0";
	jq = arguments[1] ? arguments[1] : "0";   
	var index = page_index*<?php echo PAGE_NUMS?>;
	var pagenum = <?php echo PAGE_NUMS?>;	
	var msg = "";
	
	for(i=0;i<pagenum && (index+i)<infos.length ;i++)
	{ 
		msg = msg+"<tr><td>";
		msg = msg+infos[index+i].id;
		msg = msg+"</td><td>";
		msg = msg+infos[index+i].typeName;
		msg = msg+"</td><td>";
		msg = msg + infos[i+index].eduCode;
		msg = msg + "</td><td>";
		msg = msg + infos[i+index].eduName;
		msg = msg +"</td><td>"
		msg = msg +"<a  href='<?php echo site_url();?>/configs/edu/update/";
		msg = msg +infos[i+index].id;
		msg = msg +"'>修改</a>";
		msg = msg + "</td></tr>";
	}
	
   //document.getElementById('devicepageinfo').innerHTML = msg;
	   $('#infolist').html(msg);				
   return false;
}

/** 
 * Callback function for the AJAX content loader.
 */
function initPagination() {
	
   var num_entries = <?php if(isset($num)) echo $num; ?>/<?php echo PAGE_NUMS;?>;
   
    // Create pagination element
    $("#pagination").pagination(num_entries, {
        num_edge_entries: 2,
        prev_text: '<?php echo  lang('g_previousPage')?>',
        next_text: '<?php echo  lang('g_nextPage')?>',           
        num_display_entries: 4,
        callback: pageselectCallback,
        items_per_page:1
    });
 }
        
</script>
<script type="text/javascript">
	$(function(){
		$("#province").change(function(){
			$("#cityId").load("<?php echo base_url();?>index.php?/configs/edu/citySel/"+$("#province").val());
		});

		$("#type").change(function(){
			if($('#type').val()=='1'){
				$("#eduId").load("<?php echo base_url();?>index.php?/configs/edu/typeSel/"+$("#cityId").val());
			}
		});
	});
</script>