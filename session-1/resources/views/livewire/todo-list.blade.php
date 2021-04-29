<div class="mx-auto w-1/2 my-8">

    <div class="mb-4">
        <x-jet-button wire:click="$set('showCreateModal', true)">
            {{ __('Create') }}
        </x-jet-button>

        <x-jet-button wire:click="deleteByChecklist">
            {{ __('Delete') }}
        </x-jet-button>
    </div>

    <x-jet-dialog-modal wire:model="showCreateModal">
        <x-slot name="title">
            {{ __('Create TODO Item') }}
        </x-slot>

        <x-slot name="content">
            <livewire:create-todo>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button @click="show = false">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th></th>
                <th class="text-left">Name</th>
                <th class="text-left">Due</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todoList as $todo)
                <tr>
                    <td><input type="checkbox" wire:model.defer="checkList.{{ $loop->index }}.checked"></td>
                    <td>{{ $todo->name }}</td>
                    <td>{{ $todo->due }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $todoList->links() }}
</div>
