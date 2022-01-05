<?php

namespace App\Controller;

use App\Controller\AppController;

class ArtistsController  extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $artists = $this->Artists->GetArtistsBalance();
        $this->set('artists', $artists);
    }

    public function inactive() {
        $artists = $this->Artists->GetInactiveArtists();
        $this->set('artists', $artists);
    }
    
    public function isAuthorized($user) {
        return true;
    }

}
