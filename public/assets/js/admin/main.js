//toastr success message
function toastr_success(message) {
    toastr.success(message, trans("Success"));
}

//toastr error message
function toastr_error(message) {
    toastr.error(message, trans("Failed"));
}

//sumbmit delete form
function delete_submit(el) {
    $(el).parent().submit();
}

//url
function url(url = "") {
    var base_url = location.origin;

    return base_url + "/" + url;
}

//ajax url
function ajax_url(url = "") {
    var base_url = location.origin;

    return base_url + "/ajax/" + url;
}

// validate numeric fields
$(".numeric").on("change, keyup", function () {
    var currentInput = $(this).val();
    // var fixedInput = currentInput.replace(/[A-Za-z!@#$£%^&*()=-_+}{]/g, '');
    var fixedInput = currentInput.replace(
        /[A-Za-z`~!@#$^&£*()_|+\-=?;:'",<>\{\}\[\]\\\/]/gi,
        ""
    );
    $(this).val(fixedInput);
    console.log(fixedInput);
});
