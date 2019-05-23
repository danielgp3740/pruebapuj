<?php

  $menu_izquierdo = $principal_sql->menusql($cnxn_pag, $codigopadre);

?>
<div class="page-sidebar navbar-collapse collapse">



  <!-- BEGIN SIDEBAR MENU -->
<!--<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200"> MENU ABIERTO -->
<ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <?php
    /*
     if($_SESSION['prsona']=='201604281729001'){
     ?>
      <li><a href="escenarioAdministrativo"><img src="img/ico/escenario.png" /> <span class="title">Plan Desarrollo Departamental</span></a></li>
      <?php
      }
      */
      ?>


    <?php

    while($data_menuizq=$cnxn_pag->obtener_filas($menu_izquierdo)) {

        $codigo_sismenu=$data_menuizq['sys_codigo'];
        $nombre_sismenu=$data_menuizq['sys_nombre'];
        $url_sismenu=$data_menuizq['sys_url'];
        $sys_imagen=$data_menuizq['sys_imagen'];
        $sys_padre=$data_menuizq['sys_padre'];
        $sys_tipo=$data_menuizq['sys_tipo'];

        if($url_sismenu==$seccion || preg_match('/_NA_/i', $url_sismenu)){
            $enlace_menu="javascript:void(0)";
        }
        else {
            $enlace_menu=$url_sismenu;
        }


        //$beginmostrar="";
      //$endmostrar="";


          if ($codigo_sismenu==3 || $codigo_sismenu==58) {
            /// mostrar para los administradores
            $beginmostrar="<!--";
            $endmostrar="-->";
            //$url_sismenu="";

          if ($_SESSION['prsona']=='201604281729001' /*|| $_SESSION['prsona']=='20'*/) {
                $beginmostrar="";
                $endmostrar="";
                //echo "-entro-";

            }
            else {
                $beginmostrar="<!--";
                $endmostrar="-->";
                //$url_sismenu="";
            }

          }
          else {
            $beginmostrar="";
            $endmostrar="";
          }


      ?>
        <?php echo $beginmostrar; ?>
            <li>
                <a href="<?php echo $enlace_menu; ?>"><img src="<?php echo $sys_imagen; ?>" /> <span class="title"><?php echo $nombre_sismenu; ?></span>
                  <?php
                      if($sys_tipo==1 && preg_match('/_NA_/i', $url_sismenu) ){
                          echo  '<span class="arrow"></span>';
                      }
                      else {
                          echo  '';
                      }
                  ?>

                </a>
                <?php

              if($sys_tipo==1 && preg_match('/_NA_/i', $url_sismenu) /*$url_sismenu=='NA'*/ ){


                        echo '<ul class="sub-menu">';
                        $menu_izquierdohijo = $principal_sql->menusql($cnxn_pag, $codigo_sismenu);

                          while($data_menuizqhijo=$cnxn_pag->obtener_filas($menu_izquierdohijo)) {

                            $codigo_sismenuhijo=$data_menuizqhijo['sys_codigo'];
                            $nombre_sismenuhijo=$data_menuizqhijo['sys_nombre'];
                            $url_sismenuhijo=$data_menuizqhijo['sys_url'];
                            $sys_imagenhijo=$data_menuizqhijo['sys_imagen'];
                            //$sys_padre=$data_menuizqhijo['sys_padre'];

                            echo '<li><a href="'.$url_sismenuhijo.'"><img src="'.$sys_imagen.'" /> '.$nombre_sismenuhijo.'</a></li>';
                          }
                          echo "</ul>";
                        }
                      else{
                         echo "";
                      }




                ?>
            </li>
            <?php echo $endmostrar; ?>

    <?php } ?>


  </ul>
  <!-- END SIDEBAR MENU -->

</div>
