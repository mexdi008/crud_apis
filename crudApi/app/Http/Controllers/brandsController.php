<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;

class brandsController extends Controller
{
    function gen_uid($l=6){ return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l);}

    function slugOlustur($string) 
    {
        $string = str_replace('ü','u',$string);
        $string = str_replace('Ü','U',$string);
 
        $string = str_replace('ğ','g',$string);
        $string = str_replace('Ğ','G',$string);
 
        $string = str_replace('ş','s',$string);
        $string = str_replace('Ş','S',$string);
 
        $string = str_replace('ç','c',$string);
        $string = str_replace('Ç','C',$string);
 
        $string = str_replace('ö','o',$string);
        $string = str_replace('Ö','O',$string);
 
        $string = str_replace('ı','i',$string);
        $string = str_replace('İ','I',$string);
 
        $string = str_replace('ə','e',$string);
        $string = str_replace('Ə','e',$string);
 
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
 
        return $slug;
    }
    #region Brands
    public function brandsAddPost(Request $request)
    {
        $slug = $this->slugOlustur($request->input('name'));
        $post = Http::withHeaders(['xc-auth' => env('XC_AUTH')])->post('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands',
        [
            "uniq_id" => $this->gen_uid(),
            "category_id" => $request->input('category_id'),
            "images" => $request->input('images'),
            "trusted_partners" => $request->input('trusted_partners'),
            "location" => $request->input('location'),
            "chronology" => $request->input('chronology'),
            "data" => $request->input('data'),
            "description" => $request->input('description'),
            "visionary_component" => $request->input('visionary_component'),
            "name"=> $request->input('name'),
            "informative_component"=> $request->input('informative_component'),
            "global_partnership"=> $request->input('global_partnership'),
            "slug" => $slug
        ]);
        return  response($post->json());
    }

    public function brandsGetAll()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands');
        return response()->json($response->json());
    }

    public function brandsGetByUniqId(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data[0]['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/".$id);
            return response()->json($response->json());
    }

    public function brandsGetFindOne(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/findOne?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/".$id);
            return response()->json($response->json());
    }

    public function brandsUpdate(Request $request,$uniq_id)
    {
            $get_data=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/?where=(uniq_id,like,".$uniq_id.")");
            $id=$get_data[0]['id'];
            
            $post=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->put('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/'.$id,
            [
                "category_id" => $request->input('category_id'),
                "images" => $request->input('images'),
                "trusted_partners" => $request->input('trusted_partners'),
                "location" => $request->input('location'),
                "chronology" => $request->input('chronology'),
                "data" => $request->input('data'),
                "description" => $request->input('description'),
                "visionary_component" => $request->input('visionary_component'),
                "name"=> $request->input('name'),
                "informative_component"=> $request->input('informative_component'),
                "global_partnership"=> $request->input('global_partnership'),
                "slug" => $this->slugOlustur($request->input('name')),
            ]);
            return response()->json($post->json());
    }

    public function brandsDelete($id)
    {
        $get_data=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/?where=(uniq_id,like,".$id.")");
            $id=($get_data[0]['id']);
        $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->delete("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands/".$id);
            if($response == true)
            {
                 return response()->json([
                    'state' => 'true',
                ]);
            }
            else
            {
                return response()->json([
                    'state' => 'false',
                ]);
            }
    }
    #endregion
}
