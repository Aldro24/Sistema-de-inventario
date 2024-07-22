<?php
//activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['Acceso']==1)
{
?>
<!--Contenido-->
<style>

body:not(.modal-open){ padding-right: 0px !important; }

</style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <center><label style="font-size:40px" id="idtitulo"> USUARIOS DEL SISTEMA </center></label> 
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    
                    <div class="box-header with-border">
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar un usuario</button>

                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" style="border-color: black;">
                          <thead >
                            <th >Opciones</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>N° de documento</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Foto</th>
                            <th>Estado</th>


                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>N° de documento</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Foto</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="" height="400px" id="formularioregistros" >
                        <form name="formulario" id="formulario" method="POST" >
                          <center><label style="font-size:30px">REGISTRA UN USUARIO EN EL FORMULARIO</label></center>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <label>Nombres y apellidos(*):</label>
                            <input type="hidden" name="idusuario" id="idusuario" >
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Documento(*):</label>
                          
                            <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required> 
                              <option value="cedula">CÉDULA</option>
                              <option value="RUC">RUC</option>
                              <option value="pasaporte">PASAPORTE</option></select>
                          </div>

              
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>N° de documento(*):</label>
                            <input type="text" name="num_documento" id="num_documento" class="form-control" maxlength="20" placeholder="Documento" required>
                          </div>


                  <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección(*):</label>
                            
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">

                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cargo:</label>
                            <input type="text" class="form-control" name="cargo" id="cargo" maxlength="20" placeholder="Cargo">

                            
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario(*):</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>

                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Clave(*):</label>
                            <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Clave" required>

                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Permisos:</label>
                        <ul id="permisos" style="list-style: none">
                          
                        </ul>
                          </div>



                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" >

                            <input type="hidden" name="imagenactual" id="imagenactual">

                            <img src="" width="150px" height="120px" id="imagenmuestra">
                          </div>

                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}

else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/usuario.js"></script>
<?php
  }
  ob_end_flush();
?>