<?php

namespace App\Livewire\Module\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\User;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.app')]
class AssignPermission extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $role;
    public $selectedPermissions = [];
    public $userId;

    public function mount($id)
    {
        $this->userId = $id;
        $user = User::findOrFail($id);

        $this->role = $user->getRoleNames()->first();
        $this->name = $user->name;
        
        // Permissions déjà assignées au user
        $this->selectedPermissions = $user->permissions->pluck('id')->toArray();
    }

    public function save()
    {
        $user = User::findOrFail($this->userId);

        // Valider au moins une permission
        $this->validate([
            'selectedPermissions' => 'required|array|min:1',
        ]);

        // Assigner les permissions sélectionnées
        $user->givePermissionTo($this->selectedPermissions);

        session()->flash('success', 'Permissions mises à jour avec succès !');
        return redirect()->to(route('user.index'));
    }

    // Méthode pour cocher/décocher
    public function togglePermission($id)
    {
        if (in_array($id, $this->selectedPermissions)) {
            $this->selectedPermissions = array_diff($this->selectedPermissions, [$id]);
        } else {
            $this->selectedPermissions[] = $id;
        }
    }

    public function render()
    {
        $permissionsGrouped = Permission::paginate(10);
        return view('livewire.module.user.assign-permission',['permissionsGrouped'=> $permissionsGrouped]);
    }
}
