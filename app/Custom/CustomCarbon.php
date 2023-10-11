<?php

namespace App\Custom;

use Carbon\Carbon;

class CustomCarbon extends Carbon
{
   public function format($format)
   {
      // Set locale ke 'id' setiap kali method format dipanggil
      $this->setLocale('id');
      return $this->translatedFormat($format);
   }
}
