<?php

namespace Yq\Tools;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class ImageProcessor
{

    /**
     * @param $local
     * @param $width
     * @param $height
     * @return string
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @throws \Exception
     */
    public function process($local, $width, $height)
    {

      $tempfile = tempnam(sys_get_temp_dir(), 'starfan_');
      if (!$tempfile) {
          throw new \Exception("can't create temp file");
      }
      Image::load($local)
          ->fit(Manipulations::FIT_CROP, $width, $height)
          ->format(Manipulations::FORMAT_JPG)
          ->optimize()->save($tempfile);
      return $tempfile;
  }
}
