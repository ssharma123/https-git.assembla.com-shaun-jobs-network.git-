
<div style="width: 500px;">
<div style="padding: 10px;">
    <h3>Chicago, IL</h3>
    <p style="font-size: 15px;">222 W. Merchandise Mart Plaza, 12th Floor Chicago, IL 60654</p>
</div>
<div id="map-canvas" style="width: 500px; height: 300px;"></div>
</div>
<script>
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(41.8883695, -87.63536449999999);
        var mapOptions = {
            zoom: 15,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


        var address = "222 W. Merchandise Mart Plaza, 12th Floor Chicago, IL 60654";
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
//      alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    initialize();
</script>