<?php

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation 
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php?page=siteoptions" ) {
	//Call action that sets
	add_action('admin_head','tt_option_setup');
}

function tt_option_setup(){

	//Update EMPTY options
	$tt_array = array();
	add_option('tt_options',$tt_array);

	$template = get_option('tt_template');
	$saved_options = get_option('tt_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$tt_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$tt_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$tt_array[$id] = $db_option;
			}
		}
	}
	update_option('tt_options',$tt_array);
}





/*-----------------------------------------------------------------------------------*/
/* Admin Backend 
/*-----------------------------------------------------------------------------------*/
function siteoptions_admin_head() 
{ 

	?>
	<script type="text/javascript">
		jQuery(function()
		{
			var message = '<p><strong>激活成功!</strong> 主题的设置请到 <a href="<?php echo admin_url('admin.php?page=siteoptions'); ?>">外观 > 主题设置</a>中设置，感谢您对<a href="http://salonglong.com" title="远方的雪山">远方的雪山</a>的支持！.</p>';
			jQuery('.themes-php #message2').html(message);
		});
	</script>        
    <?php 
}

add_action('admin_head', 'siteoptions_admin_head');
?>