<h2>Удаление записи</h2>

<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
if( mysqli_connect_errno() )
{
    echo '<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>';
    exit();
}

if( isset($_GET['id']) )
{
    $sql_res = mysqli_query($mysqli, 'SELECT surname FROM friends WHERE id = '.$_GET['id'].' LIMIT 0, 1');
    
    if( $sql_res && ($row = mysqli_fetch_assoc($sql_res)) )
    {
        $deleted_surname = $row['surname'];
        $sql_del = 'DELETE FROM friends WHERE id = '.$_GET['id'];
        mysqli_query($mysqli, $sql_del);
        echo '<div class="ok">Запись с фамилией '.htmlspecialchars($deleted_surname).' удалена</div>';
    }
    else
    {
        echo '<div class="error">Запись не найдена</div>';
    }
}

$sql_res = mysqli_query($mysqli, 'SELECT id, surname, name, patronymic FROM friends ORDER BY surname ASC, name ASC');

if( $sql_res && !mysqli_errno($mysqli) )
{
    echo '<div id="delete_links">';
    
    while( $row = mysqli_fetch_assoc($sql_res) )
    {
        $initials = mb_substr($row['name'], 0, 1).'.';
        if( $row['patronymic'] )
            $initials .= mb_substr($row['patronymic'], 0, 1).'.';
        echo '<a href="?p=delete&id='.$row['id'].'">'
             .$row['surname'].' '.$initials
             .'</a>';
    }
    echo '</div>';
}
else
{
    echo '<div class="error">Ошибка базы данных</div>';
    echo '<p>Записей пока нет</p>';
}
?>