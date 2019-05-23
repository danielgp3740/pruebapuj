<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/Javascript" src="js/jquery-1.9.1.min.js"></script>
    <!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwosOOqOZa96j9mY_GLElZ226EBatgsGI" type="text/javascript"></script>
	<script type="text/Javascript" src="js/gmap3.min.js"></script>

    <style>
      body, html{
        margin: 0;
        padding: 0;
        text-align:center;
      }
      .conteMapa{
        margin: 0;
        width: 100%;
        height: 400px;
      }
    </style>

	<link rel="stylesheet" href="_css__CK!/responsive.css" type="text/css" />

    <script type="text/javascript">

      $(function(){

        $('#idMapa').gmap3({
          map:{
            options:{
              center:[2.9377395,-75.2945239],
			  scrollwheel: false,
              zoom: 15
            }
          },
          marker:{
            values:[
              { latLng:[2.9377395,-75.29452392], data:"<h1><? echo $emp; ?></h1><p><? echo $dir; ?></p>", options:{icon: "_interfAz_CK!/ico_mapa.png"} }
			  /*
			  ,
              {address:"86000 Poitiers, France", data:"Poitiers : great city !"},
              {address:"66000 Perpignan, France", data:"Perpignan ! <br> GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}
			  */
            ],
            options:{
              draggable: true
            },
            events:{
              mouseover: function(marker, event, context){
                var map = $(this).gmap3("get"),
                  infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  $(this).gmap3({
                    infowindow:{
                      anchor:marker,
                      options:{content: context.data}
                    }
                  });
                }
              },
              mouseout: function(){
                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
              }
            }
          }
        });
      });
    </script>

    <body>
        <div id="idMapa" class="conteMapa"></div>
    </body>
</html>
