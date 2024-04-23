<?php

class Session extends Controller
{
   function set_loc()
   {
      $lat = $_POST['lat'];
      $long = $_POST['long'];
      if (!isset($_SESSION['log'])) {
         if (!isset($_SESSION['tools']['location'])) {
            $_SESSION['tools']['location']['lat'] = $lat;
            $_SESSION['tools']['location']['long'] = $long;
         }
      }
   }

   function add_cart()
   {
      $id = $_POST['id'];
      $mode = $_POST['mode'];
      if ($mode == 1) {
         $_SESSION['cart'][$id]['jumlah'] += 1;
      } else {
         if ($_SESSION['cart'][$id]['jumlah'] <= 1) {
            unset($_SESSION['cart'][$id]);
            if (count($_SESSION['cart']) == 0) {
               unset($_SESSION['cart']);
            }
            exit();
         } else {
            $_SESSION['cart'][$id]['jumlah'] -= 1;
         }
      }

      $_SESSION['cart'][$id]['total'] = $_SESSION['cart'][$id]['harga'] * $_SESSION['cart'][$id]['jumlah'];
   }

   function logout_admin() // controller
   {
      session_destroy();
   }
}
