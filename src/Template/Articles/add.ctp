<?php 
       
   echo $this->Form->create();

   $user = $this->request->session()->read('Auth.User');
   if(!empty($user))
   {
        echo $this->Form->hidden('user_id', ['value' => $user['id']]);
   }
?>    




<div class="row" >
   
    <div >
        <div class="col-sm-9">
             <div class="panel-heading">
                 <h4 class="panel-title"><B>New Article</B></h4>
             </div>
            
             <div class="panel-body">



            <div class="form-group">
                <?= $this->Form->input('title',['class' => 'form-control']) ?>
            </div>
            <div class="form-group">   
                <label>Body</label>
                <?= $this->Form->textarea('body', ['class' => 'form-control', 'id' => 'body_text']) ?>
            </div>

            <div class="form-group">
	            <label class="form-label">Tags</label>

	            <div class="form-control tags_checkboxs">
	            	<?php 
	            		foreach ($tags as $tag) {
	            			echo $this->Form->label($tag->name);
							echo $this->Form->checkbox($tag->name, ['value' => $tag->id, 'id' => $tag->name, 'name' => 'tags[_ids][]', 'hiddenField' => false ]);
	            		}

                    ?>

	            </div>
       		</div>
            <div class="form-group">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-md btn-info form-control']); ?>
                <?= $this->Form->end() ?>
        
            </div>
        </div>
    </div>
     <div class="col-md-2">
    </div>
</div>