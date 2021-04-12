<div>
    <ul>
    @foreach ($todoList as $todo)
        <li>{{ $todo->name }}</li>
    @endforeach
    </ul>
</div>
