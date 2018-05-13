<?php


//отобразить задачи
function taskRead($dataBaseTasks)
{
    $tasksList = $dataBaseTasks->query("SELECT id, description, is_done, date_added FROM tasks");
    if(!$tasksList) {
        echo 'Ошибка запроса к базе';
    } else {
        $taskArray = $tasksList->fetch();
    }
    return $taskArray;
}

//Добавить задачу в базу
function addTask($description)
{
    $addTask = $dataBaseTasks->prepare('INSERT INTO tasks(description) value (description=:description)');
    $addTask->bindValue(':description', $description);
    $newTask = $addTask->exec();
    return $newTask;
}

//Выполнить задачу
function doTask($id)
{
    $doTask = $dataBaseTasks->prepare('UPDATE tasks SET is_done=1 WHERE id=:id');
    $doTask->bindParam(':id', $id);
    $doTask = $doTask->exec();
    return $doTask;
}

//Удалить задачу
function deleteTask($id)
{
    $deleteTask = $dataBaseTasks->prepare("DELETE FROM tasks WHERE id=:id");
    $doTask->bindParam(':id', $id);
    $deleteTask->exec();
    return $deleteTask;
}


//обработка формы
function newTaskDescription()
{
    if (isset($_POST)) {
        if (!array_key_exists($_POST, $_POST['description'])) {
            echo 'Введите простое текстовое описание задачи длиной не более 255 символов.';
        } else {
            return preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST);
        }
    }
}

function newTaskAction()
{
    if (isset($_GET)) {
        if (!array_key_exists($_GET, $_GET['action'] or $_GET['id'])) {
            echo 'Ошибка: действие неопределено. Не получилось выполнить или удалить задачу.';
        } else {
            return preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET);
        }
    }
}

