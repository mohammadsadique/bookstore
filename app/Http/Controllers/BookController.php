<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use App\Models\BookDetail;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookData = BookDetail::orderBy('id','desc')->get();
        return view('book', compact('bookData'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
        ]);
    
        if(!empty($request->id)){
            $book = BookDetail::find($request->id);
            $msg = 'Book updated successfully.';
        } else {
            $book = new BookDetail;
            $msg = 'Book added successfully.';
        }

        if($request->file('image')){
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('image')->move(public_path('custom/images'), $fileName);
            $book->image = url('custom/images').'/'.$fileName;
        }
        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->description = $request->description;
        $book->isbn = $request->isbn;
        $book->published = $request->published;
        $book->publisher = $request->publisher;
        $book->save();

        return redirect()->route('manage-book.index')->with('customersuccess', $msg);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookData = BookDetail::orderBy('id','desc')->get();

        $updData = BookDetail::where('id' , $id)->first();
        return View::make('book', [
            'bookData' => $bookData,
            'ban' => $updData,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del = BookDetail::findOrFail($id);
        $del->delete();

        $msg = 'Book deleted successfully.';
        return redirect()->route('manage-book.index')->with('deletesuccess', $msg);
    }

    public function getdata() {
        $url = 'https://fakerapi.it/api/v1/books?_quantity=100';
        $response = Http::get($url);
        if ($response->successful()) {
            $data = $response->json(); 
            foreach($data['data'] as $getData){
                $book = new BookDetail;
                $book->title = $getData['title'];
                $book->author = $getData['author'];
                $book->genre = $getData['genre'];
                $book->description = $getData['description'];
                $book->isbn = $getData['isbn'];
                $book->image = $getData['image'];
                $book->published = $getData['published'];
                $book->publisher = $getData['publisher'];
                $book->save();

            }
            return 'Book details are insert into database.';

        } else {
            return "Failed to fetch data: " . $response->status();
        }
   
    }
    public function books()
    {
        $bookData = BookDetail::orderBy('id','desc')->limit(10)->get();
        return view('showbooks', compact('bookData'));
    }
    public function viewbook($id) {
        $bookData = BookDetail::where('id', $id)->first();
        return view('viewbook', compact('bookData'));

    }
}
