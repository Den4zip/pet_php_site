<?php
// This is the protected content for logged-in users.
// We will move the original content from index.php here.

// Page variables
$pageTitle = "Электрогитары - Ваш Магазин Мечты";
$shopName = "GuitarShop";

// Products array
$products = [
    [
        'name' => 'Fender Stratocaster',
        'description' => 'Классический звук и неповторимый стиль.',
        'price' => '$1200',
        'image' => 'https://via.placeholder.com/300x200?text=Fender+Strat'
    ],
    [
        'name' => 'Gibson Les Paul',
        'description' => 'Мощный тон и легендарное качество.',
        'price' => '$1800',
        'image' => 'https://via.placeholder.com/300x200?text=Gibson+Les+Paul'
    ],
    [
        'name' => 'Ibanez RG Series',
        'description' => 'Идеально для рока и металла.',
        'price' => '$950',
        'image' => 'https://via.placeholder.com/300x200?text=Ibanez+RG'
    ]
];

include 'partials/header.php';
?>

<section id="home" class="hero">
    <h1>Найдите Свою Идеальную Электрогитару</h1>
    <p>Широкий выбор инструментов для музыкантов всех уровней.</p>
    <a href="#products" class="btn">Посмотреть Каталог</a>
</section>

<div class="container">
    <section id="products">
        <h2 class="section-title">Наши Хиты Продаж</h2>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Цена: <?php echo htmlspecialchars($product['price']); ?></p>
                    <a href="#" class="btn">Подробнее</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="about" class="about-us">
        <h2 class="section-title">О Нашем Магазине</h2>
        <p>Добро пожаловать в <?php echo $shopName; ?> – ваш ultimate пункт назначения для всех видов электрогитар. Мы предлагаем широкий ассортимент инструментов от ведущих мировых производителей, а также эксклюзивные модели и аксессуары. Наша миссия — помочь каждому музыканту найти свой идеальный инструмент.</p>
        <p>Наша команда состоит из опытных гитаристов и экспертов, готовых проконсультировать вас по любому вопросу и помочь сделать правильный выбор.</p>
    </section>

    <section id="contact" class="contact">
        <h2 class="section-title">Свяжитесь с Нами</h2>
        <form action="" method="post">
            <label for="name">Ваше имя:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Ваш Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Сообщение:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Отправить Сообщение</button>
        </form>
    </section>
</div>

<?php include 'partials/footer.php'; ?>
