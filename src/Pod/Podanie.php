<?php

namespace Minneola\TestFoo\Pod;

class Podanie
{

   public function get($key)
   {
      return $_POST[$key];
   }

   public function all()
   {
      return $_POST;
   }

}
