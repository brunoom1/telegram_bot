<?php 
	
namespace Bot;

use \Eden\Template as Tpl;



class Template{

	private static $instance = null;

	public static function r($template_name, $vars = array()){
		if($instance == null){
			self::$instance = new Template();
		}


		$this->templateEngine = new Tpl\Index();

		self::$instance -> setVars($vars);
		self::$instance -> setFile(App::getInstance() -> getConfig()['path_template']. "/" . $template_name);

		return self::$instance -> render();
	}

	public function render(){
		return $this->templateEngine -> parsePhp($this->file, true);
	}

	public function setVars($var = array()){
		$this->templateEngine -> set($var);
	}

	public function setFile($file){
		$this->file = $file;
	}

}
