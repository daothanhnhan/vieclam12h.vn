<?php 
    $home_banner = $action->getList('slide', '', '', 'id', 'asc', '', '', '');
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-banner_ruouvang-vieclam">
    <div class="container">
        <div class="gb-banner_ruouvang-slide owl-carousel owl-theme">
            <?php foreach ($home_banner as $item) { ?>
            <div class="item">
                <img src="/images/<?= $item['image'] ?>" alt="" class="img-responsive">
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-banner_ruouvang-slide').owlCarousel({
            loop:true,
            margin: 30,
            navSpeed:500,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items:3,
                    nav:false
                }
            }
        });
    });
</script>