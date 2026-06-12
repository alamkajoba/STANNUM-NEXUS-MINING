<?php

namespace App\Livewire\Module\Notify;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InternalNotifyMessage;
use App\Models\Category;
use App\Models\FunctionType;

#[Layout('layouts.app')]
class NoteNotify extends Component
{
    public $message_custom;
    public $collection;
    public $target = 'all';

    public function submit()
    {
        // 1. Validation (optionnel)
        $this->validate([
            'message_custom' => 'required|min:4',
            'target' => 'required',
        ]);

        // 2. Exemple : Enregistrer dans une table "Notes"
        // Note::create(['content' => $this->message_custom]);

        if ($this->target === 'all') {
            $employee = Employee::all();
        } else {
            $employee = Employee::where('function_type_id', $this->target)->get();
        }

        if ($employee->isEmpty()) {
            session()->flash('error', 'Aucun agent trouvé dans cette catégorie.');
            return;
        }

        // 3. Exemple : Envoyer par mail à tous les agents
        $employee = Employee::all();
        Notification::send($employee, new InternalNotifyMessage($this->message_custom));

        // 4. Message de succès
        session()->flash('success', 'Notifications envoyées avec le texte formaté !');
        return redirect()->route('notify.noteNotify');
    }

    public function mount()
    {
        $this->collection = FunctionType::all();
    }

    public function render()
    {
        return view('livewire.module.notify.note-notify');
    }
}
