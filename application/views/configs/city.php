<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('m_configs_city')?></h3>
		<ul class="tabs">
   			<li><a href="#tab1"><?php echo  lang('v_man_city_list')?></a></li>
    		  <li><a href="#tab2"><?php echo  lang('v_man_city_add')?></a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_no')?></th> 
    				<!--<th><?php echo  lang('v_man_city_supid')?></th> -->
    				<th><?php echo  lang('v_man_city_code')?></th>     				
    				<th><?php echo  lang('v_man_city_name')?></th>  				
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody id="infolist">
			<?php $num = count($citylist->result());?>
			</table>
			<footer>
			<div id="pagination" class="submit_link"></div>
			</footer>
			</div><!-- end of #tab1 -->
		  	<?php  $attributes = array('id' =>'myform'); echo form_open('configs/city/addCity',$attributes)?>
			
			<div id="tab2" class="tab_content">
				<div class="module_content">
						<fieldset>
							<label><?php echo  lang('v_man_city_code')?></label>
							<input type="text" id='code' name="code">
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_city_name')?></label>
							<input type="text" id='name'  name="name">
						</fieldset>
				</div>
				<footer>
			<div class="submit_link">
				<input type='submit' id='submit' class='alt_btn' name='configs/city/addCity' value="<?php echo lang('v_man_submit')?>">
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
var infos = eval(<?php echo "'".json_encode($citylist->result())."'"?>);

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
		msg = msg + infos[i+index].cityId;
		msg = msg + "</td><td>";
		msg = msg + infos[i+index].cityName;
		msg = msg +"</td><td>"
		msg = msg +"<a  href='<?php echo site_url();?>/configs/city/update/";
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