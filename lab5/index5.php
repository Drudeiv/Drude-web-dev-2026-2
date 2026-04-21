<?php
date_default_timezone_set('Europe/Moscow');

function outNumAsLink($x) {
    if ($x >= 2 && $x <= 9) {
        return '<a href="?content=' . $x . '">' . $x . '</a>';
    } else {
        return $x;
    }
}

function outRow($n, $mode = 'table') {
    for ($i = 2; $i <= 9; $i++) {
        $result = $i * $n;
        
        if ($mode == 'table') {
            echo '<tr><td>';
            echo outNumAsLink($n) . ' × ' . outNumAsLink($i) . ' = ' . outNumAsLink($result);
            echo '</td></tr>';
        } else {
            echo '<div class="multiply-row">';
            echo outNumAsLink($n) . ' × ' . outNumAsLink($i) . ' = ' . outNumAsLink($result);
            echo '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №5</title>
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <header class="site-header">
        <div id="main_menu"><?php
        
        echo '<a href="?html_type=TABLE';
        if( isset($_GET['content']) )
            echo '&content=' . $_GET['content'];
        echo '"';
        if( array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'TABLE' )
            echo ' class="selected"';
        echo '>Табличная верстка</a>';

        echo '<a href="?html_type=DIV';
        if( isset($_GET['content']) )
            echo '&content=' . $_GET['content'];
        echo '"';
        if( array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV' )
            echo ' class="selected"';
        echo '>Блочная верстка</a>';
        
        ?></div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <div class="main-container">
                <div id="product_menu"><?php

                if( array_key_exists('html_type', $_GET) )
                    $all_link = '?html_type=' . $_GET['html_type'];
                else
                    $all_link = 'index5.php';
                
                echo '<a href="' . $all_link . '"';
                if( !isset($_GET['content']) )
                    echo ' class="selected"';
                echo '>Вся таблица умножения</a>';
                
                for( $i = 2; $i <= 9; $i++ ) {
                    $link = '?content=' . $i;
                    if( array_key_exists('html_type', $_GET) )
                        $link .= '&html_type=' . $_GET['html_type'];
                    
                    echo '<a href="' . $link . '"';
                    if( isset($_GET['content']) && $_GET['content'] == $i )
                        echo ' class="selected"';
                    echo '>Таблица умножения на ' . $i . '</a>';
                }
                
                ?></div>
                
                <div class="table-container">
                    <?php

                    $html_type = 'TABLE';
                    if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV') {
                        $html_type = 'DIV';
                    }
                    
                    if (!array_key_exists('content', $_GET)) {
                        if ($html_type == 'TABLE') {
                            echo '<table class="multiply-table multiply-full">';
                            echo '<tr>';
                            for ($col = 2; $col <= 9; $col++) {
                                echo '<td>';
                                for ($i = 2; $i <= 9; $i++) {
                                    $result = $col * $i;
                                    echo outNumAsLink($col) . ' × ' . outNumAsLink($i) . ' = ' . outNumAsLink($result) . '<br>';
                                }
                                echo '</td>';
                            }
                            echo '</tr>';
                            echo '</table>';
                        } else {
                            echo '<div class="multiply-blocks">';
                            for ($col = 2; $col <= 9; $col++) {
                                echo '<div class="ttRow">';
                                outRow($col, 'div');
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    } else {
                        $content = intval($_GET['content']);
                        if ($content >= 2 && $content <= 9) {
                            if ($html_type == 'TABLE') {
                                echo '<table class="multiply-table multiply-single">';
                                outRow($content, 'table');
                                echo '</table>';
                            } else {
                                echo '<div class="ttSingleRow">';
                                outRow($content, 'div');
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <?php
            if (!array_key_exists('html_type', $_GET) || $_GET['html_type'] == 'TABLE') {
                $info = 'Табличная верстка. ';
            } else {
                $info = 'Блочная верстка. ';
            }
            
            if (!array_key_exists('content', $_GET)) {
                $info .= 'Таблица умножения полностью. ';
            } else {
                $info .= 'Столбец таблицы умножения на ' . $_GET['content'] . '. ';
            }
            
            echo '<span>' . $info . date('d.m.Y H:i:s') . '</span>';
            ?>
        </div>
    </footer>
</body>
</html>