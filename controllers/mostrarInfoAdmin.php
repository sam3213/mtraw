<?php
// este archivo recibe todas las consultas del modelo para mostrar informacion al administrador
// esta funcion es la que se llama en la vista

function usuariosregistrados()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();

  $objConsultas = new consultas();
  $result = $objConsultas->contarusuarios();

  foreach ($result as $f) {
    echo '
    <div class="stat-content dib">
        <div class="stat-text">Usuarios</div>
        <div class="stat-digit">'.$f['total'].'</div>
    </div>
      ';
  }

}

function productosregistrados()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();

  $objConsultas = new consultas();
  $result = $objConsultas->contarproductos();

  foreach ($result as $f) {
    echo '
    <div class="stat-content dib">
      <div class="stat-text">Productos</div>
      <div class="stat-digit">'.$f['total'].'</div>
    </div>
      ';
  }

}

function serviciosregistrados()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();

  $objConsultas = new consultas();
  $result = $objConsultas->contarservicios();

  foreach ($result as $f) {
    echo '
    <div class="stat-content dib">
        <div class="stat-text">Servicios</div>
        <div class="stat-digit">'.$f['total'].'</div>
    </div>
      ';
  }

}


function cargarUsuarios()
{
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarUserAdmin();

  if (!isset($result)) {
    echo '<h2>No hay usuarios registrados</h2>';
  } else {
    foreach ($result as $f) {
      echo '
                <tr>
                    <td><img src="../' . $f['Foto'] . '" alt="user" style="width: 60px; height: 60px; border-radius:50%;"></td>
                    <td>' . $f['Nombres'] . '</td>
                    <td>' . $f['Apellidos'] . '</td>
                    <td>' . $f['Rol'] . '</td>
                    <td>' . $f['Estado'] . '</td>
                    <td><a href="modificar-usuario.php?id=' . $f['Identificacion'] . '" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                    <td><a href="../../controllers/eliminarUserAdmin.php?id=' . $f['Identificacion'] . '" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
    }
  }

}


function cargarSolicitudes()
{
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarSolicitudesAdmin();

  if (!isset($result)) {
    echo '<h2>No hay solicitudes pendientes</h2>';
  } else {
    foreach ($result as $f) {
      echo '
                <tr>
                    <td><img src="../' . $f['Foto'] . '" alt="user" style="width: 60px; height: 60px; border-radius:50%;"></td>
                    <td>' . $f['Nombres'] . '</td>
                    <td>' . $f['Apellidos'] . '</td>
                    <td>' . $f['Rol'] . '</td>
                    <td>' . $f['Estado'] . '</td>
                    <td><a href="modificar-usuario.php?id=' . $f['Identificacion'] . '" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                    <td><a href="../../controllers/eliminarUserAdmin.php?id=' . $f['Identificacion'] . '" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
    }
  }

}


function cargarUsuarioEditar()
{
  // aterrisamos la pk enviada desde la tabla
  $id_user = $_GET['id'];
  // enviamos la pk a una  funcion de la clase consultas
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarUsersAdmin($id_user);
  // pintamos la informacion consultada en el artefacto

  foreach ($result as $f) {
    echo '
            
            <form class="text-left clearfix" action="../../controllers/actualizarUserAdmin.php" method="POST">
            <div class="row ">
              <div class="form-group col-md-6">
                <input type="number" value="' . $f['Identificacion'] . '" class="form-control"  placeholder="identificacion" name="identificacion">
              </div>
              <div class="form-group col-md-6">
                <select name="tipo_doc" id="" class="form-control form-group ">
                  <option value="' . $f['TipoDocumento'] . '">' . $f['TipoDocumento'] . '</option>
                  <option value="Cc">CC</option>
                  <option value="Ce">CE</option>
                  <option value="Pasaporte">PASAPORTE</option>
                  
                </select>
              </div>
              <div class="form-group col-md-6">
                <input type="text" value="' . $f['Nombres'] . '" class="form-control"  placeholder="Nombre" name="nombres">
              </div>
              <div class="form-group col-md-6">
                <input type="text" value="' . $f['Apellidos'] . '" class="form-control"  placeholder="Apellido" name="apellidos">
              </div>
              <div class="form-group col-md-6">
                <input type="email" value="' . $f['Email'] . '" class="form-control"  placeholder="Email" name="email">
              </div>
              <div class="form-group col-md-6">
                <input type="tel" value="' . $f['Telefono'] . '" class="form-control"  placeholder="Telefono" name="telefono">
              </div>
              <div class="form-group col-md-6">
                <select name="rol" id="" class="form-control form-group ">
                  <option value="' . $f['Rol'] . '">' . $f['Rol'] . '</option>
                  <option value="vendedor">Vendedor</option>
                  <option value="cliente">Cliente</option>
                  <option value="administrador">Administrador</option>
                  
                </select>
              </div>
              <div class="form-group col-md-6">
                <select name="estado" id="" class="form-control form-group ">
                  <option value="' . $f['Estado'] . '">' . $f['Estado'] . '</option>
                  <option value="Activo">Activo</option>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Inactivo">Inactivo</option>
                  
                </select>
              </div>
            </div>
            <div class="text-center">
              <button type="submit"  class="btn btn-main text-center" >Actualizar</button>
            </div>
          </form>

            ';
  }

}

function cargarUsuariosReportes()
{
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarUserAdmin();

  if (!isset($result)) {
    echo '<h2>No hay usuarios registrados</h2>';
  } else {
    foreach ($result as $f) {
      echo '
              <tr>
                  <td>' . $f['Identificacion'] . '</td>
                  <td>' . $f['Nombres'] . '</td>
                  <td>' . $f['Apellidos'] . '</td>
                  <td>' . $f['Email'] . '</td>
                  <td>' . $f['Telefono'] . '</td>
                  <td>' . $f['Rol'] . '</td>
                  <td>' . $f['Estado'] . '</td>
               </tr>
              ';
    }
  }

}

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
                          <form class="text-left clearfix" action="../../controllers/modificarCuentaAdmin.php" method="POST" enctype="multipart/form-Data">
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
                          <form class="text-left clearfix" action="../../controllers/modificarFotoAdmin.php" method="POST" enctype="multipart/form-Data">
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
                          <form class="text-left clearfix" action="../../controllers/modificarClaveAdmin.php" method="POST" enctype="multipart/form-Data">
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

function cargarProductos()
{
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarPoducAdmin();

  if (!isset($result)) {
    echo '<h2>No hay Productos registrados registrados</h2>';
  } else {
    foreach ($result as $f) {
      echo '
                <tr>
                    <td>' . $f['IdProducto'] . '</td>
                    <td>' . $f['NomProducto'] . '</td>
                    <td>' . $f['Proveedor'] . '</td>
                    <td>' . $f['Categoria'] . '</td>
                    <td>' . $f['Precio'] . '</td>
                    <td>' . $f['InfoVendedor'] . '</td>

                    <td><a href="modificar-producto.php?id=' . $f['IdProducto'] . '" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                    <td><a href="../../controllers/eliminarProducAdmin.php?id=' . $f['IdProducto'] . '" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
    }
  }

}

function cargarServiciosAdmin() {
  $objConsultas = new Consultas();
  $result = $objConsultas -> mostrarServicioAdmin();

  if ( !isset( $result ) ) {
      echo '<h2>No hay servicios registrados </h2>';
  } else {
      foreach ( $result as $f ) {
          echo '
              <tr>
                  <td>'.$f[ 'IdServicio' ] .'</td>
                  <td>'.$f[ 'NomServicio' ] . '</td>
                  <td>'.$f[ 'Proveedor' ] .'</td>
                  <td>'.$f[ 'Descripcion' ]. '</td>
                  <td><a href="modificarServicioAdmin.php?id='.$f[ 'IdServicio' ].'" class="btn btn-primary"><i class="ti-pencil-alt " ></i>  Editar</a></td>
                  <td><a href="../../controllers/eliminarServicioAdmin.php?id='.$f[ 'IdServicio' ].'" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
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
  $result = $objConsultas -> mostrarServiciosAdmin($id_Servicio);
  // pintamos la informacion consultada en el artefacto

  foreach ( $result as $f ) {
      echo'

      <form class="text-left clearfix"
                                          action="../../controllers/modificarServiciosAdmin.php" method="POST"
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

function cargarDenuncias()
{
  $objConsultas = new Consultas();
  $result = $objConsultas->mostrarQuejasAmin();

  if (!isset($result)) {
    echo '<h2>No hay Productos registrados registrados</h2>';
  } else {
    foreach ($result as $f) {
      echo '
                <tr>
                    <td>' . $f['NumerQueja'] . '</td>
                    <td>' . $f['Usuario'] . '</td>
                    <td>' . $f['Nombre'] . '</td>
                    <td>' . $f['Asunto'] . '</td>
                    <td>' . $f['Descripcion'] . '</td>
                    <td>' . $f['Fecha'] . '</td>

                    <td><a href="modificar-producto.php?id=' . $f['Usuario'] . '" class="btn btn-primary"><i class="ti-pencil-alt " ></i>Contestar</a></td>
                    <td><a href="../../controllers/eliminarProducAdmin.php?id=' . $f['Usuario'] . '" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
                </tr>
                ';
    }
  }

}


?>