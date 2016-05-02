<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author Lotfi
 */
class UsersController extends AppController {

    public function index($id) {
        
    }
    
    
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }
    
    public function view($id = null){
        if(!$this->User->exists($id)){
            throw new NotFoundException(_('User invalide'));
        }
        $this->set('user',$this->User->findById($id));
    }
    
    public function add(){
        $this->set('cacherbar',1);
        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->Flash->success(_('User enregistrer !'));
                return $this->redirect(array('action' => 'login'));
            }
            else{
                $this->Flash->error(_('Un problème est survenue, le user n\'a pas été sauvegarder. Veuillez réssayer.'));
                
            }
        }
    }
    

    public function edit(){
        $user_id = $this->Auth->user('id');
        
        if(!$user_id){
            $this->redirect('/');
            die();
        }
        $this->User->id = $user_id;
        if($this->request->is('put')){
            $d = $this->request->data;
            $d['User']['id'] = $user_id;
            if($this->User->save($d,true,array('username','password','email','avatar_file'))){ // on renseigne les champs que l'utilisateur a le droit de modifier
                $this->Flash->success(_("Votre profil a bien été édité"));
            } else{
                $this->Flash->error(_("Impossible de modifier le profil"));
            }
        }
        $this->request->data = $this->User->read();
        unset($this->request->data['User']['password']);
        $this->set($user_id,'user_id');
    }
    

    public function delete($id) {
        // Avant 2.5, utilisez
        // $this->request->onlyAllow('post');


        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User supprimé'));
            return $this->redirect(array('/'));
        } 
        $this->Flash->error(__('L\'user n\'a pas été supprimé'));
        return $this->redirect(array('action' => 'edit'));
        
    }

     
    public function login() {
        $this->set('cacherbar',1);
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__("Nom d'user ou mot de passe invalide, réessayer"));
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    
    
}
            
            
            
            
            
            
            
            
            

