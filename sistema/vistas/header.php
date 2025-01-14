<?php
if(strlen(session_id())< 1)
session_start();
?>

<!DOCTYPE html>
<html>
<style>

body:not(.modal-open){ padding-right: 0px !important; }

</style>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Distribuidora Sandrely </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

<!--DATATABLES -->

<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
<link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" >
<link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">


  </head>
  <body class="hold-transition skin-black sidebar-mini ">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="Inicio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><img src="../public/images/logosd1.jpeg" style="width:30px;height:40px;"></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b style="font-family: Times New Roman; font-size: 25px;"> Dis. Sandrely </label></b></span>

        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen'];?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['login']; ?> &nbsp;&nbsp;<i class="fa fa-sort-desc" ></i></span>

                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen'];?>" class="img-circle" alt="User Image">
                    <p>
                      
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  
                  <li class="user-footer">
                   <label><p >&nbsp;&nbsp;&nbsp;</p></label><label  style="font-size:18px" > <i class="fa fa-user"  ></i>&nbsp;&nbsp;Perfil:</label> <label style="font-size:18px; padding-left: 5px;"><?php echo  $_SESSION['nombre']; ?></label>
                    <div class="pull-right">
                      
                      
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-primary state loading btn-lg " style=" margin-right: 100px; background-color: darkslategray; width:120px;height:40px;font-size:13.5px" ><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar Sesión</a>

                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        
        <!-- sidebar: style can be found in sidebar.less -->


<section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
           <?php
            if ($_SESSION['Escritorio']==1 )
            {
              echo '<li>
              <a href="escritorio.php">
                <i class="fa fa-pie-chart"></i> <span>Estadisticas</span>
              </a>
            </li> '; 
          }
          ?>

        

             <?php
            if ($_SESSION['Almacen']==1 && $_SESSION['login']=='admin')
            {
              echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                
              </ul>
            </li>'; 
          } else if ($_SESSION['Almacen']==1 && $_SESSION['login']!='admin')
            {
              echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoriab.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="articulob.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                
              </ul>
            </li>';
          }
          ?>

    
          <?php
            if ($_SESSION['Compras']==1 && $_SESSION['login']=='admin')
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li> '; 
          }else if ($_SESSION['Compras']==1 && $_SESSION['login']!='admin')
            {
              echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingresob.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="proveedorb.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                
              </ul>
            </li>';
          }
          ?>
                       
            <?php
            if ($_SESSION['Ventas']==1 && $_SESSION['login']=='admin')
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>  '; 
          }
          else if ($_SESSION['Ventas']==1 && $_SESSION['login']!='admin')
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventab.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="clienteb.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>  ';
          }
          ?>

            <?php
            if ($_SESSION['Acceso']==1 && $_SESSION['login']=='admin')
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
              
                
              </ul>
            </li> '; 
          }
          else if ($_SESSION['Acceso']==1 && $_SESSION['login']!='admin' )
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuariob.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                
              </ul>
            </li> ';
          }
          ?>

              <?php
            if ($_SESSION['Consultac']==1 && $_SESSION['login']=='admin')
            {
              echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>
            '; 
          }
          else if ($_SESSION['Consultac']==1 && $_SESSION['login']!='admin')
            {
            echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="comprasfechab.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>
            ';
          }
          ?>                    
            
            <?php
            if ($_SESSION['Consultav']==1 && $_SESSION['login']=='admin')
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li> '; 
          }
           else if ($_SESSION['Consultav']==1 && $_SESSION['login']!='admin')
            {
            echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechaclienteb.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li> ';
          }
          ?>

                 <?php
            if ($_SESSION['login']=='admin' )
            {
              echo '<li>
              <a href="kardex.php">
                <i class="fa fa-list-alt"></i> <span>Inventario</span>
              </a>
            </li> '; 
          }
          ?>
          


         
            
            
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      
         
      </aside>