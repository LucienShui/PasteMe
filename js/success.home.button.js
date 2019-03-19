function success_home_button() {
    $("#index_form")[0].reset();
    var elem_form = document.getElementById("index_form");
    var idx = elem_form.action.indexOf('?');
    if (idx > -1) {
        elem_form.action = elem_form.action.substr(0, idx);
        console.log(elem_form.action);
    }
    var form_submit_button = document.getElementById("index_form_button");
    form_submit_button.innerText = "保存";
    form_submit_button.disabled = undefined;
    $("#success_div").fadeOut("fast", function() {
        $("#home_div").fadeIn("fast");
    });
}