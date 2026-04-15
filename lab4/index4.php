<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №4</title>
    <link rel="stylesheet" href="styles4.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №4</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <?php
            $numCols = 3;

            $structures = array(
                'Яблоко*Груша*Слива#Банан*Манго*Киви',
                /*'Красный*Синий*Зелёный##Жёлтый*Белый*Чёрный'*/
                /*'###'*/
                /*'',*/
                'Кот*Пёс*Кролик#Хомяк*Черепаха*Попугай',
                'Красный*Синий*Зелёный#Жёлтый*Белый*Чёрный',
                'Январь*Февраль*Март#Апрель*Май*Июнь',
                'Понедельник*Вторник*Среда#Четверг*Пятница*Суббота',
                'Москва*Лондон*Париж#Берлин*Токио*Рим',
                'PHP*HTML*CSS#JavaScript*Python*Java',
                'Один*Два*Три#Четыре*Пять*Шесть',
                'Альфа*Бета*Гамма#Дельта*Эпсилон*Дзета',
                'Стол*Стул*Диван#Шкаф*Кровать*Полка',
            );

            function getTR($rowData, $numCols) {
                $cells = explode('*', $rowData);
                if (count($cells) === 0 || (count($cells) === 1 && $cells[0] === '')) {
                    return '';
                }
                $ret = '<tr>';
                for ($i = 0; $i < $numCols; $i++) {
                    $ret .= '<td>' . (isset($cells[$i]) ? $cells[$i] : '') . '</td>';
                }
                $ret .= '</tr>';
                return $ret;
            }

            function outTable($structure, $numCols) {
                $rows = explode('#', $structure);
                if (count($rows) === 0 || (count($rows) === 1 && $rows[0] === '')) {
                    echo '<p class="warning">В таблице нет строк</p>';
                    return;
                }
                $datas = '';
                for ($i = 0; $i < count($rows); $i++) {
                    $datas .= getTR($rows[$i], $numCols);
                }
                if ($datas === '') {
                    echo '<p class="warning">В таблице нет строк с ячейками</p>';
                    return;
                }
                echo '<table>' . $datas . '</table>';
            }

            if ($numCols == 0) {
                echo '<p class="warning">Неправильное число колонок</p>';
            } else {
                for ($i = 0; $i < count($structures); $i++) {
                    echo '<h2>Таблица №' . ($i + 1) . '</h2>';
                    outTable($structures[$i], $numCols);
                }
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