<section id="main" class="column">
		
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('m_company_office_req')?></h3>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				    <th><?php echo  lang('v_man_no')?></th>     				
    				<th><?php echo  lang('v_man_office_cid')?></th> 	
    				<th><?php echo  lang('v_man_office_name')?></th>     				
    				<th><?php echo  lang('v_man_office_req_name')?></th>     				
    				<th><?php echo  lang('v_man_office_req_time')?></th>     				
    				<th><?php echo  lang('v_man_office_req_status')?></th>  			
    				<th><?php echo  lang('g_actions')?></th>
				</tr> 
			</thead> 
			<tbody> 
			 <?php if(isset($infolist)):
			 	foreach($infolist->result() as $row)
			 	{
			 ?>
				<tr> 
				    <td><?php echo $row->rid;?></td> 
    				<td><?php echo $row->companyId;?></td> 
    				<td><?php echo $row->officeName;?></td>  
    				<td><?php echo $row->mid;?></td>  
    				<td><?php echo $row->reqTime;?></td> 
    				<td><?php if($row->status=='0'){echo "申请中";}else if($row->status=='1'){echo "面试中";}else if($row->status=='2'){echo "已入职";}else if($row->status=='3'){echo "已拒绝";}else{echo "无效";}?></td>  
    				<td>
    				<?php echo anchor('/company/officeReq/detail/'.$row->rid, lang('v_man_office_req_query'));?>
    				<?php if($row->status=='0'){ echo anchor('/company/officeReq/notify/'.$row->rid, lang('v_man_office_req_notify'));} ?>
    				<?php if($row->status=='1'){ echo anchor('/company/officeReq/agree/'.$row->rid, lang('v_man_office_req_agree'));}?>
    				</td>
				</tr> 
			<?php } endif;?>
			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
