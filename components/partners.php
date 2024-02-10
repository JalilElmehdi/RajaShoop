<style>
    


.slick-slide{
    margin: 0 20px;
}
.slick-slide img{
    width: 100%;
    height:47px;
}
.slick-slider{
    position: relative;
    display: block;
    box-sizing: border-box;
}
.slick-list{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-track{
    position: relative;
    top: 0;
    left: 0;
    display: block
}
.slick-slide{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
.slick-slide img{
    display: block;
}
.slick-initialized .slick-slide{
    display: block;
}
.copy{
    padding-top: 250px;
}
</style>
<div class="container">
        <section class="customer-logos slider">
            <div class="slide"><img src="images/link.png" alt="logo"></div>
            <div class="slide"><img src="images/cashplus.png" alt="logo"></div>
            <div class="slide"><img src="images/google.png" alt="logo"></div>
            <div class="slide"><img src="images/onexbet.png" alt="logo"></div>
            <div class="slide"><img src="images/visa.jpg" alt="logo"></div>
            <div class="slide"><img src="images/amazonpay.svg" alt="logo"></div>
            <div class="slide"><img src="images/git.png" alt="logo"></div>
            <div class="slide"><img src="images/inwi.png" alt="logo" width="110%"></div>
        </section>
</div>

    

    <script>
    
    $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover:false,
            responsive: [{
                breakpoint: 768,
                setting: {
                    slidesToShow:4
                }
            }, {
                breakpoint: 520,
                setting: {
                    slidesToShow: 3
                }
            }]
        });
    });

    </script>

