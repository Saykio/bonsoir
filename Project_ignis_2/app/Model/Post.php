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
class Post extends AppModel {
    
    public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'titre' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'avatar_file'=>array(
                    'rule' => array('fileExtension', array('jpg','jpeg','png')),
                    'message' => 'Vous ne pouvez envoyer que des jpeg ou des png')
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Citation' => array(
			'className' => 'Citation',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Texte' => array(
			'className' => 'Texte',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
        
        public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }
    
    
    public $hasMany='Commentaire';
    
    
    
    public function fileExtension($check, $extensions, $allowEmpty = FALSE){
        
        $file = current($check);
        
        if($allowEmpty && empty($file['tmp_name'])){
            return true;
        }
        
    $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION)) ;
        return in_array($extension, $extensions);
    }
    
    
    
    
        
}
