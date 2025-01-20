<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkCardRequest;
use App\Http\Requests\saveCardRequest;
use App\Models\Card;
use App\Models\Log;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @param saveCardRequest $request
     * @return string[]
     */
    public function saveCard(saveCardRequest $request)
    {
        Card::query()->create([
            'card_number' => $request->card_number
        ]);

        return [
            'message' => 'created successfully'
        ];
    }

    /**
     * @param checkCardRequest $request
     * @return bool[]
     */
    public function checkCard(checkCardRequest $request)
    {
        $cardData = Card::query()
            ->where('card_number', $request->card_number)
            ->first();

        if ($cardData) {
            Log::query()->create([
                'card_id' => $cardData->id,
                'status_id' => 1
            ]);
        }

        return [
            'status' => (bool)$cardData
        ];
    }

    public function getList()
    {
        return Card::query()->get();
    }

    public function getLogs()
    {
        return Log::query()
            ->select('logs.id', 'logs.card_id', 'logs.status_id', 'c.card_number', 'logs.created_at')
            ->leftJoin('cards as c', 'c.id', '=', 'logs.card_id')
            ->get();
    }
}
