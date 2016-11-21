<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * MainPosts cell
 */
class MainPostsCell extends Cell
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

        $posts = $this->Posts->populars(
            1,
            $this->Posts->perPage['main'],
            $notIn,
            (int)$categoryId
        );

        $showCategoryName = !((int)$categoryId);

        $this->set(compact('posts', 'showCategoryName'));
    }
}
