<?php

class C_Sess extends Controller
{
   function logout()
   {
      session_destroy();
      header("Location: " . PC::BASE_URL_ADMIN . "Login");
   }
}
