<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBCoderFunctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared("
            CREATE FUNCTION [dbo].[fn_string_To_BASE64]
            (
                @inputString NVARCHAR(MAX)
            )
            RETURNS NVARCHAR(MAX)
            AS
            BEGIN
                RETURN (
                    SELECT
                        CAST(N'' AS XML).value(
                              'xs:base64Binary(xs:hexBinary(sql:column(\"bin\")))'
                            , 'NVARCHAR(MAX)'
                        )   Base64Encoding
                    FROM (
                        SELECT CAST(@inputString AS VARBINARY(MAX)) AS bin
                    ) AS bin_sql_server_temp
                )
            END
        ");

        \Illuminate\Support\Facades\DB::unprepared("
            CREATE FUNCTION [dbo].[fn_BASE64_To_String]
            (
                @BASE64_STRING NVARCHAR(MAX)
            )
            RETURNS NVARCHAR(MAX)
            AS
            BEGIN
                RETURN (
                    SELECT
                        CAST(
                            CAST(N'' AS XML).value('xs:base64Binary(sql:variable(\"@BASE64_STRING\"))', 'VARBINARY(MAX)')
                        AS NVARCHAR(MAX)
                        )   UTF8Encoding
                )
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared("Drop function if exists fn_string_To_BASE64");
        \Illuminate\Support\Facades\DB::unprepared("Drop function if exists fn_BASE64_To_String");
    }
}
