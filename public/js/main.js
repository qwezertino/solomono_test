$(document).ready(function() {
    // Handle category link click
    $('.category-link').on('click', function(event) {
        event.preventDefault();
        const categoryId = $(this).data('id');
        fetchProducts(categoryId);
        updateURL(categoryId, $('#sort-select').val());
    });

    // Handle sort select change
    $('#sort-select').on('change', function() {
        const categoryId = $('.category-link.active').data('id') || '';
        const orderBy = $(this).val();
        fetchProducts(categoryId, orderBy);
        updateURL(categoryId, orderBy);
    });

    // Fetch products based on category and sorting
    function fetchProducts(categoryId = '', orderBy = 'price') {
        $.ajax({
            url: '/products/getProducts',
            type: 'GET',
            data: { category: categoryId, order: orderBy },
            success: function(data) {
                const products = data.products;
                const $productList = $('#product-list');
                $productList.empty();
                products.forEach(product => {
                    const productCard = `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.price} USD</p>
                                <button class="btn btn-primary buy-btn" data-id="${product.id}">Buy</button>
                            </div>
                        </div>`;
                    $productList.append(productCard);
                });
            }
        });
    }

    // Handle buy button click
    $('#product-list').on('click', '.buy-btn', function() {
        const productId = $(this).data('id');
        $.ajax({
            url: '/products/getProduct',
            type: 'GET',
            data: { id: productId },
            success: function(data) {
                const modalBody = $('#productModal .modal-body');
                modalBody.html(`<h5>${data.name}</h5><p>${data.price} USD</p>`);
                $('#productModal').modal('show');
            }
        });
    });

    // Update URL with category and sorting parameters
    function updateURL(categoryId = '', orderBy = 'price') {
        const url = new URL(window.location.href);
        if (categoryId) {
            url.searchParams.set('category', categoryId);
        } else {
            url.searchParams.delete('category');
        }
        url.searchParams.set('order', orderBy);
        window.history.pushState({}, '', url);
    }

    // On page load, fetch products based on URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('category') || '';
    const orderBy = urlParams.get('order') || 'price';
    if (categoryId) {
        $(`.category-link[data-id="${categoryId}"]`).addClass('active');
    }
    $('#sort-select').val(orderBy);
    fetchProducts(categoryId, orderBy);
});
