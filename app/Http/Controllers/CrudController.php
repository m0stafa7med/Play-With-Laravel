<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use offerTrait;
    public function create ()
    {
        return view('offers.create');
    }
    public function store(OfferRequest $request)
    {
        $file_name=$this->saveImage($request,'images/offers');
     

        

        Offer::create([
          'photo'=>$file_name,
          'name_ar'=>$request->name_ar,
          'name_en'=>$request->name_en,
          'price'=>$request->price,
          'details_ar'=>$request->details_ar,
          'details_en'=>$request->details_en,
        ]);
       
        return redirect()->back()->with(['success'=>'تم الاضافة بنجاح ']);


    }

    public function delete($offer_id)
    {
        //check if offer id exists

        $offer = Offer::find($offer_id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return redirect()->route('offers.all',$offer_id)->with(['success' => __('messages.offer deleted successfully')]);


    }
    public function getAllOffers()
    {
        $offers= Offer::select('id','price','photo',
        'name_'.LaravelLocalization::getcurrentLocale().' as name',
        'details_'.LaravelLocalization::getcurrentLocale().' as details'
        
        )->get();
        return view ('offers.all',compact('offers'));
    }
    public function editOffer($offer_id)
    {
        // Offer::findOrFail($offer_id);
        //return $offer_id;
        $offer=Offer::find($offer_id);
        if(!$offer)
        {
            return redirect()->back();
        }
        $offer= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->find($offer_id);
    return view ('offers.edit',compact('offer'));
    
    
    
    }
    
    public function updateOffer(OfferRequest $request,$offer_id)
    {
        $offer=Offer::find($offer_id);
        if(!$offer)
        {
            return redirect()->back();
        }
        $offer->update($request->all());
        return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

    


    }
    public function getVideo()
    {
        $video=Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }

}
