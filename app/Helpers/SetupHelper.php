<?php

namespace App\Helpers;

use Schema;
use Easel\Models\Settings;
use Illuminate\Support\Facades\File;

class SetupHelper extends CanvasHelper
{
    /**
     * Ensure all required tables exist;.
     */
    public static function requiredTablesExists()
    {
        $requiredTables = array_merge(self::REQUIRED_TABLES, [
            self::TABLES['users'],
            self::TABLES['settings'],
        ]);

        foreach ($requiredTables as $table) {
            if (! Schema::hasTable($table)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Whether canvas is properly set up/installed.
     * @return bool
     */
    public static function isSetUp()
    {
        return Settings::installed() && self::requiredTablesExists();
    }

    /**
     * Whether canvas is properly installed.
     * @return bool
     */
    public static function isInstalled()
    {
        return true;
    }

    public static function installedBanner()
    {
        return PHP_EOL.'   ######       ##      ####     ##  ##      ##   ##       ########
  ##////##     ####    /##/##   /## /##     /##  ####     ##////// 
 ##    //     ##//##   /##//##  /## /##     /## ##//##   /##       
/##          ##  //##  /## //## /## //##    ## ##  //##  /#########
/##         ########## /##  //##/##  //##  ## ########## ////////##
//##    ## /##//////## /##   //####   //#### /##//////##        /##
 //######  /##     /## /##    //###    //##  /##     /##  ######## 
  //////   //      //  //      ///      //   //      //  ////////'.PHP_EOL;
    }
}
