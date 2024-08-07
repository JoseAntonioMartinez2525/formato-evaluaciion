<?php

use App\Http\Controllers\FormContentController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SecretariaController;
use App\Models\DictaminatorsResponseForm2;
use App\Models\DictaminatorsResponseForm2_2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseJson;
use App\Http\Controllers\ResponseForm2Controller;
use App\Http\Controllers\ResponseForm2_2Controller;
use App\Http\Controllers\ResponseForm3_1Controller;
use App\Http\Controllers\ResponseForm3_2Controller;
use App\Http\Controllers\ResponseForm3_3Controller;
use App\Http\Controllers\ResponseForm3_4Controller;
use App\Http\Controllers\ResponseForm3_5Controller;
use App\Http\Controllers\ResponseForm3_6Controller;
use App\Http\Controllers\ResponseForm3_7Controller;
use App\Http\Controllers\ResponseForm3_8Controller;
use App\Http\Controllers\ResponseForm3_9Controller;
use App\Http\Controllers\ResponseForm3_10Controller;
use App\Http\Controllers\ResponseForm3_11Controller;
use App\Http\Controllers\ResponseForm3_12Controller;
use App\Http\Controllers\ResponseForm3_13Controller;
use App\Http\Controllers\ResponseForm3_14Controller;
use App\Http\Controllers\ResponseForm3_15Controller;
use App\Http\Controllers\ResponseForm3_16Controller;
use App\Http\Controllers\ResponseForm3_17Controller;
use App\Http\Controllers\ResponseForm3_18Controller;
use App\Http\Controllers\ResponseForm3_19Controller;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluatorSignatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DictaminatorController;

Route::get('/', function () {
    return view('login');
});

Route::get('/', [SessionsController::class, 'index'])->name('login');
Route::post('/login', [SessionsController::class, 'login'])->name('login.post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome', [HomeController::class, 'showWelcome'])->name('welcome');
Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('rules', function () {return view('rules'); })->name('rules');
Route::get('docencia', function () {return view('docencia'); })->name('docencia');
Route::get('resumen', function () {return view('resumen'); })->name('resumen');
Route::get('perfil', function () {return view('perfil'); })->name('perfil');
Route::get('general', function () {return view('general');})->name('general');
Route::get('form2', function () {
    return view('form2'); })->name('form2');
Route::get('form2_2', function () {
    return view('form2_2'); })->name('form2_2');
Route::get('comision_dictaminadora', function () {return view('comision_dictaminadora'); })->name('comision_dictaminadora');
Route::get('/secretaria', [SecretariaController::class, 'showSecretaria'])->name('secretaria');

Route::get('/show-all-users', [ProfileController::class, 'showAllUsers'])->name('show-all-users');
Route::get('/get-docentes', [DictaminatorController::class, 'getDocentes'])->name('getDocentes');
Route::get('/get-docente-data', [DictaminatorController::class, 'getDocenteData'])->name('getDocenteData');
Route::get('/get-form-content/{form}', [FormContentController::class, 'getFormContent']);


//POST formularios
Route::post('/store', [ResponseController::class, 'store'])->name('store');
Route::post('/store2', [ResponseForm2Controller::class, 'store2'])->name('store2');
Route::post('/store3', [ResponseForm2_2Controller::class, 'store3']);
Route::post('/store31', [ResponseForm3_1Controller::class, 'store31']);
Route::post('/store32', [ResponseForm3_2Controller::class, 'store32']);
Route::post('/store33', [ResponseForm3_3Controller::class, 'store33']);
Route::post('/store34', [ResponseForm3_4Controller::class, 'store34']);
Route::post('/store35', [ResponseForm3_5Controller::class, 'store35']);
Route::post('/store36', [ResponseForm3_6Controller::class, 'store36']);
Route::post('/store37', [ResponseForm3_7Controller::class, 'store37']);
Route::post('/store38', [ResponseForm3_8Controller::class, 'store38']);
Route::post('/store39', [ResponseForm3_9Controller::class, 'store39']);
Route::post('/store310', [ResponseForm3_10Controller::class, 'store310']);
Route::post('/store311', [ResponseForm3_11Controller::class, 'store311']);
Route::post('/store312', [ResponseForm3_12Controller::class, 'store312']);
Route::post('/store313', [ResponseForm3_13Controller::class, 'store313']);
Route::post('/store314', [ResponseForm3_14Controller::class, 'store314']);
Route::post('/store315', [ResponseForm3_15Controller::class, 'store315']);
Route::post('/store316', [ResponseForm3_16Controller::class, 'store316']);
Route::post('/store317', [ResponseForm3_17Controller::class, 'store317']);
Route::post('/store318', [ResponseForm3_18Controller::class, 'store318']);
Route::post('/store319', [ResponseForm3_19Controller::class, 'store319']);
Route::post('/store-resume', [ResumeController::class, 'storeResume']);
Route::post('/store-evaluator-signature', [EvaluatorSignatureController::class, 'store'])->name('store-evaluator-signature');

Route::post('/storeform2', [DictaminatorsResponseForm2::class, 'storeform2']);
Route::post('/storeform22', [DictaminatorsResponseForm2_2::class, 'storeform22']);

//GET formularios
Route::get('/get-data1', [ResponseController::class, 'getData1'])->name('getData1');
Route::get('/get-data2', [ResponseForm2Controller::class, 'getData2'])->name('getData2');
Route::get('/get-data22', [ResponseForm2_2Controller::class, 'getData22'])->name('getData22');
Route::get('/get-data-31', [ResponseForm3_1Controller::class, 'getData31'])->name('getData31');
Route::get('/get-data-32', [ResponseForm3_2Controller::class, 'getData32'])->name('getData32');
Route::get('/get-data-33', [ResponseForm3_3Controller::class, 'getData33'])->name('getData33');
Route::get('/get-data-34', [ResponseForm3_4Controller::class, 'getData34'])->name('getData34');
Route::get('/get-data-35', [ResponseForm3_5Controller::class, 'getData35'])->name('getData35');
Route::get('/get-data-36', [ResponseForm3_6Controller::class, 'getData36'])->name('getData36');
Route::get('/get-data-37', [ResponseForm3_7Controller::class, 'getData37'])->name('getData37');
Route::get('/get-data-38', [ResponseForm3_8Controller::class, 'getData38'])->name('getData38');
Route::get('/get-data-39', [ResponseForm3_9Controller::class, 'getData39'])->name('getData39');
Route::get('/get-data-310', [ResponseForm3_10Controller::class, 'getData310'])->name('getData310');
Route::get('/get-data-311', [ResponseForm3_11Controller::class, 'getData311'])->name('getData311');
Route::get('/get-data-312', [ResponseForm3_12Controller::class, 'getData312'])->name('getData312');
Route::get('/get-data-313', [ResponseForm3_13Controller::class, 'getData313'])->name('getData313');
Route::get('/get-data-314', [ResponseForm3_14Controller::class, 'getData314'])->name('getData314');
Route::get('/get-data-315', [ResponseForm3_15Controller::class, 'getData315'])->name('getData315');
Route::get('/get-data-316', [ResponseForm3_16Controller::class, 'getData316'])->name('getData316');
Route::get('/get-data-317', [ResponseForm3_17Controller::class, 'getData317'])->name('getData317');
Route::get('/get-data-318', [ResponseForm3_18Controller::class, 'getData318'])->name('getData318');
Route::get('/get-data-319', [ResponseForm3_19Controller::class, 'getData319'])->name('getData319');
Route::get('/get-data-resume', [ResumeController::class, 'getDataResume'])->name('get-data-resume');
Route::get('/get-evaluator-signature', [EvaluatorSignatureController::class, 'getEvaluatorSignature'])->name('get-evaluator-signature');

Route::get('/general', [ReportsController::class, 'index'])->name('general');
Route::get('/show-profile', [ReportsController::class, 'showProfile'])->name('show-profile');
//Route::get('/perfil', [ProfileController::class, 'showProfile'])->name('perfil.show');

Route::get('/generate-json', [ResponseController::class, 'generateJson'])->name('generate-json');
Route::get('/json-generator', [ResponseJson::class, 'jsonGenerator'])->name('json-generator');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');



