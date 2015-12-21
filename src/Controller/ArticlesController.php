<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;


class ArticlesController extends AppController
{


    public function index()
    {
         $this->set('articles', $this->Articles->find('all')->contain(['Comments', 'ApprovedComments' ,'Users', 'Tags']));
         
    }

    public function view($id = null)
    {

        $article = $this->Articles->get($id, ['contain' => ['Comments', 'ApprovedComments', 'Users', 'Tags']]);
        $this->set(compact('article'));

        
        if($this->request->is('post')){
            if($this->request->data()){



                 $comment = $this->loadModel('Comments')->newEntity($this->request->data());  
                 $comment['article_id'] = $id;
                 
                 if($this->loadModel('Comments')->save($comment)){


                    $this->Flash->success(__('the comment has been saved.'));
                     return $this->redirect(['action' => 'view', $id]);
                 }
                 else{
                    $this->Flash->error(__('the comment cannot be saved, please try again.'));
                 }
            }
        }
        
    }

    public function add()
    {

        $this->loadModel('Tags');
        $this->set('tags', $this->Tags->find('all'));  

         if($this->request->is('post')){

            //debug($this->request->data());


            $entity = $this->Articles->newEntity($this->request->data(), [
                'associated' => 'Tags'
            ]);

            if($this->Articles->save($entity)){
                  $this->Flash->success(__('Article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to save the article'));
        }

    }


    public function addComment()
    {
        debug($this->request->data());

        $comment = $this->loadModel('Comments')->newEntity($this->request->data());
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function edit($id = null)
    {
        $this->loadModel('Tags');
        $this->set('allTags', $this->Tags->find('all'));  

        $article = $this->Articles->get($id, ['contain' => ['Comments', 'ApprovedComments', 'Users', 'Tags']]);

        if($this->request->is(['post', 'put'])){

            $entity = $this->Articles->patchEntity($article, $this->request->data, [
                'associated' => ['Tags', 'Comments', 'ApprovedComments']
            ]);

            if($this->Articles->save($entity)){
                  $this->Flash->success(__('Article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to save the article'));
            
        }

         $this->set('article', $article);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

     public function approve($id = null, $articleId = null)
    {
   
    }
}

?>