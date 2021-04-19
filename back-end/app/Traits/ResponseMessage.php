<?php

namespace App\Traits;

Trait ResponseMessage {

    public function formateMessageError($message, $code)
    {
        return response()->json([
            'status' => false,
            'errors' => [ 
                'error' => [
                        $message
                    ]
            ]
        ], $code);
    }   

    public function formateMessageSuccess($message)
    {
        return response()->json(['status' => true, 'message' => $message]);
        
    }

}