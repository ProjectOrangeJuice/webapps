<?php

namespace App\Quote;

class Qod {


    private $q = "Get a new one!";
    //Pretend api - We can change the api we use without changing the controllers
    private $api = "bla bla bla";

    public function getQuote(){
        return $this->q;
    }


    //We only want to get the quote once. As it's a per day thing we should really
    // get it once for all users. But it's the concept
    public function newQuote(){
        //$json = json_decode(file_get_contents('https://quotes.rest/qod'));
        $this->q = "The determination to win is the better part of winning.";//$json->contents->quotes[0]->quote;;
    }

}