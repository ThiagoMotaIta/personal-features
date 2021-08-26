<?php

namespace App\Helpers;


class Helper
{
    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
    
        return $maskared;

        // echo mask($cnpj, '##.###.###/####-##').'<br>';
        // echo mask($cpf, '###.###.###-##').'<br>';
        // echo mask($cep, '#####-###').'<br>';
        // echo mask($data, '##/##/####').'<br>';
        // echo mask($data, '##/##/####').'<br>';
        // echo mask($data, '[##][##][####]').'<br>';
        // echo mask($data, '(##)(##)(####)').'<br>';
        // echo mask($hora, 'Agora são ## horas ## minutos e ## segundos').'<br>';
        // echo mask($hora, '##:##:##');
    }

    public static function apenasNumeros($var)
    {
        return preg_replace('/[^0-9]/', '', $var);
    }

    public static function telefone($number)
    {   
        $number =  preg_replace('/[^0-9]/', '', $number);
        $number="(".substr($number,0,2).") ".substr($number,2,-4)."-".substr($number,-4);
        // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
        return $number;
    }
}
