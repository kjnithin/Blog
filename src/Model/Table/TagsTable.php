<?php
// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;

use Cake\Validation\Validator;

class TagsTable extends Table
{
    public function initialize(array $config)
    {
         
     
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', 'The name cannot be empty');

    }
}

/**
* 
*/


?>