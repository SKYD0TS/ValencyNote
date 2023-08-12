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

// Route::get('/window', function () {
//     return view('test.window');
// });

Route::get('/editor', function () {
    return view('test.editor');
});

Route::get('/interact', function () {
    return view('test.interact');
});

Route::get('/test', function () {
    return view('welcome');
});

//     function extractStringsInQuotation($input){
//         $pattern = '/(@\["table".+?(".+?")+\])/';
//         preg_match_all($pattern, $input, $matches, PREG_OFFSET_CAPTURE);
//         foreach($matches[1] as $k => $match){
//             // $output = preg_replace_callback($pattern, $matches[2][0][0], $input);
//         }

//         return [$input, preg_replace($pattern, "<table>,</table>", $input)];
//     }

// // Example usage:
// $input = '@["string1", "string2"] gjkdfla;sjka; @["table", "string2", "string3"] hsdjakfljsdka @["string1","asds","asds"] ghjkg @["string1"] --- @["string1"]';
// $result = extractStringsInQuotation($input);
//     return view('welcome',['d'=>$result]);
// });
