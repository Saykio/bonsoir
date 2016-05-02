<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP FavorisController
 * @author Lotfi
 */
class FavorisController extends AppController {
var $uses = array('User', 'Favori');
 
    
    public function voirfavoris() {
        $id= $this->Auth->user('id');
        $f = $this->Favori->find('all',array(
            'recursive' => -1,
            'conditions' => array(                
                'Favori.user_id'=>$id                   
            ),
            'contain'=>array(
                    'Utilisateurmisenfavoris'=>array(
                        'fields'=>array(
                            'username'
                        )
                    ),
            )
        ));
      
        $this->set('favoris',$f);
        
    }

    
    public function ajouterfavoris($id){
       $this->autoRender=false;
       $this->request->data['Favori']['user_id'] = $this->Auth->user('id');
       $this->request->data['Favori']['favori_id'] = $id;
       $this->Favori->save($this->request->data);
       $this->redirect($this->referer());
    }
    
    public function supprimerfavoris($id){
        $this->autoRender=false;
        $this->Favori->delete($id);
        $this->redirect($this->referer());
        }
        
        
        
    
}
