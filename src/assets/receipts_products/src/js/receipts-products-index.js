let $addProductBtn, $formSubmitCancel, $productForm, $packagesAmount, $productId, $series, $storageCellsContainer;

$(document).ready(function() {
    $addProductBtn = $('#add-product');
    $formSubmitCancel = $('.form-submit .cancel');
    $productForm = $('#save-product-form');

    $packagesAmount = $('#save-packagesamount');
    $productId = $('#save-productid');
    $series = $('#save-series');
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

    $packagesAmount.on('change', function() {
        let $this = $(this);
        let value = parseInt($this.val());
        if (isNaN(value) || value < 1) {
            value = '';
        }
        $this.val(value);

        updateStorageCellsContainer();
    });

    $productId.on('select2:select', function () {
        updateStorageCellsContainer();
    });

    $series.on('select2:select', function () {
        updateStorageCellsContainer();
    });

    if (!$storageCellsContainer.hasClass('d-none')) {
        initStorageCellsContainerEvents();

        let totalSelectedAmount = 0;
        $('.storage-cell.table-success', $storageCellsContainer).each(function() {
            let $storageCell = $(this);
            totalSelectedAmount += parseInt($('input', $storageCell).val());
        });
        let $selectedAmount = $('#storage-cells-widget-packages-amount .selected', $storageCellsContainer);
        $selectedAmount.data('amount', totalSelectedAmount);
        $selectedAmount.text(totalSelectedAmount);
    }
})

function initStorageCellsContainerEvents() {
    let requiredAmount = parseInt($('#storage-cells-widget-packages-amount .required', $storageCellsContainer).data('amount'));
    let $selectedAmount = $('#storage-cells-widget-packages-amount .selected', $storageCellsContainer);
    let $storageCellsWidgetStorageCells = $('#storage-cells-widget-storage-cells', $storageCellsContainer);

    $('.select-cell', $storageCellsContainer).on('click', function() {
        let $storageCell = $(this).closest('.storage-cell');
        $storageCell.addClass('table-success');

        let cellAmount = parseInt($storageCell.data('max-packages'));
        let selectedCellAmount = cellAmount;
        let totalSelectedAmount = parseInt($selectedAmount.data('amount'));

        totalSelectedAmount += cellAmount;
        if (totalSelectedAmount >= requiredAmount) {
            totalSelectedAmount -= cellAmount;
            selectedCellAmount = requiredAmount - totalSelectedAmount;
            totalSelectedAmount = requiredAmount;
            $storageCellsWidgetStorageCells.addClass('full');
        }
        $('input', $storageCell).val(selectedCellAmount);
        $selectedAmount.data('amount', totalSelectedAmount);
        $selectedAmount.text(totalSelectedAmount);

        return false;
    });

    $('.unselect-cell', $storageCellsContainer).on('click', function() {
        let $storageCell = $(this).closest('.storage-cell');
        $storageCell.removeClass('table-success');
        $storageCellsWidgetStorageCells.removeClass('full');

        let totalSelectedAmount = parseInt($selectedAmount.data('amount')) - $('input', $storageCell).val();

        $('input', $storageCell).val(0);

        $selectedAmount.data('amount', totalSelectedAmount);
        $selectedAmount.text(totalSelectedAmount);

        return false;
    });
}

function updateStorageCellsContainer() {
    let packagesAmount = parseInt($packagesAmount.val());
    let productId = $productId.val()
    let series = $series.val();

    if (isNaN(packagesAmount) || isNaN(productId) || '' === series) {
        $storageCellsContainer.addClass('d-none');
        $storageCellsContainer.empty()
        return;
    }

    $.get('/receipts-products/storage-cells?packagesAmount=' + packagesAmount + '&productId=' + productId + '&series=' + series, function(response) {
        $storageCellsContainer.html(response);
        $storageCellsContainer.removeClass('d-none');

        initStorageCellsContainerEvents();
    });
}



