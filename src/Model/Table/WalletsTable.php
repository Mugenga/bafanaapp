<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class WalletsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('mvd_product_wallets');
        $this->belongsTo('Groups', array(
            'foreignKey' => 'group_id',
        ));
    }

    function CreateWallets($grpid, $data) {
        foreach ($data as $key => $value) {
            if ($key == 'spflag') {
                $wallettype = 'share';
                $walletname = 'Share Save Wallet - ' . $grpid;
            } elseif ($key == 'dpflag') {
                $wallettype = 'deposit';
                $walletname = 'Deposit Savings Wallet - ' . $grpid;
            } elseif ($key == 'lpflag') {
                $wallettype = 'loan';
                $walletname = 'Loans Wallet - ' . $grpid;
            } else {
                $wallettype = 'socialfund';
                $walletname = 'Social Fund Wallet - ' . $grpid;
            }

            $wallets[$key] = $this->CreateWallet($grpid, $walletname, $wallettype, $value);
        }

        $flags = $this->PrepareBulkWalletCreationResponse($wallets);
        
        return $flags;
    }

    function CreateWallet($gpid, $walletname, $wallettype, $pdtid) {
        $data = array(
            'wallet_name' => $walletname,
            'wallet_type'=>$wallettype,
            'group_id' => $gpid,
            'product_id' => $pdtid,
            'wallet_balance' => 0
        );

        $wallet = $this->newEntity($data);
        if ($this->save($wallet)) {
            return $wallet->wallet_id;
        } else {
            return 0;
        }
    }

    function PrepareBulkWalletCreationResponse($wallets) {
        if (!empty($wallets)) {
            //Products Were Created.
            if (count($wallets) == 4) {
                //All Products Were Created
                $flags['responsecode'] = 100;
                $flags['responsemsg'] = 'All ' . count($wallets) . ' Product Wallets Were Created';
                $flags['wallets'] = $wallets;
            } else {
                $flags['responsecode'] = 101;
                $flags['responsemsg'] = 'Only ' . count($wallets) . ' Product Wallets Were Created';
                $flags['wallets'] = $wallets;
            }
        } else {
            $flags['responsecode'] = 999;
            $flags['responsemsg'] = 'Product Wallet Creation Failed';
        }
    }
    
    function GetGroupWallets($id){
        return $this->find('all', array('conditions'=>array('group_id'=>$id)))->toArray();
    }

    function GetGroupWalletsByOrg($condition, $wallet_type){
        $options = array(
            'conditions' => array(
                $condition,
                'wallet_type' => $wallet_type 
            ),
            'contain' => ['Groups']
        );
        $wallets = $this->find('all', $options);
        $wallets->select(['count' => $wallets->func()->sum('wallet_account_balance')]);
        return $wallets->first();
    }

    function GetTopWalletsByOrg($condition, $wallet_type){
        $options = array(
            'conditions' => array(
                $condition,
                'wallet_type' => $wallet_type 
            ),
            'contain' => ['Groups'],
            'order' => ['wallet_balance' => 'DESC' ],
            'limit' => 5
        );
        $wallets = $this->find('all', $options);
        return $wallets->toArray();
    }


}
