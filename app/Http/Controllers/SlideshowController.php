<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::orderBy('orderNum', 'ASC')
            ->paginate(5);
        session(['slideshows_page' => $slideshows->currentPage()]);
        return view('admin.slideshow', compact('slideshows'));
    }
    public function toggleSlideshow(String $id, String $action)
    {
        $slideshow = Slideshow::where('ssid', $id)->first();
        $slideshow->active = ($action == '1' ? 0 : 1);
        $slideshow->save();
        $page = session('slideshows_page');
        return redirect()->route('slideshow', ['page' => $page]);
    }
    public function reorderSlideshow(string $id, string $action)
    {
        $slideshow = Slideshow::find($id);

        if ($action == "1") {
            $upperSlideshow = Slideshow::where('orderNum', '<', $slideshow->orderNum)
                ->orderBy('orderNum', 'DESC')
                ->first();

            if ($upperSlideshow) {
                $this->swapOrderNumbers($slideshow, $upperSlideshow);
            }
        } elseif ($action == "0") {
            $lowerSlideshow = Slideshow::where('orderNum', '>', $slideshow->orderNum)
                ->orderBy('orderNum', 'ASC')
                ->first();

            if ($lowerSlideshow) {
                $this->swapOrderNumbers($slideshow, $lowerSlideshow);
            }
        }

        $page = session('slideshows_page');
        return redirect()->route('slideshow', ['page' => $page]);
    }

    private function swapOrderNumbers(Slideshow $slideshow1, Slideshow $slideshow2)
    {
        [$slideshow1->orderNum, $slideshow2->orderNum] = [$slideshow2->orderNum, $slideshow1->orderNum];
        $slideshow1->save();
        $slideshow2->save();
    }
    public function deleteSlideshow($id)  {
        $slideshow = Slideshow::find($id);
        if($slideshow != null){
            $slideshow->delete();
            $page = session('slideshows_page');
            return redirect()->route('slideshow', ['page' => $page])->with('success', "Slideshow has been deleted!");
        }else{
            return redirect()->back()->with("error", "Slideshow not found!");
        }
        
    }
    public function insertProduct(){
        return view('admin.insertProduct');
    }
}
