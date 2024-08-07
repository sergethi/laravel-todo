<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\listItem;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem as BlockListItem;

class TodoListController extends Controller
{
    public function getItems(){
        return view('welcome', ['listItems' => listItem::where('is_complete', 0)->get()]);
    }

    public function saveItem(Request $request){
        //Log::info(json_encode($request->all()));
        $newItem = new listItem;
        $newItem->name = $request->listItem;
        $newItem->is_complete = 0;
        $newItem->save();
        return redirect('/');
    }

    public function markItemCompleted($id){
        Log::info($id);
        $item = listItem::find($id);
        $item->is_complete = 1;
        $item->save();
        return redirect('/');
    }

}
