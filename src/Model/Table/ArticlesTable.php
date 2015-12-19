<?php
// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;


class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    
        $this->hasMany('Comments',[
            'className' => 'Comments',
            'foreignKey' => 'article_id',
            //            'conditions' => ['isApproved' => false],

            'dependent' => true]);

        $this->hasMany('ApprovedComments', [
             'className' => 'Comments',
            'conditions' => ['isApproved' => true],
                        'foreignKey' => 'article_id',

            'propertyName'=> 'approved_comments'

          ]);

        
        $this->belongsTo('Users', [
            'className' => 'users',
            'foreignKey' => 'user_id',
            'propertyName'=> 'author'
            
        ]);




        $this->belongsToMany('Tags', [
            //'foreignKey' => 'article_id',
            //'targetForeignKey' => 'tag_id',
            'joinTable' => 'article_tag_relation'
            //'propertyName' => 'tags'
        ]);
    }

    
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('title', 'The title cannot be empty')
            ->notEmpty('body', 'The password cannot be empty');

    }

}


?>