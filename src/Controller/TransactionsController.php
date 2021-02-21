<?php

namespace App\Controller;

use App\Controller\AppController;

class TransactionsController  extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Fines');
        $this->loadModel('Finesbook');
        $this->loadModel('Socialfundbook');
    }

    public function index() {
        $trans = $this->Transactions->GetTransactions();
        $this->set('trans', $trans);
    }

    public function settlements() {
        $trans = $this->Transactions->GetRequestTransactions();
        $this->set('trans', $trans);
    }

    function getAllGroups() {
        $groups = $this->Groups->find('all', array(
            'contain' => array('Geodata')
        ));
        return $groups;
    }

    function getOrganizationGroups($id) {
        $groups = $this->Groups->find('all', array(
            'contain' => array('Geodata'),
            'conditions' => array('Groups.org_id' => $id)
        ));
        return $groups;
    }

    function getGroupsbyCreator($id) {
        $groups = $this->Groups->find('all', array(
            'contain' => array('Geodata'),
            'conditions' => array('createdby' => $id)
        ));
        return $groups;
    }

    public function creategroup() {
        $provinces = $this->Groups->Geodata->find('all', [
            'fields' => array('province_id' => 'DISTINCT(province_id)', 'province_name'),
        ]);
        $this->set('provinces', $provinces);
        $organizations = $this->Groups->Organizations->find('all');
        $this->set('organizations', $organizations);
        if ($this->request->is('post')) {
            //Create A Group & Return A Group Code:
            //$this->request->data['filename'] = $this->Groups->UploadMembersFile($this->request->data);
            $group_id = $this->Groups->NewGroup($this->request->data);
            if ($group_id != 0) {
                $response = $this->Groups->CompleteGroupCreation($group_id, $this->request->data);
                $respmsg = $this->PrepareGPResponseMsg($response);
                $this->Flash->{$respmsg['flag']}(__($respmsg['message']), ['escape' => false]);
                return $this->redirect(['action' => 'dashboard', $group_id]);
            }
            $this->Flash->error(__('Unable to create new group.'));
        }
    }

    function PrepareGPResponseMsg($response) {

        $pdtresp = $response['pdtresp']['responsecode'];
        $walresp = $response['walresp']['responsecode'];
        $finesresp = $response['walresp']['responsecode'];
        $sfresp = $response['walresp']['responsecode'];
        if ($pdtresp == 100 && $walresp == 100 && $finesresp == 100 && $sfresp == 100) {
            $respmsg['flag'] = 'success';
        } else {
            $respmsg['flag'] = 'warning';
        }

        $message = '<ul><li>' . $response['pdtresp']['responsemsg'] . '</li><li>' .
                $response['walresp']['responsemsg'] . '</li><li>' .
                $response['finesresp']['responsemsg'] . '</li><li>' .
                $response['sfresp']['responsemsg'] . '</li></ul>';
        $respmsg['message'] = $message;

        return $respmsg;
    }

    public function editgroup($id = false) {
        $provinces = $this->Groups->Geodata->find('all', [
            'fields' => array('province_id' => 'DISTINCT(province_id)', 'province_name'),
        ]);
        $this->set('provinces', $provinces);

        $group = $this->Groups->get($id, array(
            'contain' => array('Geodata')
        ));
        $village = $this->Groups->Geodata->find('all', ['conditions' => array('village_id' => $group->village_id)])->toArray();
        if (empty($village)) {
            $provinces = $this->Groups->Geodata->find('all', [
                'fields' => array('province_id' => 'DISTINCT(province_id)', 'province_name'),
            ]);
            $this->set('provinces', $provinces);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('Your Group Informationhas been updated.'), array('key' => 'response'));
                return $this->redirect(array(
                            'controller' => 'groups',
                            'action' => 'dashboard',
                            $id)
                );
            }
            $this->Flash->error(__('Unable to update Group Info.'));
        }
        $this->set('group', $group);
    }

    public function dashboard($id = false) {

        // Get Group 
        $group = $this->Groups->get($id, array(
            'contain' => array('Geodata')
        ));

        // Check if group belongs to organisation then redirect if not
        if($group->org_id != $this->org_id && $this->org_id != ''){
            $this->redirect(array('controller' => 'Dashboard', 'action' => 'Index'));
        }
        $this->set('group', $group);

        //Get Members. Savings, Loans, Social, & Settings
        $members = $this->Groups->Membersettings->find('all', array(
            'conditions' => array('Membersettings.group_id' => $id, 'Membersettings.status !=' => 'Closed'),
            'contain' => array('Members')
        ));
        $allmembers = $members->count();
        $this->set('allmembers', $allmembers);
        $this->set('members', $members);
        $groupleaders = $this->Groups->Groupadmins->find('all', array(
            'conditions' => array('Groupadmins.group_id' => $id),
            'contain' => array('Membersettings')));
        $this->set('groupleaders', $groupleaders);

        //Get Savings Book.
        $savingsbook = $this->Groups->Savingsbook->GetSavingsBook($id);
        $this->set('savingsbook', $savingsbook);
        //Get Loan Book.
        //Get Loans
        //Get The Groups Products
        $grouppdts = $this->Groups->GroupProducts($id);
        $this->set('grouppdts', $grouppdts);

        //Get Group Rules (SF Reasons, Fines, & Admins
        $grouprules = $this->Groups->GroupRules($id);
        $this->set('grouprules', $grouprules);

        //Get Group Accounts (Loan, Savings, Accounts)
        $groupaccts = $this->Groups->MemberAccounts($id);
        $this->set('groupaccts', $groupaccts);

        //Get Transaction History
        $transactions = $this->Groups->TransactionHistory($id);
        $this->set('transactions', $transactions);

        //Fines
        $finetrans = $this->Groups->Fines->GetGroupFines($id);
        $this->set('finetrans', $finetrans);

        // GET paid vs unpaid
        $unpaid = $this->Fines->GetGroupFinesAmount($id);
        $this->set('unpaid', $unpaid);
        
        //Fines
        $sfrtrans = $this->Groups->Socialfundrequests->GetGroupSocialFundRequests($id);
        $this->set('sfrtrans', $sfrtrans);

        //Get Group Fines
        $finesamount = $this->Finesbook->GetGroupFinesAmount($group->group_id);
        $this->set('finesamount', $finesamount);
        
        //Total social fund
        $socialfund = $this->Socialfundbook->GetGroupTotalSocialfunds($group->group_id);
        $this->set('socialfund', $socialfund);
        //Top Stats
        $topstats = $this->Groups->GroupDashboardStats($id);
        $this->set('topstats', $topstats);
    }

    function getGroupInfo($group_id = false) {
        $options = array(
            'conditions' => array(
                'group_id' => $group_id
            )
        );
        $shareProduct = $this->Groups->Savings->find('all', $options)->toArray();
        $loanProduct = $this->Groups->Loans->find('all', $options)->toArray();

        //retreive the wallets
        $wallets = $this->Groups->Wallets->find('all', $options)->toArray();
        foreach ($wallets as $value) {
            if ($value['product_id'] == $shareProduct[0]['product_id']) {
                $shareBalance = $value['wallet_balance'];
            }
            if ($value['product_id'] == $loanProduct[0]['product_id']) {
                $loanBalance = $value['wallet_balance'];
            }
        }

        //retreive loan book
        $loanBooks = $this->Groups->Loanbooks->getGroupLoans($group_id);
        $TotalLoans = 0;
        $PaidLoans = 0;
        foreach ($loanBooks as $value) {
            if ($value['transaction_type'] == 'request') {
                $TotalLoans += $value['transaction_amount'];
            } else if ($value['transaction_type'] == 'payment') {
                $PaidLoans += $value['transaction_amount'];
            }
        }

        // retreive the transactions
        $transactions = $this->Groups->Transactions->getGroupTrasactions($group_id);

        $this->set('shareBalance', $shareBalance);
        $this->set('loanBalance', $loanBalance);
        $this->set('TotalLoans', $TotalLoans);
        $this->set('PaidLoans', $PaidLoans);
        $this->set('transactions', $transactions);
        $this->set('group_id', $group_id);
        // print_r($shareBalance);
        // die();
    }

    public function isAuthorized($user) {
        return true;
    }

}
