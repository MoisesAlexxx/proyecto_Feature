<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Books;
use App\Models\Authors;

class BookTest extends TestCase
{
    use RefreshDatabase;
   
   /** @test */
    public function add_book_with_existing_author()
    {
        // Crea un autor primero
        $author = Author::factory()->create(); 

        // Datos para el nuevo libro
        $bookData = [
            'titulo' => 'Nuevo Libro de Prueba',   // Título del libro
            'id_author' => $author->id,           // ID del autor que existe en la base de datos
            'public_en' => '2024-11-28',       // Fecha de publicación
        ];

        // Realiza la solicitud POST para agregar el libro
        $response = $this->post('/books', $bookData);  // 

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(201);  // Código de estado 201 para creación exitosa

        // Verifica que el libro se haya añadido a la base de datos
        $this->assertDatabaseHas('books', [
            'title' => 'Nuevo Libro de Prueba',
            'id_author' => $author->id,
            'public_en' => '2024-11-28',
        ]);


    }

    /** @test */
    public function edit_book()
{
    // Crea un autor primero
    $author = Author::factory()->create();

    // Crea un libro primero
    $book = Book::factory()->create([
        'id_author' => $author->id,
        'titulo' => 'Libro Original',
    ]);

    // Datos para actualizar el libro
    $newData = [
        'titulo' => 'Libro Editado',
        'id_author' => $author->id,  // Usamos el mismo autor
        'public_en' => '2024-11-29',
    ];

    // Realiza la solicitud PUT para editar el libro
    $response = $this->put('/books/' . $book->id, $newData);

    // Verifica que la respuesta sea exitosa
    $response->assertStatus(200);  // Código de estado 200 para edición exitosa

    // Verifica que la base de datos tiene el nuevo título y fecha
    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'titulo' => 'Libro Editado',
        'public_en' => '2024-11-29',
    ]);
}
/** @test */
public function delete_book()
{
    // Crea un autor y un libro
    $author = Author::factory()->create();
    $book = Book::factory()->create([
        'id_author' => $author->id,
        'titulo' => 'Libro a Eliminar',
    ]);

    // Realiza la solicitud DELETE para eliminar el libro
    $response = $this->delete('/books/' . $book->id);

    // Verifica que la respuesta sea exitosa
    $response->assertStatus(204);  // Código de estado 204 para eliminación exitosa

    // Verifica que el libro ha sido eliminado de la base de datos
    $this->assertDatabaseMissing('books', [
        'id' => $book->id,
    ]);
}
/** @test */
public function add_author()
{
    // Datos para el nuevo autor
    $authorData = [
        'name' => 'Nuevo Autor',
    ];

    // Realiza la solicitud POST para agregar el autor
    $response = $this->post('/authors', $authorData); 

    // Verifica que la respuesta sea exitosa
    $response->assertStatus(201);  // Código de estado 201 para creación exitosa

    // Verifica que el autor se haya añadido a la base de datos
    $this->assertDatabaseHas('authors', [
        'name' => 'Nuevo Autor',
    ]);
}

}
