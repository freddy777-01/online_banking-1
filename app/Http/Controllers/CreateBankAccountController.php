<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $new_acc_no = $this->randAccNo();

        // $init_balance = $request->input('init-acc-balance');
        validator::make($request->all(), [
            "init-acc-balance" => ['required', 'integer', 'min:10000'],
            "acc-name" => ['unique']
        ])->validate();
        $acount = $user_accounts::where('account_no', $new_acc_no)->count();
        if ($acount < 0) {
            $user_accounts->account_no = $new_acc_no;
        } else {
            $user_accounts->account_no = $new_acc_no;
        }
        $user_accounts->account_name = $request->input('acc-name');
        $user_accounts->account_type = $request->input('acc-type');
        $user_accounts->balance = $request->input('init-acc-balance');
        $user_accounts->account_holder = Auth::id();

        if ($user_accounts->save()) {
            return redirect()->back()->with('success', 'Bank Account Created Successfully');
        } else {
            return redirect()->back()->with('failed', 'Failed to create Bank Account, Please Try Again');
        }
    }
}
