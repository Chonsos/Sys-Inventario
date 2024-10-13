var camposName = document.querySelectorAll('.usernameValidation');
// var camposEmail = document.querySelectorAll('.emailValidation');

for (let campoName of camposName) {
  if (campoName.classList.contains('usernameValidation')) {
    campoName.onchange = function () {
      var nombre = campoName.value;
      var datos = new FormData();
      datos.append("nombre", nombre);

      $.ajax({
        url: "ajax/ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,

        before: function () {

        },
        success: function (respuesta) {
          console.log(respuesta);
          if (respuesta == 1) {
            campoName.value = "";
            campoName.select();
            swal("Nombre rechazado!", "No puedes usar este nombre", "error");       
          } else {
            swal("Nombre aceptado!", "Puedes usar este nombre", "success");
          }
        },
        error: function (err) {
          console.log("Ocurrio un error: " + err);
        },
        complete: function () {

        }
      });
    }
  }
}

$(document).ready(function () {

  $('.muestraTemporal').hide();

  $('#buscador').focus();

  $('#buscador').on('keyup', function () {

    if ($('#buscador').val()) {

      var buscar = $('#buscador').val();

      console.log(buscar);

      $.ajax({

        url: 'ajax/ajax.php',

        type: 'POST',

        data: { buscar },

        success: function (response) {

          let productos = JSON.parse(response);

          let vista = '';

          console.log(productos);

          productos.forEach(producto => {

            vista += `
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="table_price full">
                  <div class="inner_table_price">
                    <div class="price_table_head blue1_bg">
                      <h2>Codigo: ${producto.codigoProducto}</h2>
                    </div>
                    <div class="price_table_inner">
                      <div class="cont_table_price_blog">
                    <p class="blue1_color">Producto: ${producto.nombreProducto}</p>
                  </div>
                  <div class="cont_table_price">
                    <ul>
                      <li>Descripcion: ${producto.descripcion}</li>
                      <li>Stock: ${producto.stock}</li>
                      <li>Precio: ${producto.precio}</li>
                    </ul>
                  </div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center" class="bottom_list">
                  <div class="right_button">
                    <a href="editar&idEditarProducto=${producto.id}"> 
                      <button type="button" class="btn btn-warning btn-xs"> <i class="fa fa-edit"></i> 
                      </button>
                    </a>
                    <a href="productos&idBorrar=${producto.id}"> 
                      <button type="button" class="btn btn-danger btn-xs">
                        <i class="fa fa-eraser"> </i> 
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          `;

          })
          $('#datos').html(vista);

          $('.muestraTemporal').show();

          $('.muestraNormal').hide();
        }
      })

    } else {

      $('.muestraNormal').show();

      $('.muestraTemporal').hide();

    }
  })
})

