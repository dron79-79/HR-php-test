<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\MainPageRepository;

class MainPageController extends Controller
{
    protected $mainPageRepository;
    
    public function __construct(){
	
        $this->mainPageRepository = new MainPageRepository();
    }
    
    public function index() {
	
        $weather = $this->mainPageRepository->getWeatherInCity(571476);
        
	return view('mainpage')->with('weather', $weather);
    }
}

