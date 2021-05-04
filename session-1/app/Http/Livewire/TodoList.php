<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    public $showCreateModal = false;

    private $todoList;
    public $checkList = [];
    public $searchKeyword = '';

    protected $listeners = ['todoSaved' => 'onTodoSaved'];

    public function onTodoSaved()
    {
        $user = Auth::user();
        $this->loadData($user, 3);
        $this->showCreateModal = false;
    }

    public function render()
    {
        $user = Auth::user();
        $due_limit = Carbon::now()->subDays(3);
        $this->loadData($user, $due_limit);
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

    public function deleteByChecklist()
    {
        $checkedItems = array_filter($this->checkList, function ($item) {
            return $item['checked'] === true;
        });
        $builder = Todo::query();
        if (sizeof($checkedItems) > 0) {
            foreach ($checkedItems as $checkedItem) {
                $builder->orWhere('id', $checkedItem["id"]);
            }

            $builder->delete();
        }
    }

    public function onSearch()
    {
    }

    private function loadData($user, $due_limit)
    {
        $query = Todo::where('user_id', $user->id)
            ->where('due', '>=', $due_limit);

        if (!empty($this->searchKeyword)) {
            $query->where('name', 'like', '%' . $this->searchKeyword . '%');
        }
        $this->todoList = $query
            ->orderBy('due', 'asc')
            ->paginate(5);

        $this->checkList = $this->todoList->map(function ($item) {
            return [
                'id' => $item->id,
                'checked' => false
            ];
        })->toArray();
    }
}
