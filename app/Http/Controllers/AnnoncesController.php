<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Annonces;
use Illuminate\Support\Facades\DB;

class AnnoncesController extends Controller
{

    public function index()
    {
        $annonces = Annonces::all(); 
        return view('annonces', compact('annonces'));
       
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $annonces = Annonces::where('titre', 'like', '%' . $query . '%')->get();

        return response()->json([
            'annonces'=> $annonces
        ]);
    }


    public function create()
    {
        return view('createAnnonce');
    }

    public function store(Request $request) {
        // insère les data en bdd
            $request->validate([
                'titre'=>'required|unique:annonces',
                'description'=>'required',
                'prix' => 'required|min:1',
                'photo'=>'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ]);
            
                // Si la requête prend une photo
                if($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $name = $photo->getClientOriginalName();

                    $request->photo->move(public_path('images'), $name);
                   
                
                $query = DB::table('annonces')->insert([
                    'titre'=>$request->input('titre'),
                    'description'=>$request->input('description'),
                    'prix'=>$request->input('prix'),
                    'photo'=>$request=$name,

                ]);
             }
       return redirect('annonces')->with('success', 'L\'annonce a bien été enregistrée.');
    }

}