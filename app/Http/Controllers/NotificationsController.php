<?php



namespace App\Http\Controllers;

use App\User;
use App\Notification;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\NotificationRepository;

class NotificationsController extends Controller
{

    protected $notifications;

    public function __construct(NotificationRepository $notifications)
    {
        $this->middleware('auth');

        $this->notifications = $notifications;
    }

    public function index(Request $request)
    {
        $notifications = $this->notifications->forUser($request->user());
        $warnings = 0;
        $unread = 0;
        foreach($notifications as $notification){
            if($notification->state == 'Unread'){
                $unread++;
                if($notification->type == 'Warning'){
                    $warnings++;
                }
            }
        }

        return view('notifications.index', [
            'notifications' => $notifications,
            'warnings' => $warnings,
            'unread' => $unread,
        ]);
    }

    public function add(User $user){

        return view('notifications.add', [
           'user' => $user,
        ]);
    }

    public function notify(Request $request, User $user){

        $id = $user->id;
        Notification::create([
            'user_id' => $request->input('user_id', $id),
            'name' => $request['not-name'],
            'description' => $request['not-desc'],
            'type' => $request['not-type'],
        ]);
        return redirect('/users');
    }

    public function see(Notification $notification){

        if($notification->state == 'Unread') {
            $notification->state = 'Read';
            $notification->save();
        }
        return view('notifications.see', [
            'notification' => $notification,
        ]);
    }

    public function readAll(Request $request){

        #$notifications = $this->notifications->forUser($request->user());
        #foreach($notifications as $notification){
         #   $notification->state = 'Read';
          #  $notification->save();
        #}

        return redirect('/notifications');
    }
}
