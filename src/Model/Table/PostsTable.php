<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Filesystem\Folder;

use Cake\Event\Event;
use Cake\Datasource\EntityInterface;

use WideImage\WideImage;

/**
 * Posts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sources
 * @property \Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostsTable extends Table
{
    public $imageQuality = '100';

    public $images = [
        'main_post' => [
            'w' => 400,
            'h' => 250,
        ],
        'small_post' => [
            'w' => 120,
            'h' => 120,
        ],
        'view_post' => [
            'w' => 600,
            'h' => 350,
        ],
    ];
    public $perPage = [
        'main' => 15,
        'small' => 15,
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sources', [
            'foreignKey' => 'source_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
    }

    public function getBySlug($request)
    {
        $posts = $this->find('all', [
            'fields' => ['Posts.id', 'Posts.pub_date'],
            'conditions' => [
                'slug' => $request->param('slug')
            ]            
        ]);

        if ($posts) {
            $slugDate = new \Datetime($request->param('year') . '-' . $request->param('month') . '-' . $request->param('day'));

            foreach ($posts as $key => $value) {
                if ($value->pub_date && $value->pub_date->format('Y-m-d') == $slugDate->format('Y-m-d')) {

                    return $this->find('all', [
                        'conditions' => [
                            'Posts.id' => (int)$value->id
                        ]
                    ])
                    ->first();
                }
            }
        }

        return null; 
    }

    public function getPosts($type, $page = 1, $total, $notIn = [], $categoryId = null)
    {
        return $this->$type($page, $total, $notIn = [], $categoryId = null);
    }
    public function populars($page = 1, $total, $notIn = [], $categoryId = null)
    {
        $conditions = [];

        if ($notIn) {
            $conditions['Posts.id NOT IN'] = $notIn;
        } 
        if ((int)$categoryId) {
            $conditions['Posts.category_id'] = $categoryId;
        }

        $pastDate = new \Datetime();
        $pastDate->sub(new \DateInterval('P7D'));

        $conditions['Posts.view_timestamp >='] = $pastDate;

        return $this
            ->find('all', [
                'fields' => [
                    'Posts.id',
                    'Posts.title',
                    'Posts.subtitle',
                    'Posts.slug',
                    'Posts.pub_date',
                    'Posts.photo',
                ],
                'contain' => [
                    'Categories' => function($q){
                        return $q->select(['id', 'name', 'slug']);
                    }
                ],
                'conditions' => $conditions,
                'order' => ['Posts.views DESC'],
                'offset' => $total * ($page - 1),
                'limit' => $total
            ]);
    }
    public function recents($page = 1, $total, $notIn = [], $categoryId = null)
    {
        $conditions = [];

        if ($notIn) {
            $conditions['Posts.id NOT IN'] = $notIn;
        }
        if ((int)$categoryId) {
            $conditions['Posts.category_id'] = $categoryId;
        }

        return $this
            ->find('all', [
                'fields' => [
                    'Posts.id',
                    'Posts.title',
                    'Posts.photo',
                    'Posts.slug',
                    'Posts.pub_date',
                ],
                'contain' => [
                    'Categories' => function($q){
                        return $q->select(['id', 'name', 'slug']);
                    }
                ],
                'conditions' => $conditions,
                'order' => ['Posts.pub_date' => 'DESC'],
                'offset' => $total * ($page - 1),
                'limit' => $total
            ]);
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $dir = new Folder(WWW_ROOT . 'img' . DS . 'images', true, 0755);
        $image = WideImage::load($entity->img);

        $ext = pathinfo($entity->img, PATHINFO_EXTENSION);
        $imageName = md5((new \Datetime())->format('Y-m-d H:i:s') . $entity->img) . '.jpg';

        /**
         * Original
         */
        $image
            ->saveToFile($dir->path . DS . 'original_' . $imageName, $this->imageQuality);

        foreach ($this->images as $key => $value) {
            $image
                ->resize($value['w'], $value['h'], 'outside')
                ->crop('center', 'top', $value['w'], $value['h'])
                ->saveToFile($dir->path . DS . $key . '_' . $imageName, $this->imageQuality);
        }

        $entity->photo = $imageName;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('subtitle');

        $validator
            ->notEmpty('img');

        $validator
            ->allowEmpty('tags');

        $validator
            ->allowEmpty('url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['source_id'], 'Sources'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
