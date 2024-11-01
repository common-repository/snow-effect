<?php
/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */
class GMSE_Admin {
	
	public function __construct () {

		add_action( 'admin_init', array( $this, 'GMSE_register_settings' ) );
		add_action( 'admin_menu', array( $this, 'GMSE_admin_menu' ) );
		add_action('admin_enqueue_scripts', array($this, 'GMSE_scripts'));

		add_action('wp', array( $this, 'GMSE_wp'), 10 );
		if ( is_admin() ) {
			return;
		}
		
	}

	public function GMSE_wp() {
		
	}

	public function GMSE_scripts(){
		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'wp-color-picker');
    	wp_enqueue_style( 'gmse_admin_css' , GMSE_PLUGINURL.'css/admin-style.css');
		wp_enqueue_style( 'gmse_select2_css' , GMSE_PLUGINURL.'js/select2/select2.css');
	    wp_enqueue_script('gmse_select2_js', GMSE_PLUGINURL.'js/select2/select2.js');
		wp_enqueue_script('gmse-script', GMSE_PLUGINURL . '/js/admin-script.js', array(), '1.0.0', true );
	}

	public function GMSE_admin_menu () {

		add_menu_page('Snow Effect', 'Snow Effect', 'manage_options', 'GMSE', array( $this, 'GMSE_page' ));
	}

	public function GMSE_page() {
	global $iconcusom,$predfinedata;
	$gmse_enable_setting = get_option('gmse_enable_setting');
	$gmse_flakes_number = get_option('gmse_flakes_number');
	$gmse_select_weather = get_option('gmse_select_weather');
	$gmse_make = get_option('gmse_make');
	$gmse_flake_icon_type = get_option('gmse_flake_icon_type');
	$gmse_flake_image_type = get_option('gmse_flake_image_type');
	$gmse_minimum_size = get_option('gmse_minimum_size');  
	$gmse_maximum_size = get_option('gmse_maximum_size');  
	$gmse_minimum_falling = get_option('gmse_minimum_falling');  
	$gmse_maximum_falling = get_option('gmse_maximum_falling'); 
	$gmse_flakes_shadow = get_option('gmse_flakes_shadow'); 
	$gmse_icon_color = get_option('gmse_icon_color');      
	?>
	<div>
	   <h2><?php _e('Snow Effect', 'gmse'); ?></h2>
	   <div class="about-text">
	        <p>
				Thank you for using our plugin! If you are satisfied, please reward it a full five-star <span style="color:#ffb900">★★★★★</span> rating.                        <br>
	            <a href="https://wordpress.org/support/plugin/snow-effect/reviews/?filter=5" target="_blank">Reviews</a>
	            | <a href="https://wordpress.org/support/plugin/snow-effect" target="_blank">Discussion</a>
	            | <a href="https://www.codesmade.com/contact-us/" target="_blank">Support</a>
	        </p>
	    </div>
	   <form method="post" action="options.php">
	      <?php 
	      settings_fields( 'gmse_options_group' ); 

	     
	      ?>
	      <table class="form-table">
		         
		         <tr valign="top">
		            <th scope="row">
		               <label for="gmse_enable_setting"><?php _e('Enable', 'gmse'); ?></label>
		            </th>
		            <td>
		               <input class="regular-text" type="checkbox" id="gmse_enable_setting" <?php echo (($gmse_enable_setting=='yes')?'checked':'') ; ?> name="gmse_enable_setting" value="yes" />
		            </td>
		         </tr>
		         
	           
	            <tr class="gmse_select_weather_tr" >
	                <th scope="row"><label><?php _e('Select A Weather Or Occasion', 'gmse'); ?></label></th>
	                <td>
	                	
						<select name="gmse_select_weather" class="gmse_select_weather" >
	                    	<?php

	                    	foreach ($predfinedata as $keypredfinedata => $valuepredfinedata) {
	                    		$sectesis = (($keypredfinedata==$gmse_select_weather)?'selected':'');
	                    		echo '<option value="'.$keypredfinedata.'"  '.$sectesis.'>'.$valuepredfinedata.'</option>';
	                    	}
	                    	?>
	                   	</select>

	                   	<div class="gmse_weatherlist">
	                   		<?php
	                   		/*echo "<pre>";
	                   		print_r($gmse_make);
	                   		echo "</pre>";*/
	                   		foreach ($predfinedata as $keypredfinedata => $valuepredfinedata) {
	                   			echo "<div class='gmse_inner_weather_data gmse_inner_weather_".$keypredfinedata."'>";
	                   			echo "<div class='gmse_inner_weather_data_flex'>";
	                   			$directoryPath = GMSE_PLUGINDIR."images/".$keypredfinedata;
	                   			if (is_dir($directoryPath)) {
	                   				$fileNames = scandir($directoryPath);
									if ($fileNames !== false) {
										$fileNames = array_diff($fileNames, array('.', '..'));
										$x =1;
										foreach ($fileNames as $fileName) {
								            //echo $fileName . "<br>";
								            $fileurl = GMSE_PLUGINURL."images/".$keypredfinedata."/".$fileName;
								            $filenamecustm = pathinfo($fileName, PATHINFO_FILENAME);
								            $filenamecustm =$fileName;
								            $checked = '';
								            if(isset($gmse_make[$keypredfinedata][$filenamecustm])){
								            	 $checked = 'checked';
								            }
								            $disabled = '';
								            if($x>3){
								            	$disabled = 'disabled';
								            }
								            
								            echo "<div class='gmse_innsermake'>";
								            echo "<input type='checkbox' name='gmse_make[".$keypredfinedata."][".$filenamecustm."]' ".$checked." ".$disabled."/>";
								            if($disabled == 'disabled'){
								            	echo '<a href="https://www.codesmade.com/store/festival-snow-effect/" target="_blank">Get Pro version</a>';
								            }
								            echo "<img src='".$fileurl."'/>";
								            echo "</div>";
								            $x++;
								        }
									}
	                   			}
	                   			echo "</div>";

	                   			echo "</div>";
	                   		}
	                   		?>
	                   	</div>

	                </td>
	            </tr>
	            
	            <tr class="gmse_flake_image_type_tr">
	                <th scope="row"><label><?php _e('Flake Custom Image', 'gmse'); ?></label></th>
	                <td>
						 <a href="#" class="gmse_upload_image_button button" 
						 style="
								    pointer-events: none;
								    cursor: not-allowed;
								    opacity: 0.4;
								"
								>Set Image</a>
						 <a href="https://www.codesmade.com/store/festival-snow-effect/" target="_blank">Get Pro version</a>
						 <div class="gmse_pdf_logo_prvw_image_main">
						 	<?php
						 	if(!empty($gmse_flake_image_type)){
						 		foreach ($gmse_flake_image_type as $key_gmse_flake_image_type => $value_gmse_flake_image_type) {
						 			$gmse_url = wp_get_attachment_image_src( $value_gmse_flake_image_type, 'full' );
						 		?>
						 		<div class="gmse_pdf_logo_prvw_image">
						 			<img src="<?php echo $gmse_url[0]; ?>"/>
							 		<input type="hidden" name="gmse_flake_image_type[]" value="<?php echo $value_gmse_flake_image_type;?>" />
							 		<a href="#" class="gmse_remove_image_button button">Remove Image</a>
							 	</div>
						 		<?php	
						 		}
						 	}
						 	?>
						 	
						 </div>
						 
	                </td>
	            </tr>
	            
	            <tr>
	                <th scope="row"><label><?php _e('Flakes Number', 'gmse'); ?></label></th>
	                <td>
	                   <input type="range" name="gmse_flakes_number" class="regular-text" value="<?php echo $gmse_flakes_number;?>"  min="10" step="1" max="200">
	                   <p class="description">
	                   	<?php _e('Please specify the number of flakes. Default value : 30', 'gmse'); ?>
	                   </p>
	                 
	                </td>
	            </tr>
	            <tr>
	                <th scope="row"><label><?php _e('Flakes Minimum Size', 'gmse'); ?></label></th>
	                <td>
	                   <input type="range" name="gmse_minimum_size" class="regular-text" value="<?php echo $gmse_minimum_size;?>"  min="1" step="1" max="30">
	                   <p class="description">
	                   	<?php _e('Please specify minimum size for flake. Default value : 10', 'gmse'); ?>
	                   </p>
	                 
	                </td>
	            </tr>
	            <tr>
	                <th scope="row"><label><?php _e('Flakes Maximum Size', 'gmse'); ?></label></th>
	                <td>
	                   <input type="range" name="gmse_maximum_size" class="regular-text" value="<?php echo $gmse_maximum_size;?>"  min="10" step="1" max="200">
	                   <p class="description">
	                   	<?php _e('Please specify Maximum size for flake. Default value : 20', 'gmse'); ?>
	                   </p>
	                 
	                </td>
	            </tr>
	            <tr>
	                <th scope="row"><label><?php _e('Flakes Minimum Falling Speed', 'gmse'); ?></label></th>
	                <td>
	                   <input type="range" name="gmse_minimum_falling" class="regular-text" value="<?php echo $gmse_minimum_falling;?>"  min="1" step="1" max="10">
	                   <p class="description">
	                   	<?php _e('Please specify minimal falling speed. Default value : 1', 'gmse'); ?>
	                   </p>
	                </td>
	            </tr>
	            <tr>
	                <th scope="row"><label><?php _e('Flakes Maximum Falling Speed', 'gmse'); ?></label></th>
	                <td>
	                   <input type="range" name="gmse_maximum_falling" class="regular-text" value="<?php echo $gmse_maximum_falling;?>"  min="1" step="1" max="10">
	                   <p class="description">
	                   	<?php _e('Please specify maximum falling speed. Default value : 5', 'gmse'); ?>
	                   </p>
	                </td>
	            </tr>
	            
	            
	            
	      </table>
	      <input type="hidden" name="action_wssvs_op" value="update">
	      <?php  submit_button(); ?>
	   </form>
	  
	</div>
	<style type="text/css">
		.select2-container{
			min-width: 300px;
		}
		.gmse_pdf_logo_prvw_image {
		    /* margin-top: 10px; */
		    display: flex;
		    flex-direction: column;
		    align-items: center;
		    justify-content:space-between;
		}
		.gmse_pdf_logo_prvw_image img{
			/*margin-right: 10px;*/
			max-width: 50px;
		}
		.gmse_pdf_logo_prvw_image_main {
		    display: flex;
		    gap: 5px;
		    margin-top: 10px;
		    flex-wrap: wrap;
		}
	</style>
	<script type="text/javascript">
		
	</script>
	<?php
	}

	public function GMSE_register_settings() {

		
		register_setting( 'gmse_options_group', 'gmse_enable_setting', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_flakes_number', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_select_weather', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_flake_image_type', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_make', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_minimum_size', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_maximum_size', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_minimum_falling', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_maximum_falling', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_flakes_shadow', array( $this, 'gmse_accesstoken_callback' ) );
		register_setting( 'gmse_options_group', 'gmse_icon_color', array( $this, 'gmse_accesstoken_callback' ) );
		
	}

	public function gmse_accesstoken_callback($option) {
		if ( empty( $option ) ) {
		}
		return $option;
	}

	
	
}


?>