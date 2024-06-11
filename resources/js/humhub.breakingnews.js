humhub.module('breakingnews', function (module, require, $) {

    var changeStatus = function(event) {
        var isChecked = event.$target.prop('checked');
        var expirationRow = $('#expiration_row');

        isChecked ? expirationRow.show() : expirationRow.hide();
    }

    module.export({
        changeStatus: changeStatus,
    });
});
