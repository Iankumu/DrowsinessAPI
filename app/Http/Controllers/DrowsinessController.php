<?php

namespace App\Http\Controllers;

use App\Http\Resources\Drowsiness\DrowsinessResource;
use App\Models\Drowsiness;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrowsinessController extends Controller
{

    public function index()
    {
        $drowsiness = Drowsiness::with('user')->get();
        return response()->json([
            'data'=>$drowsiness,
        ],Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $user_id = auth()->guard('api')->user()->id;
        $drowsiness = new Drowsiness();
        $drowsiness->user_id = $user_id;
        $drowsiness->perclos = $payload['perclos'];
        $drowsiness->blinks = $payload['blinks'];
        $drowsiness->save();

        return response()->json([
            'data'=>$drowsiness
        ],Response::HTTP_CREATED);
    }

    public function show(Drowsiness $drowsiness)
    {
        $data = Drowsiness::find($drowsiness);
        return response()->json([
            'data'=>$data
        ],Response::HTTP_OK);
    }


    public function update(Request $request,Drowsiness $drowsiness)
    {
        $payload = $request->all();
        $drows = Drowsiness::find($drowsiness);
        $data = [
            'user'=>$payload['user'],
            'perclos'=>$payload['perclos'],
            'blinks'=>$payload['blinks'],
        ];
        $drows->update($data);
        return response()->json([
            'data'=>$drows
        ],Response::HTTP_OK);
    }


    public function destroy(Drowsiness $drowsiness)
    {
        $drowsiness->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }

    public function signals()
    {
        $user_id = auth()->guard('api')->user()->id;
        $signals = Drowsiness::with('user')->where('user_id',$user_id)->get();
        return response()->json([
            'data'=>$signals
        ],Response::HTTP_OK);
    }
}
