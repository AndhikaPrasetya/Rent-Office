<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Models\BookingTransactions;
use App\Models\OfficeSpace;
use DateTime;
use Illuminate\Http\Request;

class BookingTransactionsController extends Controller
{
    public function store(StoreBookingTransactionRequest $request)
    {
        $validatedData = $request->validated();

        $officeSpace = OfficeSpace::find($validatedData['office_space_id']);
        
        $validatedData['is_paid'] = false;
        $validatedData['booking_trx_id'] = BookingTransactions::generateUniqueTrxId();
        $validatedData['duration'] = $officeSpace->duration;
        $validatedData['ended_at'] =(new DateTime($validatedData['started_at']))->modify("+ {$officeSpace->duration} days")->format('Y-m-d');

        $bookingTransaction = BookingTransactions::create($validatedData);

    }
}
