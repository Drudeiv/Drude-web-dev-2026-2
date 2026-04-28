<h2>Редактирование записи</h2>

<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
if( mysqli_connect_errno() )
{
    echo '<div class="error">Ошибка подключения к БД: '.mysqli_connect_error().'</div>';
    exit();
}

if( isset($_POST['button']) && $_POST['button'] == 'Изменить запись' )
{
    $sql = 'UPDATE friends SET 
            surname    = "'.htmlspecialchars($_POST['surname']).'",
            name       = "'.htmlspecialchars($_POST['name']).'",
            patronymic = "'.htmlspecialchars($_POST['patronymic']).'",
            gender     = "'.htmlspecialchars($_POST['gender']).'",
            birthdate  = "'.htmlspecialchars($_POST['birthdate']).'",
            phone      = "'.htmlspecialchars($_POST['phone']).'",
            address    = "'.htmlspecialchars($_POST['address']).'",
            email      = "'.htmlspecialchars($_POST['email']).'",
            comment    = "'.htmlspecialchars($_POST['comment']).'"
            WHERE id = '.$_GET['id'];
    
    mysqli_query($mysqli, $sql);
    echo '<div class="ok">Данные изменены</div>';
}

$currentROW = array();

if( isset($_GET['id']) )
{
    $sql_res = mysqli_query($mysqli, 'SELECT * FROM friends WHERE id = '.$_GET['id'].' LIMIT 0, 1');
    if( $sql_res )
        $currentROW = mysqli_fetch_assoc($sql_res);
}

if( !$currentROW )
{
    $sql_res = mysqli_query($mysqli, 'SELECT * FROM friends LIMIT 0, 1');
    if( $sql_res )
        $currentROW = mysqli_fetch_assoc($sql_res);
}

$sql_res = mysqli_query($mysqli, 'SELECT id, surname, name FROM friends ORDER BY surname ASC, name ASC');

if( $sql_res && !mysqli_errno($mysqli) )
{
    echo '<div id="edit_links">';
    
    while( $row = mysqli_fetch_assoc($sql_res) )
    {
        if( $currentROW && $currentROW['id'] == $row['id'] )
        {
            echo '<div class="current">'.$row['surname'].' '.$row['name'].'</div>';
        }
        else
        {
            echo '<a href="?p=edit&id='.$row['id'].'">'.$row['surname'].' '.$row['name'].'</a>';
        }
    }
    echo '</div>';
}
else
{
    echo '<div class="error">Ошибка базы данных</div>';
}
if( $currentROW ) :
?>
    <form name="form_edit" method="post" action="?p=edit&id=<?php echo $currentROW['id']; ?>">
        <input type="text" name="surname" placeholder="Фамилия" 
               value="<?php echo htmlspecialchars($currentROW['surname']); ?>" required>
        <input type="text" name="name" placeholder="Имя" 
               value="<?php echo htmlspecialchars($currentROW['name']); ?>" required>
        <input type="text" name="patronymic" placeholder="Отчество" 
               value="<?php echo htmlspecialchars($currentROW['patronymic']); ?>">
        
        <select name="gender">
            <option value="мужской" <?php if($currentROW['gender'] == 'мужской') echo 'selected'; ?>>Мужской</option>
            <option value="женский" <?php if($currentROW['gender'] == 'женский') echo 'selected'; ?>>Женский</option>
        </select>
        
        <input type="date" name="birthdate" 
               value="<?php echo htmlspecialchars($currentROW['birthdate']); ?>">
        <input type="text" name="phone" placeholder="Телефон" 
               value="<?php echo htmlspecialchars($currentROW['phone']); ?>">
        <input type="text" name="address" placeholder="Адрес" 
               value="<?php echo htmlspecialchars($currentROW['address']); ?>">
        <input type="email" name="email" placeholder="E-mail" 
               value="<?php echo htmlspecialchars($currentROW['email']); ?>">
        <textarea name="comment" placeholder="Комментарий"><?php echo htmlspecialchars($currentROW['comment']); ?></textarea>
        
        <input type="submit" name="button" value="Изменить запись">
    </form>
<?php else : ?>
    <p>Записей пока нет</p>
<?php endif; ?>