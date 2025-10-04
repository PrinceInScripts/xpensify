<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationSuccessMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // fetch a api of country and currency and pass it to view https://restcountries.com/v3.1/all?fields=name,currencies
       $response = file_get_contents("https://restcountries.com/v3.1/all?fields=name,currencies");
       $countries = json_decode($response, true);

       $countries = array_map(function($country) {
           return [
               'name' => $country['name']['common'],
               'currency' => $country['currencies'] ? array_keys($country['currencies'])[0] : null,
           ];
         }, $countries);

        $countries = array_values($countries);

        $currencies = array_column($countries, 'currency');    

        return view('signup', compact('countries', 'currencies'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
            'company_name' => ['required', 'string', 'max:255'],

        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'country' => $request->country,
            'currency' => $request->currency,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'company_id' => $company->id,
        ]);

        // Send email
    Mail::to($user->email)->send(new RegistrationSuccessMail($user, $company));

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
