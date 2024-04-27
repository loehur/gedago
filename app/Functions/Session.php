<?php

class Session extends Controller
{
   function cek()
   {
      if (isset($_SESSION['log'])) {
         return 1;
      } else {
         return 0;
      }
   }
}
