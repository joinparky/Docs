* 메신저 앱 
  * 변수작명방법
    * 소속 + 특징: ex) splashactivity_linaerlayout

  * Select the form factors and minimum SDK
    * Minimum SDK: API 15: Andriod 4.0.3 (IceCreamSandwich)
    * 많이 사용하는 최소지원버전 

  * Available Virtual Devices
    * Nexus 5X API 23

  * 화면구성 
    * 탭메뉴
      * 하이브리드 페이지 연결

  * 회원가입, 로그인기능 
    * validation 
    * PHP SDK 연동 - 웹에서 DB 연동이 가능한지?

  * 메신저기능
    * 1:1채팅방, 단체채팅방, 파일전송

----

* 채팅방 만들고나서 한번에 입력 안되는 문제 확인 

* Android Studio guest hasnt come online in 7 seconds
  open AVD manager -> Edit device -> Show Advanced Settings -> Boot option -> select Cold Boot instead of Quick boot.

* Instant Run
  https://developer.android.com/studio/run/?utm_source=android-studio#instant-run

----
* Build Variants
  * Build Variant > release

* Bulid > Generate Signed APK
  * Key store path: C:\Users\obpark\blocktalk.jks
    * Create new...
      * Key store path
      * Password, Confirm
      * Alisa: Key
      * Password, Confirm
      * Validity (years): 30
      * First and Last Name: Obyoung Park
      * Organizational Unit: Obyoung Park
      * Organization: Obyoung Park
      * City or Locality: Yuseonggu 
      * State or Province: Daejeon
      * Country Code (XX): 82
  * Key store password: ********
  * Key alise: key0
  * Key password: ********
  * Bulid Type: release
  * Signature Vesions: V1, V2 checked

E:\workspace\obpark\MyHybrid\app

* update apk
  * update version
    * /app/build.gradle
    * versionCode 2
    * versionName "1.1"
  * build apk
  * upload apk
    * /app/release/app-release.apk
    * https://play.google.com/apps/publish
      * 출시 관리 > 앱 버전 > 프로덕션 트랙 (관리)

* Google Play Store 개발자 등록 
  * https://play.google.com/apps/publish/signup/
  * https://youtu.be/gd49JeLYvUI

