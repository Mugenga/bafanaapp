<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class AmahirweController  extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $this->viewBuilder()->layout('improv');
        if ($this->request->is('post')) {
            $this->Amahirwe->NewGroup($this->request->data);
        }
    }
    public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->allow();
    }
}