<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;

class administrativeStaffController extends Controller
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

    #region AdministrativeStaff
    public function administrativeStaffAddPost(Request $request)
    {
        $slug = $this->slugOlustur($request->input('job_title'));
        $post = Http::withHeaders(['xc-auth' => env('XC_AUTH')])->post('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff',
        [
            "uniq_id" => $this->gen_uid(),
            "job_title" => $request->input('job_title'),
            "fullname" => $request->input('fullname'),
            "biography" => $request->input('biography'),
            "social_media" => $request->input('social_media'),
            "activity" => $request->input('activity'),
            "images" => $request->input('images'),
            "main_image" => $request->input('main_image'),
            "slug" => $slug
        ]);
        return  response($post->json());
    }

    public function administrativeStaffGetAll()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff');
        return response()->json($response->json());
    }

    public function administrativeStaffGetByUniqId(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data[0]['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/".$id);
            return response()->json($response->json());
    }

    public function administrativeStaffGetFindOne(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/findOne?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/".$id);
            return response()->json($response->json());
    }

    public function administrativeStaffUpdate(Request $request,$uniq_id)
    {
            $get_data=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/?where=(uniq_id,like,".$uniq_id.")");
            $id=$get_data[0]['id'];
            
            $post=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->put('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/'.$id,
            [
                "job_title" => $request->input('job_title'),
                "fullname" => $request->input('fullname'),
                "biography" => $request->input('biography'),
                "social_media" => $request->input('social_media'),
                "activity" => $request->input('activity'),
                "images" => $request->input('images'),
                "main_image" => $request->input('main_image'),
                "slug" => $this->slugOlustur($request->input('job_title')),
            ]);
            return response()->json($post->json());
    }

    public function administrativeStaffDelete($id)
    {
        $get_data=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/?where=(uniq_id,like,".$id.")");
            $id=($get_data[0]['id']);
        $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->delete("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff/".$id);
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
