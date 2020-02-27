<?php

namespace Jacksonit\Captcha;

use Jacksonit\Captcha\Library\Captcha;

class CaptchaCharge extends Captcha
{
    public $frames;
    public $framed;

    function __construct()
    {
        parent::__construct();
        // if ($aleatorio == 1) {
        //     $n = rand(1,3);
        //     $n == 1 ? $this->circulo() : 'no' ;
        //     $n == 2 ? $this->bum() : 'no' ;
        //     $n == 3 ? $this->desliz() : 'no' ;
        // }
    }

    public function circulo()
    {
        $circulo_x = 40;
        $circulo_y = 0;
        $frames_x = 20;
        for($b=0;$b<$frames_x;$b++){
            $im = imagecreatetruecolor(120, 38);
            imagecopy($im, $this->captcha, 0, 0, 0, 0, imagesx($this->captcha), imagesy($this->captcha));
            //fix
            $white = ImageColorAllocate($im,255,255,255);
            ImageFill($im,0,0,$white);
            $circulo = imagecolorallocate($im, 0, 0, 0);
            imagefilledellipse( $im, $circulo_y, $circulo_x, 30, 30, $circulo );
            $fname = public_path('tmp/'.$b.'.gif');
            imagegif($im, $fname);
            $this->frames[] = $fname;
            $this->framed[] = 1;
            $circulo_y+=10;
            imagedestroy($im);
        }
        $this->imprimir();
    }

    public function bum()
    {
        $frames_x = 30;
        for($b=0;$b<$frames_x;$b++){
            $im = imagecreatetruecolor(120, 38);
            imagecopy($im, $this->captcha, 0, 0, 0, 0, imagesx($this->captcha), imagesy($this->captcha));
            //fix
            $white = ImageColorAllocate($im,255,255,255);
            ImageFill($im,0,0,$white);
            imagefilledrectangle($im,($b*5),($b*5),10+($b*5),10+($b*5),0);
            imagefilledrectangle($im,($b*1),($b*5),10+($b*1),10+($b*5),0);
            imagefilledrectangle($im,($b*3)*2,($b*1)+$b,10+($b*3)*2,10+($b*1)+$b,0);
            imagefilledrectangle($im,($b*4)*2,($b*2)+$b,10+($b*4)*2,10+($b*2)+$b,0);
            $fname = public_path('tmp/'.$b.'.gif');
            imagegif($im, $fname);
            $this->frames[] = $fname;
            $this->framed[] = 1;
            imagedestroy($im);
        }
        $this->imprimir();
    }

    public function desliz()
    {
        $imgwidth = imagesx($this->captcha);
        $imgheight = imagesy($this->captcha);
        $frames_x = 30;
        for($b=0;$b<$frames_x;$b++){
            $im = imagecreatetruecolor(120, 38);
            imagecopy($im, $this->captcha, 0, 0, 0, 0, imagesx($this->captcha), imagesy($this->captcha));
            //fix
            $white = ImageColorAllocate($im,255,255,255);
            ImageFill($im,0,0,$white);
            imagefilledrectangle($im,($b - 1) * 8 + 8,1,$imgwidth,$imgheight, 0);
            $fname = public_path('tmp/'.$b.'.gif');
            imagegif($im, $fname);
            $this->frames[] = $fname;
            $this->framed[] = 1;
            imagedestroy($im);
        }
        $this->imprimir();
    }
}