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
if ($_SESSION['Almacen']==1   )
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
          <center><label style="font-size:40px" id="idtitulo" align="left" > ARTÍCULOS  </label> </center>
        
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar articulos</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <!--<label id="prueba"  name="prueba" > 

                      <?php echo $_SESSION['login']; ?></label>-->
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover"style="border-color: black;">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre del articulo</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre del articulo</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="" height="400px"; id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <center><label style="font-size:25px">REGISTRA UN ARTÍCULO EN EL INVENTARIO</label></center>
                          <BR>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre del artículo(*):</label>
                            <input type="hidden" name="idarticulo" id="idarticulo">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>

              
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" height="400px">
                            <label>Categoria(*):</label>
                            <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                  <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción" required>
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Codigo:</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo de producto" >
                            
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" required >

                            <input type="hidden" name="imagenactual" id="imagenactual" style="margin-top: 10px;">

                            <img src="" width="150px" height="120px" id="imagenmuestra" style="margin-top: 10px">
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>

<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo.js"></script>
<?php

  }
  ob_end_flush();
?>