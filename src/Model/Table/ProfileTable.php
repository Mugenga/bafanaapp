<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ProfileTable extends Table {

    public function initialize(array $config){
        parent::initialize($config);
        $this->table('user_profile');
        // $this->belongsTo('Members');
        $this->belongsTo('Artists', array(
            'foreignKey' => 'user_id',
        ));
    }
}