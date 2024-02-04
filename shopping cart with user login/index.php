<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?
    family=Poppins:wght@300;400;500;600;700&display-swap"
    rel="stylesheet">
    <script src="https://kit.fontawesome.com/8412332135.js" crossorigin="anonymous"></script>

</head>
<body>
 
    </div>
  </div>



    <div class="header">
    <div class="container"> 
    <div class="navbar"> 
        <div class="logo"> 
              <img src="images/logo.jpg"width="120px "height="90px">
              
        </div>    
        <nav>
            <ul>
                  <li><a href="index.php"> Home </a></li>        
                  <li><a href="#">About </a></li>
                  <li><a href="#">Contact </a></li>
                  <li><a href="account.php"> Account </a></li> 
                  <li><a href="checkout.php"> checkout</a></li> 
                  <li><a href="add cart.php">cart </a></li>                  
            </ul>
        </nav> 
        <header2>
        
        </header2>
        <img src="images/cart.gif"width="70px">
        
    </div>
    <div class="row">
        <div class="col-2">
        <h1>YOU DESERVE A <br> BETTER LOVELY PET</h1>
        <p> Get the best deal Now!</p>
        <a href="products.html" class="btn">explore now &#8594;</a>
        </div>
        <div class="col-2">
            <img src="images/Dogs Running.GIF"width="800px">
        </div>
    </div>
    </div>
    </div>

    <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">

<div class="user-profile2">

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>


</div>

<div class="products">

   <h1 class="heading">OUR BEST SELLER</h1>

   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">


         <img src="images/?php echo $fetch_product['image']; ?> alt="> 
         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_images" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   };
   ?>

        </div>
      </div>
    <!------categories--->
    <div class="categories">
        <div class="small-container">
        <div class="row">
            <div class="col-3">
                <img src="images/monitor 1.png"alt="">
            </div>
            <div class="col-3">
                <img src="images/monitor 2.png"alt="">
            </div>
            <div class="col-3">
                <img src="images/monitor 3.png"alt="">
            </div>
        </div>
    </div>
</div>

    <!------products--->
    <div class="small-container">
        <h2 class="title">Premuim Products</h2>
        <div class="row">
             <div class="col-4">
                  <img src="images/Pedigree.webp">
                  <h4>Pedigree</h4>
                  <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i> 
                </div>
                  <p>$6650.00</p>
                  <button>Add To Cart</button>
            </div>
            <div class="col-4">
                <img src="images/Royal Canin.webp">
                <h4>Royal Canin</h4>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i> 
              </div>
                <p>$4550.00</p>
                <button>Add To Cart</button>
          </div>
          <div class="col-4">
            <img src="images/Hill's Science Diet.jpg">
            <h4>Hill's Science Diet</h4>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i> 
          </div>
            <p>$3350.00</p>
            <button>Add To Cart</button>
      </div>
      <div class="col-4">
        <img src="images/Nutrience.webp">
        <h4>Nutrience</h4>
        <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i> 
      </div>
        <p>$50.00</p>
        <button>Add To Cart</button>
          </div>
    </div>  

        <!------latest--->
    <h2 class="title">Latest Products</h2>
    <div class="row">
        <div class="col-4">
             <img src="images/Holistic Select.webp">
             <h4>Holistic Select</h4>
             <div class="rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o"></i> 
           </div>
             <p>$600.00</p>
             <button>Add To Cart</button>
       </div>
       <div class="col-4">
           <img src="images/Acana.jpg">
           <h4>Acana</h4>
           <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i> 
         </div>
           <p>$550.00</p>
           <button>Add To Cart</button>
     </div>
     <div class="col-4">
       <img src="images/Orijen.jpg">
       <h4>Orijen</h4>
       <div class="rating">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i> 
     </div>
       <p>$150.00</p>
       <button>Add To Cart</button>
 </div>
 <div class="col-4">
   <img src="images/Bow Wow.jpg">
   <h4>Bow Wow</h4>
   <div class="rating">
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star-o"></i> 
 </div>
   <p>$510.00</p>
   <button>Add To Cart</button>
     </div>
     <div class="row">
        <div class="col-4">
             <img src="images/Pro Plan.jpg">
             <h4>Pro Plan </h4>
             <div class="rating">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star-o"></i> 
           </div>
             <p>$450.00</p>
             <button>Add To Cart</button>
       </div>
       <div class="col-4">
           <img src="images/Vitality.jpg">
           <h4>Vitality</h4>
           <div class="rating">
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i> 
         </div>
           <p>$560.00</p>
           <button>Add To Cart</button>
     </div>
     <div class="col-4">
       <img src="images/Alpo.webp">
       <h4>Alpo</h4>
       <div class="rating">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i> 
     </div>
       <p>$570.00</p>
       <button>Add To Cart</button>
 </div>
 <div class="col-4">
   <img src="images/Waggin' Tails.webp">
   <h4>Waggin' Tails</h4>
   <div class="rating">
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star"></i>
     <i class="fa fa-star-o"></i> 
 </div>
   <p>$510.00</p>
   <button>Add To Cart</button>
     </div>
</div>  
</div>
<!----offer-->
<div class="offer">
    <div class="small-container">
         <div class="row">
              <div class="col-2">
                   <img src="images/Special_Dog-removebg-preview.png"class="offer-img">
              </div>
              <div class="col-2">
                   <p>Exclusively Available on MRKYStore</p><br>
                   <h1>BESTSELLER </h1> <h2>90% OFF </h2>
                   <small>Welcome to a world where nutrition meets tail-wagging delight! At MRKYStore, we've crafted more than just dog food; we've created a recipe for vitality, health, and happiness. Our premium ingredients are a symphony of flavors and nutrients, ensuring that every bite nourishes your furry friend's body and soul. Because we believe that a well-fed dog is a joyful companion, ready to bound into each day with energy, vitality, and a wagging tail. Choose MRKYStore, where every meal is a celebration of the bond between you and your beloved canine companion.</small>
                   <a href="" class="btn"> Buy Now&#8594;</a>       

              </div>
            </div>
         </div>
    </div>

    <!---testimonial--->
    <div class="testimonial">
    <div class="small-container">
    <div class="row">
        <div class="col-3">
            <i class="fa fa-quote-left"></i>
            <p>PAG hindi kayo bumili kakagatin ko kayo RAWRR!!! KAYA BILI NA KAYO SA MRKStore solid to GAR! MONEY GUARANTEEN BASTA TIKMAN NIO MUNA? </p>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
       </div>
       <img src="images/raymark.jpg">
       <h3>RAYMARK DEGUZMAN</h3>
    </div>
    <div class="col-3">
      <i class="fa fa-quote-left"></i>
      <p>GAR SOLID!! lasang SKYFLAKES YUNG DOG FOOD NIO!! SOLIDD! RECOMMEND ko ito para sa mga may doggo 1month ko na gamit parang buntis na yung alaga kung aso!</p>
      <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
 </div>
 <img src="images/jerry.jpg">
       <h3>JERRY MUÑEZ</h3>
    </div>
    <div class="col-3">
      <i class="fa fa-quote-left"></i>
      <p>PANGET NG DOG FOOD NIO LAGYANKONG 1 STAR INAAMATSS</p>
      <div class="rating">
         
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
 </div>
 <img src="images/paneda.jpg">
       <h3>MARK ANTHONY PANEDA</h3>
    </div>
    <div class="col-3">
      <i class="fa fa-quote-left"></i>
      <p>ganda laki ng iprovement ng alaga kung aso grabee!! bali sa jowa ko pala pinapakain tuwing breakfast! masarap daw sabi ng jowa ko kaya napabili ako ng isang kaban rate 4start masyado nga lang mahal</p>
      <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
 </div>
 <img src="images/molina.jpg">
       <h3>KRISTINE MAE MOLINA</h3>
    </div>
    <div class="col-3">
      <i class="fa fa-quote-left"></i>
      <p>SOLLID ANG BILIS PA NG ORDER! SAMIN AT YUNG PACKAGING NAPAKA SOBRANG UNIQUE KAYA 5 STAR KA SAKIN RARWW!!</p>
      <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
 </div>
 <img src="images/belga2.jpg">
 <h3>CEEJAY PLOPINO BELGA</h3>
</div>

<div class="col-3">
  <i class="fa fa-quote-left"></i>
  <p>SINO MAN gumawa nito napaka solid mo GAR!! yung aso kung 1yr old nagbatak mag yung hindi ko na nakita kaya 3star kasakin  dahil wala ng palamunin sabahay!</p>
  <div class="rating">
      <i class="fa fa-star"></i>
      
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star-o"></i>
</div>
<img src="images/campano.jpg">
<h3>MARK JHON LOYD I CAMPANO </h3>
          </div>
       </div>
    </div>
  </div>

   <!---brands--->
   <div class="brands">
    <div class="small-container">
         <div class="row">
              <div class="col-5">
                <img src="images/joli.png">
              </div>
              <div class="col-5">
                <img src="images/tt">
              </div>
              <div class="col-5">
                <img src="images/inasal.jpg">
              </div>
              <div class="col-5">
                <img src="images/mcdo.png">
              </div>
              <div class="col-5">
                <img src="images/star.png">
              </div>
         </div>
    </div>
</div>

<!---footerl--->
<div class="footer">
  <div class="container">
       <div class="row">
            

              <div class="footer-col-2">
                <img src="images/msi logo.png"alt="">
                <h3>"At MRKStore, our purpose is clear - to elevate the well-being of your furry family members through thoughtfully crafted, premium dog food. We believe in nourishing more than just their bodies; we're dedicated to fueling their vitality, promoting longevity, and enhancing the joy they bring to your life. Each carefully selected ingredient in our recipes is a testament to our commitment to providing wholesome nutrition that aligns with your dog's health and happiness. Trust MRKStore to be the cornerstone of your dog's well-rounded and vibrant life, as we embark on this journey together, one bowl at a time of</h3>
            </div>
             <div class="footer-col-2">
                 <h3>Download Our App</h3> 
                 <p>Download App for Android and ios mobile phone.</p>
                 <div class="app-logo">
                  <img src="images/playstore.png">
                  <img src="images/apple.png">
            </div>
           
       </div>    
      </div>
    </div> 
    
    <script src="app.js"></script>

</body>
</html>