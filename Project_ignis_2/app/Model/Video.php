<?php
App::uses('AppModel', 'Model');
/**
 * Video Model
 *
 * @property Post $Post
 */
class Video extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'video_commentaire' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'champupload'=>array(
                    'rule' => array('fileExtension', array('mp4','ogg','webm')),
                    'message' => 'Vous ne pouvez envoyer que des formats mp4, ogg et webm'),
	

	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
        
    public function afterSave($created, $options = array()) {
        if(isset($this->data[$this->alias]['file'])){
            $file = $this->data[$this->alias]['file'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if(!empty($file['tmp_name'])){
                $post_id = $this->field('post_id');
                move_uploaded_file($file['tmp_name'], IMAGES . 'p_videos' . DS . $post_id . '.' . $extension);
                $this->saveField('champupload', $extension);
            }
        }
    }
        
        
        
        
        
        
}
