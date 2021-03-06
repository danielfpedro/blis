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
            'prefix' => false
        ];
    }
    protected function _getPostUrl()
    {
        if (!$this->_properties['pub_date']) {
            return [];
        }
        return [
            'controller' => 'Site',
            'action' => 'post',
            'year' => $this->_properties['pub_date']->format('Y'),
            'month' => $this->_properties['pub_date']->format('m'),
            'day' => $this->_properties['pub_date']->format('d'),
            'slug' => $this->_properties['slug'],
            'prefix' => false
        ];
    }
    /**
     * Main post
     */
    protected function _getMainPostImage()
    {
        return $this->_getImageFromPrefix('main_post');
    }
    protected function _getMainPostImageLr()
    {
        return $this->_getImageFromPrefix('main_post', true);
    }
    /**
     * Small Squared
     */
    protected function _getSmallPostImage()
    {
        return $this->_getImageFromPrefix('small_post');
    }
    protected function _getSmallPostImageLr()
    {
        return $this->_getImageFromPrefix('small_post', true);
    }
    /**
     * View Post image
     */
    protected function _getViewPostImage()
    {
        return $this->_getImageFromPrefix('view_post');
    }
    protected function _getImageFromPrefix($prefix, $lr = false) {
        if ($lr) {
            $prefix .= '_lr';
        }
        return '/img/images/' . $prefix . '_' . $this->_properties['photo'];
    }
}
