<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;
use Yajra\DataTables\Facades\DataTables;

class DataTableController extends Controller
{
    public function index(){

        // $data =
        // [
        //     [
        //         'name'      =>  'John Doe',
        //         'email'     =>  'john@gmail.com',
        //         'city'      =>  'Surabaya'
        //     ],
        //     [
        //         'name'      =>  'John Cena',
        //         'email'     =>  'cena@gmail.com',
        //         'city'      =>  'Malang'
        //     ],
        //     [
        //         'name'      =>  'Andreo',
        //         'email'     =>  'andreo@gmail.com',
        //         'city'      =>  'Jakarta'
        //     ],
        // ];

        $data = User::get();

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($item) {
                    $render =
                    '
                        <button type="button" href="product/'.$item->id.'"class="btn btn-danger">Hapus</button>
                    ';

                    return $render;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('index');
    }
}
