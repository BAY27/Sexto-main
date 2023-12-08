<?php require_once('../html/head2.php') ?>

<div class="row">

    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Lista de Computadoras</h5>

                <div class="table-responsive">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal_computadoras">
                        Nueva Computadora
                    </button>
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tipo de Computadora</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Modelo</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Numero de serie</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">marca</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">precio</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Opciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla_computadoras">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ventana Modal-->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="Modal_computadoras" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frm_computadoras">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Computadoras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="computadoraId" id="computadoraId">
                  
                    <div class="form-group">
                        <label for="tipocomputadora">Tipo de Computadora</label>
                        <select type="text" required class="form-control" name="tipocomputadora" id="tipocomputadora" class="form-group" placeholder="Seleccione el tipo de computadora">
                            <option value="compulapto">Computadora Lapto</option>
                            <option value="compuescritorio">Computadora de escritorio</option>
                            <option value="computodo">Computadora todo en uno</option>
                             </select>

                

                        <label for="modelo">Modelo</label>
                        <input type="text" required class="form-control" id="modelo" name="modelo" placeholder="Ingrese el Modelo">
                        
                        <label for="nserie">Numero de serie</label>
                        <input type="text" required class="form-control" id="nserie" name="nserie" placeholder="Ingrese el numero de serie">
   
                        <label for="precio">Precio</label>
                        <input type="int" required class="form-control" id="precio" name="precio" placeholder="Ingrese el precio de la lavadora">

                        <label for="marca">Marca</label>
                        <select type="text" required class="form-control" name="marca" id="marca" >
                            <option value="dell">DELL</option>
                            <option value="samsung">Samsung</option>
                            <option value="hp">HP</option>
                            <option value="huawei">Huawei</option>
                            <option value="quasad">Quasad</option>
                            <option value="mac">MAC</option>
                            <option value="lenovo">LENOVO</option>
                            </select>
                    
              
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/script2.php') ?>

<script src="computadoras.js"></script>