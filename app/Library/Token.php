<?php

namespace App\Library;

use App\Token as TokenModel;

class Token
{
    public function generate($number = 30)
    {
        $factory = new \RandomLib\Factory;
        $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));

        return $generator->generateString($number, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890');
    }

    /**
     * Check if token exists
     *
     * @param string $token
     * @return eloquent
     */
    public function validate($token)
    {
        return TokenModel::where(['token' => $token, 'used' => 0])->first();
    }

    /**
     * Combine token with salt
     *
     * @param string $token
     * @param string $salt
     * @return string
     */
    public function tokenWithSalt($token, $salt)
    {
        return hash('sha256', $token . $salt);
    }
}
