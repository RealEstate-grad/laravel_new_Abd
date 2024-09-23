<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Companies;
use App\Models\Estate;
use App\Models\Favorite_agents;
use App\Models\Favorite_estate;
use App\Models\Social_media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{

    public function update_user_token(Request $request)
    {
        $data = User::find(auth()->user()->id);
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


    public function update_company_token(Request $request)
    {
        $data = User::find(auth()->user()->id);
        $data->update([
            'user_id' => $request->user_id ?? $data->user_id,
            'places_id' => $request->places_id ?? $data->places_id,
            'comapany_name' => $request->datapany_name ?? $data->datapany_name,
            'website' => $request->website ?? $data->website,
            'emploies_num' => $request->emploies_num ?? $data->emploies_num,
            'description' => $request->description ?? $data->description,
            'work_days' => $request->work_days ?? $data->work_days,
            'profile_images' => $request->profile_images ?? $data->profile_images,
            'banner_image' => $request->banner_image ?? $data->banner_image,

        ]);

        return response()->json($data);
    }


    public function get_user_with_company(Request $request)
    {
        $data = User::with('user_qq')->find(auth()->user())->all();
        $social = Social_media::where('id', $data[0]->social_media_id)->get();
        $data[0]['Social_media'] = $social[0];
        return response()->json($data);
    }


    public function show_estate(string $id)
    {
        $data = Estate::where('id', $id)->first();
        return response()->json($data);
    }
    public function edit_estate(Request $request, $id)
    {
        $data = Estate::where('id', $id)->first();
        $data->update([
            'user_id' => $request->user_id ?? $data->user_id,
            'name' => $request->name ?? $data->name,
            'places_id ' => $request->places_id ?? $data->places_id,
            'phone' => $request->phone ?? $data->phone,
            'country_code_phone' => $request->country_code_phone ?? $data->country_code_phone,
            'space_of_estate' => $request->space_of_estate ?? $data->space_of_estate,
            'price_of_meter' => $request->price_of_meter ?? $data->price_of_meter,
            'rent_kind' => $request->rent_kind ?? $data->rent_kind,
            'is_furnished_text' => $request->is_furnished_text ?? $data->is_furnished_text,
            'floor' => $request->floor ?? $data->floor,
            'num_of_bedrooms' => $request->num_of_bedrooms ?? $data->num_of_bedrooms,
            'kind_text' => $request->country_code_phone ?? $data->country_code_phone,
            'num_of_receptions' => $request->num_of_receptions ?? $data->num_of_receptions,
            'num_of_bathrooms' => $request->num_of_bathrooms ?? $data->num_of_bathrooms,
            'num_of_kitchens' => $request->num_of_kitchens ?? $data->num_of_kitchens,
            'num_of_balconies' => $request->num_of_balconies ?? $data->num_of_balconies,
            'num_of_livingrooms' => $request->num_of_livingrooms ?? $data->num_of_livingrooms,
            'status' => $request->status ?? $data->status,
            'type_text' => $request->type_text ?? $data->type_text,
            'social_media_id' => $request->social_media_id ?? $data->social_media_id,
            'description' => $request->description ?? $data->description,
            'price' => $request->price ?? $data->price,
            'real_number' => $request->real_number ?? $data->real_number,
            'date_of_build' => $request->date_of_build ?? $data->date_of_build,
            'state_of_build' => $request->state_of_build ?? $data->state_of_build,
            'rent_description' => $request->rent_description ?? $data->rent_description,


        ]);
        return response()->json($data);
    }
    public function delete_estate(Request $request, $id)
    {
        $data = Estate::find($id);
        $data->delete();
        return response()->json('delete_estate');
    }
    public function get_all_estate(Request $request)
    {
        $data = Estate::find(auth()->user())->all();
        return response()->json($data);
    }

    public function add_agents(request $request)
    {
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $user->id)->first();

        $data['username']    = $request->username;
        $data['fname']    = $request->fname;
        $data['lname']    = $request->lname;
        $data['type']    = $request->type;
        $data['email']    = $request->email;
        $data['password']    = Hash::make($request->password);
        $data['phone']    = $request->phone;
        $data['countre_code_phone']    = $request->countre_code_phone;
        $data['gender']    = $request->gender;

        $soic['facebook']    = $request->facebook;
        $soic['instagram']    = $request->instagram;
        $soi = Social_media::create($soic);

        $data['social_media_id']    = $soi->id;

        $new_user = User::create($data);
        $agent_data['user_id'] = $new_user->id;
        $agent_data['companies_id'] = $company->id;
        $agent = Agents::create($agent_data);

        if ($request->hasFile('profile_images')) {
            $image = $request->file('profile_images');
            $imageName = $agent->id . '.' . $image->getClientOriginalExtension();
            $data['profile_images']                 = 'agents/profile_images/' . $imageName;
            $image->move(public_path('agents/profile_images/'), $imageName);
            $agent->update([
                'profile_image' => $data['profile_images'],
            ]);
        }

        return response()->json($data);
    }

    public function add_estate(request $request)
    {
        $data['user_id'] = $request->user_id;
        $data['name'] = $request->name;
        $data['places_id'] = $request->places_id;
        $data['phone'] = $request->phone;
        $data['country_code_phone'] = $request->country_code_phone;
        $data['space_of_estate'] = $request->space_of_estate;
        $data['price_of_meter'] = $request->price_of_meter;
        $data['rent_kind'] = $request->rent_kind;
        $data['is_furnished_text'] = $request->is_furnished_text;
        $data['floor'] = $request->floor;
        $data['num_of_bedrooms'] = $request->num_of_bedrooms;
        $data['kind_text'] = $request->kind_text;
        $data['num_of_receptions'] = $request->num_of_receptions;
        $data['num_of_bathrooms'] = $request->num_of_bathrooms;
        $data['num_of_livingrooms'] = $request->num_of_livingrooms;
        $data['num_of_kitchens'] = $request->num_of_kitchens;
        $data['num_of_balconies'] = $request->num_of_balconies;
        $data['type_text'] = $request->type_text;
        $data['social_media_id'] = $request->social_media_id;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['real_number'] = $request->real_number;
        $data['date_of_build'] = $request->date_of_build;
        $data['state_of_build'] = $request->state_of_build;
        $data['rent_description'] = $request->rent_description;

        $data = Estate::create($data);
        return response()->json($data);
    }
    public function delete_agent(Request $request, $id)
    {
        $data = Agents::find($id);
        $data->delete();
        return response()->json('delete_agent');
    }
    public function get_agents(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $user->id)->first();

        $data = Agents::where('companies_id', $company->id)->get();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['user_qq'] = User::where("id", $data[$i]->user_id)->first();
        }

        return response()->json($data);
    }
    public function get_one_agent($id)
    {

        $data = Agents::where('id', $id)->get();
        return response()->json($data);
    }
    public function edit_agent(Request $request, $id)
    {
        $data = Agents::where('id', $id)->first();
        $data->update([
            'companies_id' => $request->companies_id ?? $data->companies_id,
            'profile_image' => $request->profile_image ?? $data->profile_image,
            'views ' => $request->views ?? $data->views,
            'shares' => $request->shares ?? $data->shares,

        ]);
    }
    public function add_favorite_estate(Request $request, $id)
    {
        $data['user_id'] = $request->user_id;
        $data['estate_id'] = $request->estate_id;
        $data = Favorite_estate::create($data);
        return response()->json($data);
    }
    public function show_favorite_estate(Request $request)
    {
        $data = Favorite_estate::find(auth()->user())->all();
        return response()->json($data);
    }
    public function add_favorite_agents(Request $request, $id)
    {
        $data['user_id'] = $request->user_id;
        $data['agents_id'] = $request->agents_id;
        $data = Favorite_agents::create($data);
        return response()->json($data);
    }
    public function show_favorite_agents(Request $request)
    {
        $data = Favorite_agents::find(auth()->user())->all();
        return response()->json($data);
    }
    public function delete_favorite_estate(Request $request, $id)
    {
        $data = Favorite_estate::find(auth()->user());
        $data->delete();
        return response()->json('delete_favorite_estate');
    }
    public function delete_favorite_agents(Request $request, $id)
    {
        $data = Favorite_agents::find(auth()->user());
        $data->delete();
        return response()->json('delete_favorite_agents');
    }
}
