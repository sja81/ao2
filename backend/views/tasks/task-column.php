<?php

use common\models\tasks\TasksProject;

    $backlogColumn = '';
    if($target === \common\models\tasks\TasksStages::BACKLOG) {
        $backlogColumn = " id='bl' ";
    }
?>
<div class="col-md task-col" data-target="<?php echo $target ?>"<?php echo $backlogColumn?>>
    <h4><?php echo $title ?></h4>
    <?php
    foreach($tasks as $task) {
        if ($task['stage'] !== $target) {
            continue;
        }

        echo $this->render('task-item',[
            'priority'  => $task['priority'],
            'title' =>  $task['title'],
            'ticketNumber'  => $task['ticketNumber'],
            'ticketId'  => $task['id'],
            'status'    => $task['taskStatus'],
            'backColor' => TasksProject::getBackgroundColor($task['ticketNumber']),
            'assignee'  => $task['assignee'],
            'dueDate'   => $task['dueDate']
        ]);
    }
    ?>
</div>
