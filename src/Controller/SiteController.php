<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class SiteController extends AppController
{
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->viewBuilder()->layout('site');

		$this->loadModel('Posts');
	}
	public function home()
	{
		
	}
	public function loadMore()
	{
		$this->viewBuilder()->layout('ajax');

		$notIn = [];
		if ($this->request->query('not_in')) {
			$notIn = explode(',', $this->request->query('not_in'));
		};

		$posts = $this->Posts->populars((int)$this->request->query('page'), 15, $notIn);

		$this->set(['posts' => $posts]);
	}
	public function category()
	{

		$posts = $this->Posts->find('all');

		$this->set(['posts' => $posts]);
	}
	public function post()
	{

		$mainPost = $this->Posts->getBySlug($this->request);

		if (!$mainPost) {
			throw new NotFoundException();
		}

		$this->set(['mainPost' => $mainPost]);
	}
	public function view()
	{

		$post = $this->Posts->getBySlug($this->request);

		if (!$post) {
			throw new NotFoundException();
		}
		
		$post->views = (int)$post->views + 1;
		$post->view_timestamp = (new \Datetime())->format('Y-m-d H:i:s');

		if ($this->Posts->save($post)) {
			return $this->redirect($post->url);			
		} else {
			throw new \Exception('Erro ao salvar o view.');
		}
		
	}

	public function loadMoreSmall()
	{
		$this->viewBuilder()->layout('ajax');

		$notIn = [];
		if ($this->request->query('not_in')) {
			$notIn = explode(',', $this->request->query('not_in'));
		};
		
		$posts = $this->Posts->recents((int)$this->request->query('page'), 15, $notIn);

		$this->set(['posts' => $posts]);
	}
}