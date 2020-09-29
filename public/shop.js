// check if sessionStorage contains currentOrder and checks accordign to result
window.onload = function () {
    console.log(sessionStorage);
    if (sessionStorage.getItem("currentOrder")) {
        let orderExist = JSON.parse(sessionStorage.getItem("currentOrder"));
        orderExist.forEach(element => document.getElementById(element).checked = true);
    }
}
 
// order form submit button
var orderButton = document.getElementById('submitOrder');

// save orderedProductIds to sessionStorage
orderButton.onclick = function () {
    let orderedProductIds = getCheckedIds();
    if (orderedProductIds.length !== 0){
        let orderJson = JSON.stringify(orderedProductIds);
        sessionStorage.setItem("currentOrder", orderJson);         
        window.location.href = "/basedataform";
    } else {
        shoppingCartEmptyPopup();     
    }
}

function shoppingCartEmptyPopup(orderButton) {
    var errorBox = document.getElementById('error_box');
    errorBox.innerHTML = "Bitte wählen Sie einen Artikel aus!";

}

// gets the checked checkbox ids
function getCheckedIds() {
    return Array.from(document.querySelectorAll('input[type="checkbox"]'))
    .filter((checkbox) => checkbox.checked)
    .map((checkbox) => checkbox.id); 
}