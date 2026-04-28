<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №8</title>
    <link rel="stylesheet" href="styles8.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №8</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <h2>Результаты анализа текста</h2>
            <?php

            function test_symbs( $text )
            {
                $symbs = array();
                $rus_upper = iconv("UTF-8", "CP1251", "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ");
                $rus_lower = iconv("UTF-8", "CP1251", "абвгдеёжзийклмнопрстуфхцчшщъыьэюя");
                $l_text = strtr($text, $rus_upper, $rus_lower);
                $l_text = strtolower( $l_text );
                
                for($i = 0; $i < strlen($l_text); $i++)
                {
                    $char = $l_text[$i];
                    if( isset($symbs[$char]) )
                        $symbs[$char]++;
                    else
                        $symbs[$char] = 1;
                }
                return $symbs;
            }

            function test_it( $text ) {
                echo '<div class="src_text">' . iconv("CP1251", "UTF-8", $text) . '</div>';
                
                $cifra = array(
                    '0' => true, '1' => true, '2' => true, '3' => true, '4' => true,
                    '5' => true, '6' => true, '7' => true, '8' => true, '9' => true
                );

                $punctuation = array(
                    '.' => true, ',' => true, '!' => true, '?' => true, 
                    ':' => true, ';' => true, '-' => true, '—' => true,
                    '«' => true, '»' => true, '"' => true, "'" => true,
                    '(' => true, ')' => true
                );
                
                $delimiters = array_merge(array(' ' => true), $punctuation);

                $rus_lower = iconv("UTF-8", "CP1251", "абвгдеёжзийклмнопрстуфхцчшщъыьэюя");
                $rus_upper = iconv("UTF-8", "CP1251", "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ");
                $eng_lower = "abcdefghijklmnopqrstuvwxyz";
                $eng_upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                
                $cifra_amount = 0;
                $punct_amount = 0;
                $letters_total = 0;
                $letters_lower = 0;
                $letters_upper = 0;
                $word = '';
                $words = array();

                for($i = 0; $i < strlen($text); $i++) {
                    $char = $text[$i];
                    if( array_key_exists($char, $cifra) ) {
                        $cifra_amount++;
                    }

                    if( isset($punctuation[$char]) ) {
                        $punct_amount++;
                    }

                    if( strpos($rus_lower, $char) !== false ) {
                        $letters_total++;
                        $letters_lower++;
                    }

                    elseif( strpos($rus_upper, $char) !== false ) {
                        $letters_total++;
                        $letters_upper++;
                    }

                    elseif( strpos($eng_lower, $char) !== false ) {
                        $letters_total++;
                        $letters_lower++;
                    }

                    elseif( strpos($eng_upper, $char) !== false ) {
                        $letters_total++;
                        $letters_upper++;
                    }

                    if( isset($delimiters[$char]) || $i == strlen($text) - 1 )
                    {
                        if( $i == strlen($text) - 1 && !isset($delimiters[$char]) ) {
                            $word .= $char;
                        }
                        if( $word != '' )
                        {
                            $has_letter = false;
                            $word_len = strlen($word);
                            
                            for($j = 0; $j < $word_len; $j++) {
                                $w_char = $word[$j];
                                if( strpos($rus_lower, $w_char) !== false || 
                                    strpos($rus_upper, $w_char) !== false ||
                                    strpos($eng_lower, $w_char) !== false || 
                                    strpos($eng_upper, $w_char) !== false ) {
                                    $has_letter = true;
                                    break;
                                }
                            }
                            if( $has_letter ) {
                                $word_lower = strtr($word, $rus_upper, $rus_lower);
                                $word_lower = strtolower($word_lower);
                                
                                if( isset($words[$word_lower]) )
                                    $words[$word_lower]++;
                                else
                                    $words[$word_lower] = 1;
                            }
                        }
                        $word = '';
                    } else {
                        $word .= $char;
                    }
                }

                echo '<table class="result-table">';
                echo '<tr><th>Параметр</th><th>Значение</th></tr>';
                echo '<tr><td>Количество символов</td><td>' . strlen($text) . '</td></tr>';
                echo '<tr><td>Количество букв (всего)</td><td>' . $letters_total . '</td></tr>';
                echo '<tr><td>Строчных букв</td><td>' . $letters_lower . '</td></tr>';
                echo '<tr><td>Заглавных букв</td><td>' . $letters_upper . '</td></tr>';
                echo '<tr><td>Количество знаков препинания</td><td>' . $punct_amount . '</td></tr>';
                echo '<tr><td>Количество цифр</td><td>' . $cifra_amount . '</td></tr>';
                echo '<tr><td>Количество слов</td><td>' . count($words) . '</td></tr>';

                $symbs = test_symbs( $text );

                echo '<tr><th colspan="2">Вхождения символов (без учета регистра)</th></tr>';
                if( !empty($symbs) ) {
                    foreach( $symbs as $char => $count ) {
                        if( $char == ' ' ) {
                            echo '<tr><td>(пробел)</td><td>' . $count . '</td></tr>';
                        } else {
                            echo '<tr><td>' . iconv("CP1251", "UTF-8", $char) . '</td><td>' . $count . '</td></tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="2">Нет символов для отображения</td></tr>';
                }

                ksort($words);

                echo '<tr><th colspan="2">Вхождения слов (отсортировано по алфавиту)</th></tr>';
                if( !empty($words) ) {
                    foreach( $words as $w => $cnt ) {
                        echo '<tr><td>' . iconv("CP1251", "UTF-8", $w) . '</td><td>' . $cnt . '</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">Нет слов для отображения</td></tr>';
                }

                echo '</table>';

            }

            if( isset($_POST['data']) && $_POST['data'] ) {
                test_it( iconv("UTF-8", "CP1251", $_POST['data']) );
            } else {
                echo '<div class="src_error">Нет текста для анализа</div>';
            }
            ?>
            <a href="index8.html" class="back-link">Другой анализ</a>
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