<?php

function taskRead($tasksQuery)
{
    $taskArray = fetch($tasksQuery->exec());
    return $taskArray;
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