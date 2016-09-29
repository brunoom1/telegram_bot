<?php 

namespace Bot;

use Symfony\Component\Debug\Debug;

class App{

	private static $instance = null;
	private $config = null;

	private function __construct($config = null){
		$this->config = $config;
		$this->botapi = new BotApi($this);


		$bot = new Bot($this);
		$this->botapi -> getLinkBot() -> setBot($bot);

	}

	public function getBotApi(){
		return $this->botapi;
	}
	

	public static function getInstance($config = null){
		if(self::$instance == null){
			self::$instance = new App($config);
		}
		return self::$instance;
	}

	public function getConfig(){
		return $this->config;
	}

	public function run(){

		$count_file = $this->config['file_count'];
		$bot_key = $this->config['bot_key'];
		$time_update = $this->config['time_update']; // 1s

		$count = -1;

		while(true){

			if( file_exists($count_file)){
				$count = (int) file_get_contents($count_file);
			}

			$result = $this-> botapi -> getUpdates($count);

			foreach($result as $update){
				// each update
				$this -> botapi -> getLinkBot() -> check($update);
				$count = $update -> update_id + 1;
			}

			// save last count for offset get updates
			//file_put_contents($count_file, $count);

			// sleep per time in seconds
			sleep($time_update);

			// debug
			echo "<pre>";
			print_r($result);

			if(!$this->getConfig()['use_main_loop']){ break; }
		}

	}
}