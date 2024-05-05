<?php

class Video extends Controller
{
   public function __construct()
   {
      $cek = $this->func("Session")->cek_admin();
      if ($cek == 0) {
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }

      if (in_array("vd", $_SESSION['log_admin']['privilege']) == false) {
         session_destroy();
         header("Location: " . PC::BASE_URL_ADMIN . "Login");
         exit();
      }
   }

   public function index()
   {
      $data = [
         'title' => "Setting, " . __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $data = $this->db(0)->get_order("video", "video_id DESC");
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
   function add()
   {
      $vid_id = $_POST['video_id'];
      $comm = $_POST['comment'];

      $cols = "yt, comment, insertTime";
      $vals = "'" . $vid_id . "','" . $comm . "','" . $GLOBALS['now'] . "'";
      $in = $this->db(0)->insertCols("video", $cols, $vals);
      if ($in['errno'] <> 0) {
         echo $in['error'];
      } else {
         echo 0;
      }
   }

   function load_video($id)
   {
      $data = $id;
      $this->view(__CLASS__, __CLASS__ . "/video", $data);
   }

   function delete()
   {
      $id = $_POST['id'];
      $del  = $this->db(0)->delete_where("video", "video_id = " . $id);
      if ($del['errno'] <> 0) {
         echo $del['error'];
      } else {
         echo 0;
      }
   }
}
