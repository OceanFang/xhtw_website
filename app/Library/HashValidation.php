<?php

namespace App\Library;

use App\Library\Encrypt;

class HashValidation
{
    protected $encrypt;
    protected $clientRepository;

    public function __construct(Encrypt $encrypt)
    {
        $this->encrypt = $encrypt;
    }

    /**
     * [createPFHash description]
     * @param  array  $ary [description]
     * @return [type]      [description]
     */
    public function createHash($secret, $ary = array())
    {
        $combinedHash = '';

        if (!array_key_exists('key', $ary)) {
            return false;
        }

        $secret = config($secret);
        if (!$secret) {
            return false;
        }

        foreach ($ary as $k => $value) {
            $combinedHash .= $value;
        }

        $hashEncrypt = $this->encrypt->encode($combinedHash, $secret);

        return $hashEncrypt;
    }
}
