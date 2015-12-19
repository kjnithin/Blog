<?php header("Location: ArticlesController.php"); ?>

<div class="row" >
    <div class="col-md-1">
    </div>
    <div class="col-md-7">
        <div>
           		<h1 class="text-center"><?=h ($article->title) ?></h1>
    		</div>

        <div class="article_author" id="author_name">
          <?=h ("By: ".$article->author->username) ?>
        </div>
        <div class="article_author">
          <?=h ("Posted at ".$article->created)  ?>
        </div>

         <div>
          <label>Tags:</label>
          <ul id="tag_list">
              <?php 
                foreach ($article->tags as $tag) {
                   echo "<li><span class='label label-primary'>".$tag->name."</span></li>";

                }
              ?>
          </ul>
        </div>


    		<div>
    			<article><?=h ($article->body) ?></article>
    		</div>
        <div id="articlesListLink"> 
              <?= $this->Html->link('Back to Articles List', ['controller' => 'articles','action' => 'index']) ?>
        </div>
        <div class="form-group">
        <?php
                $user = $this->request->session()->read('Auth.User');
                if(!empty($user))
                {
                   echo $this->Form->create();
                   echo  $this->Form->textarea('comment', ['class' => 'form-control', 'id' => 'comment']); 
                   
                   echo $this->Form->button(__('Add New Comment'), ['class' => 'btn btn-md btn-info form-control']); 
                   //echo "<input type='button' id='submitBtn' class='btn btn-primary btn-lg btn-block'/>";

                   

                   echo $this->Form->end();
                }
        ?>
        </div>
    </div>

    <div class="col-md-3">

      <div class="view_actionLink">
         <div>
          <?php
                if($user['role'] == 'admin'){
                    echo $this->Html->link('Edit Article', ['controller' => 'articles','action' => 'edit', $article->id], ['class' => 'btn btn-info', 'id' => 'editArticleButton'] ,['role' => 'button']);
                    echo $this->Form->postLink('Delete Article', ['controller' => 'articles','action' => 'delete', $article->id], ['confirm' => 'Are you sure?','class' => 'btn btn-info','role' => 'button'] );       
                }
          ?>
        </div>
      </div>

      <div class="comment_area">
        <div>
           <h4 > <span class="glyphicon glyphicon-comment" id="comment_icon" aria-hidden="true"></span> <?=h (count($article->approved_comments)) ?> Comment(s)</h4>
        </div>
        
        <div>
        <ul "list-group">
              <?php
                $user = $this->request->session()->read('Auth.User');
                if($user['role'] == 'admin')
                { 
                    foreach ($article->comments as $comment) {

                          echo "<li class='comment_content list-group-item list-group-item-info'><div><p>".$comment->comment."</p><p>".$comment->created."</p>";
                                                    

                          echo "</div></li>";  
                    }
                }    
                else{
                     foreach($article->approved_comments as $comment){    

                      echo "<li class='comment_content list-group-item list-group-item-info'><div><p>".$comment->comment."</p><p>".$comment->created."</p></div></li>";

                      }
                }  

                                               
              ?>
        </ul>


      </div>
    </div>
    </div>
    <div class="col-md-1">
    </div>
</div>



