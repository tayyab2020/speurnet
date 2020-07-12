<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agent_enquiry extends Model
{
    protected $table = 'agent_enquiry';


    public function user()
    {
        return $this->hasOne('App\User','id','agent_id');
    }

}
