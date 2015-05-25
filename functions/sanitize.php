<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 4/21/15
 * Time: 5:49 PM
 */
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}