<?php

use Livewire\Component;
use app\Models\UserRequest;

new class extends Component
{
    public function userRequest(User $user){
        return $userRequests = $user->userRequest();
    }
};
?>

<div>
    @foreach ($userRequests as $request)
            <p>{{$request->title}}</p>
    @endforeach
</div>