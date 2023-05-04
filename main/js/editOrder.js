function editOrder(id) {
    
    $.post('php/ajax/load_order.php', {
        id: id
    }, function(response) {
        var result = JSON.parse(response);
        var x = result[0];

        $('#editOrderID').val(x.orderID);
        $('#edit_status_name option[value='+x.statID+']').prop('selected', true);
    });
}