<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    function extractStringsInQuotation($input){
        $pattern = '/(@\["table".+?(".+?")+\])/';
        preg_match_all($pattern, $input, $matches, PREG_OFFSET_CAPTURE);
        foreach($matches[1] as $k => $match){
            echo 'LJ-';
            echo $match[1];
            echo '\n';
            // $output = preg_replace_callback($pattern, $matches[2][0][0], $input);
        }

        return [$input, preg_replace($pattern, "<table>,</table>", $input)];
    }

// Example usage:
$input = '@["string1", "string2"] gjkdfla;sjka; @["table", "string2", "string3"] hsdjakfljsdka @["string1","asds","asds"] ghjkg @["string1"] --- @["string1"]';
$result = extractStringsInQuotation($input);
    return view('welcome',['d'=>$result]);
});
