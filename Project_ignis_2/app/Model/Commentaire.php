<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Citation $Citation
 * @property Conversation $Conversation
 * @property Image $Image
 * @property Texte $Texte
 * @property Video $Video
 * @property User $User
 */
class Commentaire extends AppModel {

            public $belongsTo= array('Post', 'User');
        
        public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
    
        
}
