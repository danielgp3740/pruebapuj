<?php


if(isset($_POST['codigo_municipio'])){
  $municipiocodigo=$_POST['codigo_municipio'];

  $municipios = $principal_sql->municipioid($cnxn_pag, $municipiocodigo);
  $data_municipio=$cnxn_pag->obtener_filas($municipios);
  $mun_coory=$data_municipio['mun_coory'];
  $mun_coorx=$data_municipio['mun_coorx'];
  $coordenadasplanas=$mun_coory.",".$mun_coorx;


  if($municipiocodigo==1){
    $plano=8;
  }
  else{
    $plano=13;
  }

}
else{
  $coordenadasplanas="2.4193814,-75.0625839";
  $plano=8;
}

?>

<div id='map' style="width:100%; height: 100%"></div>

<script>
	/* var fields = ["id","codigo", "coory", "coordx", "observacion", "urlfoto"] campoalegre 2.6838959,-75.3341532*/
	var fields = ["geo_codigo","geo_coory", "geo_coorx", "geo_descripcion", "geo_fotourl"]
	//var map = L.map('map').setView([2.927, -75.28], 13);
  //var map = L.map('map').setView([2.4193814,-75.0625839], 8);
var map = L.map('map').setView([<?php echo $coordenadasplanas; ?>], <?php echo $plano; ?>);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

    getData();


function getData(){
    $.ajax("datosgeodata", {
        data:{
            table: "geodata"
            },
            success: function(data){
                mapData(data);
                }
        })
    };

function mapData(data){
	map.eachLayer(function(layer){
		if(typeof layer._url === "undefined"){
			map.removeLayer(layer);

		}


	});

	var geojson = {
		"type": "FeatureCollection",
		"features": []
	};
	var dataArray = data.split(", ;");
	dataArray.pop();
	dataArray.forEach(function(d){
		d = d.split(", ");
		var feature = {
			"type":"Feature",
			"properties": {},
			"geometry": {
				"type": "Point",
				"coordinates": []
			}

		};
		console.log(d[1]);
		feature.geometry.coordinates = [d[2], d[1]];
		console.log(feature.geometry.coordinates);
		for (var i=0; i<fields.length; i++){

			feature.properties[fields[i]] = d[i];


		};
		geojson.features.push(feature);

	})

	var mapDAtaLayer = L.geoJson(geojson,{
	pointToLayer:function (feature, latlng){
		var marketStyle = {
			fillColor:"#FF0066",
			color: "#FFF",
			fillOpacity: 0.5,
			opacity: 0.8,
			weight: 1,
			radius: 8

		};
		var greenIcon = L.icon({
    	iconUrl: './img/geolocalizarbig.png',
    	//shadowUrl: './icon/leaf-shadow.png',

    	iconSize:     [20, 33], // size of the icon
    	//shadowSize:   [50, 64], // size of the shadow
    	iconAnchor:   [16, 32], // point of the icon which will correspond to marker's location
    	//shadowAnchor: [4, 62],  // the same for the shadow
    	popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
		return L.marker(latlng, {icon: greenIcon});
	},
	onEachFeature: function (feature, layer){
		var html ="";
		/*for (prop in feature.properties){
			html+=prop+": "+feature.properties[prop]+"<br>";
			console.log(feature.properties['geo_fotourl']);

		};*/
		var imagen=feature.properties['geo_fotourl'];
		var textodata= feature.properties['geo_descripcion'];
		var enlace="<a href='"+imagen+"' target='_blank'><img src='"+imagen+"' height='152' width='152'></a><p>"+textodata+"</p>";
		html+=enlace;
		layer.bindPopup(html)
	}

}).addTo(map);

}
</script>
