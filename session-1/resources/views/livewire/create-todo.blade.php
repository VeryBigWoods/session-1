<div>
    <form wire:submit.prevent="saveTodo">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Save</button>
    </form>
</div>
