<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentCardType;

class PaymentCardTypeController extends Controller
{
    public function index(){
        return $this->success(PaymentCardType::all());
    }
}
