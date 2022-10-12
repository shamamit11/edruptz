<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js" id="jquery-js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/header.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script>
$(".bestseller").owlCarousel({
    items: 3,
    margin: 50,
    nav: true,
    autoplay: true,
    navText: false,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        767: {
            items: 3,
            nav: false
        },
        991: {
            items: 3,
            nav: true,
            loop: false
        }
    }
});
</script>
<script src='https://kenwheeler.github.io/slick/slick/slick.js'></script>
<script  src="{{ asset('assets/js/testimonials.js') }}"></script>
<?php /*?>
<script  src="{{ asset('assets/js/logoslider.js') }}"></script><?php */?>
<?php /*?><script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script><?php */?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script  src="{{ asset('assets/js/logoslider.js') }}"></script>