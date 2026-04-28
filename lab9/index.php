<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка | Друдэ Ирина Викторовна | Лабораторная работа № 9</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Записная книжка</h1>
        </div>
    </header>

    <div class="container">
        <nav>
            <?php
            require 'menu.php';
            ?>
        </nav>
        
        <main>
            <?php
            if( $_GET['p'] == 'viewer' )
            {
                include 'viewer.php';

                if( !isset($_GET['pg']) || $_GET['pg'] < 0 )
                    $_GET['pg'] = 0;

                if( !isset($_GET['sort']) || 
                    ($_GET['sort'] != 'byid' && $_GET['sort'] != 'fam' && $_GET['sort'] != 'birth') )
                    $_GET['sort'] = 'byid';

                echo getFriendsList($_GET['sort'], $_GET['pg']);
            }
            else
            {
                if( file_exists($_GET['p'].'.php') )
                {
                    include $_GET['p'].'.php';
                }
            }
            ?>
        </main>
    </div>
    <footer>
        <p>Лабораторная работа № 9 | Записная книжка</p>
    </footer>
</body>
</html>