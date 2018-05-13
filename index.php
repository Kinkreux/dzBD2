<?php
require_once __DIR__ . '/functions.php';

//создаем подключение к базе данных
$dataBaseTasks = new PDO('mysql:dbname=global;host=localhost;charset=UTF8', 'mpustovit', 'neto1714');

//дамп создания базы
try {
    $dataBaseTasks->exec(
        "DROP TABLE IF EXISTS `tasks`;
                          CREATE TABLE `tasks` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `description` text NOT NULL,
                          `is_done` tinyint(4) NOT NULL DEFAULT '0',
                          `date_added` datetime NOT NULL,
                          PRIMARY KEY(`id`)
                          ) ENGINE = InnoDB DEFAULT CHARSET = utf8;");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$taskArray = taskRead($dataBaseTasks);

if(newTaskAction()) {
    $newTaskAction = newTaskAction();
    $description = $newTaskAction(['id']);
}

if(newTaskAction()) {
    $newTaskDescription = newTaskAction();
    $id = $newTaskAction(['description']);
}

$transaction = true;

$dataBaseTasks->beginTransaction();

if ($newTaskDescription) {
    addTask($description);
} elseif ($newTaskAction['action'] = 'doTask') {
    doTask($id);
} elseif ($newTaskAction['action'] = 'deleteTask') {
    deleteTask($id);
} else {
    $transaction = false;
}

if ($transaction) {
    $dataBaseTasks->commit();
    echo 'Задача успешно добавлена.';
} else {
    $dataBaseTasks->rollBack();
    echo 'задача "' . $newTaskDescription . '"" не добавилась, попробуйте еще раз.';
}


?>

<html>
<header>
    <title>Мое домашнее задание по лекции 4.2 «Запросы SELECT, INSERT, UPDATE и DELETE»</title>
    <style>
        h1, h2 {
            font-size: 18px;
        }

        body {
            max-width: 550px;
            margin-left: 15%;
        }

        td {
            padding: 10px;
        }
    </style>
</header>
<body>
<h1>Мое домашнее задание по лекции 4.2 «Запросы SELECT, INSERT, UPDATE и DELETE»</h1>
<h2>Мои задачи</h2>
<form method="post">
    <p>Новая задача:</p>
    <input type=text name="description">
    <input type="submit" value="Создать новую задачу">
</form>
<table>
    <thead>
    <th>Задача</th>
    <th>Сделано</th>
    <th>Дата создания</th>
    <th>Действия:</th>
    </thead>
    <tbody>
    <?php
    //читаем и выводим задачи построчно
    foreach ($taskArray as $task) : ?>
        <tr>
            <?php $id = $task['id'] ?>
            //Задача
            <td><?php $description = $task['description'];
                echo $description ?></td>
            //статус: сделано / не сделано
            <td><?php $doneTask = $task['is_done'];
                if ($doneTask) echo 'Да';
                echo 'Нет' ?></td>
            //дата создания задачи
            <td><?php $dateTask = $task['date_added'];
                echo $dateTask ?></td>
            //выполнить задачу
            <td><?php echo '<a href="?' . $id . '&action=doTask>' ?></td>
            //удалить задачу
            <td><?php echo '<a href="?' . $id . '&action=deleteTask' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h2>Код приложения</h2>
<a href="https://github.com/Kinkreux/dzBD2" target="_blank">Открыть в новом окне репозиторий на Github</a>
</body>
</html>