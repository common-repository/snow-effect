<?php

class GMSE_Cron {
	
	public function __construct () {

		add_action( 'init', array( $this, 'GMSE_default' ) );
		
	}

	public function GMSE_default(){
		
		global $iconcusom,$predfinedata;
		$iconcusom = array('•','❅','❆','✢','✣','✤','✥','✦','✧','✨','✩','✪','✫','✬','✭','✮','✯','✰','✱','✲','✳','✴','✵','✶','✷','✸','✹','✺','✻','✼','✽','✾','✿','❀','❁','❂','❃','❇','❈','❉','❊','❋','☃','♥','❤','❥'
		);
		$predfinedata = array(
			'autumn'=> 'Autumn',
			'christmas'=> 'Christmas',
			'halloween'=> 'Halloween',
			'newyear'=> 'New Year',
			'rain'=> 'Sain',
			'spring'=> 'Spring',
			'summer'=> 'Summer',
			'thanksgiving'=> 'Thanks Giving',
			'valentine'=> 'Valentine',
		);
		$defalarr = array(
			
			'gmse_enable_setting' => 'yes',
			
			'gmse_select_weather' => 'christmas',
			'gmse_minimum_size' => '10',
			'gmse_maximum_size' => '20',
			'gmse_minimum_falling' => '1',
			'gmse_maximum_falling' => '5',
			
		);
		foreach ($defalarr as $keya => $valuea) {
			if (get_option( $keya )=='') {
				update_option( $keya, sanitize_text_field($valuea) );
			}
			
		}
		
	}
}

?>