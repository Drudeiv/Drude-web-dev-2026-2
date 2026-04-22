<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №7</title>
    <link rel="stylesheet" href="styles7.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №7</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <?php

            function arg_is_not_Num($arg) {
                if ($arg === '') {
                    return true;
                }
                
                for ($i = 0; $i < strlen($arg); $i++) {
                    $char = $arg[$i];
                    if ($char !== '0' && $char !== '1' && $char !== '2' && 
                        $char !== '3' && $char !== '4' && $char !== '5' && 
                        $char !== '6' && $char !== '7' && $char !== '8' && $char !== '9') {
                        return true;
                    }
                }
                
                return false;
            }
            if (!isset($_POST['element0'])) {
                echo '<div class="warning">Массив не задан, сортировка невозможна</div>';
                exit();
            }
            $length = $_POST['arrLength'];

            for ($i = 0; $i < $length; $i++) {
                if (arg_is_not_Num($_POST['element' . $i])) {
                    echo '<div class="warning">Элемент массива "' . $_POST['element' . $i] . '" – не число</div>';
                    exit();
                }
            }

            $algoritm = $_POST['algoritm'];
            
            if ($algoritm === 'choice') {
                echo '<h1>Сортировка выбором</h1>';
            } elseif ($algoritm === 'bubble') {
                echo '<h1>Пузырьковый алгоритм</h1>';
            } elseif ($algoritm === 'shell') {
                echo '<h1>Алгоритм Шелла</h1>';
            } elseif ($algoritm === 'gnome') {
                echo '<h1>Алгоритм садового гнома</h1>';
            } elseif ($algoritm === 'quick') {
                echo '<h1>Быстрая сортировка</h1>';
            } elseif ($algoritm === 'php') {
                echo '<h1>Встроенная функция PHP для сортировки списков по значению</h1>';
            }

            $arr = array();
            
            echo '<h2>Исходный массив:</h2>';
            echo '<div class="array-container">';

            for ($i = 0; $i < $length; $i++) {
                echo '<div class="arr_element">' . $_POST['element' . $i] . '</div>';
                $arr[] = (int)$_POST['element' . $i];
            }
            echo '</div>';
            echo '<div class="success">Массив проверен, сортировка возможна</div>';

            function sorting_by_choice($arr) {
                $n = count($arr);
                $iteration = 0;
                
                echo '<h2>Ход сортировки:</h2>';
                
                for ($i = 0; $i < $n - 1; $i++) {
                    $min = $i;
                    
                    for ($j = $i + 1; $j < $n; $j++) {
                        if ($arr[$j] < $arr[$min]) {
                            $min = $j;
                        }
                    }
                    
                    if ($min != $i) {
                        $temp = $arr[$i];
                        $arr[$i] = $arr[$min];
                        $arr[$min] = $temp;
                    }
                    
                    $iteration++;
                    echo '<div class="iteration-block">';
                    echo '<span class="iteration-number">Итерация №' . $iteration . ':</span> ';
                    echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
                    echo '</div>';
                }
                
                return $iteration;
            }

            function bubble_sort($arr) {
                $n = count($arr);
                $iteration = 0;
                
                echo '<h2>Ход сортировки:</h2>';
                
                for ($j = 0; $j < $n - 1; $j++) {
                    for ($i = 0; $i < $n - 1 - $j; $i++) {
                        if ($arr[$i] > $arr[$i+1]) {
                            $temp = $arr[$i];
                            $arr[$i] = $arr[$i+1];
                            $arr[$i+1] = $temp;
                        }
                        
                        $iteration++;
                        echo '<div class="iteration-block">';
                        echo '<span class="iteration-number">Итерация №' . $iteration . ':</span> ';
                        echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
                        echo '</div>';
                    }
                }
                return $iteration;
            }

            function shell_sort($arr) {
                $n = count($arr);
                $iteration = 0;
                
                echo '<h2>Ход сортировки:</h2>';
                
                for ($k = ceil($n / 2); $k >= 1; $k = ceil($k / 2)) {
                    for ($i = $k; $i < $n; $i++) {
                        $val = $arr[$i];
                        $j = $i - $k;

                        while ($j >= 0 && $arr[$j] > $val) {
                            $arr[$j + $k] = $arr[$j];
                            $j -= $k;
                        }
                        $arr[$j + $k] = $val;
                        $iteration++;
                        echo '<div class="iteration-block">';
                        echo '<span class="iteration-number">Итерация №' . $iteration . ':</span> ';
                        echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
                        echo '</div>';
                    }
                }
                
                return $iteration;
            }

            function gnome_sort($arr) {
                $n = count($arr);
                $i = 1;
                $j = 2;
                $iteration = 0;
                
                echo '<h2>Ход сортировки:</h2>';
                
                while ($i < $n) {
                    if ($i == 0 || $arr[$i-1] <= $arr[$i]) {
                        $i = $j;
                        $j++;
                    } else {
                        $temp = $arr[$i];
                        $arr[$i] = $arr[$i-1];
                        $arr[$i-1] = $temp;
                        $i--;
                    }
                    
                    $iteration++;
                    echo '<div class="iteration-block">';
                    echo '<span class="iteration-number">Итерация №' . $iteration . ':</span> ';
                    echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
                    echo '</div>';
                }
                return $iteration;
            }

            $quick_iteration = 0;

            function quickSort(&$arr, $left, $right) {
                global $quick_iteration;
                
                $l = $left;
                $r = $right;
                $point = $arr[floor(($left + $right) / 2)];
                
                do {
                    while ($arr[$l] < $point) $l++;
                    while ($arr[$r] > $point) $r--;
                    
                    if ($l <= $r) {
                        $temp = $arr[$l];
                        $arr[$l] = $arr[$r];
                        $arr[$r] = $temp;
                        $l++;
                        $r--;
                        
                        $quick_iteration++;
                        echo '<div class="iteration-block">';
                        echo '<span class="iteration-number">Итерация №' . $quick_iteration . ':</span> ';
                        echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
                        echo '</div>';
                    }
                } while ($l <= $r);
                
                if ($r > $left) quickSort($arr, $left, $r);
                if ($l < $right) quickSort($arr, $l, $right);
            }

            function quick_sort_wrapper($arr) {
                global $quick_iteration;
                $quick_iteration = 0;
                
                echo '<h2>Ход сортировки:</h2>';
                
                quickSort($arr, 0, count($arr) - 1);
                
                return $quick_iteration;
            }

            function php_sort($arr) {
            echo '<h2>Ход сортировки:</h2>';

            sort($arr);
            
            echo '<div class="iteration-block">';
            echo '<span class="iteration-number">Результат сортировки:</span> ';
            echo '<span class="iteration-values">[' . implode(', ', $arr) . ']</span>';
            echo '</div>';
            return 0;
            }
            
            $time = microtime(true);

            if ($algoritm === 'choice') {
                $n = sorting_by_choice($arr);
            } elseif ($algoritm === 'bubble') {
                $n = bubble_sort($arr);
            } elseif ($algoritm === 'shell') {
                $n = shell_sort($arr);
            } elseif ($algoritm === 'gnome') {
                $n = gnome_sort($arr);
            } elseif ($algoritm === 'quick') {
                $n = quick_sort_wrapper($arr);
            } elseif ($algoritm === 'php') {
                $n = php_sort($arr);
            }
            
            $time_diff = microtime(true) - $time;

            echo '<h2>Сортировка завершена</h2>';
            echo '<p>Проведено итераций: ' . $n . '</p>';
            echo '<p>Сортировка заняла ' . round($time_diff, 6) . ' секунд.</p>';
            ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <span>2026 Московский Политех</span>
            <span>Друдэ И.В., 241-353</span>
        </div>
    </footer>
</body>
</html>