<?php
session_start();
require_once 'db.php';

$errors = [];
$username = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($username)) {
        $errors[] = 'Имя пользователя обязательно';
    }
    if (empty($password)) {
        $errors[] = 'Пароль обязателен';
    }
    if ($password !== $password_confirm) {
        $errors[] = 'Пароли не совпадают';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Пароль должен содержать не менее 6 символов';
    }

    // Check if username already exists
    if (empty($errors)) {
        try {
            $pdo = get_db_connection();
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $errors[] = 'Имя пользователя уже занято';
            }
        } catch (PDOException $e) {
            $errors[] = "Ошибка базы данных: " . $e->getMessage();
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = get_db_connection();
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);
            
            $success_message = 'Регистрация прошла успешно! Теперь вы можете <a href="login.php">войти</a>.';
            $username = ''; // Clear username on success
        } catch (PDOException $e) {
            $errors[] = "Ошибка регистрации: " . $e->getMessage();
        }
    }
}

$pageTitle = 'Регистрация';
include 'partials/header.php';
?>

<div class="auth-form">
    <h2 class="section-title">Регистрация</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <p><?php echo $success_message; ?></p>
        </div>
    <?php else: ?>
        <form action="register.php" method="post">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirm">Подтвердите пароль:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>

            <button type="submit">Зарегистрироваться</button>
        </form>
    <?php endif; ?>
    <p>Уже есть аккаунт? <a href="login.php">Войдите</a></p>
</div>

<?php include 'partials/footer.php'; ?>
