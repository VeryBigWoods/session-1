<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateTodo extends Component
{

    public $name = '';
    public $due = null;

    public function render()
    {
        return view('livewire.create-todo');
    }

    public function saveTodo()
    {
        $user = Auth::user();

        Todo::create([
            'name' => $this->name,
            'user_id' => $user->id,
            'due' => $this->due
        ]);        

        $this->resetFields();
        $this->emit('todoSaved');
    }

    private function resetFields() {
        $this->name = '';
        $this->due = null;
    }
}
