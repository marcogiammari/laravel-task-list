<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public  ?string $desc,
//         public bool $completed,
//     ) {
//     }
// }

// $tasks = [
//     new Task(1, 'Fare la spesa', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullamco laboriosam, nisi ut aliquid ex ea commodi consequatur.', false),
//     new Task(2, 'Pulire casa', 'Duis aute irure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', false),
//     new Task(3, 'Studiare Laravel', null, true)
// ];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        // ordina i dati in base alla colonna "created at"
        'tasks' => Task::latest()->get()

        // possiamo incatenare diversi metodi nella nostra query: where, select... in questo caso si parla di "query builder"
        // Task::latest()->where('completed', true)->get()
        // Task::select('id', 'title')->where('completed', true)->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', ['task' => Task::findOrFail($id)]);
})->name('tasks.edit');

Route::view('/tasks/create', 'create')->name('tasks.create');

// le rotte che prendono parametri vanno messe dopo le altre rotte che hanno lo stesso path -> altrimenti una rotta come /tasks/create verrebbe catturata da /task/{id}
Route::get('/tasks/{id}', function ($id) {
    // riporta alla pagina 404 se non trova l'id nel db
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

// la classe Request ci permette di accedere alla request tramite metodi come all()
Route::post('/tasks/store', function (Request $request) {

    //validazione dati
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    // il metodo save() esegue un insert query se hai creato un model, altrimenti esegue un update query 
    $task->save();

    // il metodo with crea un messaggio flash che appare al redirect e scompare al caricamento successivo
    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}', function ($id, Request $request) {

    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Route::get('/redirect-example', function () {
//     return redirect()->route('tasks.index');
// });

Route::fallback(function () {
    return '404: questa rotta non esiste';
});
