<?php 
$pid = array('name' =>'id' ,'id'=>'id','value'=>set_value('id',isset($cityInfo)?$cityInfo->id:'0'),'type'=>'hidden');
?>
<?php $attributes = array('id' =>'myform');  echo form_open('configs/city/modifyCity',$attributes)?>
<section id="main" class="column">
		<h4 class="alert_info" id="msg" style="display:none;"></h4> 
		<article class="module width_full">
		<header><h3 class="tabs_involved"><?php echo  lang('v_man_city_update')?></h3>
		</header>

		<div class="tab_container">
				<div class="module_content">
						<fieldset>
							<label><?php echo  lang('v_man_city_code')?></label>
							<input type="text" id='code' name="code" value='<?php if(isset($cityInfo)) echo $cityInfo->cityId?>'>
						</fieldset>
						<fieldset>
							<label><?php echo  lang('v_man_city_name')?></label>
							<input type="text" id='name' name="name" value='<?php if(isset($cityInfo)) echo $cityInfo->cityName?>'>
						</fieldset>
				</div>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<?php if (isset($cityInfo)) echo form_input($pid)?>
				<input type='submit' id='submit' class='alt_btn' name='configs/city/modifyCity' value="<?php echo lang('v_man_submit')?>">
			</div>
		</footer>
		</article><!-- end of content manager article -->
		<div class="clear"></div>
		<div class="spacer"></div>
	</section>
<?php echo form_close();?>
	<script type="text/javascript">

function modifyCity(id) {	
	code = trim(document.getElementById('code').value);
	name = trim(document.getElementById('name').value);
	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
	if(code=='')
	{
		document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_man_city_codeN')?></font>';
		document.getElementById('msg').style.display="block";
		return;

	}
	if(name=='')
	{
		document.getElementById('msg').innerHTML = '<font color=red><?php echo  lang('v_man_city_nameN')?></font>';
		document.getElementById('msg').style.display="block";
		return;

	}
	document.getElementById('modifyCityBtn').disabled=true;
	var data = {
			id:id,
			code : code,
			name : name
		};
		jQuery
				.ajax({
					type : "post",
					url : "<?php echo base_url()?>/index.php?/configs/city/modifyCity",
					data : data,
					success : function(msg) {
						if(!msg){
							document.getElementById('msg').innerHTML = "<font color=red><?php echo  lang('v_man_city_duplicateCode')?></font>";
							document.getElementById('msg').style.display="block";	
							document.getElementById('modifyCityBtn').disabled=false;
						}else{
						document.getElementById('msg').innerHTML = "<?php echo  lang('v_man_city_modifyCityS')?>";
						document.getElementById('msg').style.display="block";
						window.location="<?php echo site_url()?>/configs/city";}					 
					},
					error : function(XmlHttpRequest, textStatus, errorThrown) {
						alert("<?php echo  lang('t_error')?>");
						document.getElementById('modifyCityBtn').disabled=false;
					},
					beforeSend : function() {
						document.getElementById('msg').innerHTML = '<?php echo  lang('v_man_city_waitAdd')?>';
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