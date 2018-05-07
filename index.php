<?php
/*создаем подключение к базе данных;
супер-несекурно,
в интернете советуют делать отдельный ini-файл и запрещать к нему доступ,
но это пока не входит в задание.
Это будет уместно использовать, например, в дипломе. */
$dataBaseTasks = new PDO('mysql:dbname=global;host=localhost;charset=UTF8','mpustovit', 'neto1714');

//дамп создания базы
/* SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `is_done` tinyint(4) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;*/

//пишем sql-запрос
$allbooks = 'select * from tasks';

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
        <h1 style="">Мое домашнее задание по лекции 4.2 «Запросы SELECT, INSERT, UPDATE и DELETE»</h1>
            <h2>Мои задачи</h2>
            <table>
                <thead>
                    <th>Задача</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th>Действия:</th>
                </thead>
                <tbody>
                <?php
                //читаем и выводим задачи построчно
                 foreach ($dataBaseConnection->query($allbooks) as $row) : ?>
                    <tr>
                        //Задача
                        <td><?php echo $row['description'] ?></td>
                        //статус: сделано / не сделано
                        <td><?php echo $row['is_done'] ?></td>
                        //дата создания задачи
                        <td><?php echo $row['date_added'] ?></td>
                        //изменить задачу
                        <td><?php echo  ?></td>
                        //выполнить задачу
                        <td><?php echo  ?></td>
                        //удалить задачу
                        <td><?php echo  ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Код приложения</h2>
                <ul>
                <a href="https://github.com/Kinkreux/dzBD2" target="_blank">Открыть в новом окне репозиторий на Github</a>
    </body>
</html>
