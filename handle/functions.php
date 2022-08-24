<?php
function validate(int $page , int $numberOfPages ){
    if($page >= 1 && $page <= $numberOfPages){
        return true;
    }else{
        return false;
    }

}
