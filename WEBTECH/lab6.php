<?php
// Перевіряємо, чи була надіслана форма
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $q1 = htmlspecialchars($_POST['q1']);
    $q2 = htmlspecialchars($_POST['q2']);
    
    // Створюємо масив даних
    $data = [
        'timestamp' => date("Y-m-d H:i:s"),
        'name' => $name,
        'email' => $email,
        'answers' => [
            'How comfortable are you with HTML?' => $q1,
            'Favorite Lab so far?' => $q2
        ]
    ];

    // Створюємо папку survey якщо її немає
    if (!file_exists('survey')) {
        mkdir('survey', 0777, true);
    }

    // Зберігаємо у файл JSON (ім'я файлу = дата_час)
    $filename = 'survey/response_' . date("Y-m-d_H-i-s") . '.json';
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $message = "Дякуємо, {$name}! Вашу відповідь збережено о " . date("H:i:s");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>ЛР 6 - PHP Форма</title>
    <link rel="stylesheet" href="lab6.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="index.html">Головна</a></li>
            <li><a href="lab5.html">ЛР 5 (JS)</a></li>
            <li><a href="lab6.php">ЛР 6 (PHP)</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Завдання ЛР 6: PHP Опитування</h1>

        <?php if ($message): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px;">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="lab6.php" method="POST">
            <label for="name">Ваше Ім'я:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Ваш Email:</label>
            <input type="email" id="email" name="email" required>

            <h3>Питання 1: Наскільки добре ви знаєте HTML?</h3>
            <select name="q1">
                <option value="Novice">Початківець</option>
                <option value="Intermediate">Середній рівень</option>
                <option value="Pro">Профі</option>
            </select>

            <h3>Питання 2: Яка лабораторна сподобалась найбільше?</h3>
            <select name="q2">
                <option value="LR3">ЛР 3 (Хостинг)</option>
                <option value="LR4">ЛР 4 (CSS)</option>
                <option value="LR5">ЛР 5 (JS)</option>
            </select>

            <button type="submit">Надіслати відповідь</button>
        </form>

        <hr>
        <h3>Теорія (Завдання 6)</h3>
        <ul>
            <li><code>include</code>: Включає файл. Якщо помилка — видає попередження, скрипт працює далі.</li>
            <li><code>require</code>: Включає файл. Якщо помилка — фатальна помилка, скрипт зупиняється.</li>
            <li><code>include_once</code> / <code>require_once</code>: Те саме, але перевіряє, чи файл вже був підключений, щоб не дублювати.</li>
        </ul>
    </div>

</body>
</html>