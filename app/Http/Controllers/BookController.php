<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use MeiliSearch\Client;

use App\Models\BookDetail;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookData = BookDetail::orderBy('id','desc')->paginate(10);
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
        // $bookData = BookDetail::orderBy('id','desc')->get();
        $bookData = BookDetail::orderBy('id','desc')->paginate(10);

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
        return view('showbooks');

       
        // view('showbooks', compact('bookData'));
    }
    public function viewbook($id) {
        $bookData = BookDetail::where('id', $id)->first();
        return view('viewbook', compact('bookData'));

    }
    
    public function search(Request $request)
    {
        $all = $request->all;     
        $perPage = 10;
        $page = $request->input('page') ?? 1; 
        if($all === 'yes'){
            $bookData = BookDetail::orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);

        } else {
            $searchValue = $request->searchInput;        
            $bookData = BookDetail::where(function ($query) use ($searchValue) {
                $query->where('publisher', 'like', '%' . $searchValue . '%')
                    ->orWhere('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('author', 'like', '%' . $searchValue . '%')
                    ->orWhere('genre', 'like', '%' . $searchValue . '%')
                    ->orWhere('isbn', 'like', '%' . $searchValue . '%')
                    ->orWhere('published', 'like', '%' . $searchValue . '%');
            })->paginate($perPage, ['*'], 'page', $page);
        }
        $pagination = View::make('pagination', ['bookData' => $bookData])->render();
        $content = View::make('book_content', ['bookData' => $bookData])->render();


            // $bookData = BookDetail::orderBy('id','desc')->paginate(10);
            // $docs = '';
            // foreach($bookData as $val){
            //     $name = $val->title;
            //     $limitedName = strlen($name) > 25 ? substr($name, 0, 25) . '...' : $name;
                
            //     $docs .= '
            //     <div class="w3-third w3-margin-bottom">
            //         <ul class="w3-ul w3-border w3-center w3-hover-shadow">
            //             <li>
            //                 <div class="w3-card-4">';
            //                     if(!empty( $val->image )){
            //                         $docs .= '<img src="' . $val->image . '" class="w3-round w3-image w3-opacity-min" onerror="this.onerror=null;this.src=\'' . url('custom/dummy-logo.png') . '\';" alt="image" style="width:345px;height:230px;">';
            //                     } else { 
            //                         $docs .= 
            //                         '<img src="'. url('custom/dummy-logo.png') .'" alt="image" style="width:345px;height:230px;">';
            //                     }
            //                     $docs .= '
            //                     <div class="w3-container">
            //                         <h3>'. $limitedName .'</h3>
            //                         <p>'. $val->author .'</p>
            //                         <p><a href="'. route('viewbook' , $val->id) .'" class="w3-button w3-light-grey w3-block">View</a></p>
            //                     </div>
            //                 </div>
            //             </li>
            //         </ul>
            //     </div>';
            // }
           
            $pagi = '';
            // $pagi .= '
            // </div>
            // <div class="col-md-12">
            //     <nav aria-label="Page navigation">
            //         <ul class="pagination justify-content-center">';
            //             if ($bookData->onFirstPage()){
            //                     $pagi .= 
            //                     '<li class="page-item disabled">
            //                         <span class="page-link">&laquo;</span>
            //                     </li>';
            //             } else {
            //                 $pagi .= 
            //                 '<li class="page-item">
            //                     <a class="page-link" href="'. $bookData->previousPageUrl() .'" rel="prev">&laquo;</a>
            //                 </li>';
            //             }
    
            //             foreach ($bookData->getUrlRange(1, $bookData->lastPage()) as $page => $url){
            //                 $status = '';
            //                 if($page == $bookData->currentPage()){
            //                     $status = 'active';
            //                 }
            //                 $pagi .= 
            //                 '<li class="page-item '. $status .'">
            //                     <a class="page-link" href="'. $url .'">'. $page .'</a>
            //                 </li>';
            //             }
    
            //             if ($bookData->hasMorePages()){
            //                 $pagi .= 
            //                 '<li class="page-item">
            //                     <a class="page-link" href="'. $bookData->nextPageUrl() .'" rel="next">&raquo;</a>
            //                 </li>';
            //             } else {
            //                 $pagi .= 
            //                 '<li class="page-item disabled">
            //                     <span class="page-link">&raquo;</span>
            //                 </li>';
            //             }
            //             $pagi .= 
            //         '</ul>
            //     </nav>
            // </div>';


            $output = [
                'content' => $content,
                'pagination' =>  $pagination
            ];
    
    
            return $output;
      
        // return $bookData;
        return view('showbooks', compact('bookData'));


        $books = BookDetail::all();
        

        // Initialize Meilisearch client
        // $client = new Client('http://127.0.0.1:8000', 'UYVmSn7JmTFgcYnp-50KtudeROV-FIZJKMVLPmC_5N4');
        $client = new Client('http://127.0.0.1:8000/search', 'rQKc_bpt7E_L5DRfkDTdF1Wc8PgfGuGbLx-6lbq9IHQ');

        // Replace 'index_name' with your index name
        return $index = $client->getIndex('title');

        $booksToIndex = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
            ];
        })->toArray();

        $results = $index->addDocuments($booksToIndex);
      
        return response()->json($results);
    }
}
