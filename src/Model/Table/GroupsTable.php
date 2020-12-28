<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class GroupsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('mvd_groups');
        $this->hasMany('Membersettings');
        $this->hasMany('Groupadmins');
        $this->hasMany('Products');
        $this->hasMany('Savings');
        $this->hasMany('Loans');
        $this->hasMany('Loanbooks');
        $this->hasMany('Wallets');
        $this->hasMany('Transactions');
        $this->hasMany('Members');
        //$this->hasOne('Geodata');
        $this->belongsTo('Geodata', array(
            'foreignKey' => 'village_id',
        ));
        $this->belongsTo('Organizations', array(
            'foreignKey' => 'org_id',
        ));
        /*
         * Product Related
         */
        $this->hasMany('Savingsproducts');
        $this->hasMany('Loanproducts');
        $this->hasMany('Socialfundproducts');

        $this->hasMany('Socialassistreasons');
        $this->hasMany('Finereasons');
        $this->hasMany('Accounts');
        /*
         * Books & Transactions Related
         */
        $this->hasMany('Savingsbook');
        $this->hasMany('Fines');
        $this->hasMany('Socialfundrequests');
        $this->hasMany('Loanbooks');
        $this->hasMany('Fines');
    }

    function GetGroups($location = false, $org_id = "") {
        if($org_id != "") $condition = "org_id = ".$org_id;
        else $condition = "";
        
        if ($location == 0) {
            return $this->find('all', array(
                        'contain' => array('Geodata')
            ))->where($condition);
        }
        $groups = $this->find('all', array(
            'contain' => array('Geodata'),
            'conditions' => array(
                $condition,
                'Geodata.district_id' => $location
            )
        ));
        return $groups;
    }

    function NewGroup($data) {
        $group_code = $this->GetGroupCode();
        $data['group_code'] = $group_code;
        $group = $this->newEntity($data);
        if ($this->save($group)) {
            return $group->group_id;
        } else {
            return 0;
        }
    }

    function CompleteGroupCreation($group_id, $data) {
        //$memberslist = $this->Membersettings->ImportMembersExcel($data['filename']);

        //Create Products:
        $pdtflags = $this->CreateProducts($group_id, $data);

        if ($pdtflags['responsecode'] != 999) {
            //Products Were Created Successfully. Create their Wallets
            $wallets = $this->Wallets->CreateWallets($group_id, $pdtflags['products']);
            //Import Members
            //$members = $this->Membersettings->CreateMemberRecords($group_id, $memberslist, $pdtflags['products']);
        }

        //Create Fines & Social Fund Reasons
        $fines = $this->Finereasons->CreateFinesReasons($group_id, $data);
        $socialfund = $this->Socialassistreasons->CreateSocialAssistanceReasons($group_id, $data);

        $response = array('pdtresp' => $pdtflags, 'walresp' => $wallets,
            'finesresp' => $fines, 'sfresp' => $socialfund);

        return $response;
    }

    /*
     * Support Functions
     */

    function GetGroupCode() {
        $prefix = $this->find('all', array(
                    'fields' => array('group_code' => 'MAX(group_code)')
                ))->toArray();

        if (empty($prefix[0]['group_code'])) {
            $group_code = 1000;
            return $group_code;
        } else {
            $group_code = $prefix[0]['group_code'] + 1;
            return $group_code;
        }
    }

    function GetOrgCode($org_id) {
        $org = $this->Org->find('all', array(
                    'conditions' => array('org_id' => $org_id)
                ))->toArray();
        if (!empty($org)) {
            $group_code_pref = $org[0]['org_code'];
        } else {
            $group_code_pref = 10;
        }

        return $group_code_pref;
    }

    function UploadMembersFile($data) {
        if (!empty($data['membersfile']['name'])) {
            $file = $data['membersfile']; //put the data into a var for easy use

            $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('xlsx', 'csv', 'xlt', 'xls'); //set allowed extensions
            $newfilename = time() . "_" . rand(000000, 999999);

            //only process if the extension is valid
            if (in_array($ext, $arr_ext)) {
                $memfilefolder = WWW_ROOT . 'Uploads/MemberLists/';
                $filedest = $memfilefolder . $newfilename . '.' . $ext;
                move_uploaded_file($file['tmp_name'], $filedest);

                return $newfilename . '.' . $ext;
            }
        }
    }

    function CreateProducts($group_id, $data) {
        $flags = array();
        //Share:
        $products['spflag'] = $this->Savingsproducts->CreateShareProduct($group_id, $data);

        //Deposit
        $products['dpflag'] = $this->Savingsproducts->CreateDepositProduct($group_id, $data);

        //Loan
        $products['lpflag'] = $this->Loanproducts->CreateProduct($group_id, $data);

        //Social Fund
        $products['sfpflag'] = $this->Socialfundproducts->CreateProduct($group_id, $data);

        if (!empty($products)) {
            //Products Were Created.
            if (count($products) == 4) {
                //All Products Were Created
                $flags['responsecode'] = 100;
                $flags['responsemsg'] = 'All ' . count($products) . ' Products Were Created';
            } else {
                $flags['responsecode'] = 101;
                $flags['responsemsg'] = 'Only ' . count($products) . ' Products Were Created';
            }
            $flags['products'] = $products;
        } else {
            $flags['responsecode'] = 999;
            $flags['responsemsg'] = 'Product Creation Failed';
        }

        return $flags;
    }

    function GroupProducts($group_id) {
        $pdts = array();
        $pdts['savingspdts'] = $this->Savingsproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        $pdts['loanspdts'] = $this->Loanproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        $pdts['sfpdts'] = $this->Socialfundproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        return $pdts;
    }

    function GroupRules($group_id) {
        $rules = array();
        $rules['fines'] = $this->Finereasons->GetFineReasons($group_id);
        $rules['socialfund'] = $this->Socialassistreasons->GetAssistanceReasons($group_id);
        $rules['admins'] = $this->Groupadmins->GetGroupAdmins($group_id);
        return $rules;
    }

    function MemberAccounts($group_id) {
        $accounts = array();
        $accounts['savings'] = $this->Accounts->find('all', array(
                    'conditions' => array('account_type' => 'share', 'Accounts.group_id' => $group_id),
                    'contain' => array('Members')
                ))->toArray();

        $accounts['loans'] = $this->Accounts->find('all', array(
                    'conditions' => array('account_type' => 'loan', 'Accounts.group_id' => $group_id),
                    'contain' => array('Members')
                ))->toArray();
        
        $accounts['socialfund'] = $this->Accounts->find('all', array(
                    'conditions' => array('account_type' => 'Socialfund', 'Accounts.group_id' => $group_id),
                    'contain' => array('Members')
                ))->toArray();

        $accounts['deposit'] = $this->Accounts->find('all', array(
            'conditions' => array('account_type' => 'deposit', 'Accounts.group_id' => $group_id),
            'contain' => array('Members')
        ))->toArray();

        return $accounts;
    }

    function TransactionHistory($id) {
        return $this->Transactions->find('all', array('conditions' => array('group_id' => $id)))->toArray();
    }

    function GetGroupProducts($group_id) {
        $x = 0;
        $pdts[$x] = array();
        $savingspdts = $this->Savingsproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        $loanspdts = $this->Loanproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        $sfpdts = $this->Socialfundproducts->find('all', array('conditions' => array(
                        'group_id' => $group_id, 'product_status' => 'Active')))->toArray();

        foreach ($savingspdts as $key => $value) {
            $pdts[$x]['product_id'] = $value['product_id'];
            $pdts[$x]['pdt_type'] = strtolower($value['product_type']);
            $x++;
        }

        foreach ($loanspdts as $key => $value) {
            $pdts[$x]['product_id'] = $value['product_id'];
            $pdts[$x]["pdt_type"] = 'loan';
            $x++;
        }

        foreach ($sfpdts as $key => $value) {
            $pdts[$x]['product_id'] = $value['product_id'];
            $pdts[$x]["pdt_type"] = 'socialfund';
            $x++;
        }

        return $pdts;
    }

    function GroupDashboardStats($group_id) 
    {
        $wallets = $this->Wallets->GetGroupWallets($group_id);
        $wallet = [];
        foreach($wallets as $key=>$value){
            $wallet[$value['wallet_type']]=$value['wallet_account_balance'];
        }
        
        return $wallet;
    }

    
    function GetGroupWalletsByOrg($condition, $wallet_type) 
    {
        $wallets = $this->Wallets->GetGroupWalletsByOrg($condition, $wallet_type);
        return $wallets;
    }

    function GetTop5SavingGroupsByOrg($condition) 
    {
        $wallets = $this->Wallets->GetTopWalletsByOrg($condition, 'Saving');
        return $wallets;
    }

}
