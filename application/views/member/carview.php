<?php 
$mobile = array (
		'name' => 'mobile',
		'id' => 'mobile',
		'value' => set_value ( 'mobile',isset($mobile)?$mobile:''),
		'maxlength' => 20,
		'size' => 20,
		'readonly'=>'readonly' 
);

$name = array (
		'name' => 'name',
		'id' => 'name',
		'value' => set_value ( 'name',isset($name)?$name:''),
		'maxlength' => 20,
		'size' => 20,
		'readonly'=>'readonly' 
);

?>
<section id="main" class="column">
		<h4 class="alert_info" id="msg" style="display:none;"></h4>
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo lang('v_man_member_binfo') ?></h3>
		</header>		
			<div class="module_content">
				<input type='hidden' id='id' value="<?php echo $id;?>">
				<fieldset style="width: 48%; float: left; margin-right: 3%;">
						<label><?php echo lang('v_man_member_login_l') ?></label><?php echo form_error('mobile'); ?>
						<?php echo form_input($mobile); ?> 
				</fieldset>
				<fieldset style="width: 48%; float: left;">
						<label><?php echo lang('v_man_member_name') ?></label><?php echo form_error('name'); ?>
						<?php echo form_input($name); ?> 
				</fieldset>
				<div class='clear'></div>
			</div>			
		</article><!-- end of content manager article -->
		
		
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo lang('v_man_member_carinfo') ?></h3>
		<ul class="tabs2">
   			<li><a href="#tab3"><?php echo lang('v_man_member_carList') ?></a></li>
    		  <li><a href="#tab4"><?php echo lang('v_man_member_addCar') ?></a></li>
		</ul>
		</header>  
		<div class="tab_container">
			<div id="tab3" class="tab_content1">
			<table class="tablesorter" cellspacing="0"> 
			<thead>	 
				<tr> 
				    <th  width="10%"><?php echo lang('v_man_member_carno') ?></th> 			 
    				<th  width="15%"><?php echo lang('v_man_member_carbrand') ?></th> 
    				<th  width="10%"><?php echo lang('v_man_member_carregister') ?></th>    				
    				<th  width="20%"><?php echo lang('v_man_member_carframeno') ?></th>    				
    				<th  width="28%"><?php echo lang('g_actions') ?></th>     			
				</tr> 
			</thead> 
			<tbody> 
			 <?php 		 
		  if(isset($infolist)):
			 	foreach($infolist as $rel)
			 	{
			 ?>
				<tr>				  
    				<td><?php echo $rel->car_no;?></td> 
    				<td><?php echo $rel->car_brand_mode;?></td> 
    				<td><?php echo $rel->car_register_date;?></td>   
    				<td><?php echo $rel->car_frame_no;?></td> 				 
    				<td><a  href="<?php echo site_url();?>/member/member/editcar/<?php echo $rel->id; ?>">
    				<img src="<?php echo base_url();?>assets/images/icn_edit.png" title="Edit" style="border:0px;"/></a>
    				<a href="javascript:if(confirm('<?php echo lang('v_man_member_deleteCar') ?>'))location='<?php echo site_url();?>/member/member/deletecar/<?php echo $rel->id; ?>'">
    				<img src="<?php echo base_url();?>assets/images/icn_trash.png" title="Trash" style="border:0px"/></a>
    				</td>    				 
				</tr> 
			<?php } endif;?>			
			</tbody> 
			</table>
			</div><!-- end of #tab3 -->
		  	
			<div id="tab4" class="tab_content1">			
				<div class="module_content">
						<fieldset  style="width: 48%; float: left; margin-right: 3%;">
							<label><?php echo lang('v_man_member_carno') ?></label>
							<input type="text" id='carno'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo lang('v_man_member_carbrand') ?></label>
						  <select  id="carbrand">
						  	<option value="" Selected>请选择车辆品牌</option>
							<?php foreach ($brands as $row)
							{
								?>
								<option value="<?php echo $row->code;?>"><?php echo $row->title?></option>
								<?php 
							}
							?>
						  </select>
						</fieldset>
						<fieldset style="width: 48%; float: left; margin-right: 3%;">
							<label><?php echo lang('v_man_member_cartype') ?></label>
						  <select  id="cartype">
						  	<option value="" Selected>请选择车型</option>
							<?php foreach ($types as $row)
							{
								?>
								<option value="<?php echo $row->code;?>"><?php echo $row->title?></option>
								<?php 
							}
							?>
						  </select>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo lang('v_man_member_carcolor') ?></label>
							<select  id="carcolor">
								<option value="" Selected>请选择车辆颜色</option>
							<?php foreach ($colors as $row)
							{
								?>
								<option value="<?php echo $row->code;?>"><?php echo $row->title?></option>
								<?php 
							}
							?>
						  </select>
						</fieldset>
						<fieldset style="width: 48%; float: left; margin-right: 3%;">
							<label><?php echo lang('v_man_member_carframeno') ?></label>
							<input type="text" id='carframeno'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo lang('v_man_member_carengineno') ?></label>
							<input type="text" id='carengineno'>
						</fieldset>
						<fieldset style="width: 48%; float: left; margin-right: 3%;">
							<label><?php echo lang('v_man_member_carregister') ?></label>
							<input type="text" id='carregister'>
						</fieldset>
						<fieldset style="width: 48%; float: left;">
							<label><?php echo lang('v_man_member_caryearlydate') ?></label>
							<input type="text" id='caryearlydate'>
						</fieldset>
						<div class='clear'></div>
				</div>	
				<footer>
			<div class="submit_link">
				<input type='submit' id='addSysBtn' class='alt_btn'
					name="store/store/saveInfo" onClick='addcar()'
					value="<?php echo lang('v_man_submit') ?>">
			</div>
		</footer>		
		<!-- end of post new article -->
			</div><!-- end of #tab4 -->			
		</div><!-- end of .tab_container -->
		</article>                                                                
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
<script>
$(".tab_content1").hide(); //Hide all content
$("ul.tabs2 li:first").addClass("active").show(); //Activate first tab
$(".tab_content1:first").show(); //Show first tab content

$("ul.tabs2 li").click(function() {
	$("ul.tabs2 li").removeClass("active"); //Remove any "active" class
	$(".tab_content1").hide(); //Hide all tab content
	$(this).addClass("active"); //Add "active" class to selected tab
	var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
	$(activeTab).fadeIn(); //Fade in the active ID content
	return true;
});
</script>

<script type="text/javascript">

function addcar() {	
	memberid=trim(document.getElementById('id').value);
	carno = trim(document.getElementById('carno').value);
	carbrand = trim(document.getElementById('carbrand').value);
	cartype = trim(document.getElementById('cartype').value);
	carregister = trim(document.getElementById('carregister').value);
	carcolor = trim(document.getElementById('carcolor').value);
	carframeno = trim(document.getElementById('carframeno').value);
	carengineno = trim(document.getElementById('carengineno').value);
	caryearlydate = trim(document.getElementById('caryearlydate').value);
	if(carno=='')
	{
		document.getElementById('msg').innerHTML = '<font color=red><?php echo lang('v_man_member_enterCarno') ?></font>';
		document.getElementById('msg').style.display="block";
		return;

	}
	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
	for (var i = 0; i < carno.length; i++) {
		if(pattern.test(carno.substr(i, 1))){
			document.getElementById('msg').innerHTML = '<font color=red><?php echo lang('v_man_member_CarnoE') ?></font>';
			document.getElementById('msg').style.display="block";
			return;
			}
	}
	
	document.getElementById('addSysBtn').disabled=true;
	var data = {
			memberid:memberid,
			carno :carno,
			carbrand : carbrand,
			cartype:cartype,
			carcolor:carcolor,
			frameno:carframeno,
			engineno:carengineno,
			carregister:carregister,
			caryearlydate:caryearlydate
			
		};
		jQuery
				.ajax({
					type : "post",
					url : "<?php echo site_url()?>/member/member/addcar",
					data : data,
					success : function(msg) {
						if(!msg){
							document.getElementById('msg').innerHTML = "<font color=red><?php echo lang('v_man_pr_existChannelS') ?></font>";	
							document.getElementById('msg').style.display="block";
							document.getElementById('addSyschannelBtn').disabled=false;
						}else{
							document.getElementById('msg').innerHTML = "<?php echo lang('v_man_pr_modifyChannelS') ?>";	
							document.getElementById('msg').style.display="block";
							window.location="<?php echo site_url()?>/member/member/carinfo/"+memberid;
						}									 
					},
					error : function(XmlHttpRequest, textStatus, errorThrown) {
						alert("<?php echo lang('t_error') ?>");
						document.getElementById('addSysBtn').disabled=false;
					},
					beforeSend : function() {
						document.getElementById('msg').innerHTML = '<?php echo lang('v_man_pr_modifyChannel') ?>';
						document.getElementById('msg').style.display="block";
					},
					complete : function() {
					}
				});
}
function trim(str){
    return  (str.replace(/(^\s*)|(\s*$)/g,''));
 }
</script>




 