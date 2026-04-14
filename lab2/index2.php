<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №2, Вариант 4</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №2 | Вариант 4</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <?php
                $start_value = -10;
                $encounting = 16;
                $step = 1;
                $min_value = -100;
                $max_value = 100;
                $type = 'E';
                echo '<h2>Исходные данные:</h2>';
                echo '<div class="info-list">';
                echo '<div>Начальное значение x = '.$start_value.'</div>';
                echo '<div>Количество вычислений = '.$encounting.'</div>';
                echo '<div>Шаг = '.$step.'</div>';
                echo '<div>Min значение f(x) = '.$min_value.'</div>';
                echo '<div>Max значение f(x) = '.$max_value.'</div>';
                echo '<div>Тип верстки = '.$type.'</div>';
                echo '</div>';
                if( $type == 'B' )
                {
                    echo '<h2>Результаты вычислений (маркированный список):</h2>';
                    echo '<ul>';
                }
                else if( $type == 'C' )
                {
                    echo '<h2>Результаты вычислений (нумерованный список):</h2>';
                    echo '<ol>';
                }
                else if( $type == 'D' )
                {
                    echo '<h2>Результаты вычислений (таблица):</h2>';
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>№</th>';
                    echo '<th>x</th>';
                    echo '<th>f(x)</th>';
                    echo '</tr>';
                }
                else if( $type == 'E' )
                {
                    echo '<h2>Результаты вычислений (блочная верстка):</h2>';
                    echo '<div class="blocks-container">';
                }
                else
                {
                    echo '<h2>Результаты вычислений (простая верстка):</h2>';
                }
                $sum = 0;
                $count = 0;
                $values = array();
                $x = $start_value;
                for( $i = 0; $i < $encounting; $i++, $x += $step )
                {
                    if( $x <= 10 )
                    {
                        if( $x == 5 )
                        {
                            $f = 'error';
                        }
                        else
                        {
                            $f = (5 - $x) / (1 - $x/5);
                            $f = round($f, 3);
                        }
                    }
                    else if( $x < 20 )
                    {
                        $f = ($x * $x) / 4 + 7;
                        $f = round($f, 3);
                    }
                    else
                    {
                        $f = 2 * $x - 21;
                        $f = round($f, 3);
                    }
                    if( is_numeric($f) && ($f >= $max_value || $f <= $min_value) )
                    {
                        echo "<p>Остановка вычислений: f(x) = $f достигло границы [$min_value; $max_value]</p>";
                        break;
                    }
                    if( is_numeric($f) )
                    {
                        $sum += $f;
                        $count++;
                        $values[] = $f;
                    }
                    if( $type == 'A' )
                    {
                        echo '<span class="result-line">f('.$x.') = '.$f.'</span>';
                        if($i < $encounting-1)
                            echo '<br>'; 
                    }
                    else if( $type == 'B' )
                    {
                        echo '<li>f('.$x.') = '.$f.'</li>';
                    }
                    else if( $type == 'C' )
                    {
                        echo '<li>f('.$x.') = '.$f.'</li>';
                    }
                    else if( $type == 'D' )
                    {
                        $row_number = $i + 1;
                        echo '<tr>';
                        echo '<td>'.$row_number.'</td>';
                        echo '<td>'.$x.'</td>';
                        echo '<td>'.$f.'</td>';
                        echo '</tr>';
                    }
                    else if( $type == 'E' )
                    {
                        echo '<div class="block-item">';
                        echo 'f('.$x.') = '.$f;
                        echo '</div>';
                    }
                }
                if( $type == 'B' )
                {
                    echo '</ul>';
                }
                else if( $type == 'C' )
                {
                    echo '</ol>';
                }
                else if( $type == 'D' )
                {
                    echo '</table>';
                }
                else if( $type == 'E' )
                {
                    echo '</div>';
                }
                if( $count > 0 )
                {
                    $min = min($values);
                    $max = max($values);
                    $average = round($sum / $count, 3);
                    echo '<h2>Статистика:</h2>';
                    echo '<div class="stat-item">Сумма значений: ' . $sum . '</div>';
                    echo '<div class="stat-item">Минимальное значение: ' . $min . '</div>';
                    echo '<div class="stat-item">Максимальное значение: ' . $max . '</div>';
                    echo '<div class="stat-item">Среднее арифметическое: ' . $average . '</div>';
                    echo '</div>';
                }
                else
                {
                    echo '<p>Нет числовых значений для статистики</p>';
                }
            ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <span>Тип верстки: <?php echo $type; ?></span>
        </div>
    </footer>
</body>
</html>