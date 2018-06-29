### LARAVEL SAMPLE SITE
* sample site
  * lte admin, 코드관리, 사용자관리, 게시판관리

* install db
    ```
    create database lrvsample;
    grant all privileges on lrvsample.* to 'development'@'localhost' identified by '';
    grant all privileges on lrvsample.* to 'development'@'1.227.164.28' identified by '';
    //grant all privileges on lrvsample.* to 'development'@'223.33.%' identified by '';
    //grant all privileges on lrvsample.* to 'development'@'223.39.%' identified by '';
    //grant all privileges on lrvsample.* to 'development'@'223.62.%' identified by '';
    ```

* install laravel
    ```  
    //curl -sS https://getcomposer.org/installer | php
    //mv composer.phar /usr/local/bin/composer
    composer create-project laravel/laravel /var/www/html/lrvsample --no-dev --prefer-dist -vvv
    //composer create-project laravel/laravel /var/www/html/lrvsample "5.5.*" --no-dev --prefer-dist -vvv
    composer update
    ```

* setting laravel
  * setting db
    ```
    vi .env
        DB_DATABASE=lrvsample
        DB_USERNAME=development
        DB_PASSWORD=
    ```
  * change timezone
    ```
    /config/app.php
    'timezone' => 'Asia/Seoul',
    ```
  * storage 퍼미션
    ```
    chmod -R 707 storage 
    ```
  * 인증 -> 요약문서
    ```
    php artisan make:auth
    php artisan migrate
    http://114.108.177.80/lrvsample/public/index.php
    ```
  * install adminlte
    * https://github.com/almasaeed2010/AdminLTE/releases
    ```
    cd /var/www/html/lrvsample/public
    wget https://github.com/almasaeed2010/AdminLTE/archive/v2.4.3.zip
    unzip v2.4.3.zip && rm v2.4.3.zip 
    ```

* setting svn
    ```
    svnadmin create /var/www/svn/lrvsample
    vi /var/www/svn/lrvsample/conf/svnserve.conf
      anon-access = none
      auth-access = write
      password-db = passwd
    vi /var/www/svn/lrvsample/conf/passwd
    svn import -m "first commit" /var/www/html/lrvsample svn://127.0.0.1/lrvsample/trunk
    ```

* setting phpstrom
  * Check out from Version Control
  * artisan: ctrl + shift + x
    * 'Tools > Command Line Tool Support' 
      * Choose tool: Tool based on Symfony Console
      * Alias: artisan
      * phar or php script
        * Path to PHP executable: E:\php\php-7.1.16-nts-Win32-VC14-x64\php.exe 
        * Path to script: E:\workspace\obpark\lrvsample\artisan 
  * php built-in web server
    * 'Run > Edit Configurations...'
    * '+ > PHP Built-in Web Server'
      * Document root: E:\workspace\obpark\lrvsample\public
  * setting database
  * create docs
    * deploy.txt: 서버 배포 명령어
    * db.sql: project db schema
    * laravel.txt: 라라벨관련 명령어 
    * project.txt: 프로젝트 정보
    * query.sql: db console
    * todo.txt: 할일 목록

----

* route 
  * 유저 컨트롤러 생성
    * artisan make:controller UserController --resource
  * E:\workspace\obpark\lrvsample\.env
  * E:\workspace\obpark\lrvsample\config\constants.php
  * E:\workspace\obpark\lrvsample\routes\web.php

* middleware -> 요약문서
  * 레벨인증 미들웨어생성
    * artisan make:middleware AuthenticateWithLevel
    * E:\workspace\obpark\lrvsample\app\Http\Middleware\AuthenticateWithLevel.php

  * 레벨인증 미들웨어등록
    * E:\workspace\obpark\lrvsample\app\Http\Kernel.php
    * 'auth.level' => \App\Http\Middleware\AuthenticateWithLevel::class,

  * 필드추가
    * alter table users add `level` tinyint(3) unsigned NOT NULL DEFAULT '1';

  * 모델에 함수 추가
    * E:\workspace\obpark\lrvsample\app\User.php

* layout
    * 어드민용 layout생성
      * E:\workspace\obpark\lrvsample\resources\views\layouts\admin.blade.php
    
* admin user crud
  * 목록 - datatable 
  * 저장
    * form summit and ajax, validation, fileupload,  트랜잭션 처리
  * form macro -> 요약문서

