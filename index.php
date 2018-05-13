<?php
require_once __DIR__ . '/functions.php';

//создаем подключение к базе данных
$dataBaseTasks = new PDO('mysql:dbname=mpustovit;host=localhost;charset=UTF8', 'mpustovit', 'neto1714');

//дамп создания базы; она уже 1 раз создана, так что закомментирована
/*try {
    $test = $dataBaseTasks->exec(
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
}*/

if (array_key_exists('action', $_GET) or array_key_exists('id', $_GET)) {
    $actionArray = newTaskAction();
    $id = $actionArray['id'];
    $action = $actionArray['action'];
    if ($action = 'doTask') {
        doTask($id, $dataBaseTasks);
    } elseif ($action = 'deleteTask') {
        deleteTask($id, $dataBaseTasks);
    } else echo 'Действие не определено.';
}

if (array_key_exists('description', $_POST)) {
    $description = newTaskDescription();
    newTask($description, $dataBaseTasks);
}

//создаем массив задач
$tasksArray = $dataBaseTasks->query("SELECT id, description, is_done, date_added FROM tasks");
$tasksArray = $tasksArray->fetchAll();
?>

<html>
<header>
    <title>Мое домашнее задание по лекции 4.2 «Запросы SELECT, INSERT, UPDATE и DELETE»</title>
    <style>
        h1, h2 {
            font-size: 18px;
        }

        body {
            max-width: 700px;
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
    foreach ($tasksArray as $task) : ?>
        <tr>
            <?php  //id
            $id = $task['id'] ?>
            <td><?php //Задача
                echo $task['description'] ?></td>
            <td><?php  //статус: сделано / не сделано
                if ($task['is_done']) {
                    echo 'Да';
                } else {
                echo 'Нет';
                };
                ?></td>
            <td><?php  //дата создания задачи
                echo date('d.m.Y H:i', strtotime($task['date_added'])) ?></td>
            <td><?php //выполнить задачу
                echo '<a href="?id='.$id.'&action=doTask">'.'Выполнить</a>'?></td>
            <td><?php //удалить задачу
                echo '<a href="?id=' . $id . '&action=deleteTask">'.'Удалить</a>' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h2>Код приложения</h2>
<a href="https://github.com/Kinkreux/dzBD2" target="_blank">Открыть в новом окне репозиторий на Github</a>
</body>
</html>