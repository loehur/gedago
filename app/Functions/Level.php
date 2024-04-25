<?php

class Level extends Controller
{
   function level_nm($level)
   {
      foreach (PC::LEVEL as $l) {
         if ($l['level'] == $level) {
            return $l['name'];
         }
      }
   }

   function watch_fee($level)
   {
      foreach (PC::LEVEL as $l) {
         if ($l['level'] == $level) {
            return $l['benefit'][1]['fee'];
         }
      }
   }
}
