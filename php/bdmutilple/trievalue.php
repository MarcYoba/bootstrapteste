<?php

class TrieValue{
    public function RemoveChaine($Mots,$phrase){

        return str_replace($Mots,'',$phrase);
    }
}