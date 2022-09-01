<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use App\Traits\RefreshDatabaseWithData;

class ExcellController extends Controller
{
    public function importUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else {
            $file = $request->file('file');
            $file_name = 'user' . \Carbon\Carbon::now()->isoFormat('D-M-YY-hh-mm-ss-') . $file->getClientOriginalName();
            $file_path = 'imports/user';
            $file->move($file_path, $file_name);

            // DB::beginTransaction();
            try {
                $import_users = Excel::import(new UsersImport(), public_path('/imports/user/' . $file_name));
                // DB::commit();
            } catch (Exception $err) {
                // DB::rollback();
                return redirect()->back()->with(['error' => 'Import Failed - ' . $err->getMessage()]);
                // return redirect()->back()->with(['error' => 'Import Failed'])->with(['error' => $th->getMessage()]);
            }
            if ($import_users) {
                return redirect()->back()->with(['success' => 'User berhasil di import']);
            }
        }
        return redirect()->back()
            ->withInput()
            ->withErrors($validator)
            ->with(['error' => 'Data Invalid']);
    }

    public function exportUser()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
