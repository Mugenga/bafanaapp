<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TransactionsTable extends Table {

    public function initialize(array $config){
        parent::initialize($config);
        $this->table('transaction_history');
        $this->belongsTo('User', array(
            'foreignKey' => 'user_id',
        ));
        // $this->belongsTo('Members');
        // $this->belongsTo('Savingsproducts', array(
        //     'foreignKey' => 'product_id',
        // ));
    }

    public function GetTransactions(){
        $trans = $this->find('all', array(
            'contain' => ['User'],
            'conditions' => array(
                'transaction_type' => 'payment',
                'payment_status' => 'posted'
            )
        ));
        return $trans;
    }
    public function GetRequestTransactions(){
        $trans = $this->find('all', array(
            'contain' => ['User'],
            'conditions' => array(
                'transaction_type' => 'request',
                'payment_status' => 'posted'
            )
        ));
        return $trans;
    }

    public function GetPaymentTransactionsSum(){
        $options = array(
            'conditions' => array(
                'transaction_type' => 'payment',
                'payment_status' => 'posted'
            )
        );
        $contributions = $this->find('all', $options);
        $contributions->select(['count' => $contributions->func()->sum('amount')]);
        return $contributions->toArray();
    }

    public function GetRequestTransactionsSum(){
        $options = array(
            'conditions' => array(
                'transaction_type' => 'request',
                'payment_status' => 'posted'
            )
        );
        $contributions = $this->find('all', $options);
        $contributions->select(['count' => $contributions->func()->sum('amount')]);
        return $contributions->toArray();
    }

    public function GetIncome(){
        $options = array(
            'conditions' => array(
                'transaction_type' => 'payment',
                'payment_status' => 'posted'
            )
        );
        $contributions = $this->find('all', $options);
        $contributions->select(['count' => $contributions->func()->sum('amount_due')]);
        return $contributions->toArray();
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