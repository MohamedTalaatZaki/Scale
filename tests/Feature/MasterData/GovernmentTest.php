<?php

namespace Tests\Feature\MasterData;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Governorate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class GovernmentTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutMiddleware(VerifyCsrfToken::class);
//        Artisan::call(
//            'db:seed', ['--class' => 'UsersTableSeeder']
//        );
        Auth::attempt(['user_name'=>'admin','password'=>'123456']);
    }

    /**
     * @test
     */
    public function createGovernment(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('government.store'),[
            'ar_name'=>'الإسكندرية',
            'en_name'=>'Alexandria'
        ]);
        $gov = Governorate::where('en_name','Alexandria')->first();
        $this->assertNotNull($gov);
        $this->assertEquals('Alexandria',$gov->en_name);
        $this->assertEquals('الإسكندرية',$gov->ar_name);
    }

    /**
     * @test
     */
    public function createGovernmentWithoutArNameReturnValidationError(){
        $response = $this->post(route('government.store'),[
            'en_name'=>'Alexandria'
        ]);
        $response->assertSessionHasErrors(['ar_name'=>trans('master.errors.ar_name_required')]);
    }

    /**
     * @test
     */
    public function createGovernmentWithoutEnNameReturnValidationError(){
        $response = $this->post(route('government.store'),[
            'ar_name'=>'Alexandria'
        ]);
        $response->assertSessionHasErrors(['en_name'=>trans('master.errors.en_name_required')]);
    }

    /**
     * @test
     */
    public function createGovernmentWithoutDataReturnValidationError(){
        $response = $this->post(route('government.store'),[ ]);
        $response->assertSessionHasErrors([
            'en_name'=>trans('master.errors.en_name_required'),
            'ar_name'=>trans('master.errors.ar_name_required'),
        ]);
    }

    /**
     * @test
     */
    public function canNotCreateDuplicatedGovernment(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response = $this->post(route('government.store'),[
            'ar_name'=>'الإسكندرية',
            'en_name'=>'Alexandria'
        ]);
        $gov = Governorate::where('en_name','Alexandria')->first();
        $this->assertNotNull($gov);
        $this->assertEquals('Alexandria',$gov->en_name);
        $this->assertEquals('الإسكندرية',$gov->ar_name);
    }

    /**
     * @test
     */
    public function EditGovernment(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->post(route('government.store'),[
            'ar_name'=>'الإسكندرية',
            'en_name'=>'Alexandria'
        ]);
        $gov = Governorate::where('en_name','Alexandria')->first();
        $gov->update([
            'ar_name'=>'بورسعيد',
            'en_name'=>'port said',
        ]);
        $this->assertEquals('port said',$gov->en_name);
        $this->assertEquals('بورسعيد',$gov->ar_name);
    }
}
