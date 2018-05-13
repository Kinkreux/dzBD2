<?php
//Добавить задачу в базу
function newTask($description, $dataBaseTasks)
{
    $time = new DateTime('now');
    $time = date_format($time, 'Y-m-d H:i:s');
    $dataBaseTasks->exec("INSERT INTO tasks(description, date_added) value ('".$description."', '".$time."')");
}

//Выполнить задачу
function doTask($id, $dataBaseTasks)
{
        $dataBaseTasks->exec("UPDATE tasks(is_done) SET VALUE(1) WHERE id = '.$id.'");
}

//Удалить задачу
function deleteTask($id, $dataBaseTasks)
{
    $dataBaseTasks->exec("DELETE * FROM tasks WHERE id='.$id.'");
}


//обработка формы
function newTaskDescription()
{
    if (isset($_POST)) {
        if (!array_key_exists('description', $_POST)) {
            echo 'Введите простое текстовое описание задачи длиной не более 255 символов.';
        } else {
            $description = htmlspecialchars($_POST['description']);
            return $description;
        }
    }
}

function newTaskAction()
{
    if (isset($_GET)) {
        if (!array_key_exists('action', $_GET)) {
            echo 'Ошибка: действие неопределено. Не получилось выполнить или удалить задачу.';
        } elseif(!array_key_exists('id', $_GET)) {
            echo 'Ошибка: действие неопределено. Не получилось выполнить или удалить задачу.';
        }else {
            foreach ($_GET as $get)
            (
                htmlspecialchars($get)
            );
            $actionArray = $_GET;
            return $actionArray;
        }
    }
}