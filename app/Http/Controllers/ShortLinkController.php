<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;
  
class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
   
        return view('index', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);
   
        $input['link'] = $request->input('link');
        $input['code'] = $request->input('code');
   
        ShortLink::create($input);
  
        return to_route('home')->withSuccess('Kısa Link Başarıyla Oluşturuldu.');
    }

    public function shortenLink($code)
    {
        $link = ShortLink::where('code', $code)->latest()->first()->value('link');
        
        $code = Str::afterLast($link, '/');
   
        return view('link', compact('code'));
    }
}