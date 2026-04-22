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
            <form action="sort7.php" method="POST" target="_blank">
                <h2>Ввод массива и выбор алгоритма сортировки</h2>
                <table id="elements">
                    <tr>
                        <td class="element_number">0</td>
                        <td class="element_row"><input type="text" name="element0"></td>
                    </tr>
                </table>

                <input type="hidden" id="arrLength" name="arrLength" value="1">

                <input type="button" value="Добавить еще один элемент" onclick="addElement()">

                <br><br>

                <label for="algoritm">Выберите алгоритм сортировки:</label>
                <select name="algoritm" id="algoritm">
                    <option value="choice">Сортировка выбором</option>
                    <option value="bubble">Пузырьковый алгоритм</option>
                    <option value="shell">Алгоритм Шелла</option>
                    <option value="gnome">Алгоритм садового гнома</option>
                    <option value="quick">Быстрая сортировка</option>
                    <option value="php">Встроенная функция PHP для сортировки списков по значению</option>
                </select>

                <br><br>

                <input type="submit" value="Сортировать массив">
            </form>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <span>2026 Московский Политех</span>
            <span>Друдэ И.В., 241-353</span>
        </div>
    </footer>
    <script>
    function addElement() {
        const table = document.getElementById('elements');
        const index = table.rows.length;

        const row = table.insertRow(index);

        const cellNumber = row.insertCell(0);
        cellNumber.className = 'element_number';
        cellNumber.textContent = index;

        const cellInput = row.insertCell(1);
        cellInput.className = 'element_row';
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'element' + index;
        cellInput.appendChild(input);

        document.getElementById('arrLength').value = index + 1;
    }
    </script>
</body>
</html>