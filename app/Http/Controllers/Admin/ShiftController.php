<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::get();
        return view('admin.pages.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        Shift::create($data);

        return redirect()->route('shift.index')->with('process-success', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::findOrFail($id);
        return view('admin.pages.shift.show', [
            'shift' => $shift,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        return view('admin.pages.shift.edit',[
            'shift' => $shift,
        ]);
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
        $data = $request->all();

        Shift::findOrFail($id)->update($data);

        return redirect()->route('shift.index')->with('process-success', 'Berhasil mengubah data!');
    }


    public function confirmation($id)
    {
        alert()->warning('Peringatan !', 'Data yang dihapus tidak bisa dikembalikan')
        ->showConfirmButton(
        '<form action="'. route('shift.destroy', $id).'" method="POST" class="border-0">
            ' . method_field('delete') . csrf_field() . '
            <button type="submit"
                style="border: none; background-color: #3085d6; color: #fff;"
            >
                Hapus
            </button>
        </form>','#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Shift::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('process-success', 'Berhasil menghapus data!');
    }

    public function deleteAll(Request $request){
        $ids = $request->get('ids');

        if ($ids != null) {
            foreach ($ids as $id){
                $data = Shift::find($id);
                $data->delete();
            }
            return redirect()->route('shift.index')->with('process-success', 'Berhasil menghapus semua data yang terpilih!');
        } else {
            return redirect()->back();
        }
    }
}
