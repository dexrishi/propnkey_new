<script src="{{asset('/frontassets/js/jquery.min.js')}}"></script>
<script src="{{asset('/frontassets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/frontassets/js/owl.carousel.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


<script>
    $(document).ready(function(){
        $('#nav-icon3').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>
<script>
    var navIcon3 = document.getElementById("nav-icon3");
    if (navIcon3) {
        navIcon3.onclick = function() {
            var div = document.getElementById("myDiv");
            if (div) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        };
    }
</script>
<script>
    var searchFormIcon = document.getElementById("search_form-settings_icon_white");
    if (searchFormIcon) {
        searchFormIcon.onclick = function() {
            var div = document.getElementById("myDivser");
            if (div) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        };
    }
</script>
