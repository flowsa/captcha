<?php
/**
 * captcha plugin for Craft CMS 3.x
 *
 * Flows Captcha Plugin
 *
 * @link      www.flowsa.com
 * @copyright Copyright (c) 2021 Flow
 */

namespace flowsa\captcha\variables;

use flowsa\captcha\Captcha;

use Craft;

/**
 * captcha Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.captcha }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Flow
 * @package   Captcha
 * @since     1.0.0
 */
class CaptchaVariable
{
     public function generateCaptchaQuestion($formIdentifier)
     {
         // Generate a simple addition question
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);

        // Calculate the sum of num1 and num2
        $answer = $num1 + $num2;
        
        // Generate a question and convert numbers to words
        $questionInWords = $this->numberToWords($num1) . " + " . $this->numberToWords($num2) . " = ?";

        // Encrypt sum
        $encryptedAnswer = $this->encrypt($answer);
        
        // Store the sum in a session variable
        Craft::$app->getSession()->set('csrfToken_' . $formIdentifier , $encryptedAnswer);

        // Add question to and image and return image
        return $this->questionToImg($questionInWords);
     }

     private function numberToWords($number)
    {
        $words = ['One', 'Two', 'Three', 'Four', 'Five', 'Six','Seven','Eight','Nine','Ten'];
        return $words[$number - 1];
    }

    private function questionToImg($questionInWords)
    {
        // Create a new image with GD library
        $image = imagecreatetruecolor(200, 40);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $font = __DIR__ . '/rough.ttf';

        imagefilledrectangle($image, 0, 0, 199, 99, $background_color);

        // Add the question text to the image
        imagettftext($image, 20, 0, 10, 33, $text_color, $font, $questionInWords);

        // Save the image to a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'captcha');
        imagejpeg($image, $tempFilePath);

        // Return the binary data of the image
        $imageData = file_get_contents($tempFilePath);
        unlink($tempFilePath); // Remove the temporary file  
        
        return base64_encode($imageData);
    }

    private function encrypt($val)
    {
        // Store the cipher method 
        $ciphering = "AES-128-CTR"; 
        
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
        
        // Store the encryption key 
        $encryption_key = "FlowEncryption"; 

        // Use openssl_encrypt() function to encrypt the data 
        $encryption = openssl_encrypt($val, $ciphering, 
        $encryption_key, $options, $encryption_iv); 
        return $encryption;
    }
}
