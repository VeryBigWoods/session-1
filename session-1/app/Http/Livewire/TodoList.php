<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class TodoList extends Component
{
    public $showCreateModal = false;

    private $todoList = [];

    protected $listeners = ['todoSaved' => 'onTodoSaved'];

    public function onTodoSaved()
    {
        $user = Auth::user();
        $this->todoList = Todo::where('user_id', $user->id)->get();
        $this->showCreateModal = false;
    }

    public function render()
    {
        $user = Auth::user();
        $due_limit = Carbon::now()->subDays(3);
        $this->todoList = Todo::where('user_id', $user->id)
            ->where('due', '>=', $due_limit)
            ->orderBy('due', 'asc')
            ->get();
        return view('livewire.todo-list', ['todoList' => $this->todoList]);
    }

    public function deleteTodo(Todo $todo)
    {
        if ($todo !== NULL) {
            $id = $todo->id;
            if ($todo->delete()) {
                $this->todoList = array_filter($this->todoList, function ($item) use ($id) {
                    return $item->id !== $id;
                });
            }
        }
    }
}
