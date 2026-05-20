<?php

require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY RAND() LIMIT 4");
$featured = $stmt->fetchAll();
?>

<!-- ---- Hero Section ---- -->
<div class="hero">
    <div class="hero-content">
        <h1>Style That Speaks</h1>
        <p>Discover curated fashion for every occasion — minimal, modern, and made for you.</p>
        <a href="product.php" class="btn btn-primary">Shop Now</a>
    </div>
</div>

<!-- ---- Featured Products Section ---- -->
<div class="container">
    <div class="section-header">
        <h2>Featured Products</h2>
        <a href="product.php" class="view-all">View All →</a>
    </div>

    <div class="product-grid">
        <?php foreach ($featured as $product): ?>
            <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="product-card">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>"
                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-info">
                    <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
                    <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-price">Rs. <?php echo number_format($product['price'], 2); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- ---- Category Quick Links ---- -->
    <div class="category-section">
        <h2>Shop by Category</h2>
        <div class="category-cards">
            <a href="product.php?category=Men" class="category-card">
                <span class="category-icon">👔</span>
                <span>Men</span>
            </a>
            <a href="product.php?category=Women" class="category-card">
                <span class="category-icon">👗</span>
                <span>Women</span>
            </a>
            <a href="product.php?category=Accessories" class="category-card">
                <span class="category-icon">👜</span>
                <span>Accessories</span>
            </a>
        </div>
    </div>
</div>