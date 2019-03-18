<?php

function _t($slug, $replaceArray=[]){

    $translation = \App\Translations::getTranslation($slug);
    if(!empty($translation)){

        foreach($replaceArray as $search=>$replace){
            $translation = str_replace($search, $replace, $translation);
        }

        return $translation;
    }

    return "[Translation error #".$slug."]";

}