<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
  public function index(Request $request)
  {
    $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function add() {
    return view('admin.profile.create');
  }
  
  public function create(Request $request) {
    $this->validate($request, Profile::$rules);
    $profile = new Profile;
    $form = $request->all();
    unset($form['_token']);
    $profile->user_id = Auth::id();
    $profile->fill($form)->save(); 
    
     // データベースに保存する
    $profile->fill($form);
    $profile->save();
    
    return redirect('admin/profile/create');
  }
  
  public function edit() {
    $user = User::find(Auth::id());
    return view('admin.profile.edit', ['user' => $user]);
  }
  
  public function update(Request $request) {
    return redirect('admin/profile/edit');
  }
}

?>
 