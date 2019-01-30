<?php

namespace App\Library;

class Encrypt
{
    /**
     * Hash Encoding
     *
     * @param string $combine
     * @param string $secret
     * @param string $algo
     */
    public function encode($combine, $secret, $algo = 'sha256')
    {
        return hash_hmac($algo, $combine, $secret);
    }
}
