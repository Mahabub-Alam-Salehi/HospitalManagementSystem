<?php
if(!function_exists('rs_form_group')){
	function rs_form_group($data = array(),$input = ''){
		?>
		<div id="<?php echo uniqid('from_group_'); ?>" class="<?php echo (isset($data['group_class'])? $data['group_class']: 'form-group'); ?> <?php echo ($data['media']? 'media_upload': ''); ?>">
			<label class="<?php echo (isset($data['label_class'])? $data['label_class']: 'control-label col-md-3 col-sm-3 col-xs-12'); ?>" for="<?php echo (isset($data['id'])? $data['id']: ''); ?>">
				<?php echo $data['label']; ?>
				<?php if(isset($data['required']) && $data['required']){
					echo '<span class="required">*</span>';
				} ?>
			</label>
			<div class="<?php echo (isset($data['input_class'])? $data['input_class']: 'col-md-6 col-sm-6 col-xs-12'); ?>">
				<?php
				echo $input;
				if($data['media']){
					?>
						<span class="input-group-btn"> <button class="btn btn-default dialog_open" data-title="Media Library" data-url="<?php echo base_url('ajax_query/uploader/'); ?>" type="button"><span class="glyphicon glyphicon-cloud-upload"></span> Select</button> </span>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}


if(!function_exists('get_country')){
	function get_country($data = null){
		if(is_null($data)){
			$country = file_get_contents(base_url().'Ajax_query/get_coutry');
			return json_decode($country,true);
		}else{
			return file_get_contents(base_url().'Ajax_query/get_coutry/'.$data);
		}
	}
}


if(!function_exists('is_login')){
	function is_login(){
		$CI =& get_instance(); 
		$CI->load->library(array('session'));
		if(isset($CI->session->userdata['is_login']) && $CI->session->userdata['is_login']){
			return true;
		}else{
			return false;
		}
	}
}

