<section id="call-to-action">
    <div class="col">
        <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">LOKASI GUNA JAYA</h1>
            <div id="mapid" style="height:500px"></div>
            <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Contact Us : </p>
            <a href="<?= 'https://wa.me/+6281931425662' ?>" class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms"><i class="fab fa-2x fa-whatsapp white"></i> Chat With Admin</a>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="row content-justify-between">
            <div class="col-md-8 col-12 text-center text-lg-left text-md-left">
                <p class="copyright">Made by <b>3 Marjan</b></p>
            </div>
        </div>
    </div>
</footer>

<!-- Template Javascript Files
	================================================== -->
<!-- jquery -->
<script src="<?= base_url() ?>template_portofolio/plugins/jQurey/jquery.min.js"></script>
<!-- Form Validation -->
<script src="<?= base_url() ?>template_portofolio/plugins/form-validation/jquery.form.js"></script>
<script src="<?= base_url() ?>template_portofolio/plugins/form-validation/jquery.validate.min.js"></script>
<!-- slick slider -->
<script src="<?= base_url() ?>template_portofolio/plugins/slick/slick.min.js"></script>
<!-- bootstrap js -->
<script src="<?= base_url() ?>template_portofolio/plugins/bootstrap/bootstrap.min.js"></script>
<!-- wow js -->
<script src="<?= base_url() ?>template_portofolio/plugins/wow-js/wow.min.js"></script>
<!-- slider js -->
<script src="<?= base_url() ?>template_portofolio/plugins/slider/slider.js"></script>
<!-- Fancybox -->
<script src="<?= base_url() ?>template_portofolio/plugins/facncybox/jquery.fancybox.js"></script>
<!-- template main js -->
<script src="<?= base_url() ?>template_portofolio/js/main.js"></script>
<script>
    //CARA NAMPILKAN MAP

    var mymap = L.map('mapid').setView([-8.191968291899, 113.70963324663164], 16);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        id: 'mapbox/streets-v11',
        maxZoom: 18
    }).addTo(mymap);

    //CARA MENDAPATKAN KOORDINAT LOKASI

    var latInput = document.querySelector("[name=latitude]");
    var lngInput = document.querySelector("[name=longitude]");

    var curLocation = [-8.191968291899, 113.70963324663164];

    mymap.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true',
        }).bindPopup(position).update();
        $("#latitude").val(position.lat);
        $("#longitude").val(position.lng);
    });
    mymap.addLayer(marker);

    mymap.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (!marker) {
            marker = L.marker(e.latlng).addTo(mymap);
        } else {
            marker.setLatLng(e.latlng);
        }
        latInput.value = lat;
        lngInput.value = lng;
    });
</script>

</body>

</html>