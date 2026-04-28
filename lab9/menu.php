<div id="menu">
<?php

$allowed_p = array('viewer', 'add', 'edit', 'delete');
if( isset($_GET['p']) && !in_array($_GET['p'], $allowed_p) ) {
    die('Недопустимый параметр меню');
}
$allowed_sort = array('byid', 'fam', 'birth');
if( isset($_GET['sort']) && !in_array($_GET['sort'], $allowed_sort) ) {
    die('Недопустимый параметр сортировки');
}

if( !isset($_GET['p']) ) $_GET['p']='viewer';

echo '<a href="?p=viewer"';
if( $_GET['p'] == 'viewer' )
    echo ' class="selected"';
echo '>Просмотр</a>';

echo '<a href="?p=add"';
if( $_GET['p'] == 'add' )
    echo ' class="selected"';
echo '>Добавление записи</a>';

echo '<a href="?p=edit"';
if( $_GET['p'] == 'edit' )
    echo ' class="selected"';
echo '>Редактирование записи</a>';

echo '<a href="?p=delete"';
if( $_GET['p'] == 'delete' )
    echo ' class="selected"';
echo '>Удаление записи</a>';

if( $_GET['p'] == 'viewer' )
{
    echo '<div id="submenu">';

    echo '<a href="?p=viewer&sort=byid"';
    if( !isset($_GET['sort']) || $_GET['sort'] == 'byid' )
        echo ' class="selected"';
    echo '>По-умолчанию</a>';

    echo '<a href="?p=viewer&sort=fam"';
    if( isset($_GET['sort']) && $_GET['sort'] == 'fam' )
        echo ' class="selected"';
    echo '>По фамилии</a>';
    
    echo '<a href="?p=viewer&sort=birth"';
    if( isset($_GET['sort']) && $_GET['sort'] == 'birth' )
        echo ' class="selected"';
    echo '>По дате рождения</a>';
    
    echo '</div>';
}
?>
</div>