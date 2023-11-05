<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CopyBot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Notifications\BotNotification;
use Illuminate\Support\Facades\Notification;

class CopyBotController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();
        $news = CopyBot::query()->latest()->get();
        return view('admin.bots', compact('admin', 'news'));
    }

    public function edit(CopyBot $bot)
    {
        $edit = true;
        $users = User::query()->orderBy('first_name', 'asc')->get();

        return view('admin.bot-form', compact('edit', 'bot', 'users'));
    }

    public function create()
    {
        $edit = false;
        $users = User::query()->orderBy('first_name', 'asc')->get();

        return view('admin.bot-form', compact('edit', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required',
            'creator' => 'required|string',
            'yield' => 'required|string',
            'rate' => 'required|string',
            'aum' => 'required',
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
            if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/bots', $name);
        } else $pic = null;

        $chatBot = CopyBot::query()->create(
        [   
            'name' => $request['name'],
            'price' => $request['price'], 
            'creator' => $request['creator'], 
            'yield' => $request['yield'], 
            'rate' => $request['rate'], 
            'aum' => $request['aum'], 
            'image' => $pic,
        ]);

        if ($chatBot)
            return redirect()->route('admin.bot')->with('success', 'Bot added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function update(Request $request, $id)
    {
        $copyBot = CopyBot::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required',
            'creator' => 'required|string',
            'yield' => 'required|string',
            'rate' => 'required|string',
            'aum' => 'required',
        ]);
        if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

        if ($image = $request->file('image')) {
            $validator = Validator::make($request->all(), ['image' => 'mimes:jpg,png,jpeg|max:2048']);
            if ($validator->fails()) return back()->withInput()->with('error', $validator->getMessageBag());

            $name = time().$image->getClientOriginalName();
            $pic = $image->move('img/bots', $name);
        } else $pic = $copyBot['image'];

        if ($copyBot->update(
            [
                'name' => $request['name'],
                'price' => $request['price'], 
                'creator' => $request['creator'], 
                'yield' => $request['yield'], 
                'rate' => $request['rate'], 
                'aum' => $request['aum'], 
                'image' => $pic,
            ]))
            return redirect()->route('admin.bot')->with('success', 'Bot Updated successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }

    public function destroy($id)
    {
        $copyBot = CopyBot::findOrFail($id);
        if ($copyBot->delete())
            return back()->with('success', 'Bot deleted successfully');
        return back()->with('error', 'An error occurred, try again');
    }

    public function assign_bot(Request $request)
    {
        $user = User::find(auth()->id());
        $bot = $request['copy_bot'];

        $getBot = CopyBot::find($bot);

        $data = [
            'user' => $user,
            'link' => $request['copy_bot'],
        ];

        $mail = [
            'name' => $user->name,
            'subject' => 'Added a Bot',
            'body' => 'New Copy Bot added to portfolio '.$getBot->name
        ];
        // $data = CopyBot::find($bot);

        if ($user->update(['copy_bot' => $request['copy_bot']]))
            // Notification::send($user, new BotNotification($data));
            // MailController::sendBotNotification($user, $mail);
            return redirect()->route('user.index')->with('success', 'Bot added successfully');
        return back()->with('error', 'An error occurred, try again.')->withInput();
    }
}
