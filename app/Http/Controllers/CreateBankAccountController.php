<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateBankAccountController extends Controller
{
    //
    public function index()
    {
        $acc_type = DB::table('account_types')->select('id', 'name')->get();
        return view('create-bank-account', ["accounts" => $acc_type]);
    }
    public function randAccNo()
    {
        $tmp = rand();
        $d = "0152";
        $a = $d . $tmp;
        return $a;
    }

    public function CreateBankAccount(Request $request)
    {
        $user_account = new account;
        $new_acc_no = $this->randAccNo();

        // $init_balance = $request->input('init-acc-balance');
        $messages = [
            'init-acc-balance.min' => 'Initial balance must be at least 10,000!',
        ];

        validator::make($request->all(), [
            "init-acc-balance" => ['required', 'integer', 'min:10000'],
            "acc-name" => ['unique:accounts,name']
        ], $messages)->validate();

        $acount = $user_account::where('acc_number', $new_acc_no)->count();

        if ($acount < 0) {
            $user_account->acc_number = $new_acc_no;
        } else {
            $user_account->acc_number = $new_acc_no;
        }
        $user_account->name = $request->input('acc-name');
        $user_account->type_id = $request->input('acc-type');
        $user_account->balance = $request->input('init-acc-balance');
        $user_account->balance_currency = $request->input('currency-type');
        $user_account->account_holder = Auth::id();

        if ($user_account->save()) {
            return redirect()->back()->with('success', 'Bank Account Created Successfully');
        } else {
            return redirect()->back()->with('failed', 'Failed to create Bank Account, Please Try Again');
        }
    }
}
