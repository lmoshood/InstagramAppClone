<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProfileController extends Controller
{
    public function showCurrent(Request $request)
    {
        return $this->show($request, $request->user());
    }

    public function show(Request $request, User $user)
    {
        $posts = $user->posts()->withCount(['likes', 'comments'])->latest()->get();
        $isCurrentUser = $request->user()->id === $user->id;

        return view('profile.show', compact('user', 'posts', 'isCurrentUser'));
    }
}
