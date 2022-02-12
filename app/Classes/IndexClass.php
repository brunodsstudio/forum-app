<?php

namespace App\Classes;

class IndexClass {

    public $_aJs = array();
    public $_aCss = array();

    public function preit($array, $die = false){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        if($die)die();

    }

    public function loadJs($aJs, $fullPath = null) {

        if (is_array($aJs)) {
            foreach ($aJs as $js) {
                array_push($this->_aJs, '<script type="text/javascript" src="' . SERVER_ROOT . 'js/' . $js . '"></script>');
            }
        }
    }

    public function loadJsFullPath($aJs) {

        if (is_array($aJs)) {
            foreach ($aJs as $js) {
                array_push($this->_aJs, '<script type="text/javascript" src="' . $js . '"></script>');
            }
        }
    }

    public function loadCss($aCss) {

        if (is_array($aCss)) {
            foreach ($aCss as $css) {
                array_push($this->_aCss, '<link rel="stylesheet" href="' . SERVER_ROOT . 'css/' . $css . '" type="text/css" >');
            }
        }
    }

    public function loadCssFullPath($aCss) {

        if (is_array($aCss)) {
            foreach ($aCss as $css) {
                array_push($this->_aCss, '<link rel="stylesheet" href="' . $css . '" type="text/css" >');
            }
        }
    }

    public function printJs() {
        foreach ($this->_aJs as $j) {
            echo $j . "\n";
        }
    }

    public function printCss() {
        foreach ($this->_aCss as $c) {
            echo $c . "\n";
        }
    }

    public function noInjection($ds_valor) {
        $ds_valor = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\'|\"|;|\*|%2527|%27|%00|--|\\\\)/i", '', $ds_valor);
        $ds_valor = trim($ds_valor);
        $ds_valor = strip_tags($ds_valor);
        $ds_valor = addslashes($ds_valor);
        return $ds_valor;
    }

    public function alert($msg) {
        echo "<script language='javascript'>
				<!--
					alert('" . $msg . "');
				-->
			  </script>";
    }

    public function redirect($page) {
        echo "<script language='javascript'>
				<!--
					parent.location.href='" . $page . "';
				-->
			  </script>";
    }

    public function atualiza() {
        echo "<script language='javascript'>
				<!--
					window.location.reload();
				-->
			  </script>";
    }

    public function formataData($data, $separador = "/") {
        $dia = substr($data, 8, 2);
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);
        // return $dia . $separador . $mes . $separador . substr($ano, 2, 4);
        return $dia . $separador . $mes . $separador . $ano;
    }

    public function formataDatabd($data, $hora = null) {
        $datas = explode('/', $data);


        $dia = $datas[0];
        $mes = $datas[1];
        $ano = $datas[2];
        if ($hora == null) {
            $dtfinal = $ano . "-" . $mes . "-" . $dia . " 00:00:00";
        } else {
            $dtfinal = $ano . "-" . $mes . "-" . $dia . $hora;
        }

        return $dtfinal;
    }

    public function __destruct() {
        //$this->closeCon();
    }

    function obj2arr($ob, $numeric = FALSE) {
        if ($numeric === TRUE) { //verifica se $numeric foi passado como true
            $arr = get_object_vars($ob); //coloca todas as propriedades do objeto em uma array associativa
            for ($i = 0; $i < count($arr); $i++) { //loop for simples para trocar os �ndices da array
                $arr2[$i] = $arr[key($arr)]; //troca o indice associativo por um numerico
                next($arr); //avan�a o ponteiro do array
            }
            return $arr2; //retorna a array numerica
        } else {
            return get_object_vars($ob); //retorna array associativa
        }
    }

    function arr2obj($arr) {
        $ob = new stdClass; //cria um novo objeto std, a classe stdClass � padr�o no PHP e cria uma classe vazia, ela � usada por fun��es internas como o mysql_fetch_object
        for ($i = 0; $i < count($arr); $i++) { //loop para criar as variaveis no objeto
            $obVar = key($arr); //pega o �ndce da array associativa
            $ob->$obVar = $arr[key($arr)]; //cria uma propriedade com o nome do �ndice do array
            next($arr); //avan�a o ponteiro do array
        }
        return $ob; //retorna o objeto criado
    }

    function traduzDataweek($str) {
        $array = array("Monday" => "Segunda-feira",
            "Tuesday" => "Terça-feira",
            "Wednesday" => "Quarta-feira",
            "Thursday" => "Quinta-feira",
            "Friday" => "Sexta-feira",
            "Saturday" => "Sábado",
            "Sunday" => "Domingo");

        if (array_key_exists($str, $array)) {
            return $array[$str];
        } else {
            return $str;
        }
    }

    function extenso($valor = 0, $maiusculas = false) {

        $singular = array("centavo", "real", "mil", "milh&atilde;o", "bilh&atilde;o", "trilh&atilde;o", "quatrilh&atilde;o");
        $plural = array("centavos", "reais", "mil", "milh&otilde;es", "bilh&otilde;es", "trilh&otilde;es",
            "quatrilh&otilde;es");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
            "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
            "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
            "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "tr&ecirc;s", "quatro", "cinco", "seis",
            "sete", "oito", "nove");

        $z = 0;
        $rt = "";

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++)
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                    $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000"
            )
                $z++;
            elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
            return($rt ? $rt : "zero");
        } else {

            if ($rt)
                $rt = ereg_replace(" E ", " e ", ucwords($rt));
            return (($rt) ? ($rt) : "Zero");
        }
    }

    public function colocaTresPontos($str, $qtde = 60) {
        if (strlen($str) > $qtde) {
            $str = substr($str, 0, $qtde) . "...";
        }
        return $str;
    }

    public function dicMeses($name) {

        $meses = array(
            "January" => "Janeiro",
            "February" => "Fevereiro",
            "March" => "Março",
            "April" => "Abril",
            "May" => "Maio",
            "June" => "Junho",
            "July" => "Julho",
            "August" => "Agosto",
            "September" => "Setembro",
            "October" => "Outubro",
            "November" => "Novembro",
            "December" => "Dezembro",
            "01" => "Janeiro",
            "02" => "Fevereiro",
            "03" => "Março",
            "04" => "Abril",
            "05" => "Maio",
            "06" => "Junho",
            "07" => "Julho",
            "08" => "Agosto",
            "09" => "Setembro",
            "10" => "Outubro",
            "11" => "Novembro",
            "12" => "Dezembro"
        );
        return $meses[$name];
    }

    public function formataDataCustom($dt) {
        $dtF = explode("-", $dt);
        return $dtF[2] . "/" . $dtF[1] . "/" . $dtF[0];
    }

    public function formataNumero($num, $format = null) {
        $nu = explode(".", $num);


        if (count($nu) == 1) {
            if ($nu[0] == "") {
                $num = "0" . $nu[1];
            }
            $r = $num . ".00";
        } else if (count($nu) == 2) {
            if ($nu[0] == "") {
                $num = "0" . $nu[1];
            }
            if (strlen($nu[1]) == 1) {
                $r = $num . "0";
            } else {
                $r = $num;
            }
        }
        return $r;
    }

    public function bubbleSort($array) {

        $nowData = null;
        for ($i = 0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data); $j++) {

                if ($data[$i] < $data[$j]) {
                    $nowData = $data[$i];
                    $data[$i] = $data[$j];
                    $data[$j] = $nowData;
                }
            }
        }
    }

    public function paginacao($total, $colunas) {
        $array = array();

        $i = count($total)-1;
        //var_dump($i); die();
        $info = $total;
        $aRow = 0;
        do {
            for ($a = 1; $a <= $colunas; $a++) {

                if ($a == 1) {
                    $aRow++;
                }

                if ($i >= 1) {
                    $array[$aRow][$a] = $info[$i];
                    $i--;
                }
            }
        } while ($i >= 1);
        
        
        return $array;
        
    }

    public function iterarPaginacaoArray(array $array, $antes, array $meio, $depois) {


        $str = $antes;
        foreach ($array as $a) {
            $str .= $meio[0];
            for ($x = 1; $x <= count($a); $x++) {
                $str .= $meio[1] . $a[$x] . $meio[2];
                //var_dump($str); die();
            }
            $str .= $meio[3];
        }
        $str .= $depois;
        return $str;
    }

}

?>
