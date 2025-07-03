<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Http\Resources\Api\BookingTransactionsResource;
use App\Http\Resources\Api\ViewBookingResource;
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
        $bookingTransaction->load('officeSpace');

        return new BookingTransactionsResource($bookingTransaction);

    }

    public function bookingDetails(Request $request){
        $request->validate([
            'phone_number' =>'required|string',
            'booking_trx_id' =>'required|string'
        ]);

        $booking = BookingTransactions::where('booking_trx_id', $request->booking_trx_id)
        ->where('phone_number', $request->phone_number)->with(['officeSpace','officeSpace.city'])->first();

        if(!$booking){
            return response()->json([
                'message' => 'Booking Not Found'
            ],404);
        };

        return new ViewBookingResource($booking);
    }
}
