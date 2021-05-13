<?php
/**
 * User: gabidj
 * Date: 2019-07-12
 * Time: 18:08
 */

namespace Devchain\LaravelToolkit\Helpers\Model;

class SecurityHelper
{
    public static function generatePassword($length = 12, $characterTypes = ['ludsD'])
    {
        $sets = [];
        $addDashes = false;
        if (strpos($characterTypes, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($characterTypes, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($characterTypes, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($characterTypes, 's') !== false)
            $sets[] = '!@#$%&*?';
        if (strpos($characterTypes, '-') !== false)
            $addDashes = true;


        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if (!$addDashes) {
            return $password;
        }

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
