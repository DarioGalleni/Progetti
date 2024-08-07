<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function home()
    {    
        return view('welcome');
    }



public function index()
{   
    $snowboards = [
        ['id'=>'1', 'Tipo' => 'Freestyle', 'descrizione' => 'Tavole leggere e flessibili, ottimali per salti, tricks e manovre in snowpark', 'price' => 300, 'url' => 'img/snowboards/1.webp'],
        ['id'=>'2', 'Tipo' => 'Freeride', 'descrizione' => 'Tavole progettate per terreni fuoripista, offrono galleggiamento sulla neve fresca e stabilita"', 'price' => 350, 'url' => 'img/snowboards/2.webp'],
        ['id'=>'3', 'Tipo' => 'All-Mountain', 'descrizione' => 'Tavole versatili adatte a vari terreni e condizioni di neve', 'price' => 400, 'url' => 'img/snowboards/3.webp'],
        ['id'=>'4', 'Tipo' => 'Splitboard', 'descrizione' => "Tavole che possono essere divise in due per trasformarsi in sci da touring, ideali per l'escursionismo fuoripista", 'price' => 600, 'url' => 'img/snowboards/4.webp'],
        ['id'=>'5', 'Tipo' => 'Powder', 'descrizione' => 'Tavole progettate per galleggiare sulla neve fresca e profonda', 'price' => 450, 'url' => 'img/snowboards/5.webp'],
        ['id'=>'6', 'Tipo' => 'Camber', 'descrizione' => 'Tavole con un profilo curvo verso l\'esterno sotto i piedi, offrono stabilita\' e pop', 'price' => 320, 'url' => 'img/snowboards/6.webp'],
        ['id'=>'7', 'Tipo' => 'Rocker', 'descrizione' => 'Tavole con un profilo curvo verso l\'interno sotto i piedi, favoriscono la galleggiabilita\' e la manovrabilita\'', 'price' => 310, 'url' => 'img/snowboards/7.webp'],
        ['id'=>'8', 'Tipo' => 'Hybrid', 'descrizione' => 'Tavole che combinano caratteristiche del camber e del rocker per massimizzare prestazioni in diverse condizioni', 'price' => 380, 'url' => 'img/snowboards/8.webp'],
        ['id'=>'9', 'Tipo' => 'Directional', 'descrizione' => 'Tavole con una forma e una flex direzionali, ottimali per il carving e il controllo a alta velocita\'', 'price' => 370, 'url' => 'img/snowboards/9.webp'],
    ];
    
    $marca = "Burton";
    return view('index', compact('snowboards', 'marca'));
}

public function mostra($id)
{   
    $snowboards = [
        ['id'=>'1', 'Tipo' => 'Freestyle', 'descrizione' => 'Tavole leggere e flessibili, ottimali per salti, tricks e manovre in snowpark', 'price' => 300, 'url' => 'img/snowboards/1.webp'],
        ['id'=>'2', 'Tipo' => 'Freeride', 'descrizione' => 'Tavole progettate per terreni fuoripista, offrono galleggiamento sulla neve fresca e stabilita"', 'price' => 350, 'url' => 'img/snowboards/2.webp'],
        ['id'=>'3', 'Tipo' => 'All-Mountain', 'descrizione' => 'Tavole versatili adatte a vari terreni e condizioni di neve', 'price' => 400, 'url' => 'img/snowboards/3.webp'],
        ['id'=>'4', 'Tipo' => 'Splitboard', 'descrizione' => "Tavole che possono essere divise in due per trasformarsi in sci da touring, ideali per l'escursionismo fuoripista", 'price' => 600, 'url' => 'img/snowboards/4.webp'],
        ['id'=>'5', 'Tipo' => 'Powder', 'descrizione' => 'Tavole progettate per galleggiare sulla neve fresca e profonda', 'price' => 450, 'url' => 'img/snowboards/5.webp'],
        ['id'=>'6', 'Tipo' => 'Camber', 'descrizione' => 'Tavole con un profilo curvo verso l\'esterno sotto i piedi, offrono stabilita\' e pop', 'price' => 320, 'url' => 'img/snowboards/6.webp'],
        ['id'=>'7', 'Tipo' => 'Rocker', 'descrizione' => 'Tavole con un profilo curvo verso l\'interno sotto i piedi, favoriscono la galleggiabilita\' e la manovrabilita\'', 'price' => 310, 'url' => 'img/snowboards/7.webp'],
        ['id'=>'8', 'Tipo' => 'Hybrid', 'descrizione' => 'Tavole che combinano caratteristiche del camber e del rocker per massimizzare prestazioni in diverse condizioni', 'price' => 380, 'url' => 'img/snowboards/8.webp'],
        ['id'=>'9', 'Tipo' => 'Directional', 'descrizione' => 'Tavole con una forma e una flex direzionali, ottimali per il carving e il controllo a alta velocita\'', 'price' => 370, 'url' => 'img/snowboards/9.webp'],
    ];
    $snowboards= collect($snowboards)->where('id', $id)->first();
    return view('mostra', compact('snowboards'));

}

}
