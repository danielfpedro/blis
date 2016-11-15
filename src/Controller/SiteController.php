<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

class SiteController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->viewBuilder()->layout('site');
	}
	public function home()
	{
		$this->loadModel('Posts');

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
	public function category()
	{
		$this->loadModel('Posts');

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
	public function post()
	{
		$this->loadModel('Posts');

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
	public function loadMore()
	{
		$this->viewBuilder()->layout('ajax');

		$this->loadModel('Posts');

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
	public function loadMoreSmall()
	{
		$this->viewBuilder()->layout('ajax');

		$this->loadModel('Posts');

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
}