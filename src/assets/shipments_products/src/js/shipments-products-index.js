let $addProductBtn, $formSubmitCancel, $productForm, $productId, $storageCellsContainer;

$(document).ready(function() {
    $addProductBtn = $('#add-product');
    $formSubmitCancel = $('.form-submit .cancel');
    $productForm = $('#save-product-form');

    $productId = $('#save-productid');
    $storageCellsContainer = $('#save-storage-cells-container');

    // region Form buttons

    $addProductBtn.on('click', function() {
        $addProductBtn.hide()
        $productForm.show();

        return false;
    });

    $formSubmitCancel.on('click', function() {
        $addProductBtn.show();
        $productForm.hide();

        return false;
    });

    // endregion

    $productId.on('select2:select', function () {
        updateStorageCellsContainer();
    });
})

function updateStorageCellsContainer() {
    let productId = $productId.val()

    if (isNaN(productId)) {
        $storageCellsContainer.addClass('d-none');
        $storageCellsContainer.empty()
        return;
    }

    $.get('/shipments-products/products-storage-cells?productId=' + productId, function(response) {
        $storageCellsContainer.html(response);
        $storageCellsContainer.removeClass('d-none');
    });
}

