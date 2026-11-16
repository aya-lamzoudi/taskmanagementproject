<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user=auth()->user();
        $totalPendingTasks= Task::query()
        ->where('status','pending')
        ->count();

         $myPendingTasks= Task::query()
        ->where('status','pending')
        ->where('assigned_user_id',$user->id)
        ->count();

        
        $user=auth()->user();
        $totalProgressTasks= Task::query()
        ->where('status','in_progress')
        ->count();

         $myProgressTasks= Task::query()
        ->where('status','in_progress')
        ->where('assigned_user_id',$user->id)
        ->count();

        
        $user=auth()->user();
        $totalCompletedTasks= Task::query()
        ->where('status','completed')
        ->count();

         $myCompletedTasks= Task::query()
        ->where('status','completed')
        ->where('assigned_user_id',$user->id)
        ->count();

        $activeTasks = Task::query()->whereIn('status',['pending','in-progress'])
                                     ->where('assigned_user_id',$user->id)
                                    ->limit(10)
                                    ->get();
        $activeTasks = TaskResource::collection($activeTasks);


    return inertia('Dashboard', compact('totalPendingTasks', 'myPendingTasks',
                                        'myProgressTasks','totalProgressTasks',
                                        'myCompletedTasks','totalCompletedTasks',
                                         'activeTasks'
                                    ));
    }
}
