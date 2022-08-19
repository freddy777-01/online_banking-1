<?php

namespace App\Http\Controllers;

use App\Models\user_accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateBankAccountController extends Controller
{
    //
    public function index()
    {
        $acc_type = DB::table('accounts')->select('id', 'name')->get();
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
        $user_accounts = new user_accounts;

        // $init_balance = $request->input('init-acc-balance');
        validator::make($request->all(), [
            "init-acc-balance" => ['required', 'integer', 'min:10000']
        ])->validate();

        $user_accounts->account_name = $request->input('acc-name');
        $user_accounts->account_no = $request->input('');
        $user_accounts->account_type = $request->input('acc-type');
        $user_accounts->save();

        return redirect()->back()->with('success', 'Bank Account Created Successfully');
    }
}
