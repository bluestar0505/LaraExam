<?php

namespace App\Http\Controllers;

use App\Category;
use App\Paper;
use App\User;
use DB;
use Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryCtrl extends Controller
{

    public function index(Request $request)
    {
        return redirect(route('catalogue.index'));
        $uri = $request->path();

        $DefaultTab = Auth::user()->DefaultTab;

        if ($uri == 'home') {


            if ($DefaultTab == 'sf-engineering' || $DefaultTab == 'jf-mathematics') {

                if ($DefaultTab == 'jf-engineering') {
                    return redirect('/home');
                } elseif ($DefaultTab == 'sf-engineering') {
                    return redirect('/SFEngineering');
                } elseif ($DefaultTab == 'jf-mathematics') {
                    return redirect('/JFMathematics');
                } else {
                    //return redirect('/home') ;
                }
            }
        }


        User::updateActivity();

        $categories = Category::allCategories();

        return view('web.categoryList', compact('categories'));

    }

    public function categoriesQA(Request $request)
    {
        User::updateActivity();
        $categories = Category::allCategoriesSF();
        return view('web.categoryListQA', compact('categories'));
    }


    public function categoriesMA(Request $request)
    {
        User::updateActivity();

        $categories = Category::MACategories();

        return view('web.MACategories', compact('categories'));

    }


    public function show($category_id)
    {
        $category = Category::getCategory($category_id);

        if (!$category) return redirect()->back();

        $papers = null;
        $categories = null;
        if ($category->parent_id != 0) {
            $categories = Category::getCategory($category_id);
        }


        // if no child categories found - display papers
        if (!$categories) {
            $papers = Paper::inCategory($category_id);
            return view('web.papersList', compact('papers', 'category'));
        }

        // if child categories exist - display categories
        return view('web.categoryList', compact('categories'));
    }


    public function showQA($category_id)
    {
        $category = Category::getCategory($category_id);

        if (!$category) return redirect()->back();

        $papers = null;
        $categories = null;
        if ($category->parent_id != 0) {
            $categories = Category::getCategory($category_id);
        }


        // if no child categories found - display papers
        if (!$categories) {
            $papers = Paper::inCategory($category_id);
            return view('web.papersListQA', compact('papers', 'category'));
        }

        // if child categories exist - display categories
        return view('web.categoryListQA', compact('categories'));
    }


    public function DefaultTab(Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        DB::table('users')
            ->where('id', Auth::id())
            ->update(['DefaultTab' => $data['default_tab']]);

        echo "string";

    }


    public function suggestion(Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        DB::table('suggestion')->insert([
            ['Sugesstion' => $data['suggestion'], 'UserID' => Auth::id(), 'UserName' => Auth::user()->name]
        ]);


        echo "string";

    }


    public function paperError(Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        DB::table('suggestion')->insert([
            ['Sugesstion' => Auth::user()->name . ' reported ' . $data['suggestion'],
            'UserID' => Auth::id(),
            'UserName' => Auth::user()->name]
        ]);

        // send notification to all admin users
        $users = User::admin()->get();

        $notificationId = DB::table('notify')->insertGetId(
            array('notify_text' => 'Paper Error: ' . $data['suggestion'])
        );

        foreach($users as $user){
            DB::table('notification_users')->insert([
                [
                    'notification_id' => $notificationId,
                    'UserID' => $user->id,
                    'IsSeen' => 0
                ]
            ]);
        }

        echo "string";

    }


    public function deletesuggestion(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        DB::table('suggestion')->where('ID', '=', $data['id'])->delete();
        echo "string";
    }

    public function deletenotification(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        DB::table('notify')->where('ID', '=', $data['id'])->delete();
        echo "string";
    }


    public function addnotify(Request $request)
    {


        $data = $request->all(); // This will get all the request data.


        $id = DB::table('notify')->insertGetId(

            array('notify_text' => $data['notify_text'])

        );

        if(isset($data['to']) && is_array($data['to']) && !in_array('all', $data['to'])){
            $users = [];
            $allUsers = [];

            foreach ($data['to'] as $category){

                $papers = Category::find($category)->papers()->get();

                foreach($papers as $paper){
                    $paperUsers = $paper->users()->get()->toArray();

                    $allUsers = array_merge($allUsers, $paperUsers);
                }

            }

            // we filter out all the duplicates if the case
            foreach($allUsers as $user){
                if(!in_array($user['id'], $users))
                    $users[] = $user['id'];
            }

        } else {
            $users = DB::table('users')->select('id')->get();
        }


        foreach ($users as $user) {

            if(is_object($user))
                $userId = $user->id;
            else
                $userId = $user;

            DB::table('notification_users')->insert([
                ['notification_id' => $id, 'UserID' => $userId, 'IsSeen' => 0]
            ]);
        }

        echo $id;

    }


    public function getnotifications()
    {
        return Auth::user()->notificat()->orderBy('DateCreated', 'DESC')->get();
    }


    public function unseennotifications()
    {
        return Auth::user()
            ->notificat()
            ->withPivot('IsSeen')
            ->wherePivot('IsSeen', '=', 0)
            ->count();
    }


    public function Updateunseennotifications(Request $request)
    {

        DB::table('notification_users')
            ->where('UserID', Auth::id())
            ->update(['isSeen' => 1]);

        echo "string";
    }
}
