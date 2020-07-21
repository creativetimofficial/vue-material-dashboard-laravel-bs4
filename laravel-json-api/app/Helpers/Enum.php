<?php
 
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Enum
{
    public static function getValues($table, $column)
    {
        // Pulls column string from DB
        $enumStr = DB::select(DB::raw('SHOW COLUMNS FROM '.$table.' WHERE Field = "'.$column.'"'))[0]->Type;
    
        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);
    
        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }
}
