<?php

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

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public  ?string $desc,
        public bool $completed,
    ) {
    }
}

$tasks = [
    new Task(1, 'Fare la spesa', 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullamco laboriosam, nisi ut aliquid ex ea commodi consequatur.', false),
    new Task(2, 'Pulire casa', 'Duis aute irure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', false),
    new Task(3, 'Studiare Laravel', null, true)
];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks.index');


Route::get('/tasks/{id}', function ($id) use ($tasks) {
    $task = collect($tasks)->firstWhere('id', $id);

    if (!$task) {
        abort(Response::HTTP_NOT_FOUND);
    }

    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::get('/redirect-example', function () {
    return redirect()->route('tasks.index');
});

Route::fallback(function () {
    return '404: questa rotta non esiste';
});
