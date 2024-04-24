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
}
