<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Utils\Helpers;

class MaterialController extends Controller
{
    public function addMaterial(Request $request)
    {
        $helper = new Helpers();
        $material = new Material();
        $params = $request->all();
        $material->material_code = $helper->splitNameCode($request->material_name) . random_int(100, 999);
        $material->material_name = $params['material_name'];
        $material->material_unit = $params['material_unit'];
        $material->material_price = $params['material_price'];
        $material->shop_id = $params['shop_id'];
        $material->save();
        return $this->response(200, ['material' => $material], 'Add finish');
    }

    public function getMaterial()
    {
        $material = Material::all();
        return $this->response(200, ['materials' => $material]);
    }
    
    public function updateMaterial(Request $request){
        $helper = new Helpers();
        $material = Material::find($request->material_id);
        $params = $request->all();
        $material->material_code = $helper->splitNameCode($request->material_name) . random_int(100, 999);
        $material->material_name = $params['material_name'];
        $material->material_unit = $params['material_unit'];
        $material->material_price = $params['material_price'];
        $material->shop_id = $params['shop_id'];
        $material->save();
        return $this->response(200, ['material'=>$material], 'Update successfully');
    }
    
    public function deleteMaterial(Request $request){
        Material::destroy($request->material_id);
        return $this->response(200, [], 'Delete successfullys');
    }
}
