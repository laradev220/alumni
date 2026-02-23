<?php

namespace App\Livewire\Alumni;

use App\Models\AlumniProfile;
use App\Models\User;
use Livewire\Component;

class ProfileView extends Component
{
    public $userId;
    public $profile;
    public $user;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadProfile();
    }

    protected function loadProfile()
    {
        $this->profile = AlumniProfile::where('user_id', $this->userId)->first();
        $this->user = User::find($this->userId);
    }

    public function render()
    {
        return view('livewire.alumni.profile-view');
    }
}
