<?php

session_start();
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: product.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: product.php');
    exit;
}

$relStmt = $pdo->prepare(
    "SELECT * FROM products WHERE category = ? AND id != ? ORDER BY RAND() LIMIT 3"
);
$relStmt->execute([$product['category'], $id]);
$related = $relStmt->fetchAll();

include_once 'header.php';
?>

<div class="container">

    <div class="breadcrumb">
        <a href="index.php">Home</a> &rsaquo;
        <a href="product.php">Products</a> &rsaquo;
        <a href="product.php?category=<?php echo urlencode($product['category']); ?>">
            <?php echo htmlspecialchars($product['category']); ?>
        </a> &rsaquo;
        <span><?php echo htmlspecialchars($product['name']); ?></span>
    </div>

    <!-- ---- Main product layout ---- -->
    <div class="product-detail">

        <!-- Left: product image -->
        <div class="product-detail-image">
            <img src="<?php echo htmlspecialchars($product['image']); ?>"
                 alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>

        <!-- Right: product info -->
        <div class="product-detail-info">
            <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="product-detail-price">Rs. <?php echo number_format($product['price'], 2); ?></p>

            <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>

            <!-- Stock status -->
            <p class="stock-status <?php echo $product['stock'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                <?php echo $product['stock'] > 0
                    ? '✓ In Stock (' . $product['stock'] . ' available)'
                    : '✗ Out of Stock'; ?>
            </p>

            <!-- Add to Cart button -->
            <?php if ($product['stock'] > 0): ?>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity"
                               value="1" min="1" max="<?php echo $product['stock']; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            <?php else: ?>
                <button class="btn btn-disabled" disabled>Out of Stock</button>
            <?php endif; ?>

            <a href="product.php" class="btn btn-outline" style="margin-top: 10px; display: inline-block;">
                ← Back to Products
            </a>
        </div>
    </div>

    <!-- ---- Related products ---- -->
    <?php if (!empty($related)): ?>
        <div class="related-products">
            <h2>You might also like</h2>
            <div class="product-grid">
                <?php foreach ($related as $rel): ?>
                    <a href="product_detail.php?id=<?php echo $rel['id']; ?>" class="product-card">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($rel['image']); ?>"
                                 alt="<?php echo htmlspecialchars($rel['name']); ?>">
                        </div>
                        <div class="product-info">
                            <span class="product-category"><?php echo htmlspecialchars($rel['category']); ?></span>
                            <h3 class="product-name"><?php echo htmlspecialchars($rel['name']); ?></h3>
                            <p class="product-price">Rs. <?php echo number_format($rel['price'], 2); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include_once 'footer.php'; ?>