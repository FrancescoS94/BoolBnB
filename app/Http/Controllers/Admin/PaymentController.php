<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use App\Flat;

class PaymentController extends Controller
{
    public function create(Flat $flat)
    {
        return view('admin.payments.create', compact('flat'));
    }
}
