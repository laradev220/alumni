<?php

namespace App\Livewire\Alumni;

use App\Models\AlumniProfile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $userId;
    public $full_name;
    public $graduation_year;
    public $department;
    public $city;
    public $current_job;
    public $linkedin_url;
    public $bio;
    public $profile_photo;
    public $existing_photo;
    public $verification_document;
    public $existing_verification_document;

    protected function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1950|max:' . date('Y'),
            'department' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|max:2048',
            'verification_document' => 'nullable|file|max:5120',
        ];
    }

    public function mount($userId = null)
    {
        $this->userId = $userId ?? auth()->id();

        $profile = AlumniProfile::where('user_id', $this->userId)->first();

        if ($profile) {
            $this->full_name = $profile->full_name;
            $this->graduation_year = $profile->graduation_year;
            $this->department = $profile->department;
            $this->city = $profile->city;
            $this->current_job = $profile->current_job;
            $this->linkedin_url = $profile->linkedin_url;
            $this->bio = $profile->bio;
            $this->existing_photo = $profile->profile_photo_url;
            $this->existing_verification_document = $profile->verification_document_url;
        }
    }

    public function save()
    {
        $this->validate();

        $profile = AlumniProfile::updateOrCreate(
            ['user_id' => $this->userId],
            [
                'full_name' => $this->full_name,
                'graduation_year' => $this->graduation_year,
                'department' => $this->department,
                'city' => $this->city,
                'current_job' => $this->current_job,
                'linkedin_url' => $this->linkedin_url,
                'bio' => $this->bio,
            ]
        );

        if ($this->profile_photo) {
            if ($profile->profile_photo_url) {
                Storage::delete($profile->profile_photo_url);
            }
            $path = $this->profile_photo->store('profile-photos');
            $profile->profile_photo_url = $path;
            $profile->save();
        }

        if ($this->verification_document) {
            if ($profile->verification_document_url) {
                Storage::delete($profile->verification_document_url);
            }
            $path = $this->verification_document->store('verification-documents');
            $profile->verification_document_url = $path;
            $profile->verified = false;
            $profile->save();
        }

        $this->dispatch('profileUpdated');
        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.alumni.profile-edit');
    }
}
