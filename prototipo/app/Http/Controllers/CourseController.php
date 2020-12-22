<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    // public function store(Course $request)
    public function store(Request $request)
    {   
        $messages = [
            'name:required'  => 'Por favor, insira o nome do curso',
            'tutor:required' => 'Por favor, insira o tutor do curso',
            'email:required' => 'Por favor, insira o e-maill do curso'
        ];

        $rules = [
            'name'  => 'required',
            'tutor' => 'required|min:3|max:8',
            'email' => 'required|email',
        ];

        $validate = Validator::make($request->all(), $rules, $messages);

        var_dump($validate->fails());

        if($validate->fails()){
            return redirect()->route('course.create')->withInput()->withErrors($validate);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
