<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Cities;
use App\Models\Companies;
use App\Models\Estate;
use App\Models\Places;
use App\Models\Social_media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdmenController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->only('username', 'password');

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user['status'] == 'pending') {
                return response()->json(['msg' => 'Your account is still under review']);
            } else {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user,
                ]);
            }
        } else {
            return response()->json(['msg' => 'Invalid username or password']);
        }
    }

    public function register_User(Request $request)
    {
        $data['username']    = $request->username;
        $data['fname']    = $request->fname;
        $data['lname']    = $request->lname;
        // $data['status']    = $request->status;
        $data['type']    = $request->type;
        if ($data['type'] == 'company') {
            $data['status']    = 'pending';
        }
        $data['email']    = $request->email;
        $data['password']    = Hash::make($request->password);
        $data['phone']    = $request->phone;
        $data['countre_code_phone']    = $request->countre_code_phone;
        $data['gender']    = $request->gender;

        $soic['facebook']    = $request->facebook;
        $soic['instagram']    = $request->instagram;
        $soi = Social_media::create($soic);

        $data['social_media_id']    = $soi->id;

        $da = User::create($data);
        if ($request->type == 'company') {
            $com['user_id']                        = $da->id;
            $com['places_id']                      = $request->places_id;
            $com['company_name']                   = $request->company_name;
            $com['website']                        = $request->website;
            $com['emploies_num']                   = $request->emploies_num;
            $com['description']                    = $request->description;
            $com['work_days']                      = $request->work_days;

            if ($request->hasFile('profile_images')) {
                $image = $request->file('profile_images');
                $imageName = $da->id . '.' . $image->getClientOriginalExtension();
                $com['profile_images']                 = 'profile_images/' . $imageName;
                $image->move(public_path('profile_images'), $imageName);
            }
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = $da->id . '.' . $image->getClientOriginalExtension();
                $com['banner_image']                   = 'banner_image/' . $imageName;

                $image->move(public_path('banner_image'), $imageName);
            }
            $comba = Companies::create($com);
            return response()->json([$data, $com]);
        }
        return response()->json($data);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function number_estate_user_company_agent_city()
    {
        $estate = Estate::count();
        $user = User::count();
        $company = Companies::count();
        $agent = Agents::count();
        $city = Cities::count();
        return response()->json([$estate, $user, $company, $agent, $city]);
    }
    public function get_all_user()
    {
        $data = User::where('type', "user")->get();
        return response()->json($data);
    }
    public function freez(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        if ($data['status'] == 'active')
            $data->update([
                'status' => 'pending'
            ]);
        return response()->json('freez done');
    }
    public function get_all_company()
    {


        $data = User::where('status', 'active')->where('type', 'company')->with('user_qq')->get();


        return response()->json($data);
    }
    public function get_all_company_pending()
    {

        $data = User::where('status', 'pending')->where('type', 'company')->with('user_qq')->get();
        return response()->json($data);
    }

    public function remove_freez(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        if ($data['status'] == 'pending')
            $data->update([
                'status' => 'active'
            ]);
        return response()->json('remove freez done');
    }


    public function get_all_cities()
    {

        $data = Cities::all();
        return response()->json($data);
    }


    public function add_city(Request $request)
    {
        $data['name'] = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $data['name'] . '.' . $image->getClientOriginalExtension();
            $data['image']                 = 'citys_images/' . $imageName;
            $image->move(public_path('citys_images'), $imageName);
        }
        $user = Cities::create($data);
        return response()->json($data);
    }
    public function update_city(Request $request, $id)
    {
        $data = Cities::where('id', $id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension() ?? $data->name . '.' . $image->getClientOriginalExtension();
            $data['image']                 = 'citys_images/' . $imageName;
            $image->move(public_path('citys_images'), $imageName);
        }
        $data->update([
            'name' => $request->name ?? $data->name,
            'image' => $data->image,

        ]);
        return response()->json($data);
    }

    public function delete_city($id)
    {
        $data = Cities::find($id);
        $data->delete();
        return response()->json('delete_city');
    }

    public function add_places(Request $request)
    {
        $data['cities_id'] = $request->cities_id;
        $data['name'] = $request->name;
        $user = Places::create($data);
        return response()->json($data);
    }
    public function get_all_places($id)
    {

        $data = Places::where('cities_id', $id)->get();
        return response()->json($data);
    }

    public function update_places(Request $request, $id)
    {
        $data = Places::where('id', $id)->first();
        $data->update([
            'cities_id' => $request->cities_id ?? $data->cities_id,
            'name' => $request->name ?? $data->name,

        ]);
        return response()->json($data);
    }
    public function delete_places($id)
    {
        $data = Places::find($id);
        $data->delete();
        return response()->json('delete_places');
    }
    public function show_one_places($id)
    {
        $data = Places::where('id', $id)->first();
        return response()->json($data);
    }
    public function show_one_city($id)
    {
        $data = Cities::where('id', $id)->first();
        return response()->json($data);
    }
    public function show_one_company($id)
    {
        $data = Companies::with('user')->where('id', $id)->first();
        return response()->json($data);
    }



    public function update_user(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
        $data->update([
            'username' => $request->username ?? $data->username,
            'fname' => $request->fname ?? $data->fname,
            'lname' => $request->lname ?? $data->lname,
            'status' => $request->status ?? $data->status,
            'type' => $request->type ?? $data->type,
            'email' => $request->email ?? $data->email,
            'password' => $request->password ?? $data->password,
            'phone' => $request->phone ?? $data->phone,
            'countre_code_phone' => $request->countre_code_phone ?? $data->countre_code_phone,
            'gender' => $request->gender ?? $data->gender,
            'social_media_id' => $request->social_media_id ?? $data->social_media_id,
        ]);
        return response()->json($data);
    }
    public function show_one_user($id)
    {
        $data = Companies::where('id', $id)->first();
        return response()->json($data);
    }
    public function update_company(Request $request, $id)
    {

        $com = Companies::where('id', $id)->find($id);
        $com->update([
            'user_id' => $request->user_id ?? $com->user_id,
            'places_id' => $request->places_id ?? $com->places_id,
            'company_name' => $request->company_name ?? $com->company_name,
            'website' => $request->website ?? $com->website,
            'emploies_num' => $request->emploies_num ?? $com->emploies_num,
            'description' => $request->description ?? $com->description,
            'work_days' => $request->work_days ?? $com->work_days,
            'profile_images' => $request->profile_images ?? $com->profile_images,
            'banner_image' => $request->banner_image ?? $com->banner_image,
        ]);

        return response()->json($com);
    }
    public function update_company_aaa(Request $request, $id)
    {



        $com = Companies::where('id', $id)->find($id);
        $com->update([
            'user_id' => $request->user_id ?? $com->user_id,
            'places_id' => $request->places_id ?? $com->places_id,
            'company_name' => $request->company_name ?? $com->company_name,
            'website' => $request->website ?? $com->website,
            'emploies_num' => $request->emploies_num ?? $com->emploies_num,
            'description' => $request->description ?? $com->description,
            'work_days' => $request->work_days ?? $com->work_days,
            'profile_images' => $request->profile_images ?? $com->profile_images,
            'banner_image' => $request->banner_image ?? $com->banner_image,
        ]);

        return response()->json($com);
    }
}
