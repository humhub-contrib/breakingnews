humhub.module('breakingnews', function (module, require, $) {

    var changeStatus = function(event) {
        var isChecked = event.$target.prop('checked');
        var expirationRow = $('#expiration_row');

        isChecked ? expirationRow.removeClass('d-none') : expirationRow.addClass('d-none');
    }

    module.export({
        changeStatus: changeStatus,
    });
});
