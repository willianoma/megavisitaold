<!DOCTYPE html>
<html>
    <body>

        <p id="demo">Click the button to get your coordinates:</p>

        <button onclick="getLocation()">Try It</button>

        <script>
            var x = document.getElementById("demo");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                x.innerHTML = "Latitude: " + position.coords.latitude +
                        "<br>Longitude: " + position.coords.longitude;
                var lat = position.coords.latitude;
                var long = position.coords.longitude;


            }



        </script>


        <?php
        $lat = "<script>document.write(lat)</script>";
        echo "lat".$lat;
//$variavelphp = "<script>document.write(variaveljs)</script>";
//echo "Olá $variavelphp";
        ?>
    </body>
</html>
