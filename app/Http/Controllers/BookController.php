<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Book::all();

        return response() -> json([
            "message" => "Data berhasil ditemukan",
            "data" => $table
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'date_of_issue' => 'required'
        ]);

        $data = Book::create($table);
        return response() -> json([
            "message" => "Data berhasil ditambahkan",
            "data" => $data
        ]);
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
        $book = book::find($id);
        if($book){
            $book->title = $request->title ? $request->title : $book->title;
            $book->description = $request->description ? $request->description : $book->description;
            $book->author = $request->author ? $request->author : $book->author;
            $book->publisher = $request->publisher ? $request->publisher : $book->publisher;
            $book->date_of_issue = $request->date_of_issue ? $request->date_of_issue : $book->date_of_issue;
            $book->save();
            return response()->json([
                'status' => 200,
                'data' => $book
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> $id . ' Not Found'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Book::find($id);
        if($table) {
            $table -> delete();
            return response()->json([
                'status' => 200,
                'data' => $table
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> $id . ' Not Found'
            ],404);
        }
    }
}

