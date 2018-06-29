----

* create mvc
  * 클래스명(StudlyCase, 단수형): str_singular(studly_case('user'))
  * 테이블명(snake_case, 복수형): str_plural(snake_case('user'))
  * example
    ```
    artisan make:controller UserController --resource
    Route::resource('user', 'UserController');
    artisan make:model User
    artisan make:seeder UsersTableSeeder
    artisan make:request StoreUser // Form Request 유효성 검사
    ```
----

* 인증(로그인)
  * https://laravel.kr/docs/5.5/authentication
  * 권한 승인
  * 내부 시스템에서, 라라벨의 인증 기능은 "guards" 와 "프로바이더"로 구성
  * Guard는 사용자가 각각의 요청-request마다 어떻게 인증되는지 정의
    * ex) 기본적으로 session guard, token guard를 제공
  * 프로바이더는 저장소에서 사용자를 어떻게 찾을 수 있는지 정의
    * ex) database 등

----

* 미들웨어(관리자 URL 분리)
  * https://laravel.kr/docs/5.5/middleware
    ```
    artisan make:middleware AuthenticateWithLevel
    ```
  * make middleware -> 미들웨어 키등록(/app/Http/Kernel.php) -> 라우트에서 미들웨어 키 사용
    * 'auth.level' => \App\Http\Middleware\AuthenticateWithLevel::class,

----

* form macro
  * make checkbox, radio, select
  * https://laravelcollective.com/docs/5.4/html
  * vi composer.json
  * add require "laravelcollective/html":"^5.4.0"
  * update composer
  * add providers '/config/app.php'
    ```
    Collective\Html\HtmlServiceProvider::class,
    App\Providers\FormMacroServiceProvider::class,
    
    'Form' => Collective\Html\FormFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,
    ```
  * /app/Providers/FormMacroServiceProvider.php

----

* 권한확인-Authorization
  * https://laravel.kr/docs/5.5/authorization
  * 리소스에 대한 사용자 액션의 권한을 승인하는 방법을 제공
  * 액션에 대한 승인을 위한 두가지 기본 방법 제공: Gate 와 Policy 
  * 대부분의 어플리케이션에서 gate와 policy를 혼합하여 사용
  * 'gate = 라우트', 'policy = 컨트롤러'로 생각하면 됨
  * Gate
    * 관리자 대시보드와 같이 모델과 리소스에 관련되지 않은 작업들이 주로 gate에 정합
    * Gate는 항상 사용자 인스턴스를 첫번째 인자로 받고, 관련된 Eloquent 모델과 같은 추가적인 인자들을 선택적으로 전달 받음
  * Policy
    * 특정 모델이나 리소스에 대한 작업을 승인하고자 하는 경우 사용
  * create policy
    * https://laravel.kr/docs/5.5/authorization#creating-policies
      ```
      artisan make:policy PostPolicy --model=Post
      ```
  * policy 등록
    * /app/Providers/AuthServiceProvider.php

----

* 에러와 로깅
  * https://laravel.kr/docs/5.5/errors
  * custom error page
    * https://laracasts.com/discuss/channels/laravel/custom-authorizationexception?page=0
    * /app/Exceptions/Handler.php

----

* 파일 스토리지
  * https://laravel.kr/docs/5.5/filesystem
    ```
    artisan storage:link
    ```
----

* Notifications(메일은 하위 개념)
  * https://laravel.kr/docs/5.5/notifications
  * custom reset password
    ```
    artisan make:notification CustomResetPassword
    vi ./app/Notifications/CustomResetPassword.php
    vi ./app/User.php
        use Notifiable;
        public function sendPasswordResetNotification($token) {
          $this->notify(new CustomResetPassword($token));
          //$this->notify(new ResetPasswordNotification($token));
        }
    ```
  * 컴포넌트 커스터마이징
    * 어플리케이션에서 사용하는 모든 마크다운 알림 컴포넌트는 커스터마이징이 가능
    * 먼저 컴포넌트를 내보내기 위해서 vendor:publish 아티즌 명령어를 사용하여 laravel-mail 애셋 태그를 지정
      ```
      artisan vendor:publish --tag=laravel-mail
      artisan vendor:publish --tag=laravel-notifications
      ```
  * setting mailtrap.io
    * .env 
  * setting gmail
    * https://myaccount.google.com/security#connectedapps
    * 보안 수준이 낮은 앱 허용: 사용
    * .env 
    
----

* Queues-큐
  * https://laravel.kr/docs/5.5/queues
  * 큐드라이버 세팅
    ```
    vi .env
    QUEUE_DRIVER=database
    ```
  * make queue
    ```
    artisan queue:table
    artisan migrate
    ```
  * make job
    ```
    artisan make:job ProcessGenomeDownload
    vi ./app/Jobs/ProcessGenomeDownload.php
    ```
  * insert queue
    ```
    ProcessGenomeDownload::dispatch($file);
    ```
  * worker 구동
    ```
    artisan queue:work --tries=3
    artisan queue:restart
    ```
  * worker 감시
    * Supervisor 설정하기
  * 실패한 큐처리
    ```
    worker 구동시 --tries 옵션 지정해야 함
    artisan queue:failed-table
    artisan migrate
    ```
----

* API 인증
  * https://laravel.kr/docs/5.5/passport

* API Resources
  * https://laravel.kr/docs/5.5/eloquent-resources

* api_token
    ```
    ALTER TABLE users ADD `api_token` char(60) NULL;
    CREATE UNIQUE INDEX users_api_token_uindex ON users (api_token);
    ```

* modify create user 
  * App\Http\Controllers\Aut\RegisterController::create 
    ```
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60),
        ]);
    }
    ```

* add route
  * /routes/api.php
    ```
    Route::middleware('auth:api')->get('/report/{id}', 'ReportController@show')->where(['id' => '[0-9]+']);
    ```

* call url 
    ```
    $now = Carbon::now();
    $directory = "report";
    Storage::makeDirectory("public/".$directory, 'public');

    $file = "report_".$id."_".$now->toAtomString().".pdf";
    $filepath = storage_path('app/public/'.$directory)."/".$file;

    $url = url("/api/report/".$id."?api_token=gZOtac7s2DePiNnqsq8EBZjwnlejbUm9ok3Us9dxL3uDktUPd2CpXjM0d1aR");
    $cmd = "/usr/bin/chromium-browser --headless --disable-gpu --print-to-pdf='".$filepath."' ".$url;
    $last_line = system($cmd, $result);

    if ( $result === 0) {
        if (file_exists($filepath)) {
            $url = asset(Storage::url($directory."/".$file));
            $response = ['RESULT'=>true, 'MESSAGE'=>'', 'DATA'=> $url];
        }
    }
    ```
----

* 캐시
    * create cache
      ```
      artisan config:cache
      artisan route:cache
      artisan optimize — force
      ```
    * clear cache
      ```
      artisan cache:clear
      artisan config:clear
      artisan route:clear
      artisan view:clear
      ```
----

* Use "Eager Loading"
    ```
    When you invoke queries via Eloquent, it uses “lazy loading” approach.
    $books = App\Book::all(); // 20 books in table
    foreach($books as $book){
        echo $book->author->name;
    }

    For every book in database eloquent will run separate SQL query (21 queries instead of 1).
    $books = App\Book::with(‘author’)->get();
    foreach($books as $book){
        echo $book->author->name;
    }
    Eager load query will run only one SQL query with JOIN.
    ```
----

* Laravel server error Segmentation fault
    ```
    composer dump-autoload
    composer update
    artisan cache:clear
    ```
----

* Testing
    ```
    artisan make:test UserTest --unit
    ```
----

* Verification 
  * User email verification and account activation in Laravel 5.6
  * https://www.5balloons.info/user-email-verification-and-account-activation-in-laravel-5-5/

----

* db debugging
  * /vendor/laravel/framework/src/Illuminate/Database/Connection.php
    * $loggingQueries = true;
