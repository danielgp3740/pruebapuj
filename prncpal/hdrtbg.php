<?php
session_start();
$entidad_persona=$_SESSION['entidad_nombrepersona'];
$persona_nombre=$_SESSION['nomprsona']." ".$_SESSION['apeprsona'];
?>
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">

  <!-- BEGIN LOGO -->
  <div class="page-logo">
    <a href="index.html">
              <img src="img/logo_sm.png" alt="Administración" class="logo-default"/>
    </a>

    <div class="menu-toggler sidebar-toggler"></div>
  </div>
  <img src="img/camino_educacion.png" style="
      float: Left;
      margin-left: 68%;
      margin-top: 2px ;
      height: 40px;">
  <!-- END LOGO -->

  <!-- BEGIN RESPONSIVE MENU TOGGLER -->
  <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
  <!-- END RESPONSIVE MENU TOGGLER -->

  <!-- BEGIN TOP NAVIGATION MENU -->
  <div class="top-menu">
    <ul class="nav navbar-nav pull-right">

       <li class="dropdown dropdown-user ms-hover usuario">
                     <?php echo $entidad_persona; ?>
      </li>
      <li class="dropdown dropdown-user ms-hover usuario">
                      <?php echo $persona_nombre; ?>
      </li>

      <li class="dropdown dropdown-user ms-hover ">
        <!--
       <a href="" class="help">
         <input type="checkbox" id="spoiler2"></input>
         <label for="spoiler2">
            <img class="media-object" src="img/ico/ayuda.png" alt="Ayuda" title="Ayuda" />
         </label>
       -->
         <!-- <div class="spoiler"> Usted tiene 500 mensajes</div> -->

      <!-- </a> -->
      </li>

      <li class="dropdown dropdown-user ms-hover ">
        <!--
        <a href="" class="help">
        <input type="checkbox" id="spoiler3"></input>
        <label for="spoiler3">
        <img class="media-object" src="img/ico/campana.png" alt="Alerta" title="Alerta" />
        </label>
        <div class="spoiler"> Usted tiene 500 mensajes</div>
        </a>
      -->
              <!--  <span class="not">500</span> -->

      </li>
      <li class="dropdown dropdown-quick-sidebar-toggler">
        <a href="salir" class="dropdown-toggle">
        <img class="media-object" src="img/salir.png" alt="Salir" title="Salir" />
        </a>
      </li>
      <!-- END QUICK SIDEBAR TOGGLER -->
    </ul>
  </div>
  <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
