<?php
namespace Jacksonit\Captcha\Library;

use Illuminate\Http\Request;
use Jacksonit\Captcha\Library\GIFEncoder;
class Captcha
{
    protected $captcha;
    protected $clave;

    function __construct($clave)
    {
        $key = $clave;
        $this->clave = $key;
        $this->captcha = imagecreatefromjpeg(__DIR__.'/img/bg.jpg');
        $posicion_x=2;
        $font = imageloadfont(__DIR__.'/font/HomBoldB.gdf');
        for($i = 0;$i<strlen($key);$i++){
            $r=0;
            $g=189;
            $b=167;
            $posicion_y=rand(5,15);
            $im = imagecreate(100, 100);
            $colorText = imagecolorallocate($this->captcha, $r, $g, $b);

            imagestring($this->captcha, $font, $posicion_x, $posicion_y, $key[$i], $colorText);
            $posicion_x+=25;
        }
        //Fix con el color de la segunda letra
        $white = ImageColorAllocate($this->captcha,0,0,0);
        ImageColorTransparent($this->captcha, $white);
    }

    public function imprimir()
    {
        \Session('captcha', $this->clave);
        header('Content-Disposition:filename="captcha.png"');
        if (!empty($this->frames) AND !empty($this->framed))
        {
            $gif = new GIFEncoder;
            $gif->GIFEncoderInit($this->frames, $this->framed, 0, 2, 0, 0, 0, 'url');

            Header ('Content-type:image/gif');
            echo $gif->GetAnimation();
            imagedestroy($this->captcha);
        }else{
            Header('Content-type:image/gif');
            imagegif($this->captcha);
        }

    }
}
