<?php
session_start();
require_once 'db.php';

$category = $_GET['category'] ?? '';

if (!empty($category)) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? ORDER BY created_at DESC");
    $stmt->execute([$category]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY created_at DESC");
    $stmt->execute();
}

$products = $stmt->fetchAll();

$catStmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);

include_once 'header.php';
?>

<div class="container">

    <div class="page-header">
        <h1>Our Products</h1>
        <p>Discover our latest collection</p>
    </div>

    <div class="category-filters">
        <a href="product.php" class="filter-btn <?php echo empty($category) ? 'active' : ''; ?>">All</a>
        <?php foreach ($categories as $cat): ?>
            <a href="product.php?category=<?php echo urlencode($cat); ?>"
               class="filter-btn <?php echo $category === $cat ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($products)): ?>
        <div class="no-products">
            <p>No products found in this category.</p>
            <a href="product.php">View all products</a>
        </div>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>"
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="product-info">
                        <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
                        <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-price">Rs. <?php echo number_format($product['price'], 2); ?></p>
                        <span class="product-stock">
                            <?php echo $product['stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php include_once 'footer.php'; ?>