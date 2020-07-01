<?php 
    $slideshow = $action->getList('slideshow', '', '', 'id', 'asc', '', '', '');
?>
<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<div class="gb-slideshow_ruouvang">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gb-slideshow_ruouvang-slide owl-carousel owl-theme">
                    <?php
                    foreach ($slideshow as $key => $val) {
                    ?> 
                    <div class="item">
                        <a href="<?= $val['link'] ?>"><img src="/images/<?= $val['image']?>" alt="slideshow" class="img-responsive"></a>
                    </div>
                    <?php                            
                      }
                    ?> 
                </div>
            </div>
            <!-- <div class="col-md-1">
                <div class="gb-icon-home">
                    <img src="/images/icon-home.png" alt="slideshow" class="img-responsive">
                </div>
            </div> -->
        </div>
    </div>
</div>

<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-slideshow_ruouvang-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            autoplayTimeout:25000,
            nav:true,
            dots: false,
            autoplay: true,
            rewind: true,
            navText:[],
            items:1,
            responsive:{
                0:{
                    nav:false
                },
                767:{
                    nav:false
                }
            }
        });
    });
</script>