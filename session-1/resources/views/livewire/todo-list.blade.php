<div class="mx-auto w-1/2 my-8">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todoList as $todo)
                <tr>
                    <td>{{ $todo->name }}</td>
                    <td class="text-right">
                        <x-jet-button wire:click="deleteTodo({{ $todo->id }})">
                            {{ __('delete') }}
                        </x-jet-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
