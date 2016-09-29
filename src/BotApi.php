<?php 
namespace Bot;

class BotApi{

	private $url;
	private $token;
	private $curl;
	private $linkBot;


	public function __construct(App $app){
		$this->app = $app;
		$this->curl = new \Curl\Curl();		
		$this->linkBot = new LinkBot($this);
	}

	public function getLinkBot(){
		return $this->linkBot;
	}

	public function getUrlFormatted($method){
		return $this->app->getConfig()['url_api'] . $this-> app -> getConfig()['bot_key'] . "/" . $method;
	}

	public function sendMessage($options){
		$old_options = array(
			'chat_id' => 0, 
			'text' => "", 
			'parse_mode' => 'HTML',	// HTML | Markdown,
			'disable_web_page_preview' => false, 
			'disable_notification' => false,
			'reply_to_message_id' => 0,
			'reply_markup' => null
		);

		$options = array_merge($old_options, $options);
		$this->curl -> get($this->getUrlFormatted("sendMessage"), $options);
	}

	public function getUpdates($count = 0){
		$options = array();

		if($count > 0){
			$options['offset'] = $count;
		}

		$this->curl->get($this->getUrlFormatted("getUpdates"), $options);
		$result = json_decode($this->curl -> response);

		if($result -> ok === false){
			throw new Exception("getUpdates response false result", 1);			
		}

		return $result -> result;
	}

}