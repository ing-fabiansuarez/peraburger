var getUrl = window.location;
var base_url = "http://localhost/peraburger";

//TRAER LAS CIUDADES DESDE LA BASE DE DATOS

$(document).ready(function () {
  reloadproducts();
  $("#categories-select").change(function () {
    reloadproducts();
  });
});
function reloadproducts() {
  $.ajax({
    type: "get",
    url: base_url + "/productofcategory",
    data: "category=" + $("#categories-select").val(),
    success: function (r) {
      $("#productossss").html(r);
    },
  });
}
