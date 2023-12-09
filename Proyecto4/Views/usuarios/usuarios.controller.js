function initialize() {
  $("#form_usuarios").submit(guardarYEditar);
}

$().ready(() => {
  loadAllUsers();
});

const loadAllUsers = () => {
  const users = new Usuarios_Model("", "", "", "", "", "", "", "", "todos");
  users.todos();
};

const guardarYEditar = (e) => {
  e.preventDefault();
  const formData = new FormData($("#form_usuarios")[0]);
  const usuarioId = parseInt($("#UsuarioId").val());

  if (usuarioId > 0) {
    const usuarios = new Usuarios_Model("", "", "", "", "", "", "", formData, "editar");
    usuarios.editar();
  } else {
    const usuarios = new Usuarios_Model("", "", "", "", "", "", "", formData, "insertar");
    usuarios.insertar();
  }
};

const editarUsuario = (usuarioId) => {
  const usuario = new Usuarios_Model(usuarioId, "", "", "", "", "", "", "", "uno");
  usuario.uno();
};

const validateCedula = () => {
  const cedula = $("#Cedula").val();

  // Implementa la lógica de validación de la cédula aquí...

  if (validCedula) {
    $("#errorCedula").addClass("d-none");
    $("button").prop("disabled", false);
  } else {
    $("#errorCedula").removeClass("d-none");
    $("#errorCedula").html("El número de cédula ingresado no es correcto");
    $("button").prop("disabled", true);
  }
};

const checkCedulaRepetida = () => {
  const cedula = $("#Cedula").val();
  const usuario = new Usuarios_Model("", cedula, "", "", "", "", "", "", "cedula_repetida");
  usuario.cedula_repetida();
};

const checkCorreoRepetido = () => {
  const correo = $("#correo").val();
  const usuario = new Usuarios_Model("", "", "", "", "", correo, "", "", "verifica_correo");
  usuario.verifica_correo();
};

const verifyPasswords = () => {
  const contrasenia = $("#contrasenia").val();
  const contrasenia2 = $("#contrasenia2").val();

  if (contrasenia === contrasenia2) {
    $("#errorcontrasenia").addClass("d-none");
    $("button").prop("disabled", false);
  } else {
    $("#errorcontrasenia").removeClass("d-none");
    $("#errorcontrasenia").html("Las contraseñas no coinciden");
    $("button").prop("disabled", true);
  }
};

const deleteUser = (usuarioId) => {
  const eliminarUsuario = new Usuarios_Model(usuarioId, "", "", "", "", "", "", "", "eliminar");
  eliminarUsuario.eliminar();
};

initialize();
