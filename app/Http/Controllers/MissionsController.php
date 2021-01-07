<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'reward' => '',
            'type' => 'required',
            'volume' => '',
            'platform_id' => 'required'
        ]);

        $status = true;
        
        try {
            $mission = new Mission;
            $mission->title = $request->title;
            $mission->reward = $request->reward;
            $mission->type = $request->type;
            $mission->volume = $request->volume;
            $mission->platform_id = $request->platform_id;
            $mission->save();
        } catch (Exception $e) {
            $status = false;
        }
        
        return view('ms.api.add', [
            'back' => route('ms-mission'),
            'item_type' => 'mission',
            'item_fields' => $this->missionFields([]),
            'status' => $status
        ]);
    }

    public function update(Request $request) {
        $item_id = $request->query('id');
        $request->validate([
            'title' => 'required',
            'reward' => '',
            'type' => 'required',
            'volume' => '',
            'platform_id' => 'required'
        ]);

        $status = true;
        
        try {
            DB::table('missions')->where('id', $item_id)->update([
                'title' => $request->title,
                'reward' => $request->reward,
                'type' => $request->type,
                'volume' => $request->volume,
                'platform_id' => $request->platform_id
            ]);
        } catch (Exception $e) {
            $status = false;
        }
        
        return view('ms.api.edit', [
            'back' => route('ms-mission'),
            'item_type' => 'mission',
            'item_id' => $item_id,
            'item_fields' => $this->missionFieldsValues($request),
            'status' => $status
        ]);
    }

    public function delete(Request $request) {
        $item_id = $request->query('id');
        DB::table('missions')->delete($item_id);
        $missions = Mission::all();
        return view('ms.pages.mission', [
            'missions' => $missions,
            'delete_message' => 'Mission deleted.'
        ]);
    }

    public function missionFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'reward', 'type' => 'number'));
        array_push($item_fields, (object) array('name' => 'type', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'volume', 'type' => 'number'));
        array_push($item_fields, (object) array('name' => 'platform_id', 'type' => 'number'));
        return $item_fields;
    }

    public function missionFieldsValues($item) {
        $item_values = [];
        array_push($item_values, (object) array('name' => 'title', 'type' => 'text', 'value' => $item->title));
        array_push($item_values, (object) array('name' => 'reward', 'type' => 'number', 'value' => $item->reward));
        array_push($item_values, (object) array('name' => 'type', 'type' => 'text', 'value' => $item->type));
        array_push($item_values, (object) array('name' => 'volume', 'type' => 'number', 'value' => $item->volume));
        array_push($item_values, (object) array('name' => 'platform_id', 'type' => 'number', 'value' => $item->platform_id));
        return $item_values;
    }
}
