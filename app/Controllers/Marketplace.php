<?php

class Marketplace extends Controller
{
   public function __construct()
   {
   }

   public function index()
   {
      $data = [
         'title' => __CLASS__,
         'content' => __CLASS__
      ];

      $this->view_layout(__CLASS__, $data);
   }

   public function content($parse)
   {
      $data = [
         [
            "level" => 1,
            "name" => "Trial",
            "topup" => 200000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "1x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 2,
            "name" => "Standar",
            "topup" => 600000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "3x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 1,
            "name" => "Junior",
            "topup" => 1800000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "5x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 1,
            "name" => "Luxury",
            "topup" => 5400000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "7x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 1,
            "name" => "Golden",
            "topup" => 16200000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "9x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 1,
            "name" => "Platinum",
            "topup" => 48600000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "11x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
         [
            "level" => 1,
            "name" => "Diamond",
            "topup" => 145800000,
            "benefit" => [
               "Daily Checkin Fee 0,5%",
               "13x Daily Watch Video Reels Fee 0.5%",
               "1x Subscribe Inflash Gedago Sosial Account"
            ]
         ],
      ];
      $this->view(__CLASS__, __CLASS__ . "/content", $data);
   }
}
