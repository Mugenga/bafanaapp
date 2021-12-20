<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArtistsTable extends Table {

    public function initialize(array $config){
        parent::initialize($config);
        $this->table('user');
        $this->hasMany("Profile");
        $this->hasMany("Transaction");
        $this->hasMany("Accounts");
    }

    public function GetAllArtists(){
        return $this->find('all')->toArray();
    }

    public function GetUserProfile($id){
        $user = $this->find('all', array(
            'contain' => ['Profile'],
            'conditions' => array(
                'id' => $id,
            )
        ));
        return $user->first();
    }
    public function GetArtistsBalance(){
        $user = $this->find('all', array(
            'contain' => ['Accounts', 'Profile']
        ));
        return $user->toArray();
    }

    public function GetUsersForReview(){
        $users = $this->find('all', array(
            'conditions' => array(
                'status' => 'review'
            )
        ));
        return $users->toArray();
    }

      
    function Verify($id){
        $artist = $this->get($id);
        $artist->status = 'active';
        if ($this->save($artist)) {
            return 1;
        } else {
            return 0;
        }
    }

    function UpdatePhoneNumber($id, $new_value){
        $artist = $this->get($id);
        $artist->phone_number = $new_value;
        if ($this->save($artist)) {
            return 1;
        } else {
            return 0;
        }
    }

    function GetSignUpStats(){
        return $this->find('all', array(
            'fields' => [
                'x' => 'COUNT(id)',
                'y' => 'DATE(created_at)'
            ],
            'conditions' => array(
                'status' => 'active',
                'created_at >=' => '2021-06-01'
            ),
            'group' => 'y'
        ));
    }

    function GetUsersByCountry() {
        $options = array(
            'fields' => [
                'country' => 'country',
                'count' => 'COUNT(id)'
            ],
            'group' => 'country',
            'order' => ['country' => 'DESC' ],
        );
        return $this->find('all', $options);
    }
}