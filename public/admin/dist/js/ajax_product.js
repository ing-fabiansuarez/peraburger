var getUrl = window.location;
var base_url = "http://localhost/peraburger";

//TRAER PRODUCTOS DESDE LA BASE DE DATOS

$(document).ready(function () {
  reloadproducts();
  $("#categories-select").change(function () {
    reloadproducts();
  });
  $("#products-select").change(function () {
    reloadingredients();
  });
});
function reloadproducts() {
  $.ajax({
    type: "get",
    url: base_url + "/productofcategory",
    data: "category=" + $("#categories-select").val(),
    success: function (r) {
      $("#products-select").html(r);
      reloadingredients();
    },
  });
}

//TRAER INGREDIENTES DESDE LA BASE DE DATOS

function reloadingredients() {
  $.ajax({
    type: "get",
    url: base_url + "/ingredientsofproduct",
    data: "product=" + $("#products-select").val(),
    success: function (r) {
      $("#ingredients-div").html(r);
    },
  });
}
