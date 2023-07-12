<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');
        $borrowers = DB::table('borrowers')
            ->join('users', 'borrowers.user_id', '=', 'users.id')
            ->join('books', 'borrowers.book_id', '=', 'books.id')
            ->select('users.name', 'books.judul', 'borrowers.tanggal_pinjam', 'borrowers.tanggal_kembali', 'borrowers.status')
            ->get();

        return view('borrowers.index', [
            'title' => 'Data Peminjam',
            'borrowers' => $borrowers
        ]);
    }

}