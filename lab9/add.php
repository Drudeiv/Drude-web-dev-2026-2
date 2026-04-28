<h2>Добавление записи</h2>

<form name="form_add" method="post" action="?p=add">
    <input type="text" name="surname" placeholder="Фамилия" required>
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="patronymic" placeholder="Отчество">
    
    <select name="gender">
        <option value="мужской">Мужской</option>
        <option value="женский">Женский</option>
    </select>
    
    <input type="date" name="birthdate" placeholder="Дата рождения">
    <input type="text" name="phone" placeholder="Телефон">
    <input type="text" name="address" placeholder="Адрес">
    <input type="email" name="email" placeholder="E-mail">
    <textarea name="comment" placeholder="Комментарий"></textarea>
    
    <input type="submit" name="button" value="Добавить запись">
</form>

<?php

if( isset($_POST['button']) && $_POST['button'] == 'Добавить запись' )
{
    $mysqli = mysqli_connect('localhost', 'root', '', 'friends');
    
    if( mysqli_connect_errno() )
        echo '<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>';
    else
    {
        $sql = 'INSERT INTO friends (surname, name, patronymic, gender, birthdate, phone, address, email, comment) 
        VALUES ("'.htmlspecialchars($_POST['surname']).'", 
                "'.htmlspecialchars($_POST['name']).'", 
                "'.htmlspecialchars($_POST['patronymic']).'", 
                "'.htmlspecialchars($_POST['gender']).'", 
                "'.htmlspecialchars($_POST['birthdate']).'", 
                "'.htmlspecialchars($_POST['phone']).'", 
                "'.htmlspecialchars($_POST['address']).'", 
                "'.htmlspecialchars($_POST['email']).'", 
                "'.htmlspecialchars($_POST['comment']).'")';

        $sql_res = mysqli_query($mysqli, $sql);

        if( mysqli_errno($mysqli) )
            echo '<div class="error">Ошибка: запись не добавлена</div>';
        else
            echo '<div class="ok">Запись добавлена</div>';
    }
}
?>