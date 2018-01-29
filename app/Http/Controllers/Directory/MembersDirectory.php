<?php
/**
 * Created by PhpStorm.
 * User: raf
 * Date: 27/01/2018
 * Time: 2:59 PM
 */

namespace App\Http\Controllers\Directory;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class MembersDirectory extends Controller
{


    public function index()
    {
        if(Auth::check()) {

            $members = User::all();

        } else {

            $members = User::where('list_on_public_directory', true)->get();
        }

        $totalCount = User::count();

        $members = $members->shuffle();

        return view('directory.members', compact('members', 'totalCount'));
    }


    public function membersByCompany($company)
    {
        $members = User::whereCompany($company)->where('profile_type','professional')->orderBy('name')->get();
        $totalCount = User::whereCompany($company)->count();

        return view('directory.members', compact('members', 'company', 'totalCount'));
    }
}