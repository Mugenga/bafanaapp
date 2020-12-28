<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TransactionsTable extends Table {

    public function initialize(array $config){
        parent::initialize($config);
        $this->table('transaction_history');
        // $this->belongsTo('Members');
        // $this->belongsTo('Savingsproducts', array(
        //     'foreignKey' => 'product_id',
        // ));
    }

    public function GetTransactions(){
        $trans = $this->find('all', array(
            'conditions' => array(
                'payment_status' => 'posted'
            )
        ));
        return $trans;
    }

    function GetMemberGroupTransactions($member_id, $group_id)
    {
        return $this->find('all', array('conditions' => array('member_id' => $member_id, 'group_id' => $group_id)))->toArray();
    }

    function GetMemberGroupTermSavings($member_id, $group_id)
    {
        return $this->find('all', array(
            'contain' => ['Savingsproducts'],
            'conditions' => array(
                'member_id' => $member_id, 
                'Transactions.group_id' => $group_id,
                'transaction_type' => "payment",
                'Savingsproducts.product_type' => "Deposit"
                )
            ))->toArray();
    }
}