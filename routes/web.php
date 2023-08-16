<?php

use App\Http\Requests\TaskRequest;
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

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// index

Route::get('/tasks', function () {
    return view('index', [
        // ordina i dati in base alla colonna "created at" e impagina 5 risultati
        'tasks' => Task::latest()->paginate(5)

        // possiamo incatenare diversi metodi nella nostra query: where, select... in questo caso si parla di "query builder"
        // Task::latest()->where('completed', true)->get()
        // Task::select('id', 'title')->where('completed', true)->get()
    ]);
})->name('tasks.index');

// edit

Route::get('/tasks/{task}/edit', function (Task $task) {

    // route model binding: di default laravel cerca l'id del task, quindi possiamo evitare di usare l'id e usare direttamente il model Task

    return view('edit', ['task' => $task]);
})->name('tasks.edit');


// create

Route::view('/tasks/create', 'create')->name('tasks.create');

// le rotte che prendono parametri vanno messe dopo le altre rotte che hanno lo stesso path -> altrimenti una rotta come /tasks/create verrebbe catturata da /task/{id}
Route::get('/tasks/{task}', function (Task $task) {
    // riporta alla pagina 404 se non trova l'id nel db
    return view('show', ['task' => $task]);
})->name('tasks.show');


// store

// la classe Request ci permette di accedere alla request tramite metodi come all()
Route::post('/tasks/store', function (TaskRequest $request) {

    //validazione dati
    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // il metodo save() esegue un insert query se hai creato un model, altrimenti esegue un update query 
    // $task->save();

    // il metodo create sostituisce il blocco di codice qui sopra
    $task = Task::create($request->validated());

    // il metodo with crea un messaggio flash che appare al redirect e scompare al caricamento successivo
    return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task created successfully!');
})->name('tasks.store');


// update

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task updated successfully!');
})->name('tasks.update');

// Route::get('/redirect-example', function () {
//     return redirect()->route('tasks.index');
// });


// delete

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::fallback(function () {
    return '404: questa rotta non esiste';
});
