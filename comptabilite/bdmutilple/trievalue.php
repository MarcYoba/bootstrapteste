<?php

class TrieValue{
    public function RemoveChaine($Mots,$phrase){
        if (str_contains($phrase,$Mots)) {
            return str_replace($Mots,'',$phrase);
        } else {
            return $phrase;
        }
        
        
    }
}