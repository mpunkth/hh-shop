document.addEventListener("DOMContentLoaded", function(event) { 

    let div = document.getElementById("order-overview");
    let orderJson = sessionStorage.getItem('currentOrder');
    $.ajax({
        type: "POST",
        url: "/getorderdata",
        dataType: 'html',
        data: orderJson,
        success: function(data) {
            div.innerHTML = data;
        }
        
    });
});