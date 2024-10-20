<?php

namespace App\Quote;

class Qod {


    public $q = "Get a new one!";
    public function getQuote(){
        // $json = json_decode(file_get_contents('https://quotes.rest/qod'));
        // return $json->contents->quotes[0]->quote;
        return $this->q;
    }

    public function newQuote(){
        //$json = json_decode(file_get_contents('https://quotes.rest/qod'));
        $this->q = "Hello";//$json->contents->quotes[0]->quote;;
    }

}