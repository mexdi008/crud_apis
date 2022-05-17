<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;

class sectorsController extends Controller
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
   #region sectors
    public function sectorsAddPost(Request $request)
    {
        $data= $request->validate(['title' => 'required']);
        $post = Http::withHeaders(['xc-auth' => env('XC_AUTH')])->post('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors',
        [
            "uniq_id" => $this->gen_uid(),
            "title" => $request->input('title'),
        ]);
        return  response($post->json());
    }

    public function sectorsGetAll()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors');
        return response()->json($response->json());
    }

    public function sectorsGetByUniqId(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data[0]['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/".$id);
            return response()->json($response->json());
    }

    public function sectorsGetFindOne(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/findOne?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/".$id);
            return response()->json($response->json());
    }

    public function sectorsUpdate(Request $request,$uniq_id)
    {
            $data= $request->validate(['title' => 'required']);
            $get_data=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/?where=(uniq_id,like,".$uniq_id.")");
            $id=$get_data[0]['id'];
            
            $post=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->put('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/'.$id,
            [
                "title" => $request->input('title'),
            ]);
            return response()->json($post->json());
    }

    public function sectorsDelete($id)
    {
        $get_data=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/?where=(uniq_id,like,".$id.")");
            $id=($get_data[0]['id']);
        $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->delete("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/sectors/".$id);
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
