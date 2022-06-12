<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function globalSearch($string)
    {        
        Log::info('Showing the search results for students: '.$string);
        //all column names for dynamically exract in query
        $field = ['name','id','phone_number', 'email', 'country', 'country_code'];
        
        $name = Student::Where(function ($query) use($string, $field) {
             for ($i = 0; $i < count($field); $i++){
                $query->orwhere($field[$i], 'like',  '%' . $string .'%');
             }      
        })->paginate(10); //response with pagination

        Log::info("data fetched");
        return $this->sendResponse($name, 'Students successfully Retrieved...!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info("inside store method");
        //countryByCode method is called from helper class
        $contry = countryByCode($request->country_code);
        Log::info("Country name ". $contry[0]['name']." by code ".$request->country_code);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone_number' => 'required|numeric',
            'email' => 'required|string|email|max:100|unique:users',
            'country_code' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), '', 400);       
        }
    
        $student = Student::create(array_merge($request->all(), ['country' => $contry[0]['name']]));
        Log::info("data added successfully");
        return $this->sendResponse($student, 'Student added successfully...!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students)
    {
        //
    }
}
