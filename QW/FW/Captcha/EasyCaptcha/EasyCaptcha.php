<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 13. 6. 2015
 * Time: 23:35
 */

namespace QW\FW\Captcha\EasyCaptcha;

use QW\FW\Basic\Object;
use QW\FW\Basic\String;
use QW\FW\Images\ImageTextGenerate;
use QW\FW\Math\Math;
use QW\FW\Paint\Color;

class EasyCaptcha extends Object
{

    private $captcha;
    private $text;

    public function __construct($width = 400, $height = 200)
    {
        parent::__construct();

        $this->captcha = new ImageTextGenerate($width, $height);
        $this->captcha->setBackgroundColorO(new Color(0, 0, 0));
        $this->captcha->setTextColorO(new Color(255, 255, 255));
        $string = new String(uniqid());
        $this->text = $string->subString(0, 6);
        $this->captcha->setText(Math::randomInterval(0, 6), 0, 0, $this->text);
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPNG()
    {
        $this->captcha->toPNG();
    }

    public function getBMP()
    {
        $this->captcha->toBMP();
    }

    public function getJPG()
    {
        $this->captcha->toJPG();
    }

    public function getGIF()
    {
        $this->captcha->toGIF();
    }
}
