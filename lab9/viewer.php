<?php
function getFriendsList($sort, $page) {
    $mysqli = mysqli_connect('localhost', 'root', '', 'friends');
    if( mysqli_connect_errno() )
        return 'Ошибка подключения к БД: '.mysqli_connect_error();

    if( $sort == 'fam' )
        $order = 'ORDER BY surname ASC';
    elseif( $sort == 'birth' )
        $order = 'ORDER BY birthdate ASC';
    else
        $order = 'ORDER BY id ASC';

    $sql_res = mysqli_query($mysqli, 'SELECT COUNT(*) FROM friends');
    if( mysqli_errno($mysqli) || !($row = mysqli_fetch_row($sql_res)) )
        return 'Неизвестная ошибка';
    
    $TOTAL = $row[0];
    if( !$TOTAL )
        return 'В таблице нет данных';
    
    $PAGES = ceil($TOTAL / 10);

    if( $page >= $PAGES )
        $page = $PAGES - 1;
    if( $page < 0 )
        $page = 0;

    $start = $page * 10;
    $sql = 'SELECT * FROM friends '.$order.' LIMIT '.$start.', 10';
    $sql_res = mysqli_query($mysqli, $sql);

    $ret = '<table class="friends-table">';

    $ret .= '<tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Телефон</th>
        <th>Адрес</th>
        <th>E-mail</th>
        <th>Комментарий</th>
    </tr>';
    
    while( $row = mysqli_fetch_assoc($sql_res) ) {
        $ret .= '<tr>
            <td>'.$row['surname'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['patronymic'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['birthdate'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['comment'].'</td>
        </tr>';
    }
    
    $ret .= '</table>';

    if( $PAGES > 1 ) {
        $ret .= '<div id="pages">';
        $ret .= 'Страницы: ';
        for($i = 0; $i < $PAGES; $i++) {
            if( $i != $page )
                $ret .= '<a href="?p=viewer&sort='.$sort.'&pg='.$i.'">'.($i+1).'</a>';
            else
                $ret .= '<span>'.($i+1).'</span>';
        }
        $ret .= '</div>';
    }
    return $ret;
}
?>
