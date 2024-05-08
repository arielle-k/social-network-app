<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewChatMessageNotification;
use Illuminate\Foundation\Bus\Dispatchable;

class ChMessage extends Model
{
    use UUID;



}
