<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\Slider;
use App\Models\Category;    



class WebsiteController extends Controller
{
    //
    public function home()
    {
        $sliders = Slider::where('is_active', true)->latest()->get();
        return view('website.home', compact('sliders'));
    }
    public function aboutUs()
    {
        return view('website.aboutus');
    }

    public function testimonial()
    {
        return view('website.testimonial');
    }

    public function faqs()
    {
        return view('website.faq');
    }

    public function appointment()
    {
        $doctors = Doctor::all();
        $services = Service::all();
        // make locations array for select dropdown
        $locations = array();
         
        $locations['1'] = 'GK 1';
        $locations['2'] = 'New Ashok Nagar';
        $locations['3'] = 'DASANA';
        return view('website.appointment', compact('doctors', 'services', 'locations'));
         
    }

    public function serviceP()
    {
        return view('website.services');
    }

    public function staff()
    {
        return view('website.staff');
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function privacy()
    {
        return view('website.privacy');
    }

    public function term()
    {
        return view('website.term');
    }

    public function drpnbehl()
    {
        return view('website.drpnbehl');
    }

    public function facilities()
    {
        return view('website.facilities');
    }

    public function skinDiseasesTreatments()
    {
        return view('website.skindiseasestreatments');
    }

    public function treatmentsServices()
    {
        return view('website.treatmentsservices');
    }

    public function aimsObjectives()
    {
        return view('website.aimsobjectives');
    }

    public function mission()
    {
        return view('website.mission');
    }

    public function vision()
    {
        return view('website.vision');
    }

    public function blog()
    {
        $posts = BlogPost::where('status', 'draft')->latest()->paginate(9);
        //return view('website.blog');
        return view('website.blog', compact('posts'));
    }
    public function blogShow($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('status', 'draft')->firstOrFail();
        return view('website.blog.show', compact('post'));
    }
    public function slider() {
        $sliders = Slider::where('is_active', true)->latest()->get();
        return view('website.include.banner', compact('sliders'));
    }
}
