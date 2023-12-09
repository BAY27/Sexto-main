class Usuarios_Model {
  constructor(UsuarioId, cedula, Nombres, Apellidos, Telefono, correo, contrasenia, Rol, Ruta) {
    this.UsuarioId = UsuarioId;
    this.cedula = cedula;
    this.Nombres = Nombres;
    this.Apellidos = Apellidos;
    this.Telefono = Telefono;
    this.correo = correo;
    this.contrasenia = contrasenia;
    this.Rol = Rol;
    this.Ruta = Ruta;
  }

  todos() {
    $.get(`../../Controllers/usuarios.controller.php?op=${this.Ruta}`, (res) => {
      res = JSON.parse(res);
      let html = "";
      res.forEach((valor, index) => {
        const fondo = getFondoColor(valor.Rol);
        html += `<tr>
          <td>${index + 1}</td>
          <td>${valor.Nombres}</td>
          <td>${valor.Apellidos}</td>
          <td><div class="d-flex align-items-center gap-2">
            <span class="badge ${fondo} rounded-3 fw-semibold">${valor.Rol}</span>
          </div></td>
          <td>
            <button class='btn btn-success' onclick='editar(${valor.UsuarioId})'>Editar</button>
            <button class='btn btn-danger' onclick='eliminar(${valor.UsuarioId})'>Eliminar</button>
            <button class='btn btn-info' onclick='ver(${valor.UsuarioId})'>Ver</button>
          </td>
        </tr>`;
      });
      $("#tabla_usuarios").html(html);
    });
  }

  insertar() {
    const dato = new FormData();
    dato.append("Rol", this.Rol);
    $.ajax({
      url: "../../Controllers/usuarios.controller.php?op=insertar",
      type: "POST",
      data: dato,
      contentType: false,
      processData: false,
      success: function (res) {
        res = JSON.parse(res);
        if (res === "ok") {
          Swal.fire("usuarios", "Usuario Registrado", "success");
          todos_controlador();
        } else {
          Swal.fire("Error", res, "error");
        }
      },
    });
    this.limpia_Cajas();
  }

  cedula_repetida() {
    const cedula = this.cedula;
    $.post(
      "../../Controllers/usuarios.controller.php?op=cedula_repetida",
      { cedula: cedula },
      (res) => {
        res = JSON.parse(res);
        const cedulaRepetida = parseInt(res.cedula_repetida);
        $("#CedulaRepetida").toggleClass("d-none", cedulaRepetida <= 0);
        $("button").prop("disabled", cedulaRepetida > 0);
      }
    );
  }

  verifica_correo() {
    const correo = this.correo;
    $.post(
      "../../Controllers/usuarios.controller.php?op=verifica_correo",
      { correo: correo },
      (res) => {
        res = JSON.parse(res);
        const correoRepetido = parseInt(res.cedula_repetida);
        $("#CorreoRepetido").toggleClass("d-none", correoRepetido <= 0);
        $("button").prop("disabled", correoRepetido > 0);
      }
    );
  }

  uno() {
    const UsuarioId = this.UsuarioId;
    $.post(
      "../../Controllers/usuarios.controller.php?op=uno",
      { UsuarioId: UsuarioId },
      (res) => {
        res = JSON.parse(res);
        $("#UsuarioId").val(res.UsuarioId);
        $("#cedula").val(res.cedula);
        $("#Nombres").val(res.Nombres);
        $("#Apellidos").val(res.Apellidos);
        $("#Telefono").val(res.Telefono);
        $("#correo").val(res.correo);
        $("#contrasenia").val(res.contrasenia);
        $("#contrasenia2").val(res.contrasenia);
        document.getElementById("Rol").value = res.Rol; //asignar al select el valor
      }
    );
    $("#Modal_usuario").modal("show");
  }

  editar() {
    const dato = new FormData();
    dato.append("Rol", this.Rol);
    $.ajax({
      url: "../../Controllers/usuarios.controller.php?op=actualizar",
      type: "POST",
      data: dato,
      contentType: false,
      processData: false,
      success: function (res) {
        res = JSON.parse(res);
        if (res === "ok") {
          Swal.fire("usuarios", "Usuario Registrado", "success");
          todos_controlador();
        } else {
          Swal.fire("Error", res, "error");
        }
      },
    });
    this.limpia_Cajas();
  }

  eliminar() {
    const UsuarioId = this.UsuarioId;
    Swal.fire({
      title: "Usuarios",
      text: "Esta seguro de eliminar el usuario",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          "../../Controllers/usuarios.controller.php?op=eliminar",
          { UsuarioId: UsuarioId },
          (res) => {
            res = JSON.parse(res);
            if (res === "ok") {
              Swal.fire("usuarios", "Usuario Eliminado", "success");
              todos_controlador();
            } else {
              Swal.fire("Error", res, "error");
            }
          }
        );
      }
    });
    this.limpia_Cajas();
  }

  limpia_Cajas() {
    const ids = ["cedula", "Nombres", "Apellidos", "Telefono", "correo", "contrasenia", "contrasenia2", "UsuarioId"];
    ids.forEach((id) => (document.getElementById(id).value = ""));
    $("#Modal_usuario").modal("hide");
  }
}

function getFondoColor(rol) {
  switch (rol) {
    case "Administrador":
      return "bg-primary";
    case "Vendedor":
      return "bg-success";
    case "Cliente":
      return "bg-warning";
    case "Gerente":
      return "bg-danger";
    case "Cajero":
      return "bg-info";
    default:
      return "";
  }
}
