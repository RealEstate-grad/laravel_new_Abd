<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Estate;
use App\Models\Favorite_agents;
use App\Models\Favorite_estate;
use App\Models\Social_media;
use App\Models\User;
use Illuminate\Http\Request;

class AgeantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_user_with_ageant(Request $request)
    {
        $data = User::find(auth()->user())->all();
        return response()->json($data);
    }


    public function update_social_media(Request $request,$id)
    {
        $data = Social_media::find(auth()->user());
        $data->update([
            'facebook'=>$request->facebook??$data->facebook,
            'instagram'=>$request->instagram??$data->instagram,
        ]);
        return response()->json($data);
    }

    public function update_user_auth(Request $request, $id)
    {
        $data = User::find(auth()->user());
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

    public function edit_agent_auth(Request $request,$id)
    {
        $data = Agents::find(auth()->user());
        $data->update([
            'companies_id'=>$request->companies_id??$data->companies_id,
            'profile_image'=>$request->profile_image??$data->profile_image,
            'views '=>$request->views??$data->views,
            'shares'=>$request->shares??$data->shares,

        ]);
        return response()->json($data);
    }

    public function get_all_estate(Request $request)
    {
        $data = Estate::find(auth()->user())->all();
        return response()->json($data);
    }

    public function add_estate_auth(request $request)
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

        $data = Estate::find(auth()->user());
        $data->create($data);
        return response()->json($data);

    }
    public function edit_estate_auth(Request $request,$id)
    {
        $data = Estate::find(auth()->user());
        $data->update([
            'user_id'=>$request->user_id??$data->user_id,
            'name'=>$request->name??$data->name,
            'places_id '=>$request->places_id??$data->places_id,
            'phone'=>$request->phone??$data->phone,
            'country_code_phone'=>$request->country_code_phone??$data->country_code_phone,
            'space_of_estate'=>$request->space_of_estate??$data->space_of_estate,
            'price_of_meter'=>$request->price_of_meter??$data->price_of_meter,
            'rent_kind'=>$request->rent_kind??$data->rent_kind,
            'is_furnished_text'=>$request->is_furnished_text??$data->is_furnished_text,
            'floor'=>$request->floor??$data->floor,
            'num_of_bedrooms'=>$request->num_of_bedrooms??$data->num_of_bedrooms,
            'kind_text'=>$request->country_code_phone??$data->country_code_phone,
            'num_of_receptions'=>$request->num_of_receptions??$data->num_of_receptions,
            'num_of_bathrooms'=>$request->num_of_bathrooms??$data->num_of_bathrooms,
            'num_of_kitchens'=>$request->num_of_kitchens??$data->num_of_kitchens,
            'num_of_balconies'=>$request->num_of_balconies??$data->num_of_balconies,
            'num_of_livingrooms'=>$request->num_of_livingrooms??$data->num_of_livingrooms,
            'status'=>$request->status??$data->status,
            'type_text'=>$request->type_text??$data->type_text,
            'social_media_id'=>$request->social_media_id??$data->social_media_id,
            'description'=>$request->description??$data->description,
            'price'=>$request->price??$data->price,
            'real_number'=>$request->real_number??$data->real_number,
            'date_of_build'=>$request->date_of_build??$data->date_of_build,
            'state_of_build'=>$request->state_of_build??$data->state_of_build,
            'rent_description'=>$request->rent_description??$data->rent_description,


        ]);
        return response()->json($data);

    }
    public function delete_estate_auth(Request $request,$id)
    {
        $data = Estate::find(auth()->user());
        $data->delete();
        return response()->json('delete_estate');
    }
    public function add_favorite_estate (Request $request,$id)
    {
        $data['user_id'] = $request->user_id;
        $data['estate_id'] = $request->estate_id;
        $data = Favorite_estate::create($data);
        return response()->json($data);
    }
    public function delete_favorite_estate(Request $request,$id)
    {
        $data = Favorite_estate::find(auth()->user());
        $data->delete();
        return response()->json('delete_favorite_estate');
    }
    public function add_favorite_agents(Request $request,$id)
    {
        $data['user_id'] = $request->user_id;
        $data['agents_id'] = $request->agents_id;
        $data = Favorite_agents::create($data);
        return response()->json($data);
    }
    public function delete_favorite_agents(Request $request,$id)
    {
        $data = Favorite_agents::find(auth()->user());
        $data->delete();
        return response()->json('delete_favorite_agents');
    }
}
