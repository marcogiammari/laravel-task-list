<?php

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
        public bool $completed,
    ) {
    }
}

$tasks = [
    new Task(1, 'Fare la spesa', false),
    new Task(2, 'Pulire casa', false),
    new Task(3, 'Studiare Laravel', true)
];

Route::get('/', function () use ($tasks) {
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks.index');


Route::get('/{id}', function ($id) {
    return 'One single task';
})->name('tasks.show');

Route::get('/redirect-example', function () {
    return redirect()->route('tasks.index');
});

Route::fallback(function () {
    return '404: questa rotta non esiste';
});
