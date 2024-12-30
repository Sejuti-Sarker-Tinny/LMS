<?php
//function validation
    function selectAll($table, $link){
        $query = mysqli_query($link, "select * from $table");
        if($query){
            return $query;
        }
        else{
            $query = "Failed";
        }
    }
    function selectOne($table, $fieldOne, $argOne, $link){
        $query = mysqli_query($link, "select * from $table where $fieldOne = '$argOne' ");
        if($query){
            return $query;
        }
        else{
            $query = "Failed";
        }
    }
    function selectTwo($table, $fieldOne, $fieldTwo, $argOne, $argTwo, $link){
        $query = mysqli_query($link, "select * from $table where $fieldOne = '$argOne' and $fieldTwo = '$argTwo' ");
        if($query){
            return $query;
        }
        else{
            $query = "Failed";
        }
    }
    function selectThree($table, $fieldOne, $fieldTwo, $fieldThree, $argOne, $argTwo, $argThree, $link){
        $query = mysqli_query($link, "select * from $table where $fieldOne = '$argOne' and $fieldTwo = '$argTwo' and $fieldThree = '$argThree' ");
        if($query){
            return $query;
        }
        else{
            $query = "Failed";
        }
    }
    function nameFinder($db, $field, $arg, $link){
        $nameFinder = selectOne($db, $field, $arg, $link);
        if(mysqli_num_rows($nameFinder) == 1){
            $nameFinderR = mysqli_fetch_assoc($nameFinder);
            return $nameFinderR;
        }
        else{
            return null;
        }
    }