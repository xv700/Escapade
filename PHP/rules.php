<?php
namespace Rules; 
// /*
//  * where条件连接
//  */
function StrPeplace($str){
    $str = str_replace("Gte",">=",$str);
    $str = str_replace("Gt",">",$str);

    $str = str_replace("Lte","<=",$str);
    $str = str_replace("Lt","<",$str);

    $str = str_replace("NotNull","IS NOT NULL",$str);
    $str = str_replace("Null","IS NULL",$str);

    $str = str_replace("NotEq","<>",$str);
    $str = str_replace("Eq","=",$str);
    
    $str = str_replace("NotLike","NOT Like",$str);
    $str = str_replace("NotIn","Not In",$str);
    return $str;
}

function test(){

	return "test1111";
}
?>