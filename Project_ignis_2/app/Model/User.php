<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * CakePHP User
 * @author Lotfi
 */
class User extends AppModel {
    public $name = 'User';
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Un nom d\'utilisateur est requis'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Un mot de passe est requis'
            )
        ),
        
        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Une adresse mail est requise'
            )
        ),
        
        'avatar_file'=>array(
                    'rule' => array('fileExtension', array('jpg','jpeg','png')),
                    'message' => 'Vous ne pouvez envoyer que des jpeg ou des png')
        
    );
    
    
    public $hasMany = array(
        'FavoriCoteUtilisateur' => array(
            'className' => 'Favori',
            'foreignKey' => 'user_id'
        ),
        'Favori' => array(
            'className' => 'Favori',
            'foreignKey' => 'favori_id'
        )
    );
    
    
    
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
             );
        }
        return true;
    }
    
    public function fileExtension($check, $extensions, $allowEmpty = true){
        
        $file = current($check);
        
        if($allowEmpty && empty($file['tmp_name'])){
            return true;
        }
        
    $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION)) ;
        return in_array($extension, $extensions);
    }
    
    
    public function beforeDelete($cascade = true) {
        $oldextension = $this->field('avatar');
                $oldfile = IMAGES . 'avatars' . DS . $this->id . '.' . $oldextension;
                if(file_exists($oldfile)){
                    unlink($oldfile);
                }
    }
    
    
   public function afterSave($created, $options = array()) {
        if(isset($this->data[$this->alias]['avatar_file'])){
            $file = $this->data[$this->alias]['avatar_file'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if(!empty($file['tmp_name'])){
                
                $oldextension = $this->field('avatar');
                $oldfile = IMAGES . 'avatars' . DS . $this->id . '.' . $oldextension;
                if(file_exists($oldfile)){
                    unlink($oldfile);
                }
                
                move_uploaded_file($file['tmp_name'], IMAGES . 'avatars' . DS . $this->id . '.' . $extension);
                $this->saveField('avatar', $extension);
            }
        }
    }
    
    
}

