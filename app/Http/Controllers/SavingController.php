<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Saving;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SavingController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.saving')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = Saving::with('user','history')->paginate(10);
        $savings = PaginationHelper::addSerialNo($savings);

        return view('saving.index',compact('savings'));
    }

    public function checkUser(){
        return view('saving.check-user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereNotNull('email_verified_at')->get();

        return view('saving.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category' => [
                'required',
                Rule::when(function() use($request){
                    return !Saving::where('user_id',$request->user_id)->exists();
                },'not_in:0')
            ],
            'amount' => 'required',
            'note' => 'nullable'
        ],[
            'category.not_in' => 'You cannot select category withdraw because this user has no previous savings.'
        ]);

         try{
            DB::beginTransaction();
            $checkRecord = Saving::where('user_id',$validatedData['user_id'])->first();
            $historyData = $validatedData;

            if($checkRecord){
                $amount = $validatedData['amount'];

                if($validatedData['category'] == "0"){
                    if($amount > $checkRecord->amount){
                        return redirect()->back()->with('warning','Insufficient balance for withdrawal.');
                    }
                    $checkRecord->amount -= $amount;
                }elseif($validatedData['category'] == "1"){
                    $checkRecord->amount += $amount;
                }

                $checkRecord->note = $validatedData['note'] ?? null;

                $checkRecord->save();
                $saving = $checkRecord;
            }else{

                unset($validatedData['category']);
                $saving = Saving::create($validatedData);
            }
            
            //Removing User Field
            unset($historyData['user_id']);
            $saving->history()->create($historyData);

            DB::commit();
            return redirect()->route('saving.index')->with('success','Successfully created new transaction');
        }catch(Exception $e){
            DB::rollBack();
            Log::channel('user')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to create new transaction');
        }
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
