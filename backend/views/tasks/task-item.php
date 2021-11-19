<div class="ibox task-<?php echo $priority ?>" data-id="<?php echo $ticketId ?>" style="background-color: <?= $backColor ?>">
    <header class="ibox-header" style="font-weight: 500">
        <a href="/backoffice/tasks/issue?id=<?php echo $ticketId ?>"><?php echo $ticketNumber ?></a>
    </header>
    <p>
        <?php echo $title ?>
    </p>
    <footer>
        <img src="assets/images/tasks/<?= $priority ?>.svg" alt="<?= $priority?>" title="<?= $priority ?>" width="16" height="16">
        <span class="ml-1"><?= $assignee ?></span>
        <?php
        if (!is_null($dueDate)) {
        ?>
        <span class="ml-2"><i class="mdi mdi-clock"> </i> <?= $dueDate ?></span>
        <?php
        }
        ?>
    </footer>
</div>