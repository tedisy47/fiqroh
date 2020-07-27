
</!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
        #map {
            height: 100%;
        }
    </style>
</head>
<body>
  <h3><?=base_url()?></h3>
  <div id="map"></div>
<script src="<?=base_url()?>assets/js/MeasureTool.js"></script>
<script>
  var map, measureTool;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -6.385589, lng: 106.830711},
      zoom: 14,
      scaleControl: true
    });
    measureTool = new MeasureTool(map, {
      unit: MeasureTool.UnitTypeId.IMPERIAL
    });
    console.log(measureTool);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&amp;libraries=geometry&amp;callback=initMap" async defer></script>
</body>
</html>