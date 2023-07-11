<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


use App\Models\Topic;

class TopicController extends Controller
{
    //


    public function store(Request $request,$id) : RedirectResponse  {
   

$request->merge(["classroom_id"=>$id]);
    
    Topic::create($request->all()); 

    
    return  redirect()->back();
    
    
    
    
    
    
    }


public function show (){
    $topics=Topic::all();

    return view("topics.show",["topics"=>$topics]);
}
public function edit ($id){
  
$topic=Topic::find($id);

    return view("topics.edit",["topic"=>$topic]);
}
public function update (Request $request,$id): RedirectResponse {
  
$topic=Topic::find($id);
$topic->update($request->all());

   return redirect()->back();
}
public function destroy ($id) : RedirectResponse {
  
Topic::destroy($id);

return  redirect()->back();
}


}
