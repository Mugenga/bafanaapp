<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

    public function index() {
        $this->set('users', $this->Users->find('all', array('contain' => array('UserLevels'))));
    }

    public function newuser() {
        $accesslevels = $this->Users->UserLevels->find('all');
        $this->set('accesslevels', $accesslevels);

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $hpass = (new DefaultPasswordHasher)->hash($this->request->data['password']);
            $this->request->data['password'] = $hpass;
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    public function newuserlvl() {
        
    }

    public function userlvl() {
        $this->set('userlvls', $this->Users->UserLevels->find('all'));
    }

    public function edituserlvl($id = false) {
        
    }

    public function login() {
        $this->viewBuilder()->layout('auth');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user) {
        /* $base = 'menuchoices/';
          if ($this->request->action == 'index') {
          $method = $base;
          } else {
          $method = $base . $this->request->action;
          } */
        if (isset($user['access_level'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }

}
