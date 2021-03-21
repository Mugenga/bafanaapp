<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AmahirweTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('amahirwe');
    }


    function NewGroup($data) {
        $group = $this->newEntity($data);
        if ($this->save($group)) {
            return $group->group_id;
        } else {
            return 0;
        }
    }
}
