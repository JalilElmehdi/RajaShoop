<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">



   

   <!-- <link rel="stylesheet" href="css/styleslide.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" > -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>There's only one color</h3>
               <p id="details-tenue"><a href="products.php" id="btn-seemenu">see products</a></p>
            </div>
            <div class="image">
               <img src="images/h.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>the black Eagle</h3>
               <p id="details-tenue"><a href="products.php" id="btn-seemenu">see products</a></p>
            </div>
            <div class="image">
               <img src="images/c.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>Order them now</h3>
               <p id="details-tenue"><a href="products.php" id="btn-seemenu">see products</a></p>
            </div>
            <div class="image">
               <img src="images/d.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">Products category</h1>

   <div class="box-container">

      <a href="category.php?category=Entrainement" class="box">
         <img src="images/cate1.png" alt="">
         <h3>Training</h3>
      </a>

      <a href="category.php?category=Tenues de Match" class="box">
         <img src="images/cate2.png" alt="">
         <h3>Match Outfits</h3>
      </a>

      <a href="category.php?category=Cadeaux et Accessoires" class="box">
         <img src="images/cate3.png" alt="">
         <h3>Gifts and Accessories</h3>
      </a>

      <a href="category.php?category=Mode" class="box">
         <img src="images/cate4.png" alt="" width="300px">
         <h3>Fashion</h3>
      </a>

   </div>

</section>





<div>
   <h1 class="title">ProductS</h1>  
<div class="container produits">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 4");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>


      <div class="box">
         <form action="" method="post">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>">

            <h2><?= $fetch_products['name']; ?></h2>
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <p><?= $fetch_products['description']; ?></p>
            <input type="hidden" name="qty" class="qty"  value="1" >
            <span><?= $fetch_products['price']; ?> MAD</span>
            <div class="rate">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i><br>

            </div>
            <div class="options">
                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"> AddToCart</button>
                
            </div>
         </form>
        </div>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
      
   </div>
      </div>
   <div class="more-btn">
      <a href="products.php" id="btn-viewall">view all</a>
   </div>
</div><br>


      
<div class="image-support">
   <img src="images/logohome.png" alt="">
</div>
<h1 class="title">Our Partners</h1>  
<?php include 'components/partners.php'; ?>


















<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});


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

</body>
</html>