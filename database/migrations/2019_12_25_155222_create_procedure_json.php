<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureJson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        \Illuminate\Support\Facades\DB::unprepared("
            Create Procedure p_json_result 
            (
                @id int
            )
            as
            Begin
            DECLARE @source VARCHAR(MAX), @encoded VARCHAR(MAX), @decoded VARCHAR(MAX);
            
            
            Select @source = json_result from v_json_result where id = @id;
            
            SET @encoded = (SELECT dbo.fn_string_To_BASE64(@source));
            
            SET @decoded = (SELECT dbo.fn_BASE64_To_String(@encoded));
            
            SELECT @encoded As Value;
            End
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared("Drop procedure if exists p_json_result;");
    }
}
