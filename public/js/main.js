$(document).ready(function() {
    $('.category-link').on('click', function(event) {
        event.preventDefault();
        $('.category-link').removeClass('active');
        $(this).addClass('active');
        const categoryId = $(this).data('id');
        fetchProducts(categoryId, $('#sort-select').val());
        updateURL(categoryId, $('#sort-select').val());
    });

    $('#sort-select').on('change', function() {
        const categoryId = $('.category-link.active').data('id') || '';
        const orderBy = $(this).val();
        fetchProducts(categoryId, orderBy);
        updateURL(categoryId, orderBy);
    });

    function fetchProducts(categoryId = '', orderBy = 'price') {
        $.ajax({
            url: '/products/fetch-products',
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
                                <button class="btn btn-primary btn-buy" data-id="${product.id}">Buy</button>
                            </div>
                        </div>`;
                    $productList.append(productCard);
                });
            }
        });
    }

    $('#product-list').on('click', '.btn-buy', function() {
        const productId = $(this).data('id');
        $.ajax({
            url: '/products/fetch-product',
            type: 'GET',
            data: { id: productId },
            success: function(data) {
                const modalBody = $('#productModal .modal-body');
                modalBody.html(`<h5>${data.name}</h5><p>${data.price} USD</p>`);
                $('#productModal').modal('show');
            }
        });
    });

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

    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('category') || '';
    const orderBy = urlParams.get('order') || 'price';
    if (categoryId) {
        $(`.category-link[data-id="${categoryId}"]`).addClass('active');
    }
    $('#sort-select').val(orderBy);
    fetchProducts(categoryId, orderBy);

    $('.tree li').each(function() {
        if ($(this).children('ul').length > 0) {
            $(this).addClass('parent');
            $(this).children('ul').hide();
        }
    });

    $('.tree li.parent').click(function(e) {
        e.stopPropagation();
        $(this).children('ul').toggle();
        $(this).toggleClass('open');
    });
});
