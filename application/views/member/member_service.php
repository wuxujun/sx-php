<section id="main" class="column" style="height:1100px">
	<article class="module width_full">
		<header>
			<h3 class="tabs_involved"><?php echo  lang('m_member_s')?></h3>
			<!--
			<span class="relative r"> <a
				href="<?php echo site_url()?>/report/device/export"
				class="bottun4 hover"><font><?php echo  lang('g_exportToCSV')?></font></a>
			</span>-->
		</header>

		<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
					<th width="10%"><?php echo  lang('v_man_info_id')?></th>
					<th width="15%"><?php echo  lang('v_man_member_service_l')?></th>
					<th width="15%"><?php echo  lang('v_man_member_mobile_l')?></th>
					<th width="10%"><?php echo  lang('v_man_list_state')?></th>
					<th><?php echo  lang('v_man_member_submittime_l')?></th>
					<th width="20%"><?php echo  lang('g_actions')?></th>
				</tr>
			</thead>
			<tbody id="infolist">
			<?php $num = count($infolist->result());?>
	    	
		</tbody>
	</table>

		<footer>
			<div id="pagination" class="submit_link"></div>
		</footer>	
	</article>
</section>

<script type="text/javascript">
$(document).ready(function() {
	initPagination();
	pageselectCallback(0,null);
});
var infos = eval(<?php echo "'".json_encode($infolist->result())."'"?>);

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
		msg = msg + infos[i+index].type_name;
		msg = msg+"</td><td>";
		msg = msg + infos[i+index].member;
		msg = msg + "</td><td>";
		msg = msg + infos[i+index].state;
		msg = msg + "</td><td>";
		msg = msg + infos[i+index].addtime;
		msg = msg +"</td><td>"
		msg = msg +"<a  href='<?php echo site_url();?>/member/member/servicedeal/";
		msg = msg +infos[i+index].id;
		msg = msg +"'>处理</a>";

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