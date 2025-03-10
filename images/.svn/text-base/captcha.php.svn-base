<?php
 // echo "MODULE!!! <BR>";
//  ,
    
session_start();
//
    $string = getRandomString(5, 'lower');

//    ( )
    $width = 108;
    $height = 25;

//   .    15 ,
//     "press to change"
    $captcha = imagecreatetruecolor($width, $height + 15);

//
    $bg = imagecolorallocate($captcha, mt_rand(10, 50), mt_rand(10, 50), mt_rand(10, 50));

//
    $font_color = imagecolorallocate($captcha, mt_rand(220, 255), mt_rand(220, 255), mt_rand(220, 255));

    $white = imagecolorallocate($captcha, 255, 255, 255);
    $black = imagecolorallocate($captcha, 0, 0, 0);

//    ,
    imagefill($captcha, 0, 0, $white);
    imagefilledrectangle($captcha, 0, 0, $width, $height, $bg);

// ""       .
//
    for ($i = 0; $i < 4; $i++)
    {
    //
        $color = imagecolorallocate($captcha, mt_rand(170, 255), mt_rand(170, 255), mt_rand(170, 255));

    //
        imageline(
                   $captcha,
                   mt_rand(0, $width  - 1),
                   mt_rand(0, $height - 1),
                   mt_rand(0, $width  - 1),
                   mt_rand(0, $height - 1),
                   $color
                   );
    }

//
    imagestring($captcha, 5, 33, 4, $string, $font_color);

//
    $how_refresh = 'изменить код';
    //imagestring($captcha, 3, 2, 26, $how_refresh, $black);
	
	$font ='fonts/font3.ttf';

// Write the font to the image
//imagepstext($captcha, $how_refresh, $font, 12, $white, $black, 2, 26);

imagettftext($captcha,10,0,5,35,$black,$font,$how_refresh);


//
    $_SESSION['key'] = $string;

//   ,
    header('Content-type: image/png');

//       ( )
    imagepng($captcha);

/**
 *
 *
 * @param int $length  -
 * @param string $case -   ,   lower, upper,
 *                       both.       ,
 *                        lower
 * @return string - ,
 *
 */
    function getRandomString($length, $case = 'lower')
    {
        /*  ,    :
         *   : a b c e o p x l
         *   : A B C E H K M O P T X
         */
        $ban_chars = array('a', 'b', 'c', 'e', 'o', 'p', 'x', 'l',
                           'A', 'B', 'C', 'E', 'H', 'K', 'M', 'O', 'P', 'T', 'X');

        //    $case    ,
        //
        switch ($case)
        {
            case 'upper':
                $random_chars = range('A', 'Z');
            break;

            case 'both':
                $random_chars = array_merge(range('a', 'z'), range('A', 'Z'));
            break;

            case 'lower':
            default:
                $random_chars = range('a', 'z');
            break;
        }
    //   (   O_o,   )
        $random_chars = array_merge(range(1, 9), $random_chars);
    //
        $random_chars = array_diff($random_chars, $ban_chars);
    //
        shuffle($random_chars);
    //   $length
        $chars = array_slice($random_chars, 0, $length);
    //      -   .
        return implode('', $chars);
    }





 ?>