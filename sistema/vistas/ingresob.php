<?php
//activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Compras']==1)
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
          <center><label style="font-size:40px" id="idtitulo"> INGRESO </center></label> 
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar ingreso</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover"style="border-color: black;">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Tipo de comprobante</th>
                            <th>Número de comprobante</th>
                            <th>Total de compra</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Tipo de comprobante</th>
                            <th>Número de comprobante</th>
                            <th>Total de compra</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style= "" height= "400px" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <center><label style="font-size:30px"></label></center>
                          <br>
                          <br>
                         
                          <div class="form-group col-lg-6 col-md-8 col-sm-8 col-xs-12">
                            <label>Proveedor(*):</label>
                            <input type="hidden" name="idingreso" id="idingreso">
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora"required="" readonly><br>
                          
                          </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Comprobante(*):</label>
                        
                            <select id="tipo_comprobante" name="tipo_comprobante" class="form-control selectpicker" required="">

                            <option value="Factura">Factura</option>
                            <option value="Boleta">Boleta</option>
                            <option value="Ticket">Ticket de reserva</option>

                            </select>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie de comprobante:</label>
                            <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie" required="">
                          </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Número de comprobante:</label>
                            <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="">
                          </div>

                            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Impuesto:</label>
                            <input type="text" class="form-control" name="impuesto" id="impuesto"  required="">
                          </div>


                          <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Agregar Articulos</button>
                            </a>

                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                <th>Opciones</th>
                                <th>Articulos</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                              </thead>
                              <tfoot>
                                
                              <th>TOTAL</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th><H4 id="total">$.0.00</H4></th><input type="hidden" name="total_compra" id="total_compra">
                              </tfoot>
                              <tbody>

                              </tbody>
                            </table>
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button class="btn btn-danger" id="btnCancelar" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>

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

  <!--Ventana modal de articulos -->

<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
<div class="modal-dialog " style="width: 50% !important;" >
  <div class="modal-content " >
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

      <h4 class="modal-title"> Seleccione un artículo</h4>
    </div>
    <div class="modal-body" >
      <div class="panel-body table-responsive">
      <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover"  >
                        <thead >
                            <th >Opciones</th>
                            <th >Nombre del articulo</th>
                            <th >Categoria</th>
                            <th >Codigo</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                          </thead>
                          <tbody>
                            
                          </tbody>

                          <tfoot>
                            <th >Opciones</th>
                            <th >Nombre del articulo</th>
                            <th >Categoria</th>
                            <th>Codigo</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                      
                          </tfoot>
                         
      </table> 
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar
    </div>

  
  </div>
</div>

</div>
  <!--  Fin ventana modal-->

<?php
}

else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/ingresob.js"></script>
<?php
  }
  ob_end_flush();
?>