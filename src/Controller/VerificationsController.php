<?php

namespace App\Controller;

use App\Controller\AppController;

class VerificationsController  extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Artists');
        $this->loadModel('Finesbook');
        $this->loadModel('Socialfundbook');
    }

    public function index() {
        $artists = $this->Artists->GetUsersForReview();
        $this->set('artists', $artists);
    }

    public function review($id) {
        $artist = $this->Artists->GetUserProfile($id);
        $this->set('artist', $artist);
    }

    public function comfirm($id) {
        $verifying = $this->Artists->Verify($id);
        if($verifying == 1){
            $this->sendMail($id);
        }else{
            echo "error while Verifying";die();
        }
        return $this->redirect([
            'controller' => 'Verifications',
            'action' => 'index'
        ]);
    }

    public function sendMail($id){
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();

        $url = LOCAL_API_URL."/mails/sendmail/".$id;

        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);

        // This option will return data as a string instead of direct output
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);

        curl_close($curl_handle);
    }

    public function isAuthorized($user) {
        return true;
    }

}
