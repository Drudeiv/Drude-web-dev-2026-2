<?php
$store = '';
$count = 0;
if (isset($_GET['store'])) {
    $store = $_GET['store'];
    if (isset($_GET['count'])) {
        $count = intval($_GET['count']);
    }
    if (isset($_GET['key'])) {
        if ($_GET['key'] === 'reset') {
            $store = '';
        } else {
            $store .= $_GET['key'];
        }
        $count++;
    }
} else {
    $store = '';
    $count = 0;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Друдэ Ирина Викторовна, 241-353 | Лабораторная работа №3</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <header class="site-header">
        <div class="header-container">
            <img src="images/logo.jpg" alt="Логотип университета" class="logo">
            <div class="header-info">
                <h1>Друдэ Ирина Викторовна</h1>
                <p>Группа: 241-353 | Лабораторная работа №3</p>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="content-wrapper">
            <div class="result"><?php echo $store; ?></div>

            <div class="keyboard">
                <?php
                foreach ([1,2,3,4,5] as $digit) {
                    echo '<a class="key" href="?key='.$digit.'&store='.$store.'&count='.$count.'">'.$digit.'</a>';
                }
                echo '<br>';
                foreach ([6,7,8,9,0] as $digit) {
                    echo '<a class="key" href="?key='.$digit.'&store='.$store.'&count='.$count.'">'.$digit.'</a>';
                }
                echo '<br>';
                ?>
                <a class="key key-reset" href="?key=reset&store=<?php echo $store; ?>&count=<?php echo $count; ?>">СБРОС</a>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <span>Нажатий: <?php echo $count; ?></span>
        </div>
    </footer>
</body>
</html>