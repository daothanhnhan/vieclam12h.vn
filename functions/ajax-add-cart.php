<?php 
session_start();
	if($_POST["action"] == "add"){  
              if(isset($_SESSION["shopping_cart"]))  
              {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                  if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"] && $_SESSION['shopping_cart'][$keys]['product_size'] == $_POST['product_size'])  
                  {  
                    $is_available++;  
                    $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                  }  
                }  
                if($is_available < 1)  
                {  
                  $item_array = array(  
                    'product_id'               =>     $_POST["product_id"],  
                    'product_name'             =>     $_POST["product_name"],  
                    'product_price'            =>     $_POST["product_price"],  
                    'product_quantity'         =>     $_POST["product_quantity"],
                    'product_size'             =>     $_POST['product_size']
                  );  
                  $_SESSION["shopping_cart"][] = $item_array;  
                }  
              }  
              else  
              {  
                $item_array = array(  
                  'product_id'               =>     $_POST["product_id"],  
                  'product_name'             =>     $_POST["product_name"],  
                  'product_price'            =>     $_POST["product_price"],  
                  'product_quantity'         =>     $_POST["product_quantity"],
                  'product_size'             =>     $_POST['product_size']
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
              }  
            } 
?>