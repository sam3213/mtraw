<?php
//Mostrar la informacion del vendedor

function perfil()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();
  $id = $_SESSION['id'];

  $objConsultas = new consultas();
  $result = $objConsultas->verPerfil($id);

  foreach ($result as $f) {
    echo '
      <li class="label">' . $f['Rol'] . '</li>
                    <li>
                        <a class="sidebar-sub-toggle">
                            <img src=" ../' . $f['Foto'] . '" style="height:50px; width:50px;"> ' . $f['Nombres'] . ' 
                            <!-- <span class="badge badge-primary">2</span> -->
                            <span class="sidebar-collapse-icon ti-angle-down"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="perfil.php?id=' . $f['Identificacion'] . '">
                                <i class="ti-pencil-alt"></i>Editar cuenta</a>
                            </li>
                            <li>
                                <a href="../../controllers/cerrarSesion.php"><i class="ti-close "></i>Cerrar Sesion</a>
                            </li>
                        </ul>
                    </li>

      ';
  }

}

function pefilEditar()
{

  $id = $_GET['id'];

  $objConsultas = new consultas();
  $result = $objConsultas->verPerfil($id);

  foreach ($result as $f) {

    echo '
      <section id="main-content">
      <div class="row">
          <div class="col-lg-4">
              <div class="card perfil-user">
                  <center><img src="../'.$f['Foto'].'" alt="" style="width:300px; height:310px; "></center>
                  <h2 style="text-align:center;">'.$f['Nombres'].' '.$f['Apellidos'].'</h2>
                  <h2 style="text-align:center;">'.$f['Rol'].'</h2>
              </div>
          </div>
          <div class="col-lg-8">
              <div class="card modificar-user">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-toggle="tab"
                              data-target="#home" type="button" role="tab" aria-controls="home"
                              aria-selected="true">Perfil</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-toggle="tab"
                              data-target="#profile" type="button" role="tab" aria-controls="profile"
                              aria-selected="false">Cambiar foto</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-toggle="tab"
                              data-target="#contact" type="button" role="tab" aria-controls="contact"
                              aria-selected="false">Cambiar clave</button>
                      </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel"
                          aria-labelledby="home-tab">
                          <form class="text-left clearfix" action="../../controllers/modificarCuentaVendedor.php" method="POST" enctype="multipart/form-Data">
                              <div class="row ">
                                  <div class="form-group col-md-6">
                                      <input type="number" class="form-control" value="'.$f['Identificacion'].'"
                                          readonly placeholder="identificacion" name="identificacion">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <select name="tipo_doc" id="" class="form-control form-group ">
                                          <option value= " '.$f['TipoDocumento'].' ">'.$f['TipoDocumento'].'</option>
                                          <option value="Cc">CC</option>
                                          <option value="Ce">CE</option>
                                          <option value="Pasaporte">PASAPORTE</option>

                                      </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                      <input type="text" class="form-control" value="'.$f['Nombres'].'" placeholder="Nombre"
                                          name="nombres">
                                  </div>
                                  <div class="form-group col-md-6">
                                      <input type="text" class="form-control" value="'.$f['Apellidos'].'" placeholder="Apellido"
                                          name="apellidos">
                                  </div>
                                  <div class="form-group col-md-6">
                                      <input type="email" class="form-control" value="'.$f['Email'].'" placeholder="Email"
                                          name="email">
                                  </div>
                                  <div class="form-group col-md-6">
                                      <input type="tel" class="form-control" value="'.$f['Telefono'].'" placeholder="Telefono"
                                          name="telefono">
                                  </div>


                              </div>
                              <div class="text-center">
                                  <button type="submit"
                                      class="btn btn-main text-center">Modificar</button>
                              </div>
                          </form>
                      </div>
                      
                      
                      <div class="tab-pane fade" id="profile" role="tabpanel"
                          aria-labelledby="profile-tab">
                          <form class="text-left clearfix" action="../../controllers/modificarFotoVendedor.php" method="POST" enctype="multipart/form-Data">
                              <div class="row ">
                              <div class="form-group col-md-6">
                                      <input type="number" class="form-control" value="'.$f['Identificacion'].'"
                                          readonly placeholder="identificacion" name="identificacion">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>foto de perfil:</label>
                                      <input type="file" class="form-control" placeholder="Foto usuario"
                                          name="foto" accept=".jpeg, .jpg, .png, .gif">
                                  </div>


                              </div>
                              <div class="text-center">
                                  <button type="submit"
                                      class="btn btn-main text-center">Modificar</button>
                              </div>
                          </form>
                      </div>


                      <div class="tab-pane fade" id="contact" role="tabpanel"
                          aria-labelledby="contact-tab">
                          <form class="text-left clearfix" action="../../controllers/modificarClaveVendedor.php" method="POST" enctype="multipart/form-Data">
                              <div class="row ">
                                  
                              <div class="form-group col-md-12">
                                      <input type="number" class="form-control" value="'.$f['Identificacion'].'"
                                          readonly placeholder="identificacion" name="identificacion">
                                  </div>

                              <div class="form-group col-md-6">
                                      <input type="password" class="form-control"
                                          placeholder="Nueva clave" name="clave" required>
                                  </div>

                                  <div class="form-group col-md-6">
                                      <input type="password" class="form-control"
                                          placeholder="Confirmar clave" name="clave2" required>
                                  </div>
                                 

                              </div>
                              <div class="text-center">
                                  <button type="submit"
                                      class="btn btn-main text-center">Modificar</button>
                              </div>
                          </form>
                      </div>
                  </div>

              </div>
          </div>
      </div>


      <div class="row">
          <div class="col-lg-12">
              <div class="footer">
                  <p>2018 © Admin Board. - <a href="#">example.com</a></p>
              </div>
          </div>
      </div>
  </section>
      
      
      
      ';

  }



}

// Mostrar los Productos al vendedor
function cargarProductosVendedor() {
    $id = $_SESSION['id'];
    $objConsultas = new Consultas();
    $result = $objConsultas -> mostrarPoducVendedor($id);

    if ( !isset( $result ) ) {
        echo '<h2>No hay Productos registrados registrados</h2>';
    } else {
        foreach ( $result as $f ) {
            echo '
                <tr>
                    <td>'.$f[ 'IdProducto' ] .'</td>
                    <td>'.$f[ 'NomProducto' ] . '</td>
                    <td>'.$f[ 'Proveedor' ]. '</td>
                    <td>'.$f[ 'Categoria' ] .'</td>
                    <td>'.$f[ 'Precio' ] .'</td>
                    <td><a href="modificarProducto.php?id='.$f[ 'IdProducto' ].'" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                    <td><a href="../../controllers/eliminarProducVendedor.php?id='.$f[ 'IdProducto' ].'" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
        }
    }

}

// Para editar los productos el vendedor
function cargarProductoEditar() {
    // aterrisamos la pk enviada desde la tabla
    $id_Producto = $_GET[ 'id' ];
    // enviamos la pk a una  funcion de la clase consultas
    $objConsultas = new Consultas();
    $result = $objConsultas -> mostrarProducVendedor($id_Producto);
    // pintamos la informacion consultada en el artefacto

    foreach ( $result as $f ) {
        echo'
        <form class="text-left clearfix"
        action="../../controllers/ActualizarProductosVendedor.php" method="POST"
        enctype="multipart/form-Data">
        <div class="row ">
        <div class="form-group col-md-6">
                <input type="text" class="form-control"
                placeholder="Numero Producto" value="'.$f['IdProducto'].'" name="IdProducto">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control"
                    placeholder="Nombre producto" name="nomProducto" value="'.$f['NomProducto'].'">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="Proveedor" value="'.$f['Proveedor'].'"
                    name="proveedor">
            </div>
            <div class="form-group col-md-6">
                <select name="categoria" id="" class="form-control form-group ">
                    <option value="'.$f['Categoria'].'">'.$f['Categoria'].'</option>
                    <option value="Repuesto interno">Repuesto interno</option>
                    <option value="Repuesto externo">Repuesto externo</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="Cantidad"
                    name="cantidad" value="'.$f['Cantidad'].'">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" placeholder="Precio"
                    name="precio" value="'.$f['Precio'].'">
            </div>

            

        </div>
        <div class="text-center">
            <button type="submit"
                class="btn btn-main text-center">Registrar</button>
        </div>
        <div class="text-center">
            <a href=">Productos registrados</a>
        </div>
    </form>

            ';
    }

}

// Mostrar los servios al vendedor
function cargarServiciosVendedor() {

    $id = $_SESSION['id'];
    $objConsultas = new Consultas();
    $result = $objConsultas -> mostrarServicioVendedor($id);

    if ( !isset( $result ) ) {
        echo '<h2>No hay servicios registrados </h2>';
    } else {
        foreach ( $result as $f ) {
            echo '
                <tr>
                    <td>'.$f[ 'numeroServicio' ] .'</td>
                    <td>'.$f[ 'NomServicio' ] . '</td>
                    <td>'.$f[ 'Proveedor' ] .'</td>
                    <td>'.$f[ 'Descripcion' ]. '</td>
                    <td><a href="modificarServicio.php?id='.$f[ 'IdServicio' ].'" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                    <td><a href="../../controllers/eliminarServicioVendedor.php?id='.$f[ 'IdServicio' ].'" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
        }
    }

}

function cargarServicioEditar() {
    // aterrisamos la pk enviada desde la tabla
    $id_Servicio = $_GET[ 'id' ];
    // enviamos la pk a una  funcion de la clase consultas
    $objConsultas = new Consultas();
    $result = $objConsultas -> mostrarServiciosVendedor($id_Servicio);
    // pintamos la informacion consultada en el artefacto

    foreach ( $result as $f ) {
        echo'

        <form class="text-left clearfix"
                                            action="../../controllers/modificarServiciosVendedor.php" method="POST"
                                            enctype="multipart/form-Data">
                                            <div class="row ">
                                            <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" value="'.$f['IdServicio'].'"
                                                        readonly placeholder="Numero de servicio" name="IdServicio">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" value="'.$f['NomServicio'].'"
                                                        placeholder="Nombre del servicios" name="NomServicio">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" value="'.$f['Proveedor'].'" placeholder="Proveedor"
                                                        name="Proveedor">
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="Descripcion" id="" cols="106"  placeholder="Descripcion del servicio" rows="2" style="resize:none;">'.$f['Descripcion'].'</textarea>
                                                </div>

                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-main text-center">modificar</button>
                                            </div>
                                           
                                        </form>

            ';
    }

}

//CUENTA LOS PRODUCTOS
function productosregistrados()
{
    $id = $_SESSION['id'];
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();

  $objConsultas = new consultas();
  $result = $objConsultas->contarproductosVendedor($id);

  foreach ($result as $f) {
    echo '
    <div class="stat-content dib">
      <div class="stat-text">Mis productos</div>
      <div class="stat-digit">'.$f['total'].'</div>
    </div>
      ';
  }

}

//CUENTA LOS SERVICIOS
function serviciosregistrados()
{
    $id = $_SESSION['id'];
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();

  $objConsultas = new consultas();
  $result = $objConsultas->contarserviciosVendedor($id);

  foreach ($result as $f) {
    echo '
    <div class="stat-content dib">
        <div class="stat-text">Mis servicios</div>
        <div class="stat-digit">'.$f['total'].'</div>
    </div>
      ';
  }

}

//mustra las citas solicitadas o pendientes
function mostrarCitas(){

    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitasVendedor($id);
    

        if (!isset($result)) {
            echo '<h2>Hasta este momento no te han solitado ninguna cita</h2>';
        } else {
            foreach ($result as $f) {


    echo'<tr>
        <td>'.$f['NomServicio'].'</td>
        <td>'.$f['Nombres'].'</td>
        <td>'.$f['Telefono'].'</td>
        <td>'.$f['Fecha'].' / '.$f['Hora'].'</td>
        <td>'.$f['EstadoCita'].'</td>
        <td><a href="../../controllers/aceptarCitaVendedor.php?id='.$f['IdCita'].'" class="btn btn-primary"><i class="ti-trash " ></i>Aceptar</a></td>
        <td style="color:white;"><a  data-bs-toggle="modal" data-bs-target="#cita'.$f['IdCita'].'" class="btn btn-info"><i style="padding-right:4px;" class="ti-write " ></i>Reprogramar</a></td>
        <td><a href="../../controllers/cancelarCitaVendedor.php?id='.$f['IdCita'].'" class="btn btn-danger"><i class="ti-trash " ></i>Cancelar</a></td>
    </tr>';
    }
}
}

//muestra las citas Aceptadas
function mostrarCitasAceptadas(){

    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitasVendedorA($id);
    

        if (!isset($result)) {
            echo '<h2>Hasta este momento no te han solitado ninguna cita</h2>';
        } else {
            foreach ($result as $f) {


    echo'<tr>
        <td>'.$f['NomServicio'].'</td>
        <td>'.$f['Nombres'].'</td>
        <td>'.$f['Telefono'].'</td>
        <td>'.$f['Fecha'].' / '.$f['Hora'].'</td>
        <td>'.$f['EstadoCita'].'</td>
     <td style="color:white;"><a  data-bs-toggle="modal" data-bs-target="#citas'.$f['IdCita'].'" class="btn btn-info"><i style="padding-right:4px;" class="ti-write " ></i>Reprogramar</a></td>

        <td><a href="../../controllers/cancelarCitaVendedor.php?id='.$f['IdCita'].'" class="btn btn-danger"><i class="ti-trash " ></i>Cancelar</a></td>
        <td><a href="../../controllers/citaTerminadaVendedor.php?id='.$f['IdCita'].'" class="btn btn-danger"><i class="ti-check-box " ></i>Terminada</a></td>
    </tr>';
    }
}
}

//modal pra formulario de reagendar citas
function modalReagendarCitas(){
    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitasVendedor($id);


    if (!isset($result)) {
        echo '';
    } else{
    foreach ($result as $f){


        echo '
        <div class="modal product-modal" id="cita'.$f['IdCita'].'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
                      <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; max-height: 900px;"  >
                        <div class="modal-content " >
    
                            <div class="modal-body" >
                                <div class="row">
                                    <h3 style="text-align:center; margin-bottom: 30px;">Agendamiento de cita</h3>
                                    <form class="text-left clearfix"
                                                action="../../controllers/reagendarCitaVendedor.php" method="POST"
                                                enctype="multipart/form-Data">
                                                <div class="row ">
                                                <div class="form-group col-md-6" "margin-bottom:0px;">
                                                <label> Servicio requerido</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Servicio requerido" readonly value="'.$f['NomServicio'].'" >
                                                    </div>
                                                    <div class="form-group col-md-6" "margin-bottom:0px;">
                                                    <label> Nombre del Taller</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Nombre producto" readonly value="'.$f['Nombres'].'" >
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:0px;">
                                                    <label> Fecha de la cita</label>
                                                        <input type="date" class="form-control" 
                                                        placeholder="Proveedor" name="fecha">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:0px;">
                                                    <label> hora de la cita</label>
                                                        <input type="time" class="form-control" placeholder="Cantidad"
                                                            name="hora">
                                                    </div>
                                                    <div class="form-group col-md-12" style="margin-bottom:0px;">
                                                    <label> Direccion</label>
                                                        <input type="text" class="form-control" placeholder="Cantidad" readonly value="'.$f['Direccion'].'">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:6px;">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['numeroServicio'].'"
                                                            name="IdServicio">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:6px;">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['IdCita'].'"
                                                            name="idcita">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$id.'"
                                                            name="IdCliente">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                   
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['Identificacion'].'"
                                                            name="IdTaller">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-main text-center">Registrar</button>
                                                </div>
                                            </form>
                                    
                                </div>	
                            </div>
    
                            <div class="modal-footer" style="display: flex; justify-content: center;>
                                
                                <div class"row">
                                    <div class="col-md-8" style="display: flex; justify-content: center; text-align:center;">
                                        <p> Estimado/a cliente, Si por alguna razón necesita cancelar o reprogramar la cita, le pedimos amablemente lo registre con un día de anticipación. </p>
                                    </div>
                                    <button type="button" class="btn btn-danger col-md-2" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                </div>
                            
                            </div>
                            
                        </div>
                      </div>
                </div>
                ';
    }}
}

//modal pra formulario de reagendar citas
function modalReagendarCitasAceptas(){
    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitasVendedorA($id);


    if (!isset($result)) {
        echo '';
    } else{
    foreach ($result as $f){


        echo '
        <div class="modal product-modal" id="citas'.$f['IdCita'].'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
                      <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; max-height: 900px;"  >
                        <div class="modal-content " >
    
                            <div class="modal-body" >
                                <div class="row">
                                    <h3 style="text-align:center; margin-bottom: 30px;">Agendamiento de cita</h3>
                                    <form class="text-left clearfix"
                                                action="../../controllers/reagendarCitaVendedor.php" method="POST"
                                                enctype="multipart/form-Data">
                                                <div class="row ">
                                                <div class="form-group col-md-6" "margin-bottom:0px;">
                                                <label> Servicio requerido</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Servicio requerido" readonly value="'.$f['NomServicio'].'" >
                                                    </div>
                                                    <div class="form-group col-md-6" "margin-bottom:0px;">
                                                    <label> Nombre del Taller</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Nombre producto" readonly value="'.$f['Nombres'].'" >
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:0px;">
                                                    <label> Fecha de la cita</label>
                                                        <input type="date" class="form-control" 
                                                        placeholder="Proveedor" name="fecha">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:0px;">
                                                    <label> hora de la cita</label>
                                                        <input type="time" class="form-control" placeholder="Cantidad"
                                                            name="hora">
                                                    </div>
                                                    <div class="form-group col-md-12" style="margin-bottom:0px;">
                                                    <label> Direccion</label>
                                                        <input type="text" class="form-control" placeholder="Cantidad" readonly value="'.$f['Direccion'].'">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:6px;">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['numeroServicio'].'"
                                                            name="IdServicio">
                                                    </div>
                                                    <div class="form-group col-md-6" style="margin-bottom:6px;">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['IdCita'].'"
                                                            name="idcita">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                    
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$id.'"
                                                            name="IdCliente">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                   
                                                        <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['Identificacion'].'"
                                                            name="IdTaller">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-main text-center">Registrar</button>
                                                </div>
                                            </form>
                                    
                                </div>	
                            </div>
    
                            <div class="modal-footer" style="display: flex; justify-content: center;>
                                
                                <div class"row">
                                    <div class="col-md-8" style="display: flex; justify-content: center; text-align:center;">
                                        <p> Estimado/a cliente, Si por alguna razón necesita cancelar o reprogramar la cita, le pedimos amablemente lo registre con un día de anticipación. </p>
                                    </div>
                                    <button type="button" class="btn btn-danger col-md-2" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                </div>
                            
                            </div>
                            
                        </div>
                      </div>
                </div>
                ';
    }}
}

//muestra las citas Terminadas o canceladas
function mostrarCitasTermindas(){

    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitasVendedorP($id);
    

        if (!isset($result)) {
            echo '<h2>Hasta este momento no te han solitado ninguna cita</h2>';
        } else {
            foreach ($result as $f) {


    echo'<tr>
        <td>'.$f['NomServicio'].'</td>
        <td>'.$f['Nombres'].'</td>
        <td>'.$f['Telefono'].'</td>
        <td>'.$f['Fecha'].' / '.$f['Hora'].'</td>
        <td>'.$f['EstadoCita'].'</td>
    </tr>';
    }
}
}

?>