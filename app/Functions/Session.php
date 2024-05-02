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

   function cek_admin()
   {
      if (isset($_SESSION['log_admin'])) {
         return 1;
      } else {
         return 0;
      }
   }
}
