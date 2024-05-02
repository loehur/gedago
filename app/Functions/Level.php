<?php

class Level extends Controller
{
   function level_nm($level)
   {
      foreach ($_SESSION['config']['level'] as $l) {
         if ($l['level'] == $level) {
            return $l['name'];
         }
      }
   }

   function watch_fee($level)
   {
      foreach ($_SESSION['config']['level'] as $l) {
         if ($l['level'] == $level) {
            return $l['benefit'][1]['fee'];
         }
      }
   }
}
