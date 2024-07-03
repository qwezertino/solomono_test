<div class="row">
    <div class="col-md-3">
        <ul class="list-group">
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item">
                    <a href="#" class="category-link" data-id="<?= $category['id'] ?>"><?= $category['name'] ?> (<?= $category['product_count'] ?>)</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-9">
        <select id="sort-select" class="form-control mb-3">
            <option value="price">Sort by price</option>
            <option value="name">Sort by name</option>
            <option value="created_at">Sort by newest</option>
        </select>
        <div id="product-list">
            <?php foreach ($products as $product): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['price'] ?> USD</p>
                        <button class="btn btn-primary buy-btn" data-id="<?= $product['id'] ?>">Buy</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
