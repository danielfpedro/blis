<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Navbar cell
 */
class NavbarCell extends Cell
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
    public function display()
    {
        $categories = (object)[
            (object)[
                'name' => 'Jogos',
                'slug' => 'jogos'
            ],            
            (object)[
                'name' => 'Cinema',
                'slug' => 'cinema'
            ],
            (object)[
                'name' => 'TV',
                'slug' => 'tv'
            ],            
        ];
        
        $this->set(['categories' => $categories]);
    }
}
