<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $apartments_with_sponsor = [];
        $apartments = Apartment::where('user_id', $user->id)->get();
        if(Auth::id() != $user->id){
            return abort(403, 'Non hai i permessi per stare qui');
        }
        foreach($apartments as $apartment) {
            $actual_date = $this->createCarbonDate(null);
            $sponsorExpire = $apartment->sponsors()->pluck('expire_date');
            foreach($sponsorExpire as $expire_date => $plan) {
                $expire_carbon_date = $this->createCarbonDate($expire_date);            
                if($expire_carbon_date > $actual_date) {
                    array_push($apartments_with_sponsor, $apartment->id);
                    break;
                }
            }
        }
        return view('admin.users.show', compact('user', 'apartments', 'apartments_with_sponsor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::id() != $user->id){
            return abort(403, 'Non hai i permessi per stare qui');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $params = $request->validate([
            'name' => 'nullable|max:255',
            'surname' => 'nullable|max:255',
            'email' => 'required|email:rfc',
            'password' => 'nullable|min:8',
            'date_of_birth' => 'nullable|date',
            'profile_pic' => 'nullable|image|max:2048'
        ]);
 
        if($params['password']) {     
            $params['password'] = Hash::make($params['password']);
        } else {
            $params['password'] = $user->password;
        }

        if(array_key_exists('profile_pic', $params) && $params['profile_pic'] !== $user->profile_pic) {
            $img_path = Storage::disk('images')->put('profile_images', $params['profile_pic']);
            $params['profile_pic'] = $img_path;
        }

        $user->update($params);

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->profile_pic);
        
        User::where('profile_pic', $user->profile_pic)->update(['profile_pic' => null]);

        return redirect()->route('admin.users.show', $user);
    }

    public function createCarbonDate($date) {
        $result = null;
        if($date) {
            $result = Carbon::parse($date);
        } else {
            $result = Carbon::now();
        }
        return $result;
    }
}
