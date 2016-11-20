<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\Utility\Inflector;

use Cake\View\Helper\HtmlHelper;
/**
 * Post Entity
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $img
 * @property int $source_id
 * @property string $tags
 * @property int $category_id
 * @property string $url
 *
 * @property \App\Model\Entity\Source $source
 * @property \App\Model\Entity\Category $category
 */
class Post extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setTitle($title)
    {
        $this->set('slug', strtolower(Inflector::slug($title)));
        return $title;
    }
    protected function _getViewUrl()
    {
        if (!$this->_properties['pub_date']) {
            return [];
        }
        return [
            'controller' => 'Site',
            'action' => 'view',
            'year' => $this->_properties['pub_date']->format('Y'),
            'month' => $this->_properties['pub_date']->format('m'),
            'day' => $this->_properties['pub_date']->format('d'),
            'slug' => $this->_properties['slug'],
        ];
    }
    protected function _getImagePath()
    {
        return '/files/images/' . $this->_properties['photo'];
    }
    protected function _getSquaredImagePath()
    {
        return '/files/images/square_' . $this->_properties['photo'];
    }
}
