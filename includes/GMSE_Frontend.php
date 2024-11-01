<?php
/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */

class GMSE_Frontend {
	
	public function __construct () {

		add_action( 'wp_enqueue_scripts',  array( $this, 'gmse_scritps' ) );
		add_action( 'wp_footer',  array( $this, 'gmse_wp_footer' ) );
	}

	public function gmse_scritps () {
		wp_enqueue_style('gmse-style', GMSE_PLUGINURL . '/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_script('gmse-snow', GMSE_PLUGINURL . '/js/snowfall.jquery.min.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script('gmse-script', GMSE_PLUGINURL . '/js/script.js', array(), '1.0.0', true );

	}

	public function gmse_wp_footer () {
		global $iconcusom;
		$gmse_enable_setting = get_option('gmse_enable_setting');
		$gmse_flakes_number = get_option('gmse_flakes_number');
		$gmse_flake_image_type = get_option('gmse_flake_image_type'); 
		$gmse_select_weather = get_option('gmse_select_weather'); 
		$gmse_make = get_option('gmse_make');  
		$gmse_minimum_size = get_option('gmse_minimum_size');  
		$gmse_maximum_size = get_option('gmse_maximum_size');  
		$gmse_minimum_falling = get_option('gmse_minimum_falling');  
		$gmse_maximum_falling = get_option('gmse_maximum_falling'); 
		$gmse_flakes_shadow = get_option('gmse_flakes_shadow'); 
		$gmse_icon_color = get_option('gmse_icon_color');   
		if ($gmse_enable_setting=='yes') { 

		?>
		<script type='text/javascript'>     
        jQuery(document).ready(function(){
        	<?php
        		if(isset($gmse_make) && isset($gmse_select_weather)){
        			//print_r($gmse_select_weather);
        			//print_r($gmse_make[$gmse_select_weather]);
        			if(!empty($gmse_make[$gmse_select_weather])){
        				foreach ($gmse_make[$gmse_select_weather] as $key_gmse_flake_image_type => $value_gmse_flake_image_type) {
							//print_r($value_gmse_flake_image_type);
							$fileurl = GMSE_PLUGINURL."images/".$gmse_select_weather."/".$key_gmse_flake_image_type;
							?>
							jQuery(document).snowfall({
					        	 image :"<?php echo $fileurl; ?>",
					        	 minSize:<?php echo $gmse_minimum_size;?>, 
					        	 maxSize:<?php echo $gmse_maximum_size;?>,
					        	 minSpeed:<?php echo $gmse_minimum_falling;?>,
					        	 maxSpeed:<?php echo $gmse_maximum_falling;?>,
					        	 flakeCount:<?php echo $gmse_flakes_number;?>,
				        	 }); 
							<?php
						}
        			}

        		}

        		if(!empty($gmse_flake_image_type)){
					foreach ($gmse_flake_image_type as $key_gmse_flake_image_type => $value_gmse_flake_image_type) {
						$gmse_url = wp_get_attachment_image_src( $value_gmse_flake_image_type, 'full' );
						?>
						jQuery(document).snowfall({
				        	 image :"<?php echo $gmse_url[0]; ?>",
				        	 minSize:<?php echo $gmse_minimum_size;?>, 
				        	 maxSize:<?php echo $gmse_maximum_size;?>,
				        	 minSpeed:<?php echo $gmse_minimum_falling;?>,
				        	 maxSpeed:<?php echo $gmse_maximum_falling;?>,
				        	 flakeCount:<?php echo $gmse_flakes_number;?>,
			        	 }); 
						<?php
					}
				}
			
        	?>
        });
        </script>
        <style type="text/css" media="screen">
        <?php 
        if($gmse_icon_color!=''){
        	?>
        	.snowfall-flakes{
	        	color: <?php echo $gmse_icon_color;?>;
	        }
        	<?php
        }
        ?>	
        .snowfall-flakes{
        	width: auto !important;
        }
        
        </style>
		<?php
		}
	}

	
}
?>