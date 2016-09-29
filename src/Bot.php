<?php

/**
 *	Este bot e responsavel por responder as mensagens e pedidos dos usuarios no telegram
 */

namespace Bot;

class Bot{

	private $app;

	public function __construct($app){
		$this->app = $app;
	}

	public function help($message){

		$content = Template::r("help");

		$this->app->getBotApi()->sendMessage(array(
			"text" => $content,
			"chat_id" => $message -> chat -> id,
			"reply_to_message_id" => $message -> message_id
		));
	}

	public function welcome($message){

		$content = Template::r("welcome", array(
			'name' => $message->from->first_name
		));

		$this->app->getBotApi()->sendMessage(array(
			"text" => $content,
			"chat_id" => $message -> chat -> id,
			"reply_to_message_id" => $message -> message_id
		));
	}

	public function goodbye($message){
		$content = Template::r("goodbye", array(
			'name' => $message->from->first_name
		));

		$this->app->getBotApi()->sendMessage(array(
			"chat_id" => $message -> chat -> id,
			"text" => $content,
			"reply_to_message_id" => $message -> message_id
		));
	}

}
