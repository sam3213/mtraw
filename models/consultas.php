<html>
    <head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
    </head>
<?php
    //creamos una clase que contiene todas las funciones crud del sistema
    class Consultas{
        //Modulo usuarios insertar

        // insertar usuarios de forma externa (Registro)
        public function insertarUserEx( $identificacion, $tipo_doc, $nombres,$apellidos ,$email,$telefono ,$claveMd, $rol, $estado
        ){
            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            //select de usuario registrado en el sistema
            //el objetivo de este select es identificar si el ususario ya existe en la base ded datos

            //Creamos el objeto de la conexion
            //creamos la variable que contenga la consulta
            $consultar = "SELECT * FROM usuarios WHERE Identificacion=:identificacion   OR Email=:email";
            // $consultar = "SELECT * FROM usuarios WHERE email=:email";

            $result = $conexion -> prepare($consultar);

            $result -> bindparam(":identificacion", $identificacion );
            $result -> bindparam(":email", $email );

            $result -> execute();

            $f = $result -> fetch();

            if($f){
                echo '<script> alert("El usuario ya existe") </script>';
                echo "<script>location.href='../views/Cliensite/login.html'</script>";
            }else{





            //creamos la variable que contiene la consulta a ejecutar
            $insertar ="INSERT INTO usuarios(Identificacion,TipoDocumento,Nombres,Apellidos,Email,Telefono,Clave,Rol,Estado) VALUES(:identificacion, :tipo_doc, :nombres,:apellidos ,:email,:telefono ,:claveMd, :rol, :estado)";

            //Preparamos lo necesario para ejecutar la funcion anterior

            $result= $conexion -> prepare($insertar);

            //convertimos los argumentos en parametros

            $result->bindparam(":identificacion", $identificacion);
            $result->bindparam(":tipo_doc", $tipo_doc);
            $result->bindparam(":nombres", $nombres);
            $result->bindparam(":apellidos", $apellidos);
            $result->bindparam(":email", $email);
            $result->bindparam(":telefono", $telefono);
            $result->bindparam(":claveMd", $claveMd);
            $result->bindparam(":rol", $rol);
            $result->bindparam(":estado", $estado);

            //ejecutamos el insert
            $result->execute();

            echo '<script> alert("Has creado tu cuenta con exito") </script>';
            echo "<script>location.href='../views/Cliensite/signin.html'</script>";
            }
        }

        // Modulo de administrador
        // insertar usuarios desde administrador
        public function insertarUserAdmin($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono , $clave, $rol, $estado, $foto
        ){
            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();


            $consultar = "SELECT * FROM usuarios WHERE Identificacion=:identificacion   OR Email=:email";
            // $consultar = "SELECT * FROM usuarios WHERE email=:email";

            $result = $conexion -> prepare($consultar);

            $result -> bindparam(":identificacion", $identificacion );
            $result -> bindparam(":email", $email );

            $result -> execute();

            $f = $result -> fetch();

            if($f){
                echo '<script> 
                swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "El usuario a registrar ya se encuentra en la base de datos",
                    confirmButtonText: "Regresar"
                }).then(function() {
                    window.location = "../views/administrador/registrar-usuario.php";
                });</script>';
                // echo "<script>location.href='../views/administrador/registrar-usuario.php'</script>";
            }else{

                //creamos la variable que contiene la consulta a ejecutar
            $insertar ="INSERT INTO usuarios(Identificacion,TipoDocumento,Nombres,Apellidos,Email,Telefono,Clave,Rol,Estado,Foto) VALUES(:identificacion, :tipo_doc, :nombres,:apellidos ,:email,:telefono ,:clave, :rol, :estado, :foto)";

            //Preparamos lo necesario para ejecutar la funcion anterior

            $result= $conexion -> prepare($insertar);

            //convertimos los argumentos en parametros

            $result->bindparam(":identificacion", $identificacion);
            $result->bindparam(":tipo_doc", $tipo_doc);
            $result->bindparam(":nombres", $nombres);
            $result->bindparam(":apellidos", $apellidos);
            $result->bindparam(":email", $email);
            $result->bindparam(":telefono", $telefono);
            $result->bindparam(":clave", $clave);
            $result->bindparam(":rol", $rol);
            $result->bindparam(":estado", $estado);
            $result->bindparam(":foto", $foto);

            //ejecutamos el insert
            $result->execute();

            echo '<script> 
                swal.fire({
                    icon: "success",
                    title: "Registro Exitoso",
                    text: "Registro al nuevo usuario exitosamente",
                    confirmButtonText: "Regresar"
                }).then(function() {
                    window.location = "../views/administrador/registrar-usuario.php";
                });</script>';
            }

        }

        // Mostrar Los usuarios desde el administrador
        public function mostrarUserAdmin(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT * FROM usuarios   ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;

        }

        //Mostrar las solicitudes al administrador
        public function mostrarSolicitudesAdmin(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT * FROM usuarios  WHERE  Estado= 'Pendiente' ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;

        }
        
        // mostrar los usuarios para poder modificarlos
        public function mostrarUsersAdmin($id_user){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM usuarios WHERE Identificacion=:id_user";
            $result = $conexion -> prepare ($buscar);

            $result-> bindParam(':id_user', $id_user);

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Se actualiza los usuarios desde el administrador
        public function ActualizarUserAdmin($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono, $rol, $estado){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET TipoDocumento=:tipo_doc, Nombres=:nombres, Apellidos=:apellidos, Email=:email, Telefono=:telefono, Rol=:rol, Estado=:estado WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("tipo_doc", $tipo_doc);
            $result->bindParam("nombres", $nombres);
            $result->bindParam("apellidos", $apellidos);
            $result->bindParam("email", $email);
            $result->bindParam("telefono", $telefono);
            $result->bindParam("rol", $rol);
            $result->bindParam("estado", $estado);

            $result-> execute();

            echo '<script>swal.fire({
                icon: "success",
                title: "Usuario modificado",
                confirmButtonText: "Ok"
            }).then(function() {
                window.location = "../views/administrador/ver-usuarios.php";
            });</script>';

            



        }

        //modificar la cuenta del administrador
        public function modificarCuentaAdmin($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Tipodocumento=:tipo_doc, Nombres=:nombres, Apellidos=:apellidos, Email=:email, Telefono=:telefono WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("tipo_doc", $tipo_doc);
            $result->bindParam("nombres", $nombres);
            $result->bindParam("apellidos", $apellidos);
            $result->bindParam("email", $email);
            $result->bindParam("telefono", $telefono);

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: 'Informacion modificada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/administrador/perfil.php?id=$identificacion';
            });</script>";

            



        }

        //ELIMINAR USUARIOS desde el administrador
        public function eliminarUserAdmin($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM usuarios WHERE Identificacion=:id";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);

            $result->execute();

            echo '<script> alert("Usuario Eliminado") </script>';
            echo "<script>location.href='../views/administrador/ver-usuarios.php'</script>";            

        }
        //Se logra ver el perfil esta funcion es universal para todos los roles
        public function verPerfil($id){
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM usuarios WHERE Identificacion=:id";
            $result = $conexion -> prepare ($buscar);

            $result-> bindParam(':id', $id);

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;
        }

        // Mostrar Los Productos desde el administrador
        public function mostrarPoducAdmin(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT * FROM productos ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        //ELIMINAR PRODUCTOS LADO ADMINISTRADOR
        public function eliminarProducAdmin($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM productos WHERE IdProducto=:id";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);

            $result->execute();

            echo '<script> alert("Producto eliminado") </script>';
            echo "<script>location.href='../views/administrador/verProductos.php'</script>";            

        }

        // Modulos productos insertar
        // insertar productos desde administrador
        public function insertarProducAdmin($nomProducto,$proveedor,$categoria,$cantidad,$precio, $foto1, $foto2, $foto3, $foto4, $infovendedor){

            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

                //creamos la variable que contiene la consulta a ejecutar
                $insertar ="INSERT INTO productos(NomProducto,Proveedor,Categoria,Cantidad,Precio,Foto1, Foto2, Foto3, Foto4, InfoVendedor) VALUES(:nomProducto, :proveedor,:categoria, :cantidad,:precio ,:foto1, :foto2, :foto3, :foto4, :infovendedor )";

                //Preparamos lo necesario para ejecutar la funcion anterior
    
                $result= $conexion -> prepare($insertar);
    
                //convertimos los argumentos en parametros
    
                $result->bindparam(":nomProducto", $nomProducto);
                $result->bindparam(":proveedor", $proveedor);
                $result->bindparam(":categoria", $categoria);
                $result->bindparam(":cantidad", $cantidad);
                $result->bindparam(":precio", $precio);
                $result->bindparam(":foto1", $foto1);
                $result->bindparam(":foto2", $foto2);
                $result->bindparam(":foto3", $foto3);
                $result->bindparam(":foto4", $foto4);
                $result->bindparam(":infovendedor", $infovendedor);


                

                

                //ejecutamos el insert
                $result->execute();
    
                echo '<script> alert("Has añadido con exito el producto") </script>';
                echo "<script>location.href='../views/administrador/registrarProducto.php'</script>";
        }

        // editar la foto del administrador
        public function actualizarFotoAdmin($id, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Foto=:foto WHERE Identificacion=:id";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("id", $id);
            $result->bindParam("foto", $foto);
            

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: foto actualizada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/administrador/perfil.php?id=$id';
            });</script>";

            echo "
            <script>
                location.href = '../views/administrador/perfil.php?id=$id'
            </script>
            ";

        }
        
        // Actualizar la clave del administrador
        public function actualizarClaveAdmin($identificacion, $clavemd){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Clave=:clavemd WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("clavemd", $clavemd);
            

            $result-> execute();

        

            echo "
            <script>
                location.href = '../views/administrador/perfil.php?id=$identificacion'
            </script>
            ";

        }

        // Registrar servicio  Administrador
        public function  insertarServicioAdmin($nomservicio,$proveedor,$descripcion,$foto1){
            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

                //creamos la variable que contiene la consulta a ejecutar
                $insertar ="INSERT INTO servicios(NomServicio ,Descripcion, Proveedor, Foto1) VALUES(:nomservicio, :descripcion,:proveedor, :foto1)";

                //Preparamos lo necesario para ejecutar la funcion anterior
    
                $result= $conexion -> prepare($insertar);
    
                //convertimos los argumentos en parametros
                
                $result->bindparam(":nomservicio", $nomservicio);
                $result->bindparam(":descripcion", $descripcion);
                $result->bindparam(":proveedor", $proveedor);
                $result->bindparam(":foto1", $foto1);
                
                //ejecutamos el insert
                $result->execute();
    
                echo '<script> alert("Has añadido con exito el Servicio") </script>';
                echo "<script>location.href='../views/administrador/registrarServicios.php'</script>";
        }

        // Mostrar servicios
        public function mostrarServicioAdmin(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM servicios ";
            $result = $conexion -> prepare ($buscar);


            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Mostrar productos para modificarlos
        public function mostrarServiciosAdmin($id_Servicio){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM servicios WHERE IdServicio=:id_Servicio";
            $result = $conexion -> prepare ($buscar);

            $result-> bindParam(':id_Servicio', $id_Servicio);

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

         // Se hace el update para actualizar los productos
         public function ActualizarServicioAdmin($IdServicio, $NomServicio, $Proveedor, $Descripcion){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE servicios SET IdServicio=:IdServicio, NomServicio=:NomServicio, Proveedor=:Proveedor, Descripcion=:Descripcion WHERE IdServicio=:IdServicio";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("IdServicio", $IdServicio);
            $result->bindParam("NomServicio", $NomServicio);
            $result->bindParam("Proveedor", $Proveedor);
            $result->bindParam("Descripcion", $Descripcion);
            
        

            $result-> execute();
            
            
            echo '<script>swal.fire({
                icon: "success",
                title: "Servicio modificado",
                confirmButtonText: "Ok"
            }).then(function() {
                window.location = "../views/administrador/verServicios.php";
            });</script>';
        }

        // Eliminar Servicios del vendedor
        public function eliminarServicioAdmin($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM servicios WHERE IdServicio=:id";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);

            $result->execute();

            echo '<script> alert("Servicio eliminado") </script>';
            echo "<script>location.href='../views/administrador/verServicios.php'</script>";            

        }

        // Contar los usuarios registrados para el administrador
        public function contarusuarios(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT COUNT(*) as total FROM usuarios ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        //Mostrar Quejas al admiistrador
        public function mostrarQuejasAmin(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM quejas";
            $result = $conexion -> prepare ($buscar);

           

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Contar los Productos registrados para el administrador
        public function  contarproductos(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT COUNT(*) as total FROM productos ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        // Contar los Productos registrados para el administrador
        public function  contarservicios(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT COUNT(*) as total FROM servicios ";

            $result = $conexion -> prepare($consultar);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        




        // seccion de vendedor
        // insertar productos desde Vendedor
        public function insertarProducVendedor( $Idproducto, $nomProducto,$proveedor,$categoria,$cantidad,$precio, $foto1, $foto2, $foto3, $foto4, $identificacion)
        {
            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

                //creamos la variable que contiene la consulta a ejecutar
                $insertar ="INSERT INTO productos(IdProducto, NomProducto,Proveedor,Categoria,Cantidad,Precio, Foto1, Foto2, Foto3, Foto4, InfoVendedor) VALUES(:Idproducto, :nomProducto, :proveedor,:categoria, :cantidad,:precio, :foto1, :foto2, :foto3, :foto4, :identificacion)";

                //Preparamos lo necesario para ejecutar la funcion anterior
    
                $result= $conexion -> prepare($insertar);
    
                //convertimos los argumentos en parametros
                $result->bindparam(":Idproducto", $Idproducto);
                $result->bindparam(":nomProducto", $nomProducto);
                $result->bindparam(":proveedor", $proveedor);
                $result->bindparam(":categoria", $categoria);
                $result->bindparam(":cantidad", $cantidad);
                $result->bindparam(":precio", $precio);
                $result->bindparam(":foto1", $foto1);
                $result->bindparam(":foto2", $foto2);
                $result->bindparam(":foto3", $foto3);
                $result->bindparam(":foto4", $foto4);
                $result->bindparam(":identificacion", $identificacion);



                //ejecutamos el insert
                $result->execute();
    
                echo '<script> alert("Has añadido con exito el producto") </script>';
                echo "<script>location.href='../views/Vendedor/registrarProducto.php'</script>";
        }

        // Mostrar Los Productos desde el Vendedor
        public function mostrarPoducVendedor($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT * FROM productos WHERE InfoVendedor=:id ";

            $result = $conexion -> prepare($consultar);
            $result -> bindParam(":id", $id);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        // Mostrar productos para modificarlos
        public function mostrarProducVendedor($id_Producto){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM productos WHERE IdProducto=:id_Producto";
            $result = $conexion -> prepare ($buscar);

            $result-> bindParam(':id_Producto', $id_Producto);

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Registrar servicio Vendedor
        public function  insertarServicioVendedor($nomservicio,$proveedor,$numeroServicio,$descripcion,$foto1){
            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

                //creamos la variable que contiene la consulta a ejecutar
                $insertar ="INSERT INTO servicios(NomServicio, Descripcion, Proveedor, Foto1, numeroServicio) VALUES(:nomservicio, :descripcion,:proveedor, :foto1, :numeroServicio)";

                //Preparamos lo necesario para ejecutar la funcion anterior
    
                $result= $conexion -> prepare($insertar);
    
                //convertimos los argumentos en parametros
                $result->bindparam(":nomservicio", $nomservicio);
                $result->bindparam(":descripcion", $descripcion);
                $result->bindparam(":proveedor", $proveedor);
                $result->bindparam(":foto1", $foto1);
                $result->bindparam(":numeroServicio", $numeroServicio);

                
                //ejecutamos el insert
                $result->execute();
    
                echo '<script> alert("Has añadido con exito el Servicio") </script>';
                echo "<script>location.href='../views/Vendedor/registrarServicio.php'</script>";
        }
        
        // Mostrar servicios
        public function mostrarServicioVendedor($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM servicios WHERE Proveedor=:id";
            $result = $conexion -> prepare ($buscar);
            $result->bindParam(":id", $id);


            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Eliminar Servicios del vendedor
        public function eliminarServicioVendedor($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM servicios WHERE IdServicio=:id";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);

            $result->execute();

            echo '<script> alert("Servicio eliminado") </script>';
            echo "<script>location.href='../views/Vendedor/verServicios.php'</script>";            

        }

        //mostrar los servicios para editar
        public function mostrarServiciosVendedor($id_Servicio){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM servicios WHERE IdServicio=:id_Servicio";
            $result = $conexion -> prepare ($buscar);

            $result-> bindParam(':id_Servicio', $id_Servicio);

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        // Se hace el update para actualizar los productos
        public function ActualizarServicioVendedor($IdServicio, $NomServicio, $Proveedor, $Descripcion){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE servicios SET IdServicio=:IdServicio, NomServicio=:NomServicio, Proveedor=:Proveedor, Descripcion=:Descripcion WHERE IdServicio=:IdServicio";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("IdServicio", $IdServicio);
            $result->bindParam("NomServicio", $NomServicio);
            $result->bindParam("Proveedor", $Proveedor);
            $result->bindParam("Descripcion", $Descripcion);
            
        

            $result-> execute();
            
            
            echo '<script>swal.fire({
                icon: "success",
                title: "Servicio modificado",
                confirmButtonText: "Ok"
            }).then(function() {
                window.location = "../views/Vendedor/verServicios.php";
            });</script>';
        }

        // Se hace el update para actualizar los productos
        public function ActualizarProductosVendedor($Idproducto, $nomProducto, $proveedor, $categoria, $cantidad, $precio){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE productos SET IdProducto=:Idproducto, NomProducto=:nomProducto, Proveedor=:proveedor, Cantidad=:cantidad, Precio=:precio, Categoria=:categoria WHERE IdProducto=:Idproducto";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("Idproducto", $Idproducto);
            $result->bindParam("nomProducto", $nomProducto);
            $result->bindParam("proveedor", $proveedor);
            $result->bindParam("categoria", $categoria);
            $result->bindParam("cantidad", $cantidad);
            $result->bindParam("precio", $precio);
        

            $result-> execute();

            echo '<script>swal.fire({
                icon: "success",
                title: "Producto modificado",
                confirmButtonText: "Ok"
            }).then(function() {
                window.location = "../views/Vendedor/verProductos.php";
            });</script>';
        }

        // Eliminar productos del vendedor
        public function eliminarProducVendedor($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM productos WHERE IdProducto=:id";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);

            $result->execute();

            echo '<script> alert("Producto eliminado") </script>';
            echo "<script>location.href='../views/Vendedor/verProductos.php'</script>";            

        }

        // Editar producto vendedor

        // Actualizar la foto del vendedor
        public function actualizarFotoVendedor($id, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Foto=:foto WHERE Identificacion=:id";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("id", $id);
            $result->bindParam("foto", $foto);
            

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: foto actualizada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/Vendedor/perfil.php?id=$id';
            });</script>";

            echo "
            <script>
                location.href = '../views/Vendedor/perfil.php?id=$id'
            </script>
            ";

        }

        // Actualizar la clave del Vendedor
        public function actualizarClaveVendedor($identificacion, $clavemd){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarioS SET Clave=:clavemd WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("clavemd", $clavemd);
            

            $result-> execute();

        

            echo "
            <script>
                location.href = '../views/Vendedor/perfil.php?id=$identificacion'
            </script>
            ";

        }

         //modificar la cuenta del Vendedor
         public function modificarCuentaVendedor($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET TipoDocumento=:tipo_doc, Nombres=:nombres, Apellidos=:apellidos, Email=:email, Telefono=:telefono WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("tipo_doc", $tipo_doc);
            $result->bindParam("nombres", $nombres);
            $result->bindParam("apellidos", $apellidos);
            $result->bindParam("email", $email);
            $result->bindParam("telefono", $telefono);

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: Informacion modificada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/Vendedor/perfil.php?id=$identificacion';
            });</script>";

            



        }

        // Contar los Productos registrados para el Vendedor
        public function  contarproductosVendedor($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT COUNT(*) as total FROM productos WHERE InfoVendedor=:id ";

            $result = $conexion -> prepare($consultar);

            $result->bindParam(":id", $id);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        // Contar los Productos registrados para el Vendedor
        public function  contarserviciosVendedor($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $consultar = "SELECT COUNT(*) as total FROM servicios WHERE Proveedor=:id";
            $result = $conexion -> prepare($consultar);
            $result->bindParam(":id", $id);

            $result->execute();

            while ($resultado = $result -> fetch()){
                $f[] = $resultado;
            }
            return $f;
        }

        //Mostrar las citas hechas por el cliente al vendedor 
        public function mostrarCitasVendedor($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * 
                       FROM citas A 
                       INNER JOIN servicios B ON A.Servicio = B.numeroServicio
                       INNER JOIN usuarios C ON A.Cliente = C.Identificacion WHERE Taller =:id AND EstadoCita='Pendiente'
                       ";

            $result = $conexion -> prepare ($buscar);
            $result ->bindParam(":id", $id) ;           
            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }
        //Mostrar las citas hechas por el cliente al vendedor Aceptadas
        public function mostrarCitasVendedorA($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * 
                       FROM citas A 
                       INNER JOIN servicios B ON A.Servicio = B.numeroServicio
                       INNER JOIN usuarios C ON A.Cliente = C.Identificacion WHERE Taller =:id AND EstadoCita='Aceptada'
                       ";

            $result = $conexion -> prepare ($buscar);
            $result ->bindParam(":id", $id) ;           
            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }
        //Mostrar las citas hechas por el cliente al vendedor Terminadas o canceladas
        public function mostrarCitasVendedorP($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * 
                       FROM citas A 
                       INNER JOIN servicios B ON A.Servicio = B.numeroServicio
                       INNER JOIN usuarios C ON A.Cliente = C.Identificacion WHERE Taller =:id AND EstadoCita IN ('Terminada', 'Cancelada')
                       ";

            $result = $conexion -> prepare ($buscar);
            $result ->bindParam(":id", $id) ;           
            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }
        //Cancelar cita cliente
        public function cancelarCitaVendedor($id, $cancelar){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "UPDATE citas SET EstadoCita=:cancelar WHERE IdCita=:id ";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);
            $result->bindParam(":cancelar", $cancelar);
            

            

            $result->execute();

            echo '<script> alert("La cita fue cancelada") </script>';
            echo '<script>location.href="../views/Vendedor/VerCitasP.php?"</script>';            

        }
        //Aceptar citas
        public function aceptarCitaVendedor($id, $aceptar){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "UPDATE citas SET EstadoCita=:aceptar WHERE IdCita=:id ";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);
            $result->bindParam(":aceptar", $aceptar);
            

            

            $result->execute();

            echo '<script> alert("La cita fue aceptada") </script>';
            echo '<script>location.href="../views/Vendedor/VerCitasA.php?"</script>';       

        }

        //Aceptar citas
        public function citaTerminadaVendedor($id, $terminada){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "UPDATE citas SET EstadoCita=:terminada WHERE IdCita=:id ";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);
            $result->bindParam(":terminada", $terminada);
            

            $result->execute();

            echo '<script> alert("La cita fue hecha y dado por terminada") </script>';
            echo '<script>location.href="../views/Vendedor/VerCitas.php?"</script>';       

        }

        //Mostrar citas para reagendar
        public function MostrarCitasReagendar($idCita, $fecha, $hora){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $reagendar = "UPDATE citas SET Fecha=:fecha, Hora=:hora WHERE IdCita=:idCita ";
            $result = $conexion->prepare($reagendar);

            $result->bindParam(":fecha", $fecha);
            $result->bindParam(":hora", $hora);
            $result->bindParam(":idCita", $idCita);


            $result->execute();

            echo '<script> alert("La cita fue Reagendada") </script>';
            echo '<script>location.href="../views/Vendedor/VerCitas.php?"</script>';  

            



        }





        // seccion del cliente
        // Modificar cuenta del cliente
        public function modificarCuentaCliente($identificacion, $tipo_doc, $nombres, $apellidos, $email, $telefono){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET TipoDocumento=:tipo_doc, Nombres=:nombres, Apellidos=:apellidos, Email=:email, Telefono=:telefono WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("tipo_doc", $tipo_doc);
            $result->bindParam("nombres", $nombres);
            $result->bindParam("apellidos", $apellidos);
            $result->bindParam("email", $email);
            $result->bindParam("telefono", $telefono);

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: 'Informacion modificada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/Cliente/perfil.php?id=$identificacion';
            });</script>";

            
            
            



        }
        // modificar clave cliente
        public function actualizarCliente($identificacion, $clavemd){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Clave=:clavemd WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("identificacion", $identificacion);
            $result->bindParam("clavemd", $clavemd);
            

            $result-> execute();

        

            echo "
            <script>
                location.href = '../views/Cliente/perfil.php?id=$identificacion'
            </script>
            ";

        }

        // actualizar foto cliente
        public function actualizarFotoCliente($id, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE usuarios SET Foto=:foto WHERE Identificacion=:id";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam("id", $id);
            $result->bindParam("foto", $foto);
            

            $result-> execute();

            echo "<script>swal.fire({
                icon: 'success',
                title: foto actualizada',
                confirmButtonText: 'Ok'
            }).then(function() {
                window.location = '../views/Cliente/perfil.php?id=$id';
            });</script>";

            echo "
            <script>
                location.href = '../views/Cliente/perfil.php?id=$id'
            </script>
            ";

        }
        
        //Mostrar servicios al cliente
        public function mostrarServicioCliente(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM servicios A INNER JOIN usuarios B ON A.Proveedor = B.Identificacion";
            $result = $conexion -> prepare ($buscar);

           

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        //Mostrar servicios al cliente
        public function mostrarProductosCliente(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM productos";
            $result = $conexion -> prepare ($buscar);

           

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }


        //Registrar una queja 
        public function insertarDenunciaCliente($usuario, $nombreUsuario, $asunto, $descripcion){
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $registrar = "INSERT INTO quejas (Usuario, Nombre, Descripcion, Asunto) values(:usuario, :nombreUsuario, :descripcion, :asunto)";

            $result = $conexion -> prepare($registrar);

            $result->bindParam("usuario", $usuario);
            $result->bindParam("nombreUsuario", $nombreUsuario);
            $result->bindParam("descripcion", $descripcion);
            $result->bindParam("asunto", $asunto);

            

            $result-> execute();

        
            echo '<script> alert("El mensaje fue enviado con exito") </script>';
            echo "<script> location.href = '../views/Cliente/contact.php'</script>";
        }

        //Mostrar las denuncias hechas por el cliente
        public function mostrarDenuncias($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * FROM quejas where Usuario=:id";
            $result = $conexion -> prepare ($buscar);

            $result->bindParam(":id", $id);

           

            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }

        //Mostrar las citas hechas por el cliente
        public function mostrarCitas($id){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            $buscar = "SELECT * 
                       FROM citas A 
                       INNER JOIN usuarios B ON  A.Cliente = B.Identificacion
                       INNER JOIN usuarios C ON A.Taller = C.Identificacion
                       INNER JOIN servicios D ON A.Servicio = D.numeroServicio Where Cliente=:id
                       ";

            $result = $conexion -> prepare ($buscar);
            
            $result -> bindParam(":id", $id);
            $result -> execute();

            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }
            
            return $f;

        }
        
        //Eliminar queja cliente
        public function eliminarQuejaCliente($id){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "DELETE FROM quejas WHERE NumerQueja=:id ";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);
            

            $result->execute();

            echo '<script> alert("Su queja a sido eliminada") </script>';
            echo '<script>location.href="../views/Cliente/Denuncias.php"</script>';            

        }

        //Registrar una Cita 
        public function insertarCitaCliente($fecha, $hora,$Nservicio,$Ncliente, $Ntaller, $estado){
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $registrar = "INSERT INTO citas (Cliente, Taller, Fecha, hora, Servicio, EstadoCita ) values(:Ncliente, :Ntaller, :fecha, :hora, :Nservicio, :estado)";

            $result = $conexion -> prepare($registrar);

            $result->bindParam(":Ncliente", $Ncliente);
            $result->bindParam(":Ntaller", $Ntaller);
            $result->bindParam(":fecha", $fecha);
            $result->bindParam(":hora", $hora);
            $result->bindParam(":Nservicio", $Nservicio);
            $result->bindParam(":estado", $estado);



            $result-> execute();

        
            echo '<script> alert("Tu cita fue registrada correctamente") </script>';
            echo "<script> location.href = '../views/Cliente/llanteras.php'</script>";
        }

        //Cancelar cita cliente
        public function cancelarCitaCliente($id, $cancelar){

            
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $eliminar = "UPDATE citas SET EstadoCita=:cancelar WHERE IdCita=:id ";
            $result = $conexion->prepare($eliminar);

            $result->bindParam(":id", $id);
            $result->bindParam(":cancelar", $cancelar);
            

            

            $result->execute();

            echo '<script> alert("Su cita Fue cancelada") </script>';
            echo '<script>location.href="../views/Cliente/Citas.php?"</script>';            

        }

        //Modificar cita cliente
        public function ModificarCitaCliente($fecha, $hora, $idCita){

            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            $actualizar = "UPDATE citas SET Fecha=:fecha, Hora=:hora WHERE IdCita=:idCita";

            $result = $conexion -> prepare($actualizar);

            $result->bindParam(":fecha", $fecha);
            $result->bindParam(":hora", $hora);
            $result->bindParam(":idCita", $idCita);
            

            $result-> execute();

            echo '<script>swal.fire({
                icon: "success",
                title: "Tu cita fue reagendada",
                confirmButtonText: "Ingresar"
            }).then(function() {
                window.location = "../views/Cliente/Citas.php";
            });</script>';

            



        }


    }


    class Validarsesion{

        public function iniciarSesion($identificacion,$clave){

            //Creamos el objeto de la conexion
            $objConexion = new Conexion();
            $conexion = $objConexion-> get_conexion();

            //creamos la variable que contiene la consulta a ejecutar
            $consultar = "SELECT * FROM usuarios WHERE Identificacion=:identificacion";

            $result = $conexion -> prepare($consultar);
            
            //convertimos los argumentos en parametros
            $result -> bindparam(":identificacion", $identificacion );

            //ejecutar consultar

            $result -> execute();

            //convertir la variable result en un arreglo para separar o segmentar la informacion

            $f = $result -> fetch();

            if($f){

                //verificar la contraseña
                if($f['Clave'] == $clave){
                    //validar el esatado de cuenta
                    if($f['Estado'] == "Activo"){
                       
                        //se realiza el inicio de sesion
                        session_start();
                        
                        //creamos variables de sesion
                        
                        $_SESSION['id'] =$f['Identificacion'];
                        $_SESSION['email']= $f['Email'];
                        $_SESSION['rol']= $f['Rol'];
                        $_SESSION['AUTENTICADO'] = "si";

                        //Validar el rol para redirecionar a la interfaz correcta

                        switch($f['Rol']){
                            case'Administrador':
                                echo '<script>swal.fire({
                                    icon: "success",
                                    title: "Bienvenido Administrador",
                                    confirmButtonText: "Ingresar"
                                }).then(function() {
                                    window.location = "../views/administrador/home.php";
                                });</script>';

                                // echo '<script> alert("Bienvenido administrador") </script>';
                                // echo "<script>location.href='../views/administrador/home.php'</script>";
                                break;
                            case'Vendedor':
                                echo '<script>swal.fire({
                                    icon: "success",
                                    title: "Bienvenido Vendedor",
                                    confirmButtonText: "Ingresar"
                                }).then(function() {
                                    window.location = "../views/Vendedor/home.php";
                                });</script>';

                                // echo '<script> alert("Bienvenido vendedor") </script>';
                                // echo "<script>location.href='../views/Vendedor/home.php'</script>";
                                break;
                            case'Cliente':
                                echo '<script>swal.fire({
                                    icon: "success",
                                    title: "Bienvenido Cliente",
                                    confirmButtonText: "Ingresar"
                                }).then(function() {
                                    window.location = "../views/Cliente/home.php";
                                });</script>';

                                // echo '<script> alert("Bienvenido Cliente") </script>';
                                // echo "<script>location.href='../views/Cliente/home.php'</script>";
                                // break;
                        }

                    }else{{
                        echo '<script>swal.fire({
                            icon: "error",
                            title: "Su estado es inactivo",
                            text: "Comuniquese con el administrador del sitio",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location = "../views/Cliensite/login.html";
                        });</script>';

                        // echo '<script> alert("su estado es inactivo") </script>';
                        // echo "<script>location.href='../views/Cliensite/login.html'</script>";
                    }}

                }else{
                    echo '<script>   swal.fire({
                        icon: "error",
                        title: "Clave incorrecta",
                        text: "Por favor completa todos los campos",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location = "../views/Cliensite/login.html";
                    });</script>';


                    // echo '<script> alert("Clave incorrecta") </script>';
                    // echo "<script>location.href='../views/Cliensite/login.html'</script>";
                }


            }else{
                echo '<script>swal.fire({
                    icon: "error",
                    title: "El usuario no esta registrado",
                    text: "Registrate!",
                    confirmButtonText: "OK"
                }).then(function() {
                    window.location = "../views/Cliensite/signin.html";
                });</script>';

                // echo '<script> alert("Usuario no registrado") </script>';
                // echo "<script>location.href='../views/Cliensite/login.html'</script>";
                
            }

        }

        public function cerrarSesion(){
            $objConexion = new Conexion();
            $conexion = $objConexion -> get_conexion();

            session_start();
            session_destroy();

            echo "<script>location.href='../index.php'</script>";
        }

    }
?>
</html>