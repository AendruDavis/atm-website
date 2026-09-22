<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactEnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SurveyRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
Route::get('/insights/{post}', [InsightController::class, 'show'])->name('insights.show');
Route::get('/contact', [ContactEnquiryController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactEnquiryController::class, 'store'])->middleware('throttle:6,1')->name('contact.store');
Route::get('/request-a-survey', [SurveyRequestController::class, 'create'])->name('survey-requests.create');
Route::post('/request-a-survey', [SurveyRequestController::class, 'store'])->middleware('throttle:4,1')->name('survey-requests.store');
Route::get('/request-a-survey/{surveyRequest}/received', [SurveyRequestController::class, 'success'])->name('survey-requests.success');
Route::get('/legal/{page}', [LegalPageController::class, 'show'])->name('legal.show');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
