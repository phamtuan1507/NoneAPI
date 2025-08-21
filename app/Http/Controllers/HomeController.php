<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage');
    }
    public function about()
    {
        return view('about');
    }
    public function services()
    {
        return view('services');
    }
    public function team()
    {
        return view('team');
    }
    public function appointment()
    {
        return view('appointment');
    }
    // public function products()
    // {
    //     return view('products');
    // }
    public function contact()
    {
        return view('contact');
    }
    public function cart()
    {
        return view('cart', ['cart' => session('cart', [])]);
    }
}
