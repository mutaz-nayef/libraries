<?php

namespace App\Providers;

use Carbon\Carbon;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // في حال كان اسم البوليسي لا يحتوي على اسم مودل في الاسم اتبع السطر الي بعديه 
        // 'App\Models\City' => 'App\Policies\CitiesPolicy'
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        // هان اضطرينا نحط الباث عشان الرول مش موجود في ملف المودل لانه من مكتبة
        'Spatie\Permission\Models\Permission' => 'App\Policies\PermissionPolicy'


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport::routes();
        Passport::enableImplicitGrant();
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(1));
    }

    // public function boot()
    // {
    //     $this->registerPolicies();
    //     Passport::useTokenModel(Token::class);
    //     Passport::useClientModel(Client::class);
    //     Passport::useAuthCodeModel(AuthCode::class);
    //     Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    //         Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(1));

    // }
}
