//aqui va a estar el codigo de usuarios.model.js

function init() {
    $("#frm_computadoras").on("submit", function (e) {
      guardaryeditar(e);
    });
  }
  
  $().ready(() => {
    todos();
  });
  
  var todos = () => {
    var html = "";
    $.get("../../Controllers/computadoras.controller.php?op=todos", (res) => {
      console.log(res);
      res = JSON.parse(res);
      $.each(res, (index, valor) => {
        html += `<tr>
                  <td>${index + 1}</td>
                  <td>${valor.tipocomputadora}</td>
                  <td>${valor.modelo}</td>
                  <td>${valor.nserie}</td>
                  <td>${valor.marca}</td>
                  <td>${valor.precio}</td>
              <td>
              <button class='btn btn-success' onclick='editar(${
                valor.computadoraId
              })'>Editar</button>
              <button class='btn btn-danger' onclick='eliminar(${
                valor.computadoraId
              })'>Eliminar</button>
              <button class='btn btn-info' onclick='ver(${
                valor.computadoraId
              })'>Ver</button>
              </td></tr>
                  `;
      });
      $("#tabla_computadoras").html(html);
    });
  };
  
  var guardaryeditar = (e) => {
    e.preventDefault();
    var dato = new FormData($("#frm_computadoras")[0]);
    var ruta = "";
    var computadoraId = document.getElementById("computadoraId").value;
    if (computadoraId > 0) {
      ruta = "../../Controllers/computadoras.controller.php?op=actualizar";
    } else {
      ruta = "../../Controllers/computadoras.controller.php?op=insertar";
    }
    $.ajax({
      url: ruta,
      type: "POST",
      data: dato,
      contentType: false,
      processData: false,
      success: function (res) {
        console.log(res)
        res = JSON.parse(res);
        if (res == "ok") {
          Swal.fire("computadoras", "Registrada con éxito", "success");
          todos();
          limpia_Cajas();
        } else {
          Swal.fire("computadoras", "Error al guardar, intente mas tarde", "error");
        }
      },
    });
  };
  
  
  var editar = async (computadoraId) => {
    await cargaComputadora();
    $.post(
      "../../Controllers/computadoras.controller.php?op=uno",
      { computadoraId: computadoraId },
      (res) => {
        res = JSON.parse(res);
        
        $("#computadoraId").val(res.computadoraId);
        $("#tipocomputadora").val(res.tipocomputadora);
        $("#modelo").val(res.modelo);
        $("#nserie").val(res.nserie);
        $("#marca").val(res.marca);
        $("#precio").val(res.precio);
        //document.getElementById("computadoraId").value = res.computadoraId;
  
      }
    );
    $("#Modal_computadoras").modal("show");
  };
  
  var eliminar = (computadoraId) => {
    Swal.fire({
      title: "computadora",
      text: "Esta seguro de eliminar la lavadora",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          "../../Controllers/computadoras.controller.php?op=eliminar",
          { computadoraId: computadoraId },
          (res) => {
            res = JSON.parse(res);
            if (res === "ok") {
              Swal.fire("computadoras", "computadora Eliminada", "success");
              todos();
            } else {
              Swal.fire("Error", res, "error");
            }
          }
        );
      }
    });
  
    impia_Cajas();
  };
  
  var limpia_Cajas = () => {
      document.getElementById("computadoraId").value = "";
      document.getElementById("tipocomputadora").value = "";
      document.getElementById("modelo").value = "";
      document.getElementById("nserie").value = "";
      document.getElementById("marca").value = "";
      document.getElementById("precio").value = "";
    $("#Modal_computadoras").modal("hide");
  };
  init();
  