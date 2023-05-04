function editCustomer(id) {
    $.post('php/ajax/load_customer.php', {
        id: id
    }, function(response) {
        var result = JSON.parse(response);
        var x = result[0];

        $('#customerID').val(x.customerID);
        $('#customername').val(x.name);
        $('#username').val(x.username);
        $('#number').val(x.phone);
        $('#email').val(x.email);
        $('#password').val(x.password);
        $('#address').val(x.address);
        $('#postal').val(x.postalCode);

    });
}