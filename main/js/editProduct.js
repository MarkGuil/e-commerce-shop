function editProduct(id) {
    
    $.post('php/ajax/load_product.php', {
        id: id
    }, function(response) {
        var result = JSON.parse(response);
        var x = result[0];

        $('#prodID').val(x.productID);
        $('#edit_product-name').val(x.productName);
        $('#edit_category-name').val(x.category_id);
        $('#productDesc').val(x.productDescription);
        if(x.status == 'featured') document.getElementById("edityes").checked = true;
        else document.getElementById("editno").checked = true;

        $('#editQuantity').val(x.availableQuantity);
        $('#price').val(x.price);
        $('#voucher').val(x.voucher);
        $('#voucherval').val(x.vouchervalue);

    });
}