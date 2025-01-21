<?php

namespace Modules\Settings\Repositories\Financial;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Modules\Settings\Http\Requests\CreateCountryRequest;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\SignUpRequest;
use Modules\Users\Repositories\BaseRepository;

class FinancialRepository extends BaseRepository 
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

 
   
}
