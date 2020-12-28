<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class DashboardTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany("Groups");
        $this->hasMany("Wallets");
        
    }
}