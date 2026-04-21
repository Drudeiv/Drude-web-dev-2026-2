<?php

$show_results = false;

if (isset($_POST['A'])) {
    $show_results = true;
    $a = str_replace(',', '.', $_POST['A']);
    $b = str_replace(',', '.', $_POST['B']);
    $c = str_replace(',', '.', $_POST['C']);
    $user_answer = str_replace(',', '.', $_POST['result']);

    $task = $_POST['TASK'];
    $calculated_result = 0;
    $task_name = '';
    
    if ($task == 'square') {
        $p = ($a + $b + $c) / 2;
        $calculated_result = sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
        $task_name = 'Площадь треугольника (формула Герона)';
    }
    elseif ($task == 'perimeter') {
        $calculated_result = $a + $b + $c;
        $task_name = 'Периметр треугольника';
    }
    elseif ($task == 'volume') {
        $calculated_result = $a * $b * $c;
        $task_name = 'Объем параллелепипеда';
    }
    elseif ($task == 'average') {
        $calculated_result = ($a + $b + $c) / 3;
        $task_name = 'Среднее арифметическое';
    }
    elseif ($task == 'hypotenuse') {
        $calculated_result = sqrt($a * $a + $b * $b);
        $task_name = 'Гипотенуза прямоугольного треугольника';
    }
    elseif ($task == 'max') {
        $calculated_result = max($a, $b, $c);
        $task_name = 'Максимальное из трех чисел';
    }
    
    $calculated_result = round($calculated_result, 2);

    $fio = $_POST['FIO'];
    $group = $_POST['GROUP'];
    $about = isset($_POST['ABOUT']) ? $_POST['ABOUT'] : '';
    $version = $_POST['VERSION'];
    
    $user_answer_rounded = round((float)$user_answer, 2);
    $test_passed = ($user_answer_rounded == $calculated_result);
    
    $out_text = '';
    $out_text .= "ФИО: $fio<br>";
    $out_text .= "Группа: $group<br>";
    
    if (!empty($about)) {
        $out_text .= "<br>$about<br>";
    }
    $out_text .= "Решаемая задача: $task_name<br>";
    $out_text .= "Входные данные: A = $a, B = $b, C = $c<br>";
    
    if ($user_answer === '') {
        $out_text .= "Задача самостоятельно решена не была<br>";
    } else {
        $out_text .= "Предполагаемый результат: $user_answer<br>";
    }
    
    $out_text .= "Вычисленный программой результат: $calculated_result<br>";
    $out_text .= "<br>";

    if ($test_passed) {
        $out_text .= "<b>Тест пройден</b><br>";
    } else {
        $out_text .= "<b>Ошибка: тест не пройден</b><br>";
    }
    
    $mail_sent = false;
    if (isset($_POST['send_mail']) && !empty($_POST['MAIL'])) {
        $to = $_POST['MAIL'];
        $subject = 'Результаты тестирования';
        $message = str_replace('<br>', "\r\n", $out_text);
        $headers = "From: auto@mani.ru\nContent-Type: text/plain; charset=utf-8\n";
        
        @mail($to, $subject, $message, $headers);
        $mail_sent = true;
    }
    
    $output_report = $out_text;
    
    if ($mail_sent) {
        $output_report .= "<br>Результаты теста были автоматически отправлены на e-mail: " . $_POST['MAIL'] . "<br>";
    }
}

$default_A = mt_rand(0, 10000) / 100;
$default_B = mt_rand(0, 10000) / 100;
$default_C = mt_rand(0, 10000) / 100;

$fio_value = isset($_GET['F']) ? $_GET['F'] : '';
$group_value = isset($_GET['G']) ? $_GET['G'] : '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №6</title>
    <link rel="stylesheet" href="styles6.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №6</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <?php
            if ($show_results) {
                echo '<div class="results-block' . ($_POST['VERSION'] == 'print' ? ' print-version' : '') . '">';
                echo '<h2>Результаты теста</h2>';
                echo $output_report;
                
                if ($_POST['VERSION'] == 'browser') {
                    echo '<br>';
                    echo '<a href="?F=' . $_POST['FIO'] . '&G=' . $_POST['GROUP'] . '" class="repeat-button">Повторить тест</a>';
                }
                echo '</div>';
            } else {
                ?>
                <h2>Форма для ввода данных</h2>
                <form method="post" action="" class="test-form">
                    <div class="form-grid">
                        <label for="fio">ФИО:</label>
                        <input type="text" id="fio" name="FIO" value="<?php echo $fio_value; ?>" required>

                        <label for="group">Номер группы:</label>
                        <input type="text" id="group" name="GROUP" value="<?php echo $group_value; ?>" required>

                        <label for="val_a">Значение A:</label>
                        <input type="text" id="val_a" name="A" value="<?php echo $default_A; ?>" required>

                        <label for="val_b">Значение B:</label>
                        <input type="text" id="val_b" name="B" value="<?php echo $default_B; ?>" required>

                        <label for="val_c">Значение C:</label>
                        <input type="text" id="val_c" name="C" value="<?php echo $default_C; ?>" required>

                        <label for="user_answer">Ваш ответ:</label>
                        <input type="text" id="user_answer" name="result" placeholder="Введите ваш ответ">

                        <label for="about">Немного о себе:</label>
                        <textarea id="about" name="ABOUT" rows="4" placeholder="Расскажите немного о себе..."></textarea>

                        <label for="task">Выберите задачу:</label>
                        <select id="task" name="TASK">
                            <option value="square">Площадь треугольника (по формуле Герона)</option>
                            <option value="perimeter">Периметр треугольника</option>
                            <option value="volume">Объем параллелепипеда</option>
                            <option value="average">Среднее арифметическое</option>
                            <option value="hypotenuse">Гипотенуза прямоугольного треугольника</option>
                            <option value="max">Максимальное из трех чисел</option>
                        </select>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="send_mail" name="send_mail" onclick="
                            obj = document.getElementById('email-container');
                            if (this.checked)
                                obj.style.display = 'flex';
                            else
                                obj.style.display = 'none';
                        ">
                        <label for="send_mail">Отправить результат теста по e-mail</label>
                    </div>

                    <div id="email-container" class="email-container hidden">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="MAIL" placeholder="example@mail.ru">
                    </div>

                    <div class="form-grid">
                        <label for="version">Версия:</label>
                        <select id="version" name="VERSION">
                            <option value="browser">Версия для просмотра в браузере</option>
                            <option value="print">Версия для печати</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="submit-button">Проверить</button>
                </form>
                <?php
            }
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