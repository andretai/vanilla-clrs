<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlatformsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'platform' => 'required'
        ]);
        $platform = new Platform;
        $platform->platform = $request->platform;
        $platform->save();
        return view('ms.api.add', [
            'back' => route('ms-platform'),
            'item_type' => 'platform',
            'item_fields' => $this->platformFields([])
        ]);
    }

    public function update(Request $request) {
        $status = true;
        try {
            $item_id = $request->query('id');
            $request->validate([
                'platform' => 'required'
            ]);
            DB::table('platforms')->where('id', $item_id)->update([
                'platform' => $request->platform
            ]);
        } catch(Exception $e){
            $status = false;
        }
        return view('ms.api.edit', [
            'back' => route('ms-platform'),
            'item_type' => 'platform',
            'item_id' => $item_id,
            'item_fields' => $this->platformFieldsValues($request),
            'status' => $status
        ]);
    }

    public function delete(Request $request) {
        $item_id = $request->query('id');
        DB::table('platforms')->delete($item_id);
        $platforms = Platform::all();
        return view('ms.pages.platform', [
            'platforms' => $platforms,
            'delete_message' => 'Platform deleted.' 
        ]);
    }

    public function platformFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'platform', 'type' => 'text'));
        return $item_fields;
    }

    public function platformFieldsValues($item) {
        $item_values = [];
        array_push($item_values, (object) array('name' => 'platform', 'type' => 'text', 'value' => $item->platform));
        return $item_values;
    }
}
