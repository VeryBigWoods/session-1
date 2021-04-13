<div class="mx-auto w-1/2 my-8">
    <ul class="border border-gray-300 rounded-md">
    @foreach ($todoList as $todo)
        <li class="p-1">{{ $todo->name }}</li>
    @endforeach
    </ul>
</div>
