<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Validate {


    public static $regexes = array(
		'date'			=> "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$",
        'time'          => "^\d\d?:\d\d\$",
        'id'            => "^[1-9][0-9]*\$",
		'amount'		=> "^[-]?[0-9]+\$",
		'number'		=> "^[-]?[0-9]+\$",
        'name'          => "[\p{L}0-9][\p{L}0-9 -.,']*",
        'title'         => "^[0-9\p{L} ,.\-_\\/s\?\!']+\$",
        'alfanum'       => "^[0-9\p{L} ,.\-_\\s\?\!]+\$",
        'alfanumplus'   => "^[0-9\p{L} ,.\-=_\\s\?\!)(&!@#$%^*\/;:~'\"\n]+\$",
        'string'        => "[0-9\p{L}]+",
		'words'			=> "^[\p{L}]+[\p{L} \\s]*\$",
		'phone'			=> "^[0-9]{10,11}\$",
		'zipcode'		=> "(^\d{5}\$)|(^\d{5}-\d{4}\$)",
		'plate'			=> "^([0-9a-zA-Z]{2}[-]){2}[0-9a-zA-Z]{2}\$",
		'price'			=> "^[0-9.,]*(([.,][-])|([.,][0-9]{2}))?\$",
		'2digitopt' 	=> "^\d+(\,\d{2})?\$",
		'2digitforce'	=> "^\d+\,\d\d\$",
		'anything'		=> "^[\d\D]{1,}\$",
		'email'			=> "^[A-Za-z0-9][A-Za-z0-9._%+-]*@(?:[A-Za-z0-9-]+\.)+[a-zA-Z]{2,4}\$",
        'token'         => "^[a-zA-Z0-9]+\$"
    );



    public function __construct() {

    }



    public function run($val, $tests) {

        $tests = explode('|', $tests);

        foreach ($tests AS $t) {
            $rez = $this->evaluate($val, $t);
            if (! $rez) return $rez;
        }

        return TRUE;
    }



    public function evaluate($val, $regex) {
        if (array_key_exists($regex, self::$regexes)) {
            $re = self::$regexes[$regex];

            if (! preg_match("/$re/u", $val)) {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }

        return TRUE;
    }



    public function is_alphanumPlus($str) {
        return TRUE;
        if (!$str) return FALSE;
        elseif (preg_match('/^[-a-zA-Z0-9.?\,)(&!@#$%^*\/;:\'"\n ]+$/Ds',$str)) return TRUE;
        else return FALSE;
    }



}

/* End of file Validate.php */