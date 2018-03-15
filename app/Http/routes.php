<?php
/**
 * Contains the route definitions.
 *
 * This file calls the various functions on the Route to register all routes
 * and resources defined by the application.
 *
 * PHP Version 5
 *
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

// Application root
Route::get('/', ['as' => 'root', 'uses' => 'RootController@root']);

// Authentication & Registration
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['uses' => 'Auth\AuthController@postRegister']);

Route::get('person/autocomplete', ['as' => 'person.autocomplete', 'uses' => 'PersonController@autocomplete']);
Route::resource('person', 'PersonController');
Route::resource('person.award', 'QualificationAwardController');
Route::resource('project_role', 'ProjectRoleController');
Route::resource('qualification', 'QualificationController');
Route::resource('funder', 'FunderController');
Route::get(
    'funding_app/autocomplete',
    ['as' => 'funding_app.autocomplete',
    'uses' => 'FundingApplicationController@autocomplete']
);
Route::resource('funding_app', 'FundingApplicationController');
Route::resource('funding_app.applicant', 'FundingApplicantController');
Route::resource('project', 'ProjectController');
Route::resource('project.participant', 'ProjectParticipantController');
Route::resource('project.funding', 'ProjectFundingController');
