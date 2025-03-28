<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ebook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class EBookController extends Controller
{
    /**
     * Display a listing of the ebook.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.ebook.list');
    }

    /**
     * Display the specified customer.
     *
     * This method decrypts the provided customer ID, retrieves the customer
     * along with their roles from the database, and returns the edit view
     * with the customer data and the selected role ID.
     *
     * @param string $id The encrypted customer ID.
     * @return \Illuminate\View\View The view displaying the customer edit form.
     */
    public function show(string $id)
    {
        $ebookId = decrypt($id);
        $ebook = Ebook::with(['petName'])->find($ebookId);

        return view('admin.ebook.edit',[
            'ebook' => $ebook,
        ]);
    }

    public function getAjaxtEbookData()
    {
        $model = Ebook::with(['petName'])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('petName', function ($ebook) {
                return $ebook->petName->name;
            })
            ->editColumn('title', function ($ebook) {
                return $ebook['title'];
            })
            ->editColumn('description', function ($ebook) {
                return Str::limit($ebook->description, 50);
             })
            ->addColumn('edit', function ($ebook) {
                $edit_url = route('e-book.show',encrypt($ebook->id));
                $btn = '<a href="' . $edit_url . '"><i class="fa fa-eye"></i></a>';
                return $btn;
            })
            ->addColumn('activation', function($ebook){
                if ( $ebook->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                $btn = '<a href="' . route('customer.change-status', ['id' =>$ebook->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->rawColumns(['edit','activation'])
            ->toJson();
    }
}
