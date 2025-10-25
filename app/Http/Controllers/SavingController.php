<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = User::has('savings')->with('savings')->paginate(10);
        $savings = PaginationHelper::addSerialNo($savings);

        return view('saving.index',compact('savings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saving.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Saving $saving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saving $saving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saving $saving)
    {
        //
    }
}
