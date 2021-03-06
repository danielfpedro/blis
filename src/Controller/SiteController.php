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
		$this->Auth->allow();

		$this->viewBuilder()->layout('site');

		$this->loadModel('Posts');
	}
	public function home()
	{
		
	}
	public function loadMore($type = null)
	{
		if (!in_array($type, ['populars', 'recents'])) {
			throw new NotFoundException();
		}

		$this->viewBuilder()->layout('ajax');
		$this->viewBuilder()->template('load_more_' . $type);

		$notIn = [];
		if ($this->request->query('not_in')) {
			$notIn = explode(',', $this->request->query('not_in'));
		};

		$posts = $this->Posts->getPosts(
			$type,
			(int)$this->request->query('page'),
			$this->Posts->perPage['main'],
			$notIn,
			(int)$this->request->query('category')
		);

		$this->set([
			'posts' => $posts,
			'showCategoryName' => !($this->request->query('category'))
		]);
	}
	// public function loadMoreSmall()
	// {
	// 	$this->viewBuilder()->layout('ajax');

	// 	$notIn = [];
	// 	if ($this->request->query('not_in')) {
	// 		$notIn = explode(',', $this->request->query('not_in'));
	// 	};
		
	// 	$posts = $this->Posts->recents(
	// 		(int)$this->request->query('page'),
	// 		$this->Posts->perPage['small'],
	// 		$notIn,
	// 		(int)$this->request->query('category')
	// 	);

	// 	$this->set(['posts' => $posts]);
	// }
	public function category()
	{
		$this->loadModel('Categories');

		$category = $this->Categories->getBySlug($this->request);

		if (!$category) {
			throw new NotFoundException();
			
		}
		$this->set(compact('category'));
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
}