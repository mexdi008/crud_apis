<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;
class ApiController extends Controller
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
    

    public function addPost(Request $request)
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

    public function getAllPost()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/administrative_staff');
        return response()->json($response->json());
    }

    public function getPostByUniqId(Request $request)
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

    public function getPostFindOne(Request $request)
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

    public function updatePost(Request $request,$uniq_id)
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

    public function deletePost($id)
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

    public function brandsGetAllPost()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/brands');
        return response()->json($response->json());
    }

    public function brandsGetPostByUniqId(Request $request)
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

    public function brandsGetPostFindOne(Request $request)
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

    public function brandsUpdatePost(Request $request,$uniq_id)
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

    public function brandsDeletePost($id)
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

    #region hero_slider


    public function heroSliderAddPost(Request $request)
    {

        $post = Http::withHeaders(['xc-auth' => env('XC_AUTH')])->post('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider',
        [
            "uniq_id" => $this->gen_uid(),
            "f_index_id" => $request->input('f_index_id'),
            "priority" => $request->input('priority'),
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "file" => $request->input('file'),
            "button" => $request->input('button'),
            "media_path" => $request->input('media_path'),
            "status" => $request->input('status'),
        ]);
        return  response($post->json());
    }

    public function heroSliderGetAllPost()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider');
        return response()->json($response->json());
    }

    public function heroSliderGetPostByUniqId(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data[0]['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/".$id);
            return response()->json($response->json());
    }

    public function heroSliderGetPostFindOne(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/findOne?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/".$id);
            return response()->json($response->json());
    }

    public function heroSliderUpdatePost(Request $request,$uniq_id)
    {
            $get_data=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/?where=(uniq_id,like,".$uniq_id.")");
            $id=$get_data[0]['id'];
            
            $post=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->put('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/'.$id,
            [
                "f_index_id" => $request->input('f_index_id'),
                "priority" => $request->input('priority'),
                "title" => $request->input('title'),
                "description" => $request->input('description'),
                "file" => $request->input('file'),
                "button" => $request->input('button'),
                "media_path" => $request->input('media_path'),
                "status" => $request->input('status'),
            ]);
            return response()->json($post->json());
    }

    public function heroSliderDeletePost($id)
    {
        $get_data=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/?where=(uniq_id,like,".$id.")");
            $id=($get_data[0]['id']);
        $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->delete("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/hero_slider/".$id);
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

    #region subscriptions

    public function subscriptionsAddPost(Request $request)
    {

        $data= $request->validate(['email' => 'required|email',
                                   'source' => 'required']);
        $post = Http::withHeaders(['xc-auth' => env('XC_AUTH')])->post('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions',
        [
            "uniq_id" => $this->gen_uid(),
            "email" => $request->input('email'),
            "source" => $request->input('source'),
        ]);
        return  response($post->json());
    }

    public function subscriptionsGetAllPost()
    {
        $response=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])->get('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions');
        return response()->json($response->json());
    }

    public function subscriptionsGetPostByUniqId(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data[0]['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/".$id);
            return response()->json($response->json());
    }

    public function subscriptionsGetPostFindOne(Request $request)
    {
        $uniq_id = $request->input('uniq_id');
        $get_data=Http::withHeaders(
            [
                'xc-auth' => env('XC_AUTH'),
                'Content-Type' => 'application/json'
            ]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/findOne?where=(uniq_id,like,".$uniq_id.")");
            $id=($get_data['id']);
            $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/".$id);
            return response()->json($response->json());
    }

    public function subscriptionsUpdatePost(Request $request,$uniq_id)
    {
        $data= $request->validate(['email' => 'required|email',
                                   'source' => 'required']);
            $get_data=Http::withHeaders([
            'xc-auth' => env('XC_AUTH'),
            'Content-Type' => 'application/json'
            ])
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/?where=(uniq_id,like,".$uniq_id.")");
            $id=$get_data[0]['id'];
            
            $post=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->put('http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/'.$id,
            [
                "email" => $request->input('email'),
                "source" => $request->input('source'),
            ]);
            return response()->json($post->json());
    }

     public function subscriptionsDeletePost($id)
    {
        $get_data=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )
            ->get("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/?where=(uniq_id,like,".$id.")");
            $id=($get_data[0]['id']);
        $response=Http::withHeaders(
            ['xc-auth' => env('XC_AUTH')]
            )->delete("http://172.16.10.132:3574/nc/aga_project_tyds/api/v1/subscriptions/".$id);
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