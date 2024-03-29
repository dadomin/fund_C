<?php

use Damin\Route;;

Route::get("/", "MainController@index");
Route::get("/index", "MainController@index");

Route::get("/register", "RegisterController@index");
Route::post("/register/ok", "RegisterController@ok");

Route::get("/login","LoginController@index");
Route::post("/login/ok", "LoginController@ok");
Route::get("/logout", "LoginController@logout");

Route::get("/profile", "ProfileController@index");

Route::get("/fund", "FundController@index");
Route::get("/fund/business", "FundController@business");
Route::get("/fund/remove", "FundController@remove");
Route::get("/fund/invest", "FundController@invest");

Route::get("/adapt", "AdaptController@index");
Route::post("/adapt/ok", "AdaptController@ok");

Route::get("/investor", "InvestorController@index");

Route::get("/admin", "AdminController@index");