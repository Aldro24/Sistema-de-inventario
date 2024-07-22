<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['login']=='admin')
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <center><label style="font-size:40px" id="idtitulo"> Kardex </center></label> 
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        
                        <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Articulo</label>
                          <select name="idarticulo" id="idarticulo" class="form-control selectpicker" data-live-search="true" required>                         	
                          </select>                          
                          <button class="btn btn-success" onclick="listar()">Mostrar</button>
                        </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>id</th>
                            <th>fecha</th>
                             <th>tipo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Stock</th>
                            
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>id</th>
                            <th>fecha</th>
                            <th>tipo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Stock</th>
                          </tfoot>
                        </table>
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
<script type="text/javascript" src="scripts/kardex.js"></script>
<?php 
}
ob_end_flush();
?>


