<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Favori
 * @author Lotfi
 */
class Favori extends AppModel {
    public $actsAs = array('Containable');
    
    
     public $belongsTo = array(
        'Utilisateurmettantenfavoris' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Utilisateurmisenfavoris' => array(
            'className' => 'User',
            'foreignKey' => 'favori_id'
        )
    );
    
    
}
