<?php

namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Artists');
        $this->loadModel('Transactions');
        $this->loadModel('Accounts');
    }

    public function index() {
 
        $users = $this->Artists->GetAllArtists();
        $this->set('users', count($users));

        $review = $this->Artists->GetUsersForReview();
        $this->set('review', count($review));

        $contributions = $this->Transactions->GetPaymentTransactionsSum();
        $this->set('contributions', $contributions[0]->count);

        $unsettled = $this->Accounts->GeAccountsBalance();
        $this->set('unsettled', $unsettled[0]->count);

        $settlements = $this->Transactions->GetRequestTransactionsSum();
        $this->set('settlements', $settlements[0]->count);


        $income = $this->Transactions->GetIncome();
        $this->set('income', $contributions[0]->count - $income[0]->count);
        //District Co-ordinates
        // $distcords = $this->Districts->find('all');
        // $this->set('distcords', $distcords);

        //Number of Groups
        // $num_of_groups = $this->Groups->find('all')->where($condition);
        // $allgroups = $num_of_groups->count();
        // $this->set('allgroups', $allgroups);

        //Number of Members


        //Get Top 5 Saving Groups
        //Gender Composition:
        // $top5 = $this->Wallets->find('list', [
        //     'contain' => ['Groups'],
        //     'keyField' => 'grouping',
        //     'valueField' => 'numbers',
        //     'fields' => [
        //         'grouping' => 'Groups.group_name',
        //         'numbers' => 'Wallets.wallet_account_balance'
        //     ],
        //     'conditions' => [
        //         $condition,
        //         'wallet_type' => 'share'
        //     ],
        //     'order' => ['wallet_account_balance' => 'DESC' ],
        //     'limit' => 5,
        //     'group' => ['grouping']
        // ])->toArray();

        // $top5ids = json_encode(array_keys($top5));
        // $top5numbers = json_encode(array_values($top5));
        // $this->set('top5ids', $top5ids);
        // $this->set('top5numbers', $top5numbers);

    }

    public function numbers(){
        $artists = $this->Artists->GetArtistsBalance();
        echo "-------------------------------------------------------------";
        echo "<br>  Sanitize Start <br> ";
        foreach ($artists as $artist) {
            if ($artist->phone_number == "250780348088") {
                if($this->Artists->UpdatePhoneNumber($artist->id, null)== 1){
                    echo "Success";
                }else{
                    echo $artist->id;
                }
            }elseif(strlen($artist->phone_number) == 10){
                if($this->Artists->UpdatePhoneNumber($artist->id, "25".$artist->phone_number)== 1){
                    echo "Success";
                }else{
                    echo $artist->id;
                }
            }elseif(strlen($artist->phone_number && $artist->phone_numberr != null) <= 7){
                if($this->Artists->UpdatePhoneNumber($artist->id, null)== 1){
                    echo "Success";
                }else{
                    echo $artist->id;
                }
            }
        }
        echo "<br>  Sanitize End <br> ";
        echo "-------------------------------------------------------------";

        die();
    }

    public function emails(){
        $artists = $this->Artists->GetArtistsBalance();
        echo "-------------------------------------------------------------";
        echo "<br>  Sanitize Start <br> ";
        foreach ($artists as $artist) {

            if($this->validateEmail($artist->email) != TRUE){
                echo $artist->email;
                echo "<br>";
            }
        }
        echo "<br>  Sanitize End <br> ";
        echo "-------------------------------------------------------------";

        die();
    }

    public static function validateEmail($email)
{
    // SET INITIAL RETURN VARIABLES

        $emailIsValid = FALSE;

    // MAKE SURE AN EMPTY STRING WASN'T PASSED

        if (!empty($email))
        {
            // GET EMAIL PARTS

                $domain = ltrim(stristr($email, '@'), '@') . '.';
                $user   = stristr($email, '@', TRUE);

            // VALIDATE EMAIL ADDRESS

                if
                (
                    !empty($user) &&
                    !empty($domain) &&
                    checkdnsrr($domain)
                )
                {$emailIsValid = TRUE;}
        }

    // RETURN RESULT

        return $emailIsValid;
}

    public function isAuthorized($user) {
        if (isset($user['access_level'])) {
            if ($user['access_level'] == '3') {
                return $this->redirect(array('controller' => 'dashboard', 'action' => 'partner', $user['user_id']));
            }
            return true;
        }
        return parent::isAuthorized($user);
    }

}
