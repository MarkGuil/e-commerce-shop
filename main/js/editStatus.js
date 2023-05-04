function editStatus(id) {
    $.post('php/ajax/load_status.php', {
        id: id
    }, function(response) {
        var result = JSON.parse(response);
        var x = result[0];

        $('#editStatID').val(x.statID);
        $('#editStat').val(x.statusName);

    });
}