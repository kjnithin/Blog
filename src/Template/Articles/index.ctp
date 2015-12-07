<h1>Blog articles</h1>

<?= $this->Html->link('Add Article', ['action' => 'add']) ?> <br>

<?php

 echo $this->Html->link('Log Out', array('controller'=>'users','action' => 'logout')); 

?>  

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Comments</th>
        <th>Created</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Approve</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
             <?= $this->Html->link($article->comments, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?>
            </td>
            <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $article->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
        <td>
            <?= $this->Html->link('Approve', ['action' => 'edit', $article->id]) ?>
            </td
    </tr>
    <?php endforeach; ?>

    
</table>