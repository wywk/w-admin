<?php
Route::middleware('myAuth')->prefix('admin/tool')->group(function (){
    Route::get('/queue','ToolController@queue');
});

