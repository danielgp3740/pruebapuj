<div class="titulo">
  Municipio: Colombia / Sectores / Programas
    <div class="bloDr">
        <input type="button" class="volver-modal" value="" alt="Regresar" title="Regresar">
    </div>
</div>
<div class="bloqIzq" style="background-image: url(img/municipios/colombia_id.png);">
  <div class="destacados">
      <ul>
        <!--
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
          <li><span data-codestacado="1"></span></li>
        -->
        </ul>
    </div>
</div>
<div class="bloqDer">
    <table>
      <tr>
        <td class="titul verVentana">Programa 1</td>
        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
      </tr>
      <tr>
        <td class="titul verVentana">Programa 2</td>
        <td><img src="img/ico/inf-ejecutado.png" /> 3.345.000</td>
        <td>10.234 <img src="img/ico/inf-genero.png" /></td>
      </tr>
    </table>
</div>
<script type="text/javascript">
    $("#programas .volver-modal").click(function(){
      ver_destacado = 0;
      ocultarDestacado();

      $("#programas").animate({left: "110%"}, 400);
    });

</script>
