<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\NewUserRegisterNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Mockery\Matcher\Not;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // send notification to admin

        $admin = Admin::find(1);
        $admin->notify(new NewUserRegisterNotification($user));
        
        // or
        // Notification::send($admin, new NewUserRegisterNotification($user));

        // or send notification to all admins
        
        // Notification::send(Admin::all(), new NewUserRegisterNotification($user));
        
        // or user foreach 
        // foreach (Admin::all() as $admin) {
        //     $admin->notify(new NewUserRegisterNotification($user));
        // }

        // Broadcast Event
        // broadcast(new NewUserRegisterEvent($user));
        
        // or 
        event(new NewUserRegisterEvent($user));
        // or
        // NewUserRegisterEvent::dispatch();


        // Model Broadcasting
        $user->broadcastChannel();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
