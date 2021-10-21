<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class SinglePageController extends Controller
{
    public function index() {
        return view('app');
    }

    public function calculateMediaNotes(Request $request){

        Test::truncate();

        $inputs = $request->all();
        $suma = 0;

        foreach ($inputs['arrayNote'] as $input){
            $suma =  $suma + $input['note'];
        }

        $media = $suma / count($inputs['arrayNote']);

        $arrayOutput= [];
        foreach ($inputs['arrayNote'] as $input){

           if($input['note'] > $media) $calificacion = 'Bueno';
           else $calificacion = 'Malo';

           array_push($arrayOutput, [
               'nombres' => $input['nombres'],
               'note' => $input['note'],
               'calificacion' => $calificacion
           ] );
        }

        Test::insert($arrayOutput);

        return 1;

    }


    public function getCalculateNotes(Request $request){
        $arrayOutput = Test::orderBy('nombres')->get();
        $media =  Test::sum('note') / $arrayOutput->count();
        return [ $arrayOutput, round($media, 2)];
    }

    public function getNumberRepetidos(Request $request){
        $inputs = $request->all();
        $numbers = explode(', ', $inputs['numbers']);

        $numbers = array_count_values($numbers);

        foreach ($numbers as $number => $numberRepeated){
            if($numberRepeated == 1){
                unset($numbers[$number]);
            }
        }

        return [$numbers, count($numbers)];
    }
}
