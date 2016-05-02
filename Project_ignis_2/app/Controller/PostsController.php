<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PostsController
 * @author Lotfi
 */
class PostsController extends AppController {

    var $uses = array('Post','Commentaire','Favori');
    public $components = array('Paginator');
    
    public $paginate = array(
        'limit' => 5
    );
    
    public function index() {
        /*$posts = $this->Post->find('all');
        $this->paginate('Post');
        $this->set(compact('posts',$this->paginate()));*/
    
        
        $this->Paginator->settings = $this->paginate;
        $posts = $this->Paginator->paginate(
                'Post');
        $this->set(compact('posts'));
    }
    
    
    public function view($id = null) {
        $post = $this->Post->get($id);
        $this->set(compact('post'));
    }
    
    /**
     * 
     * @param type $id
     */
    public function voir($id){
        if(!empty($this->request->data)){
            $this->request->data['Commentaire']['user_id'] = $this->Auth->user('id');// on assigne ici le user_id afin d'enregistrer le commentaire
            $this->Commentaire->save($this->request->data);//sauvegarde du commentaire
        }
        $q = $this->Post->find('first',array(
            'recursive' => -1,
            'conditions' => array(                  //ici on rattache le user au commentaire afin que 
                'Post.id'=>$id                      //l'on puisse le retrouver directement.
            ),
            'contain'=>array(
                'Commentaire'=>array(
                    'User'=>array(
                        'fields'=>array(
                            'username'
                        )
                    )
                ),
                'User','Texte','Video','Citation','Conversation','Image',
            )
        ));
        $this->set('post',$q);
    }
    
    
    public function voirblog($id){
        
         $vb = $this->Post->find('all',array(
            'recursive' => -1,
            'conditions' => array(                  //ici on rattache le user au commentaire afin que 
                'user_id'=>$id                    //l'on puisse le retrouver directement.
            ),
            'contain'=>array(
                    'User'=>array(
                        'fields'=>array(
                            'username','id','avatar'
                        )
                    ),
                'User','Texte','Video','Citation','Conversation','Image',
            )
        ));
      
        $this->set('posts',$vb);
        $this->set('id_blog',$id);
        
        $de = $this->Favori->find('first', array('conditions'=>array(
            'favori_id'=>$id , 
            'user_id'=>$this->Auth->user('id')
                )
            ));
        if(empty($de)){$addfav = true;}
else{  
   $addfav = false;
}
$this->set('addfav',$addfav);       
        
    }
    
    
    
    public function add($type='texte') {
        
        if(!in_array($type, ['texte','video', 'image', 'citation', 'conversation' ])){ // on vérifie ici que le type reçu correspond à l'un des paramètres
            $this->Flash->error(_('Ce type de post n\'existe pas'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('type')); // on renvoie vers le type de post associé
        
        
        
        
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id'); // Valeur du user connecté lors de l'ajout
            $this->request->data['Post']['type'] = $type; // Valeur du type lors de l'ajout
            //debug($this->request->data);die();
            /* CONVERTIR LA VIDEO YOUTUBE EN EMBED SINON NE PASSE PAS
            if(empty(preg_match('/(youtube.com)|(youtu\.be)/'))){
                preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $post['Post']['url_video']);
            }*/
         //debug($this->request->data);die();
    unset($this->request->data['Post']['id']);// afin qu'un utilisateur malveillant ne puisse pas donner une valeur à la publication créer
    unset($this->request->data[ucfirst($post['Post']['type'])]['id']); // même chose afin que l'utilisateur ne puisse changer le type
            if ($this->Post->saveAssociated($this->request->data)) {
                
                $this->Flash->success(__('Votre publication a été sauvegardé.'));
                $this->redirect(array('action' => 'index'));
            }
            else{
                if($this->request->data['Image']['file']['error']!=0){
                    return false;
                }
            }
        }
    }
    
    
    
    public function edit($id) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    //$post = $this->Post->findById($id);
    $post = $this->Post->find('first',array(
            'conditions' => array(                  
                'Post.id'=>$id 
            ),
            'contain'=>array(
                'Texte','Video','Citation','Conversation','Image','User'
            )
        ));
    //debug($post);die();
    
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }
    //debug($post);die();
    if($post['User']['id']== $this->Auth->user('id')){ // AU CAS OU L'UTILISATEUR CHANGE D'ID ARTCLE DANS L'URL
    if ($this->request->is('post')||$this->request->is('put')) {
        $this->request->data['Post']['id'] = $id;
        $this->request->data[ucfirst($post['Post']['type'])]['id']  = $post[ucfirst($post['Post']['type'])]['id']; // ON PREND ICI L'ID DE LA PUBLIACATION AFIN QUE L'ON NE CREER PAS DE NEW ENREGISTREMENT DANS LA TABLE TEXTE.
        if ($this->Post->saveAssociated($this->request->data)) {
            $this->Flash->success(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Unable to update your post.'));
    }
    if (!$this->request->data) {
        $this->request->data = $post;
    }
    $this->set('post',$post);  
        }else{ // ON LE RENVOIE DANS CE CAS SI CE N'EST PAS LUI VERS L'INDEX
            return $this->redirect(array('action' => 'index'));
    }
}
    
     public function delete($id) {


        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('post introuvable'));
        }
        
            
       
        if ($this->Post->delete()) { 
            $this->Flash->success(__('Post supprimé'));
            return $this->redirect(array('action' => 'index'));
        }  
        $this->Flash->error(__('Le post n\'a pas été supprimé'));
        return $this->redirect(array('action' => 'index'));
        
    }
    
    
    
    public function isAuthorized($user) {
        // Tous les users inscrits peuvent ajouter les posts
        if ($this->action === 'add') {
            return true;
        }

        // Le propriétaire du post peut l'éditer et le supprimer
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int)$this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
    
    
}
