<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("logout","HomeController@logout")->name("logout");


Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('selection');
    })->name("selection");

    Route::get("login.show/{type}",function($type){

        return view("auth.login",["type"=>$type]);

    })->name("login.show");

    Route::post("login","Auth\LoginController@login")->name("login");
});


 //==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

   //==============================dashboard============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });



    Route::get("/class_list","classes\classroom@index")->name("class_list");
    Route::post("/classroom.store","classes\classroom@store")->name("classroom.store");
    Route::post("/classroom.update","classes\classroom@update")->name("classroom.update");
    Route::post("/classroom.destroy","classes\classroom@destroy")->name("classroom.destroy");
    Route::post("delete_group_class","classes\classroom@delete_group_class")->name("delete_group_class");
    Route::post("techer.subject","techers\\techer@store_subject")->name("techer.subject");


    Route::get("/section","sections\section@index")->name("section");
    Route::get("/classes/{id}","classes\classroom@get_classes_by_grade");
    Route::post("section.store","sections\section@store")->name("section.store");
    Route::post("section.edit","sections\section@edit")->name("section.edit");
    Route::post("section.delete","sections\section@delete")->name("section.delete");
    Route::get("/show_parent","parents\parents@index")->name("show_parents");
    Route::get("add_parents","parents\parents@add_parents")->name("add_parents");
    Route::post("/parent.store","parents\parents@store")->name("parent.store");
    Route::get("/parent.delete/{id}","parents\parents@delete")->name("parent.delete");
    Route::get("/parent.edit/{id}","parents\parents@edit")->name("parent.edit");
    Route::post("parent.update","parents\parents@update")->name("parent.update");
    Route::get("show_techer","techers\\techer@index")->name("techer.show");
    Route::get("techer.create","techers\\techer@create")->name("techer.create");
    Route::post("techer.store","techers\\techer@store")->name("techer.store");
    Route::get("techer.edit/{id}","techers\\techer@edit")->name("techer.edit");
    Route::post("techer.update","techers\\techer@update")->name("techer.update");
    Route::post("techer.delete/{id}","techers\\techer@delete")->name("techer.delete");
    Route::get("show.student","students\student@index")->name("show.student");
    Route::get("student.create","students\student@create")->name("student.create");
    Route::post("student.store","students\student@store")->name("student.store");
    Route::get("student.edit/{id}","students\student@edit")->name("student.edit");
    Route::post("student.update","students\student@update")->name("student.update");
    Route::post("student.delete/{id}","students\student@delete")->name("student.delete");
    Route::get("promotion","promotions\promotion@index")->name("show.promotion");
    Route::get("get_all_classroom/{id}","classes\classroom@get_classes_by_grade");
    Route::get("get_all_section/{id}","sections\section@get_section_by_classroom");
    Route::post("promotion.store","promotions\promotion@store")->name("promotion.store");
    Route::get("manage_promotion","promotions\promotion@index")->name("promotion.index");
    Route::get("parent.show_info/{id}","parents\parents@show_info")->name("parent.show_info");
    Route::get("parent_attachment/{id}","parents\parents@delete_image")->name("parent_attachment");
    Route::post("attachment_parent_save","parents\parents@parent_save_images")->name("attachment_parent_save");
    Route::get("techer.salary_show","salarys\salary@index")->name("techer.salary_show");
    Route::get("salary.create","salarys\salary@create")->name("salary.create");
    Route::post("salary.store","salarys\salary@store")->name("salary.store");
    Route::post("salary.delete","salarys\salary@delete")->name("salary.delete");
    Route::get("salary.edit/{id}","salarys\salary@edit")->name("salary.edit");
    Route::post("salary.update","salarys\salary@update")->name("salary.update");
    Route::get("techer.show_details/{id}","techers\\techer@show_detail")->name("techer.show_details");
    Route::post("attachment_techer_save","techers\\techer@save_attachment")->name("attachment_techer_save");
    Route::get("/download_attachment/{attachment}/{type}/{id}/{url}","parents\parents@download_image")->name("download_parent_attachment");
    Route::get("detail_grade/{id}","Grades\GradeController@show_details")->name("detail_grade");
    Route::get("classroom_student/{id}","classes\classroom@student_classroom")->name("classroom_student");
    Route::get("show_subjects","subjects\subject@index")->name("show_subjects");
    Route::get("subject.create","subjects\subject@create")->name("subject.create");
    Route::post("subject.store","subjects\subject@store")->name("subject.store");
    Route::get("subject_student/{id}","subjects\subject@show_student")->name("subject_student");
    Route::get("student.details/{id}","students\student@show_details")->name("student.details");
    Route::post("attachment_student_save","students\student@attachment_student_save")->name("attachment_student_save");
    Route::get("classroom_subject/{id}","classes\classroom@show_subject")->name("classroom_subject");
    Route::get("show_fees","fees\\fees@index")->name("show_fees");
    Route::get("fee.create","fees\\fees@create")->name("fee.create");
    Route::post("fee.store","fees\\fees@store")->name("fee.store");
    Route::get("add_fee_student/{id}","student_fees\student_fee@create_student_fee")->name("add_fee_student");
    Route::post("fee.student.store","student_fees\student_fee@store_student_fee")->name("fee.student.store");
    Route::get("subject.edit/{id}","subjects\subject@edit")->name("subject.edit");
    Route::post("subject.update","subjects\subject@update")->name("subject.update");
    Route::post("subject.delete","subjects\subject@delete")->name("subject.delete");
    Route::get("fee.edit/{id}","fees\\fees@edit")->name("fee.edit");
    Route::post("fee.update","fees\\fees@update")->name("fee.update");
    Route::post("fee.delete","fees\\fees@delete")->name("fee.delete");
    Route::get("student_fee.edit/{id}","fees\\fees@student_fee_edit")->name("student_fee.edit");
    Route::post("fee.student.update","fees\\fees@student_fee_update")->name("fee.student.update");
    Route::get("student_fee.delete/{id}","fees\\fees@student_fee_delete")->name("student_fee.delete");
    Route::get("add_shecks_student/{id}","shecks\sheck@create")->name("add_shecks_student");
    Route::post("sheck.student.store","shecks\sheck@store")->name("sheck.student.store");
    Route::get("student_sheck.delete/{id}","shecks\sheck@delete")->name("student_sheck.delete");
    Route::get("student_sheck.edit/{id}","shecks\sheck@edit")->name("student_sheck.edit");
    Route::post("sheck.student.update","shecks\sheck@update")->name("sheck.student.update");
    Route::get("/get_amount/{id}","fees\\fees@student_fee_get");
    Route::get("/get_amount_fee/{id}","fees\\fees@student_sheck_get");
    Route::get("attendace.show","attendaces\attendace@index")->name("attendace.show");
    Route::get("attendace.create/{id}","attendaces\attendace@create")->name("attendace.create");
    Route::post("attendace.store","attendaces\attendace@store")->name("attendace.store");
    Route::get("attendace.details/{id}","attendaces\attendace@details")->name("attendace.details");
    Route::get("show_exam","exams\\exam@index")->name("show_exam");
    Route::get("exam.create","exams\\exam@create")->name("exam.create");
    Route::post("exam.store","exams\\exam@store")->name("exam.store");
    Route::get("exam.delete/{id}","exams\\exam@delete")->name("exam.delete");
    Route::get("exam.edit/{id}","exams\\exam@edit")->name("exam.edit");
    Route::post("exam.update","exams\\exam@update")->name("exam.update");
    Route::get("show_queze","quezes\queze@index")->name("show_queze");
    Route::get("queze.create","quezes\queze@create")->name("queze.create");
    Route::post("queze.store","quezes\queze@store")->name("queze.store");
    Route::get("queze.delete/{id}","quezes\queze@delete")->name("queze.delete");
    Route::get("queze.edit/{id}","quezes\queze@edit")->name("queze.edit");
    Route::post("queze.update","quezes\queze@update")->name("queze.update");
    Route::get("show_library","librarys\library@index")->name("show_library");
    Route::get("library.create","librarys\library@create")->name("library.create");
    Route::post("library.store","librarys\library@store")->name("library.store");
    Route::post("library.destroy","librarys\library@delete")->name("library.destroy");
    Route::get("download_file/{id}","librarys\library@download_file")->name("download_file");
    Route::get("library.edit/{id}","librarys\library@edit")->name("library.edit");
    Route::post("library.update","librarys\library@update")->name("library.update");
    Route::get("show_setting","settings\setting@index")->name("show_setting");
    Route::post("setting.store","settings\setting@store")->name("setting.store");
    Route::get("delete_section_techer/{id}","techers\\techer@delete_section")->name("delete_section_techer");
    Route::post("section_techer.update","techers\\techer@update_section")->name("section_techer.update");
    Route::get("promotion.create","promotions\promotion@create")->name("promotion.create");
    Route::get("promotion.backStudent/{id}","promotions\promotion@backStudent")->name("promotion.backStudent");
    Route::get("promotion.graduate","graduates\graduate@index")->name("promotion.graduate");
    Route::get("graduate.create","graduates\graduate@create")->name("graduate.create");


});
// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
