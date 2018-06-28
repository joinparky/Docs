```
if (!$request->ajax()) {
    $segment = $request->route()->getPrefix();
    return view($segment."user.index");
}

$response = ['RESULT'=>false, 'MESSAGE'=>'오류가 발생하였습니다.'];
$statusCode = 200;

try {
    DB::beginTransaction();


    $now = Carbon::now();
    $user = User::find($id);
    $result = $user->update('level','1');

    if ($result) {
        $response = ['RESULT'=> true, 'MESSAGE'=>''];
        DB::commit();
    } else {
        DB::rollBack();
    }
} catch (Exception $e) {
    $statusCode = 500;
    $response['MESSAGE'] = $e;
} finally {
    return Response::json($response, $statusCode);
}
```
