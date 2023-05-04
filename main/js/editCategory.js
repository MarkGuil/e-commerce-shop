function editCategory(id) {
    $.post('php/ajax/load_categories.php', {
        id: id
    }, function(response) {
        var result = JSON.parse(response);
        var x = result[0];

        $('#editID').val(x.category_id);
        $('#editCode').val(x.category_name);

    });
}