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
            <div class="row">
              <div class="col-md-12">
                <center> <label  style="font-size:40px">Permisos</label></center>
                  <div class="box">

                    <div class="box-header with-border">
                         
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            
                            <th>Nombre</th>
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            
                            <th>Nombre</th>
                            
                          </tfoot>
                        </table>
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
<script type="text/javascript" src="scripts/permiso.js"></script>
<?php
  }
  ob_end_flush();
?>