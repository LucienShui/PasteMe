var vm = new Vue({
    el: '#success_div',
    data: {
        keyword: "",
    }
});
$("#index_form").submit(function(event) {
    event.preventDefault(); //prevent default action 
    var post_url = $(this).attr("action"); //get form action url
    var request_method = $(this).attr("method"); //get form GET/POST method
    var form_data = $(this).serialize(); //Encode form elements for submission
    var form_submit_button = document.getElementById("index_form_button");
    form_submit_button.innerText = "保存中";
    form_submit_button.disabled = "disabled";
    $.ajax({
        url : post_url,
        type: request_method,
        data : form_data
    }).done(function(response) {
        vm.keyword = response;
        document.getElementById('copy').setAttribute("data-clipboard-text", $("#copy").attr("base") + response);
        $("#home_div").fadeOut("fast", function() {
            document.getElementById("pasteme_body").style = undefined;
            $("#success_div").fadeIn("fast");
        });
    });
});
