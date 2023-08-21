<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::orderBy('orderNum', 'ASC')
            ->paginate(5);
        session(['slideshows_page' => $slideshows->currentPage()]);
        return view('admin.slideshow', compact('slideshows'));
    }
    public function getSlideshow(Request $request)
    {
        $slideshows = Slideshow::orderBy('orderNum', 'ASC')
            ->paginate(10);
        session(['slideshows_page' => $slideshows->currentPage()]);
        return response()->json(compact('slideshows'));
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
    public function deleteSlideshow($id)
    {
        $slideshow = Slideshow::find($id);
        if ($slideshow != null) {
            $slideshow->delete();
            if ($slideshow->img) {
                unlink("image/slideshow/" . $slideshow->img);
                unlink("image/slideshow/thumbnail/" . $slideshow->img);
            }
            $page = session('slideshows_page');
            return redirect()->route('slideshow', ['page' => $page])->with('success', "Slideshow has been deleted!");
        } else {
            return redirect()->back()->with("error", "Slideshow not found!");
        }
    }
    public function insertProduct()
    {
        return view('admin.insertProduct');
    }

    function showFomSlideshow()
    {
        return view('admin.addslideshow');
    }

    public function addSlideshow(Request $request)
    {
        $slideshow = new Slideshow();
        $validator = Validator::make($request->all(), [
            'txttitle' => 'required',
            'txtsubTitle' => 'required',
            'txttext' => 'required',
            'txtlink' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed mime types and max size
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        // Image handling
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $slidehsowImage = $request->file('img');
            $slidehsowImageName = time() . '_' . $slidehsowImage->getClientOriginalName();
            $slidehsowImagePath = public_path("image/slideshow");
            // Thumbnail
            $thumbnailImage = Image::make($slidehsowImage);
            $thumbnailImage->resize(50, 50);
            $thumbnailPath = $slidehsowImagePath . "/thumbnail/" . $slidehsowImageName;
            $thumbnailImage->save($thumbnailPath);
            // Move Image
            $slidehsowImage->move($slidehsowImagePath, $slidehsowImageName);
            $slideshow->img = $slidehsowImageName;
        } else {
            $slideshow->img = null;
            return redirect()->back()->with('error', 'Please upload a valid image file.');
        }

        // Create new Slideshow instance
        $slideshow->title = $request->txttitle;
        $slideshow->subtitle = $request->txtsubTitle;
        $slideshow->text = $request->txttext;
        $slideshow->link = $request->txtlink;
        $slideshow->active = $request->has('chkenable') ? 1 : 0;
        $slideshow->orderNum = Slideshow::max('orderNum') + 1;
        $slideshow->save();

        return redirect()->route('slideshow')->with('success', 'Slideshow has been added!.');
    }
    public function editSlideshow(Request $request)
    {
        $slideshow = Slideshow::find($request->ssid);
        $validator = Validator::make($request->all(), [
            'editTitle' => 'required',
            'editsubtitle' => 'required',
            'editText' => 'required',
            'editLink' => 'required',
            'editImg' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed mime types and max size
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        if ($request->hasFile('editImg') && $request->file('editImg')->isValid()) {
            $slidehsowImage = $request->file('editImg');
            $slidehsowImageName = time() . '_' . $slidehsowImage->getClientOriginalName();
            $slidehsowImagePath = public_path("image/slideshow");
            // Thumbnail
            $thumbnailImage = Image::make($slidehsowImage);
            $thumbnailImage->resize(50, 50);
            $thumbnailPath = $slidehsowImagePath . "/thumbnail/" . $slidehsowImageName;
            $thumbnailImage->save($thumbnailPath);
            // Move Image
            $slidehsowImage->move($slidehsowImagePath, $slidehsowImageName);
            
            // Remove old Image
            $oldImage = $slideshow->img;
            if ($oldImage) {
                $path = public_path("image/slideshow");
                unlink($path . '/' . $oldImage);
                $thumbnaiPath = public_path("image/slideshow/thumbnail");
                unlink($thumbnaiPath . '/' . $oldImage);
            }
            $slideshow->img = $slidehsowImageName;
        }
        $slideshow->title = $request->editTitle;
        $slideshow->subtitle = $request->editsubtitle;
        $slideshow->text = $request->editText;
        $slideshow->link = $request->editLink;
        $slideshow->active = $request->has('chkEditactive') ? 1 : 0;
        $slideshow->save();
        return redirect()->route('slideshow')->with('success', 'Slideshow has been Updated!.');
    }
}
