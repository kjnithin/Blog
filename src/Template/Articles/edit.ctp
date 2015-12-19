<!--Articles/edit.ctp-->
<?php 
       echo $this->Form->create($article);
?>    

<?php 
	$nameArray = array();
	foreach ($article->tags as $checkedTag) {
		array_push($nameArray, $checkedTag->name);			
	}
	

?>


<div class="row" >
    <div class="col-md-1">
    </div>
    <div class="col-md-7">
        <div>
        	 <?= $this->Form->input('title',['class' => 'form-control']) ?>
           	
    	</div>

        <div class="article_author" id="author_name">
          <?=h ("By: ".$article->author->username) ?>
        </div>
        <div class="article_author">
          <?=h ("Posted at ".$article->created)  ?>
        </div>

         <div>
          <label>Tags:</label>	
         <div class="form-control tags_checkboxs">
	            	<?php 
	            		foreach ($allTags as $tag) {

	            				if(array_search($tag->name, $nameArray) !== false)
	            				{
	            					echo $this->Form->label($tag->name);
	            					echo $this->Form->checkbox($tag->name, ['value' => $tag->id, 'id' => $tag->name, 'name' => 'tags[_ids][]', 'hiddenField' => false , 'checked' => 'true' ,'style' => 'vertical-align:middle;' ]);
	            				}
	            				else{
	            					echo $this->Form->label($tag->name);

	            					echo $this->Form->checkbox($tag->name, ['value' => $tag->id, 'id' => $tag->name, 'name' => 'tags[_ids][]', 'hiddenField' => false , 'style' => 'vertical-align:middle; ']);
	            				}
	            			}
                    ?>
          </div>          
	     </div>
        


    		<div class="form-group" >
    			<label>Body</label>
    			<textarea class="form-control" name="body" id="body_text"><?=h ($article->body) ?></textarea>
    		</div>

    		<div class="form-group">
    			<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-md btn-info form-control']); ?>
                
    		</div>
        <div id="articlesListLink"> 
              <?= $this->Html->link('Back to Articles List', ['controller' => 'articles','action' => 'index']) ?>
        </div>
        
    </div>

    <div class="col-md-3">
      <div class="comment_area">
        <div>
           <h4 > <span class="glyphicon glyphicon-comment" id="comment_icon" aria-hidden="true"></span> <?=h (count($article->comments)) ?> Comment(s)</h4>
        </div>
        
        <div>
        <ul class="list-group" id="comment_list">
        	
              <?php
                $user = $this->request->session()->read('Auth.User');
                if($user['role'] == 'admin')
                { 
                	$i = 0;

                    foreach ($article->comments as $comment)
                    {             
                    	echo "<li class='comment_content list-group-item list-group-item-info'>";

                      	echo $this->Form->input('comments.'.$i.'.id');
		
						echo $this->Form->input('comments.'.$i.'.comment', ['label' => false, 'class' => 'form-control']);
						
						echo $this->Form->input('comments.'.$i.'.isApproved');
					  	
					  	echo "<div>" ;
						echo $this->Form->postLink('Delete', ['controller' => 'Comments', 'action' => 'delete', $comment->id, $article->id], [ 'confirm' => 'Are you sure?', 'class' => 'btn btn-primary btn-sm']);
						echo "</div>" ;

					  	echo "</li>";



					  	$i++;
					 }

				}
                ?>
				

                      	 <!--echo "<textarea class='form-control' name='comment' >".$comment->comment."</textarea>";
                      	 echo "<li class='comment_content list-group-item list-group-item-info'><div>"."<p>".$comment->created."</p>";

                          echo "<div class='row'>";

                          echo "<div class='col-sm-3'><label for=".$comment->id.">Approved</div>";
                          echo "<div class='col-sm-3'>".$this->Form->checkbox($comment->isApproved, ['value' => $comment->comment, 'id' => $comment->id, 'name' => 'comments[_ids][]', 'hiddenField' => false , 'checked' => 'true' ,'style' => 'vertical-align:middle;margin-left:10px;', 'class' => 'list-group-item list-group-item-info' ])."</div>";
                          
                      	  echo"<div class='col-sm-6'></div></div>";	

                          echo $this->Form->postLink('Delete', ['controller' => 'Comments', 'action' => 'delete', $comment->id], ['class' => 'btn btn-primary btn-sm']);

                          echo "</div></li>";         
                      }
                      else{
                            echo "<textarea class='form-control' name='comment'>".$comment->comment."</textarea>";

                      	   echo "<li class='comment_content list-group-item list-group-item-info'><div>"."<p>".$comment->created."</p>";
                      	    echo "<div class='row'>";

                          echo "<div class='col-sm-3'><label for=".$comment->id.">Approved</div>";
                          echo "<div class='col-sm-3'>".$this->Form->checkbox($comment->isApproved, ['value' => $comment->comment, 'id' => $comment->id, 'name' => 'comments[_ids][]', 'hiddenField' => false , 'style' => 'vertical-align:middle;margin-left:10px;', 'class' => 'list-group-item list-group-item-info' ])."</div>";
                          
                      	  echo"<div class='col-sm-6'></div></div>";	
                      	   echo $this->Form->postLink('Delete', ['controller' => 'Comments', 'action' => 'delete', $comment->id], ['class' => 'btn btn-primary btn-sm']);
                      
                      	   echo "</div></li>";         
                      }
                     
                    }

                    $commentCount = count($article->comments);

                    for ($i=0; $i < $commentCount; $i++) {

                    	if($article->comments[$i]->isApproved)
                    	{
                    		echo "<textarea class='form-control' name='comment' >".$article->comments[$i]->comment."</textarea>";
                      	 	echo "<li class='comment_content list-group-item list-group-item-info'><div>"."<p>".$article->comments[$i]->created."</p>";

                          echo "<div class='row'>";

                          echo "<div class='col-sm-3'><label for=".$article->comments[$i]->id.">Approved</div>";
                          echo "<div class='col-sm-3'>".$this->Form->checkbox($article->comments[$i]->isApproved, ['value' => $$article->comments[$i]->comment, 'id' => $article->comments[$i]->id, 'name' => 'comments[_ids][]', 'hiddenField' => false , 'checked' => 'true' ,'style' => 'vertical-align:middle;margin-left:10px;', 'class' => 'list-group-item list-group-item-info' ])."</div>";
                          
                      	  echo"<div class='col-sm-6'></div></div>";	

                          echo $this->Form->postLink('Delete', ['controller' => 'Comments', 'action' => 'delete', $article->comments[$i]->id], ['class' => 'btn btn-primary btn-sm']);

                          echo "</div></li>";         
                    	}
                    	else{
                    		echo "<textarea class='form-control' name='comment' >".$article->comments[$i]->comment."</textarea>";
                      	 	echo "<li class='comment_content list-group-item list-group-item-info'><div>"."<p>".$article->comments[$i]->created."</p>";

                          echo "<div class='row'>";

                          echo "<div class='col-sm-3'><label for=".$article->comments[$i]->id.">Approved</div>";
                          echo "<div class='col-sm-3'>".$this->Form->checkbox($article->comments[$i]->isApproved, ['value' => $article->comments[$i]->comment, 'id' => $article->comments[$i]->id, 'name' => 'comments[_ids][]', 'hiddenField' => false , 'style' => 'vertical-align:middle;margin-left:10px;', 'class' => 'list-group-item list-group-item-info' ])."</div>";
                          
                      	  echo"<div class='col-sm-6'></div></div>";	

                          echo $this->Form->postLink('Delete', ['controller' => 'Comments', 'action' => 'delete', $article->comments[$i]->id], ['class' => 'btn btn-primary btn-sm']);

                          echo "</div></li>";         
                    	}

                    }*/ -->

  
                                           
              
        </ul>


      </div>
			<?php echo $this->Form->end(); ?>       
    </div>
    </div>
    <div class="col-md-1">
    </div>
</div>