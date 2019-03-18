function success_home_button() {
    $('#index_form')[0].reset();
    var form_submit_button = document.getElementById("index_form_button");
    form_submit_button.innerText = "保存";
    form_submit_button.disabled = undefined;
    $("#success_div").fadeOut("fast", function() {
        $("#home_div").fadeIn("fast");
    });
}