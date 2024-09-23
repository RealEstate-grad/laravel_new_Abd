<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Agents_rates;
use App\Models\Cities;
use App\Models\Companies;
use App\Models\Estate;
use App\Models\Places;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class HomebageController extends Controller
{


    public function get_city_palaces($id)
    {
        $data = Cities::where('id', $id)->with('places')->with('estate')->get();
        return response()->json($data);
    }

    public function get_12_new_estate()
    {
        $data = Estate::take('12')->get();
        return response()->json($data);
    }

    public function get_12_new_company()
    {
        $data = Companies::take('12')->get();
        return response()->json($data);
    }
    public function get_12_new_ageant()
    {
        $agents = Agents::get();
        for ($i = 0; $i < count($agents); $i++) {
            $agents[$i]['user_qq'] = User::where("id", $agents[$i]->user_id)->first();
        }

        return response()->json($agents);
    }
}
