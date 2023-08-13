<h1>Tasklist</h1>

<div>


    @forelse ($tasks as $task)
        <div>
            <a href=" {{ route('tasks.show', ['id' => $task->id]) }}">
                <h2>{{ $task->title }}</h2>
            </a>
            @if ($task->completed)
                <p>&check;</p>
            @else
                <p>&cross;</p>
            @endif
        </div>

    @empty
        <div>
            <p>There are no tasks</p>
        </div>
    @endforelse


</div>
