<?php

namespace Modules\Users\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Users\Http\Requests\createUserRequest;
use Modules\Users\Http\Requests\signUpRequest;
use Modules\Users\Services\Auth\IUserSignUpService as AuthIUserSignUpService;
use Modules\Users\Services\Auth\UserService;
use Modules\Users\Services\IUserSignUpService;

class UserCrudController extends Controller
{
    public AuthIUserSignUpService $userService;

    public function __construct(AuthIUserSignUpService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
{
    $users = $this->userService->showUers();


    return view('users::dashboard.dashboard', compact('users'));


}

public function AllUsers()
{
    $users = $this->userService->showUers();


    return view('users::users.all_users', compact('users'));


}
    public function showUers()
    {   
        try {
            // جلب البيانات باستخدام الخدمة
            $users = $this->userService->showUers();
    
            if ($users->isNotEmpty()) {
                // رسالة النجاح
                session()->flash('success', 'Users fetched successfully.');
    
                // تمرير البيانات إلى العرض
                return redirect()->route('users::auth.dashboard');
            } else {
                // إذا كانت البيانات فارغة
                session()->flash('info', 'No users found.');
                return redirect()->route('users::auth.dashboard');
            }
        } catch (\Exception $e) {
            // تسجيل الخطأ إن لزم
        //\Log::error('Error fetching users: ' . $e->getMessage());
    
            // رسالة الخطأ
            session()->flash('error', 'An error occurred while fetching users.');
            return redirect()->route('users::auth.dashboard');
        }
    }
    
    
    //
}