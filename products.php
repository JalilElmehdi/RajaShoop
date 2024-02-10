<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

// Vérifiez si le fichier add_cart.php existe avant de l'inclure
if (file_exists('components/add_cart.php')) {
    include 'components/add_cart.php';
} else {
    // Gérez l'erreur ou affichez un message approprié
    echo 'Le fichier add_cart.php n\'existe pas.';
}

// Définition du nombre de produits par page
$productsPerPage = 9;

// Récupération du numéro de page à afficher
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcul de l'offset
$offset = ($page - 1) * $productsPerPage;

// Récupération de la catégorie sélectionnée
if (isset($_POST['categorieF'])) {
    $categorieF = $_POST['categorieF'];
    if ($categorieF === "all") {
        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT :limit OFFSET :offset");
    } else {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = :categorie LIMIT :limit OFFSET :offset");
        $select_products->bindParam(':categorie', $categorieF);
    }
} else {
    $select_products = $conn->prepare("SELECT * FROM `products` LIMIT :limit OFFSET :offset");
}

$select_products->bindParam(':limit', $productsPerPage, PDO::PARAM_INT);
$select_products->bindParam(':offset', $offset, PDO::PARAM_INT);
$select_products->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      #show_products{
   max-width:1200px;
    margin: 0 auto;
    padding: 2rem;
      }
      #box-container{
         display: grid;
    grid-template-columns: repeat(auto-fit, 33rem);
    gap: 1.5rem;
    justify-content: center;
    align-items: flex-start;
      }
      #box-container .box{
         background-color: white;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 5px 5px 10px 1px rgb(0, 0, 0, 12%);
    gap: 17.5px;
    width: 260px;
      }
      #box-container .box img{
         width: 100%;
    margin-bottom: 10px;
      }
      .filtrer{
         padding:20px;
         margin-left:50px;
         width:300px;
         font-weight:bold;
      }
      .filtrer form{
         display:flex;
         justify-content:space-between;
         align-items:center;
      }
      .filtrer .btn{
         width:100px;
         background:#21C143;
         color:white;
         font-weight:400;
         margin-left:10px;
      }
      .pagination {
         margin-top: 20px;
         display: flex;
         justify-content: center;
      }
      .pagination a {
         padding: 8px 16px;
         text-decoration: none;
         border: 1px solid #ddd;
         color: black;
         margin: 0 4px;
      }
      .pagination a.active {
         background-color: #4CAF50;
         color: white;
         border: 1px solid #4CAF50;
      }
      .pagination a:hover:not(.active) {background-color: #ddd;}
      .pagination .page-link {
         font-size: 14px;
         cursor: pointer;
      }
   </style>
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Products</h3>
   <p><a href="home.php">home</a> <span> / products</span></p>
</div>

<!-- menu section starts  -->

<div id="show_products">
   <h1 class="title">ProductS</h1> 
   <div class="filtrer">
      <form action="" method="post">
      <select class="form-select" name="categorieF">
         <option value="">Categorie</option>
         <option value="Entrainement">Entrainement</option>
         <option value="Tenues de Match">Tenues de Match</option>
         <option value="Cadeaux et Accessoires">Cadeaux et Accessoires</option>
         <option value="all">All Products</option>

      </select>
      <input type="submit" value="Chercher" class="btn">
   </form>
   </div> <br>
<div id="box-container">

      <?php
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
            <br><div class="rate">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
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
   <!-- Pagination links -->
   <div class="pagination">
      <?php if ($page > 1) : ?>
         <a href="?page=<?= $page - 1 ?>" class="page-link">Previous</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $productsPerPage; $i++) { ?>
         <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
      <?php } ?>

      <?php if ($page < $productsPerPage) : ?>
         <a href="?page=<?= $page + 1 ?>" class="page-link">Next</a>
      <?php endif; ?>
   </div>

</div>

<!-- menu section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
