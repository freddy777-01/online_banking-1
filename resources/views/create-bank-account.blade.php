<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Bank Account') }}
        </h2>
    </x-slot>

<div class="notification">
@if (\Session::has('success'))
    <div class="alert alert-success">
    {!! \Session::get('success') !!}!
    </div>
@endif
@if (\Session::has('failed'))
    <div class="alert alert-danger">
    <span class="alert-text">
    {!! \Session::get('failed') !!}!
    </span>
    <span>
   	X
    </span>
    </div>
@endif
</div>

<div class="create-account-container">
<div class="available-acounts f-item">
<header>Available Accounts</header>
<section>
<ol>
<li>
<header>Current Account</header>
<ul>
<li>currency used Tzs</li>
<li>charges are applied monthly and when person makes money transfer</li>
<li>one can deposite and with draw</li>
<li>minimum operating balance 10,000</li>
<li>this account can be used to pay for some bills</li>
</ul>
</li>

<li>
<header>Fixed Deposite Account</header>
<ul>
<li>A time Deposite Account, the duration of investiment would be in a range of every 3 months or 6 or 12</li>
<li>the interest will be 5% for every year</li>
<li>the money is kept for predetermined time</li>
<li>minimum operating balance 50,00</li>
<li>no charges will be applied on this account</li>
</ul>
</li>
</ol>

</section>
</div>

<div class="create-account f-item">
<header>Create your account</header>
<section>
<div class="form-error">{{$errors->first('init-acc-balance')}}</div>
<form action="/create-my-bank-account" method="post">
@csrf
<div class="input-box">
<label for="select-acc-type">Select Type of Account</label>
<select id="select-acc-type" name="acc-type">
@foreach ($accounts as $acc_type)
<option value="{{$acc_type->id}}">{{$acc_type->name}}</option>
@endforeach
</select>
</div>

<div class="input-box">
<label for="acc-name">Account Name</label>
<input id="acc-name" name="acc-name" type="text" placeholder="Account Name">
</div>

<div class="input-box">
<label for="acc-balance">Set Account Balance</label>
<input id="acc-balance" name="init-acc-balance" type="number" placeholder="Set Account Balance">
<small>Should be greater than 10,000</small>
</div>
<div class="input-box">
<button type="submit">Create Account</button>
</div>
</form>
</section>
</div>
</div>
</x-app-layout>
