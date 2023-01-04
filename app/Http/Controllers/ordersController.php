<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;

class ordersController extends Controller
{
 // by this function we get all data from table
 public function index()
 {
    $posts = order::orderBy('order','ASC')->get();
    $Projects = order::orderBy('order','ASC')->get()->unique('Project');
    return view('Order')->with([
        'posts' => $posts,
        'Projects' => $Projects,
    ]);
 }

// by this function we can find tasks by project in table
 public function findByProject(Request $request, $name)
 {
    $posts = order::orderBy('order','ASC')->where('Project', $name)->get();
    $Projects = order::orderBy('order','ASC')->get()->unique('Project');
    return view('Order')->with([
        'posts' => $posts,
        'Projects' => $Projects,
    ]);
 }

 // by this function we can create new data in table
 public function store(Request $request) 
 { 
    $data = $request->validate([
        'title' => 'required',
        'Project' => 'required'
    ]);
    order::create($data);
    return back();
 }

//  by this function we can delete data in table
public function destroy($id) 
{
    $user = order::where('id', $id)->delete();
    return back();
}

// Update a record in the table
public function updateTask(Request $request, $id)
{
    $posts = order::where('id', $id)->get();
    return view('updateTask', compact('posts'));
}

// this function will update tasks and project name in table
public function updateData(Request $request, $id)
{
    order::where("id", $id)
    ->update([
        'Project' => $request->Project_update,
        'title' => $request->title_update
    ]);    
    return redirect('/');
}

// this function update all data and orders accordin put or pull to frontend
 public function update(Request $request)
 {
     $posts = order::all();
     foreach ($posts as $post) {
         foreach ($request->order as $order) {
             if ($order['id'] == $post->id) {
                 $post->update(['order' => $order['position']]);
             }
         }
     }
     return response('Update Successfully.', 200);
 }

//  this function will delete all data in table
 public function deleteAll()
 {
    order::truncate();
    return back();
 }


}