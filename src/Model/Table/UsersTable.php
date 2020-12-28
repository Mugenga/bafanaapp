<?php

// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

    public function initialize(array $config) {
        $this->table('cp_users');
        $this->addBehavior('Timestamp');
        $this->hasMany('UserLevels', array(
            'foreignKey' => 'access_denotor',
        ));
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('username', 'A username is required')
                        ->notEmpty('password', 'A password is required');
    }

}
