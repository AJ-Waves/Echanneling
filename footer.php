<footer>
        <div class="container">
            <div class="col-md-2">
                <h4>Other</h4>
                <ul>
                    <li><a href="index.php">Channelling</a></li>
                    <li><a href="index.php">Medical Checkup</a></li>
                    <li><a href="index.php">Hemodialysis</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="#">Your Feedback</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h4>About</h4>
                <ul>
                    <li><a href="#">The Company</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Advertising</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h4>Contact</h4>
                <ul>
                    <li><a href="#">info.ABCchannelling@gmail.com</a></li>
                    <li>T: +94111234567</li>
                    <li>F: +94111234568</li>
                    <li>No 1111, Malabe,</li>
                    <li>Kaduwela, Sri Lanka.</li>
                </ul>
            </div>

            <div class="col-md-3 col-xs-12 social">
                <h4>Follow us on:</h4>
                <ul>
                    <li><a href=#><i class="icon ion-social-facebook"></i></a></li>
                    <li><a href=#><i class="icon ion-social-twitter"></i></a></li>
                    <li><a href=#><i class="icon ion-social-linkedin"></i></a></li>
                    <li><a href=#><i class="icon ion-social-googleplus"></i></a></li>
                    <!-- "https://web.facebook.com/abce.channelling" "https://twitter.com/ABC_Company_"   "https://www.linkedin.com/in/abc-chennelling-8b1914151/"   "https://mail.google.com/mail/?pc=topnav-about-en#inbox"-->
                </ul>

            </div>
        </div>
    </footer>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/bootstrap.min.js"></script>



<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        loop:true,
        autoplay:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            }

        }
    });

</script>

<script type="text/javascript">
    $('#doc_search').click(function(){
        var doc_name = $('#doc_name').val();
        var doc_specialty = $('#doc_specialty').val();
        var doc_hospital = $('#doc_hospital').val();
        var channelling_date = $('#channelling_date').val();

        $.ajax({
            url: 'ajax.php',
            data: {"doc_name": doc_name, "doc_specialty": doc_specialty, "doc_hospital": doc_hospital, "channelling_date": channelling_date },
            success: function(data){
                $('#search_result').html(data);
            }
        });
    });

</script>


</html>