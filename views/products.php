<?php /** @var $categories \app\models\Category[] */ ?>
<?php /** @var $products \app\models\Product[] */ ?>
<?php /** @var $selectedCategory int */ ?>
<?php /** @var $selectedOrder string */ ?>

<div class="row">
    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item active">Categories</li>
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item <?php echo $category['id'] == $selectedCategory ? 'active' : '' ?>">
                    <a href="#" class="category-link" data-id="<?php echo $category['id'] ?>">
                        <?php echo $category['name'] ?>
                        <span class="badge badge-primary badge-pill"><?php echo $category['product_count'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <select id="sort-select" class="form-control">
                <option value="">Sort by</option>
                <option value="price_asc" <?php echo $selectedOrder == 'price_asc' ? 'selected' : '' ?>>Price (Low to High)</option>
                <option value="price_desc" <?php echo $selectedOrder == 'price_desc' ? 'selected' : '' ?>>Price (High to Low)</option>
                <option value="name" <?php echo $selectedOrder == 'name' ? 'selected' : '' ?>>Name</option>
                <option value="newest" <?php echo $selectedOrder == 'newest' ? 'selected' : '' ?>>Newest</option>
            </select>
        </div>
        <div id="product-list" class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name'] ?></h5>
                            <p class="card-text">$<?php echo number_format($product['price'], 2) ?></p>
                            <button class="btn btn-primary btn-buy" data-id="<?php echo $product['id'] ?>">Buy</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
