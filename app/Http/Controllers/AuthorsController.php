<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Authors;

class AuthorsController extends Controller
{
 
    public function index()
    {
        //
        $authors = Authors::all();
        return view('authors', compact('authors'));
    }


    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //mando a guardar los datos registrados a la db
        $authors = new Authors($request->input());
        $authors-> saveOrFail();
        return redirect('authors');
    }

    
    public function show($id)
    {
        $author = Authors::find($id);
        return view('editAuthor', compact('author'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $author = Authors::find($id);
        $author->fill($request->input())->saveOrFail();
        return redirect('authors');
    }

   
    public function destroy($id)
    {
        $author = Authors::find($id);
        $author->delete();
        return redirect('authors');
    }
}
