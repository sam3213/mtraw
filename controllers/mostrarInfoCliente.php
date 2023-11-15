<?php

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
    <ul>
        <img src="../' . $f['Foto'] . '" alt="" style="width:60px; height:60px; border-radius:50%;">
        <li >' . $f['Rol'] . '</li>
        <li>' . $f['Nombres'] . '</li>
        <li><a href="perfil.php?id=' . $f['Identificacion'] . '">Gestiona tu cuenta</a></li>
        <li><a href="../../controllers/cerrarSesion.php">Cerrar sesion</a></li>
    </ul>

      ';
  }

}

//Para enviar en el boton el id del usuario
function verActividadBoton()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();
  $id = $_SESSION['id'];

  $objConsultas = new consultas();
  $result = $objConsultas->verPerfil($id);

  foreach ($result as $f) {
    echo '
        
        <a href="Denuncias.php?id='.$f['Identificacion'].'">Mi actividad</a> 

      ';
  }

}

function verActividadNav()
{
  //variable de sesion para el login
  // si ya se inicio en el anterior archivo no debe existir en este
  // session_start();
  $id = $_SESSION['id'];

  $objConsultas = new consultas();
  $result = $objConsultas->verPerfil($id);

  foreach ($result as $f) {
    echo '
        
    <div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="Denuncias.php?id=' . $f['Identificacion'] . '">Denuncias y quejas</a>
    <a class="nav-link" href="Historial.php?id=' . $f['Identificacion'] . '">Historial de compras</a>
    <a class="nav-link" href="Citas.php?id=' . $f['Identificacion'] . '">Citas</a>
    <a class="nav-link" href="Historial.php?id=' . $f['Identificacion'] . '">Historial de compras</a>
    <a class="nav-link" href="#">Pricing</a>
  </div> 

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
                  <h2 style="text-align:center; padding-top:10px;">'.$f['Nombres'].' '.$f['Apellidos'].'</h2>
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
                      <div class="tab-pane fade show active in" id="home" role="tabpanel"
                          aria-labelledby="home-tab">
                          <form class="text-left clearfix" action="../../controllers/modificarCuentaCliente.php" method="POST" enctype="multipart/form-Data">
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
                          <form class="text-left clearfix" action="../../controllers/modificarFotoCliente.php" method="POST" enctype="multipart/form-Data">
                              <div class="row ">
                              <div class="form-group col-md-12">
                                      <input type="number" class="form-control" value="'.$f['Identificacion'].'"
                                          readonly placeholder="identificacion" name="identificacion">
                                  </div>

                                  <div class="form-group col-md-12">
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
                          <form class="text-left clearfix" action="../../controllers/modificarClaveCliente.php" method="POST" enctype="multipart/form-Data">
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


function mostrarQuejas(){
    $id = $_SESSION['id'];
    $objConsultas = new consultas();
    $result = $objConsultas->mostrarDenuncias($id);
    

        if (!isset($result)) {
            echo '<h2>No hay Quejas registradas hasta el momento</h2>';
        } else {
            foreach ($result as $f) {


    echo'<tr>
        <td>'.$f['Asunto'].'</td>
        <td>'.$f['Descripcion'].'</td>
        <td>'.$f['Fecha'].'</td>
        <td>'.$f['Asunto'].'</td>
        <td><a href="../../controllers/eliminarQuejaCliente.php?id='. $f['NumerQueja'] . '" class="btn btn-danger"><i class="ti-trash " ></i>  Eliminar</a></td>
    </tr>';
    }
}
}

function mostrarCitas(){

    $id = $_SESSION['id'];
    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitas($id);
    

        if (!isset($result)) {
            echo '<h2>Hasta este momento no has solitado ninguna queja</h2>';
        } else {
            foreach ($result as $f) {


    echo'<tr>
        <td>'.$f['NomServicio'].'</td>
        <td>'.$f['Nombres'].'</td>
        <td>'.$f['Direccion'].'</td>
        <td>'.$f['Fecha'].' / '.$f['Hora'].'</td>
        <td>'.$f['EstadoCita'].'</td>
        <td><a  data-bs-toggle="modal" data-bs-target="#'.$f['IdCita'].'" class="btn btn-primary"><i class="ti-trash " ></i>Reprogramar</a></td>
        <td><a href="../../controllers/cancelarCitaCliente.php?id='.$f['IdCita'].'" class="btn btn-danger"><i class="ti-trash " ></i>Cancelar</a></td>
    </tr>';
    }
}
}

//modal para reagendar la cita
function modalReagendar(){
    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->verPerfil($id);

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarServicioCliente();

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarCitas($id);
  
    foreach ($result as $f){


    echo '
    <div class="modal product-modal" id="'.$f['IdCita'].'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
  				<div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; max-height: 900px;"  >
    				<div class="modal-content " >

						<div class="modal-body" >
                            <div class="row">
                                <h3 style="text-align:center; margin-bottom: 30px;">Agendamiento de cita</h3>
                                <form class="text-left clearfix"
                                            action="../../controllers/ModificarCitaCliente.php" method="POST"
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
                                                <div class="form-group col-md-6">
                                                
                                                    <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$id.'"
                                                        name="IdCliente">
                                                </div>
                                                <div class="form-group col-md-6">
                                               
                                                    <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['Identificacion'].'"
                                                        name="IdTaller">
                                                </div>
                                                <div class="form-group col-md-6">
                                               
                                                <input type="hidden" class="form-control" placeholder="Cantidad" value="'.$f['IdCita'].'"
                                                    name="idcita">
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
    }
}

function mostrarServiciosIndexcliente(){
    $objConsultas = new consultas();
    $result = $objConsultas->mostrarServicioCliente();
  
    foreach ($result as $f) {
      echo '
      <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="../'.$f['Foto1'].'" alt="product-img" style="height: 400px;"/>
						<div class="preview-meta">
							<ul>
								<li>
                                    <a href="#" ><i class="fi fi-ss-map-marker"></i></a>
								</li>
								<li>
                                    <span  data-bs-toggle="modal" data-bs-target="#'.$f['IdServicio'].'">
			                            <i class="fi fi-ss-info"></i>
                                    </span>
								</li>
								<li>
                                    <span  data-bs-toggle="modal" data-bs-target="#2'.$f['IdServicio'].'">
                                        <i class="fi fi-brands-whatsapp"></i>
                                    </span>
									
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">'.$f['NomServicio'].'</a></h4>
						
					</div>
				</div>	
			</div>




  
        ';

} 
}

function modal(){

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarServicioCliente();
  
    foreach ($result as $f){


    echo '
    <div class="modal product-modal" id="'.$f['IdServicio'].'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
  				<div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; max-height: 900px;"  >
    				<div class="modal-content " >

						<div class="modal-body" >

							<div class="row">

							<div class="col-md-7" style="border: 2px solid black; border-radius:20px;">
								<div class="modal-image">
                                    <img class="img-responsive" src="../'.$f['Foto1'].'" alt="" style="height:450px;">
                                </div>
            
							</div>

							<div class="col-md-5" >
								<h2 class="product-title">'.$f['NomServicio'].'</h2>
								<p class="product-short-description">'.$f['Descripcion'].'</p>
							</div>

							</div>
							
						</div>
						<div class="modal-footer">
							
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
						</div>
						
    				</div>
  				</div>
			</div>
            ';
    }
}

function modalForm(){
    $id = $_SESSION['id'];

    $objConsultas = new consultas();
    $result = $objConsultas->verPerfil($id);

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarServicioCliente();
  
    foreach ($result as $f){


    echo '
    <div class="modal product-modal" id="2'.$f['IdServicio'].'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
  				<div class="modal-dialog modal-dialog-centered" style="max-width: 1200px; max-height: 900px;"  >
    				<div class="modal-content " >

						<div class="modal-body" >
                            <div class="row">
                                <h3 style="text-align:center; margin-bottom: 30px;">Agendamiento de cita</h3>
                                <form class="text-left clearfix"
                                            action="../../controllers/registrarCitasCliente.php" method="POST"
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
    }
}

function mostrarProductosClientes(){
    

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarProductosCliente();
  
    if (!isset($result)) {
        echo '';
    } else {
    foreach ($result as $f) {
      echo '
      <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="../'.$f['Foto1'].'" alt="product-img" style="height: 400px;" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#'.$f['IdProducto'].'">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>

                                


								<li>
			                        <a href="#!" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">'.$f['NomProducto'].'</a></h4>
						<p class="price">$'.$f['Precio'].'</p>
					</div>
				</div>
			</div>
        ';

} 
    }
}

function modalProductos(){

    $objConsultas = new consultas();
    $result = $objConsultas->mostrarProductosCliente();
    
    if(!isset($result)){
        echo'';
    }else{
    foreach ($result as $f){


    echo '
    <div class="modal product-modal fade" id="'.$f['IdProducto'].'">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="tf-ion-close"></i>
    </button>
      <div class="modal-dialog " role="document">
        <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="modal-image">
                            <img class="img-responsive" src="../'.$f['Foto1'].'" alt="product-img" style="height: 300px;"/>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="product-short-details">
                            <h2 class="product-title">'.$f['NomProducto'].'</h2>
                            <p class="product-price">$'.$f['Precio'].'</p>
                            <p class="product-short-description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil cum. Illo laborum numquam rem aut officia dicta cumque.
                            </p>
                            <a href="cart.html" class="btn btn-main">Add To Cart</a>
                            <a href="product-single.html" class="btn btn-transparent">View Product Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

            ';
    }}
}


function mostrarProductosindex(){
    $objConsultas = new consultas();
    $result = $objConsultas->mostrarProductosCliente();
  
    foreach ($result as $f) {
      echo '
      <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="Cliente/'.$f['Foto1'].'" alt="product-img" style="height: 400px;" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#'.$f['IdProducto'].'">

                                    

										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
			                        <a href="#!" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">'.$f['NomProducto'].'</a></h4>
						<p class="price">$'.$f['Precio'].'</p>
					</div>
				</div>
			</div>
        ';

} 
}

function mostrarServiciosIndex(){
    $objConsultas = new consultas();
    $result = $objConsultas->mostrarServicioCliente();
  
    foreach ($result as $f) {
      echo '
      <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="../'.$f['Foto1'].'" alt="product-img" style="height: 400px;"/>
						<div class="preview-meta">
							<ul>
								<li>
                                    <a href="#" ><i class="fi fi-ss-map-marker"></i></a>
								</li>
								<li>
                                    <span  data-bs-toggle="modal" data-bs-target="#'.$f['IdServicio'].'">
			                            <i class="fi fi-ss-info"></i>
                                    </span>
								</li>
								<li>
									<a href="#!"><i class="fi fi-brands-whatsapp"></i></a>
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">'.$f['NomServicio'].'</a></h4>
						
					</div>
				</div>	
			</div>
        ';
} 
}

?>