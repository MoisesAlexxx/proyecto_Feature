<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Authors;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::all(); 
        $authors = Authors::all();
        return view('book', compact('books', 'authors'));
    }
    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'titulo' => 'required|string|max:70',
            'id_author' => 'required|exists:authors,id',
            'public_en' => 'nullable|string|max:70', 
        ]);

        // Guardar el libro en la base de datos
        Books::create([
            'titulo' => $request->titulo,
            'id_author' => $request->id_author,
            'public_en' => $request->public_en,
        ]);

        return redirect('books')->with('success', 'Libro añadido exitosamente.');
    }

    public function show($id)
    {
        $book = Books::findOrFail($id); 
        $authors = Authors::all();
        return view('editBook', compact('book', 'authors')); 
    }
    

    public function edit($id)
    {
        $book = Books::findOrFail($id);
        $authors = Authors::all();
        return view('editBook', compact('book', 'authors'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:70',
            'id_author' => 'required|exists:authors,id',
            'public_en' => 'nullable|string|max:70',
        ]);
    
        $book = Books::findOrFail($id);
        $book->update($request->only(['titulo', 'id_author', 'public_en']));
    
        return redirect('books')->with('success', 'Libro actualizado exitosamente.');
    }    

    public function destroy($id)
    {
        $book = Books::findOrFail($id); 
        $book->delete();
        return redirect('books')->with('success', 'Libro eliminado exitosamente.');
    }
}
