<!--here-->
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
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<div class="container">
    <div class="checkoutLayout">

        
        <div class="returnCart">
            <a href="index.php">keep shopping</a>
            <h1>List Product in Cart</h1>
          
<div class="shopping-cart">



<table>
   <thead>
      <th></th>
      <th>name</th>
      <th>price</th>
      <th></th>
      <th>total  price</th>
      <th>action</th>
   </thead>
   <tbody>
   <?php
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
         while($fetch_cart = mysqli_fetch_assoc($cart_query)){
   ?>
      <tr>
        
         <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
         <td><?php echo $fetch_cart['name']; ?></td>
         <td>$<?php echo $fetch_cart['price']; ?>/-</td>
         <td>
            <form action="" method="post"> 
               <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">

               <!--<input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
              <!-- <input type="submit" name="update_cart" value="update" class="option-btn">-->

            </form>
         </td>
         <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
         <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
      </tr>
   <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
      }
   ?>
   <!--end-->
   <tr class="table-bottom">
      <td colspan="4">grand total :</td>
      <td>$<?php echo $grand_total; ?>/-</td>
      <td><a href="index.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>

   </tr>
</tbody>
</table>
</div>

        </div>


        <div class="right">
            <h1>Checkout</h1> 

            <div class="form">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name">
                </div>
    
                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone">
                </div>
    
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                </div>
    
                <div class="group">
                    <label for="country">Country</label>
                    <select name="country" id="country">
                        <option value="">Afghanistan</option>
                        <option value="">Brazil</option>       
                        <option value="">Cambodia</option>    
                        <option value="">Dominican Republic</option>    
                        <option value="">Egypt</option>                  
                        <option value="">France</option>    
                        <option value="">Germany</option>    
                        <option value="">Hungary</option>    
                        <option value="">Indonesia</option>    
                        <option value="">Japan</option>    
                        <option value="">Korea</option>    
                        <option value="">Laos</option>    
                        <option value="">Mexico</option>
                        <option value="">New Zealand</option>    
                        <option value="">Philippines</option>   
                        <option value="">Qatar</option>     
                        <option value="">Russia</option>    
                        <option value="">Singapore</option>    
                        <option value="">Turkey</option> 
                        <option value="">United States</option>    
                        <option value="">Vietnam</option>    
                        <option value="">Yemen</option>    
                        <option value="">Zambia</option>    
                    </select>
                </div>
    
                <div class="group">
                    <label for="city">City</label>
                    <select name="city" id="city">
                        <option value="">Choose..</option>
                        <option value="">London</option>
                    </select>
                </div>
            </div>
            <div class="return">
                <div class="row">
                    <div>Total Quantity</div>
                    <div class="totalQuantity">70</div>
                </div>
                
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice">$900</div>
                </div>
            </div>
            <button class="buttonCheckout">CHECKOUT</button>
            </div>
    </div>
</div>







<script src="checkout.js"></script>

</body>
</html>