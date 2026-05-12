<?php
session_start();

if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = array();
    $_SESSION['iteration'] = 0;
}
$_SESSION['iteration']++;

function isnum($x) {
    $x = (string)$x; 
    if ($x === '0') return true;
    if ($x === '') return false;
    $is_minus = false;
    if ($x[0] == '-') {
        $is_minus = true;
        $x = substr($x, 1);
        if ($x === '') return false;
    }
    if ($x[0] == '.' || $x[0] == '0') return false;
    
    if ($x[strlen($x) - 1] == '.') return false;
    
    for ($i = 0, $point_count = false; $i < strlen($x); $i++) {
        if ($x[$i] != '0' && $x[$i] != '1' && $x[$i] != '2' && $x[$i] != '3' &&
            $x[$i] != '4' && $x[$i] != '5' && $x[$i] != '6' && $x[$i] != '7' &&
            $x[$i] != '8' && $x[$i] != '9' && $x[$i] != '.')
            return false;
        if ($x[$i] == '.') {
            if ($point_count)
                return false;
            else
                $point_count = true;
        }
    }
    return true;
}

function calculate($val) {
    if ($val === '' || $val === null) return 'Выражение не задано!';
    if (isnum($val)) return $val;

    $args = explode('+', $val);
    if (count($args) > 1) {
        $sum = 0;
        for ($i = 0; $i < count($args); $i++) {
            $arg = calculate($args[$i]);
            if (!isnum($arg)) return $arg;
            $sum += $arg;
        }
        return $sum;
    }

    $args = explode('-', $val);
    if (count($args) > 1) {
        $arg = calculate($args[0]);
        if (!isnum($arg)) return $arg;
        $sub = $arg;
        for ($i = 1; $i < count($args); $i++) {
            $arg = calculate($args[$i]);
            if (!isnum($arg)) return $arg;
            $sub -= $arg;
        }
        return $sub;
    }

    $args = explode('*', $val);
    if (count($args) > 1) {
        $sup = 1;
        for ($i = 0; $i < count($args); $i++) {
            $arg = $args[$i];
            if (!isnum($arg)) return 'Неправильная форма числа!';
            $sup *= $arg;
        }
        return $sup;
    }

    $val_div = str_replace(':', '/', $val);
    $args = explode('/', $val_div);
    if (count($args) > 1) {
        $arg = calculate($args[0]);
        if (!isnum($arg)) return $arg;
        $div_res = $arg;
        for ($i = 1; $i < count($args); $i++) {
            $arg = calculate($args[$i]);
            if (!isnum($arg)) return $arg;
            if ($arg == 0) return 'Деление на ноль!'; 
            $div_res /= $arg;
        }
        return $div_res;
    }
    return 'Недопустимые символы в выражении';
}

function SqValidator($val) {
    $open = 0;
    
    for ($i = 0; $i < strlen($val); $i++) {
        if ($val[$i] == '(') {
            $open++;
        } elseif ($val[$i] == ')') {
            $open--;
            if ($open < 0) return false;
        }
    }
    if ($open !== 0) return false;
    return true;
}

function calculateSq($val) {
    if (!SqValidator($val)) return 'Неправильная расстановка скобок';
    $start = strpos($val, '(');

    if ($start === false) {
        return calculate($val);
    }
    $end = $start + 1;
    $open = 1;
    
    while ($open && $end < strlen($val)) {
        if ($val[$end] == '(') $open++;
        elseif ($val[$end] == ')') $open--;
        $end++;
    }

    $new_val = substr($val, 0, $start);
    $inner = calculateSq(substr($val, $start + 1, $end - $start - 2));
    if (!isnum($inner)) return $inner;
    $new_val .= $inner;
    $new_val .= substr($val, $end);
    return calculateSq($new_val);
}

$res = '';
if (isset($_POST['val'])) {
    $res = calculateSq($_POST['val']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №10</title>
    <link rel="stylesheet" href="styles10.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №10</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <?php
            if (isset($_POST['val'])) {
                if (isnum($res)) {
                    echo 'Значение выражения: ' . $res;
                } else {
                    echo 'Ошибка вычисления выражения: ' . $res;
                }
            }
            ?>
            <form method="post" class="calc-form">
                <label for="val">Введите выражение:</label>
                <input type="text" id="val" name="val" required>
                <input type="hidden" name="iteration" value="<?php echo $_SESSION['iteration']; ?>">
                <button type="submit">Вычислить</button>
            </form>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="history-block">
                <h3>История вычислений</h3>
                <?php
                for ($i = 0; $i < count($_SESSION['history']); $i++) {
                    echo $_SESSION['history'][$i] . '<br>';
                }
                if (isset($_POST['val']) && $_POST['iteration'] + 1 == $_SESSION['iteration']) {
                    $_SESSION['history'][] = $_POST['val'] . ' = ' . $res;
                }
                ?>
            </div>
        </div>
    </footer>
</body>
</html>