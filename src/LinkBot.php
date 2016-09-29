<?php
namespace Bot;


class LinkBot{

	private $bot = null;

	public function __construct($botApi){
		$this->botApi = $botApi;
	}

	public function setBot(Bot $bot){
		$this->bot = $bot;
	}

	public function check($updates){
		// trabalha os updates
		if($updates -> message){
			return $this->message($updates->message);
		}
		return false;
	}


	public function message($message){

		// is command
		if($message -> new_chat_member){
			$message -> text = "/welcome@hobr_bot";
		}elseif($message -> left_chat_member){
			$message -> text = "/goodbye@hobr_bot";
		}
		

		if($message -> text){
			$this->call_command($message);						
		}

	}


	public function call_command($message){
		$msg_command = explode("@", $message -> text)[0];
		$msg_command = substr($msg_command, 1, strlen($msg_command));

		if(method_exists($this->bot, $msg_command)){			
			$this->bot->$msg_command($message);
		}
	}

}