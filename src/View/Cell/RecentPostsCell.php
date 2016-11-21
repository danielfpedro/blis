<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * RecentPosts cell
 */
class RecentPostsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($notIn = [], $categoryId = null)
    {
        $this->loadModel('Posts');

        $posts = $this->Posts->recents(
            1,
            $this->Posts->perPage['small'],
            $notIn,
            $categoryId
        );

        $this->set(compact('posts'));
    }
}
