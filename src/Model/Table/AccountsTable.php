<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AccountsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('accounts');
        $this->belongsTo('Artists');
    }

    function GeAccountsBalance() {
        $contributions = $this->find('all');
        $contributions->select(['count' => $contributions->func()->sum('account_balance')]);
        return $contributions->toArray();
    }
    
    function UpdateAccount($data){
        $account = $this->get($data['account_number']);
        $account->linked_msisdn = $data['linked_msisdn'];
        if ($this->save($account)) {
            return 1;
        } else {
            return 0;
        }
    }

    function UpdateMemberAccounts($data) {
        $accounts = $this->find('all', array('conditions' => array('group_id' => $data['group_id'], 'member_id' => $data['member_id'])))->toArray();
        $x=0;
        foreach ($accounts as $key => $value) {
            $data['account_number']=$value['account_number'];
            $auflags[$x] = $this->UpdateAccount($data);
            $x++;
        }
        return $auflags;
    }

    function SaveAccounts($group_id, $data, $pdtflags) {
        foreach ($pdtflags as $key => $value) {
            if ($key == 'spflag') {
                $account = 'share';
            }
            if ($key == 'dpflag') {
                $account = 'deposit';
            }
            if ($key == 'lpflag') {
                $account = 'loan';
            }
            if ($key == 'sfpflag') {
                $account = 'socialfund';
            }
            $postData = array(
                'account_type' => $account, 'group_id' => $group_id, 'member_id' => $data['member_id'],
                'linked_msisdn' => $data['linked_msisdn'], 'account_status' => 'active', 'product_id' => $value,
                'date_created' => date('Y-m-d G:i:s')
            );

            $accountnos[$key] = $this->SaveAccount($postData);
        }
        return $accountnos;
    }

    function GetMemberAccounts($member_id, $group_id) 
    {
        return  $this->find('all', array(
            'conditions' => array('member_id' => $member_id, 'group_id =' => $group_id)
        ))->toArray();
    }

}
