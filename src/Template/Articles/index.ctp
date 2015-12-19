
<!-- File: src/Template/Articles/index.ctp -->

<div class="row">

    <div class="col-md-1">
    </div>

    <div class="col-md-10">

        <div class="panel panel-info">
            <div class="panel-heading">    
                <h1>Blog Articles</h1>
            </div>
            <div class="panel-body">
                <?php
                    $user = $this->request->session()->read('Auth.User');
                    if(!empty($user))
                    {
                        echo "<div>".$this->Html->link('Add New Article', ['action' => 'add'])."</div>";
                    }
                    if($user['role'] == 'admin')
                    {
                        echo "<div>".$this->Html->link('Add New Tags', ['controller' => 'Tags', 'action' => 'add'])."</div>";
                    }    
                ?>
                    
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Comment</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>

                    <!-- Here is where we iterate through our $articles query object, printing out article info -->

                    <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td>
                            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
                        </td>
                        <td>

                            <?php 

                                $user = $this->request->session()->read('Auth.User');
                                if($user['role'] == 'admin'){
                                    echo count($article->comments)." Comment(s)";
                                }
                                else{
                                    echo count($article->approved_comments)." Comment(s)";   
                                }    

                            ?>

                        </td>
                        <td>
                           <!-- <?= debug($article->tags) ?> -->
                            <?= $article->author->username ?>
                        </td>
                        <td>
                            <?= $article->created ?>
                        </td>
                        <td>
                            <?=  $this->Html->link('View', ['action' => 'view', $article->id]); ?>

                        <?php
                            //$user = $this->request->session()->read('Auth.User');
                            if($user['role'] == 'admin')
                            {

                               echo " | ";
                               echo $this->Form->postLink(
                                    'Delete',
                                    ['action' => 'delete', $article->id],
                                    ['confirm' => 'Are you sure?']);
                               
                               echo " | ";

                               echo $this->Html->link('Edit', ['action' => 'edit', $article->id]);
                               
                            }       
                            
                        ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-1">
    </div>
