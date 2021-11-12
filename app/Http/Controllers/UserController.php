<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
//        $items = $user->products;
        $items = Item::where('user_id', $user->id)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();

//        foreach ($items as $item){
//            $t=strtotime($item->srok)-time();
//            echo $t;
//            if ($t==60){
////                $code = rand(1234, 9998);
//                $mess = 'Уведомляем Вас о том, что завтра истекает срок действия вашего объявления. Вы можете продлить срок у себя в Личном Кабинете';
//                $array = array(
//                    'login'    => 'louerkz',
//                    'psw' => 'bd331759',
//                    'phones'=>$tel,
//                    'mes'=>$mess
//                );
//
//                $ch = curl_init('https://smsc.ru/sys/send.php');
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                curl_setopt($ch, CURLOPT_HEADER, false);
//                $html = curl_exec($ch);
//                curl_close($ch);
//            }else{
//                echo 'ups';
//            }
//        }

        //1 вариант
//        $archives = DB::table('items')
//            ->where('user_id', $user->id)
//            ->where('srok', '>', date('Y-m-d H:i:s'))
//            ->get();

        //2 вариант
        $itemsArchives = Item::where('user_id', $user->id)
            ->where('srok', '<', date('Y-m-d H:i:s'))
            ->get();
        return view('profile_page', compact('user', 'categories', 'brands', 'items', 'itemsArchives'));
    }


    public function profilePage2(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::where('user_id', $user->id)
            ->where('srok', '>', date('Y-m-d H:i:s'))
            ->get();
        $itemsArchives = Item::where('user_id', $user->id)
            ->where('srok', '<', date('Y-m-d H:i:s'))
            ->get();
        return view('profile_page2', compact('user', 'categories', 'brands', 'items', 'itemsArchives'));
    }

    public function settingPage(){
        $user = Auth::user();
        $categories = Category::all();
        $brands = Brand::all();
        $items = Item::all();
        $password = Hash::make($user->password);
        return view('setting_page', compact('user', 'categories', 'brands', 'items', 'password'));
    }

    public function settingSavePage(Request $request){
//        $email = $request->get('email');
//        $phone_number = $request->get('phone_number');
//        $user1 = User::where('id', $request->id)->first();
//        $request->validate([
//            'phone_number'=>'unique:users,phone_number,'.$user->id
//        ]);
        User::where('id', $request->id)->update($request->except('id', '_method', '_token', 'password'));
        $user = Auth::user();

        return view('setting_page', compact('user'));
    }

    public function changePassword(Request $request){
        // validate Form
        $validator = Validator::make($request->all(),[
            'old_password'=>[
                'required', function($attribute, $value, $fail){
                    if (!Hash::check($value, Auth::user()->getAuthPassword())){
                        return $fail(__('Действующий пароль неправильный'));
                    }
                },
                'min:5',
                'max:10'
            ],
            'new_password'=>'required|min:5|max:10',
            'cnew_password'=>'required|same:new_password'
        ], [
            'old_password.required'=>'Введите Ваш действующий пароль',
            'old_password.min'=>'Действующий пароль должен состоять не менее чем из 5 символов',
            'old_password.max'=>'Действующий пароль не должен содержать более 10 символов',
            'new_password.required'=>'Введите новый пароль',
            'new_password.min'=>'Новый пароль должен состоять не менее чем из 5 символов',
            'new_password.max'=>'Новый пароль не должен содержать более 10 символов',
            'cnew_password.required'=>'Повторно введите новый пароль',
            'cnew_password.same'=>'Введенный пароль должен совпадать с новым паролем',
        ]);

        if (!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $update = User::find(Auth::user()->id)->update(['password'=>Hash::make($request->new_password)]);
            if (!$update){
                return response()->json(['status'=>0, 'msg'=>'Что-то пошло не так, не удалось обновить пароль в базе данных']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Ваш пароль был успешно изменен']);
            }
        }
    }
}
