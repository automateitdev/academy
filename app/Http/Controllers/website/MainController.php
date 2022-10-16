<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Speech;
use App\Models\About;
use App\Models\User;
use App\Models\Administration;
use App\Models\Basic;
use App\Models\Gallery;

class MainController extends Controller
{

    public function getPerson(Request $request)
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $person = $request->person;
        return view('person', compact('person', 'categories', 'subcategories'));
    }

    public function getGlance()
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $glanceData = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae autem voluptatibus, officiis harum sed quas omnis earum quia id ex, doloremque voluptate consequatur beatae cum repellat deleniti. Eos, illum voluptates.
        Debitis iusto aliquam exercitationem quas vero impedit velit eius illum nesciunt quae doloremque libero eveniet, fugiat commodi sapiente ut similique dolorum, eum labore neque nostrum aspernatur officia! Maxime, sequi quia.
        Aperiam saepe soluta laboriosam ullam impedit corrupti odio dolores aut asperiores eum et excepturi ut consequuntur veniam, cupiditate sapiente tempora ratione ipsum accusantium inventore quidem. Quo sit corrupti exercitationem reiciendis!
        Cupiditate eius eaque a, eligendi id dicta obcaecati quam facilis eos neque hic est, at dolor recusandae iusto? Incidunt tempore maxime reprehenderit placeat error voluptate ratione officiis odit quae corrupti?
        Placeat aliquid minus rem commodi, qui eum sed! Facere, eligendi ratione saepe neque velit repudiandae cumque illo commodi non, unde tempore blanditiis delectus placeat odit doloribus nesciunt architecto quis dolore.
        Iste culpa atque dolor blanditiis perferendis aliquid consequuntur harum nostrum quaerat repellendus, at libero suscipit sed! Reiciendis consectetur voluptates similique at totam animi. Qui perferendis ducimus vero eum esse doloremque?
        Rem doloremque, magnam debitis pariatur perspiciatis cumque voluptatibus autem velit consequatur quo rerum ab, aspernatur distinctio nam fugiat temporibus, maxime possimus et sit eum error placeat? Eveniet accusamus ducimus quia!
        Veritatis earum fugiat quam, voluptate quisquam omnis cum ex quae quas assumenda facilis perspiciatis laudantium dolore ea officiis voluptates numquam tenetur porro alias eligendi animi ipsum iusto. Aperiam, distinctio numquam!
        Quam fugiat minima ipsa officia, in rem odio? Voluptate sint magnam quis corrupti illum, doloremque quos reprehenderit ratione dolor possimus in debitis odit omnis non. Dolores recusandae sapiente natus? Voluptatem.
        Tenetur libero consectetur impedit, fuga id voluptate soluta, eos expedita corrupti excepturi doloribus, iusto distinctio unde. Excepturi consequuntur quae, perspiciatis, rem ipsam quos dicta ut deleniti quasi nobis sit vel.
        Dolores laboriosam cumque ipsa, quia ratione aliquid reprehenderit aperiam. Deserunt, veritatis sunt explicabo sint ab velit magni laudantium perferendis, doloribus excepturi accusantium quidem vel eos rem error voluptates iusto expedita!
        Quidem, aut perferendis veritatis provident cumque excepturi vitae eum culpa fugiat enim dolores earum cupiditate ratione soluta, harum mollitia distinctio iure ad quam ipsum blanditiis quis, deserunt est? Consequatur, vel.";
        return view('glance', compact('glanceData', 'categories', 'subcategories'));
    }

    public function getTeachers(Request $request)
    {
        $categories = DB::table('categories')->paginate(10);
        $subcategories = subcategory::all();
        if (!empty($request->department)) {
            $teacherList = "Here query for teacherList by department";
            return view('teachers', compact('teacherList', 'categories', 'subcategories'));
        } else {
            $teacherList = "Here query for all teacherList";
            return view('teachers', compact('teacherList', 'categories', 'subcategories'));
        }
    }

    public function getDepartments()
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $departments =  ["english", "bangla", "mathematics", "physics", "chemistry", 'biology', "english", "bangla", "mathematics", "physics", "chemistry", 'biology', "english", "bangla", "mathematics", "physics", "chemistry", 'biology', "english", "bangla", "mathematics", "physics", "chemistry", 'biology']; //"Here query for Departmentlist";
        return view('departments', compact('departments', 'categories', 'subcategories'));
    }

    public function getEachDepartment(Request $request)
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $department = "get data by department $request->name";
        return view('per_department', compact('department', 'categories', 'subcategories'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speeches = Speech::all();
        $sliders = Slider::all();
        $categories = category::all();
        $subcategories = subcategory::all();
        $users = User::all();
        $basics = Basic::all();
        $galleries = Gallery::all();
        return view('frontend', compact('categories', 'subcategories', 'sliders', 'speeches','users','basics','galleries'));
    }
    public function getSubCat(Request $request)
    {
        $data = subcategory::select('cat_id','subcat_name', 'subcat_link', 'id')->where('cat_id', $request->id)->take(100)->get();
        return response()->json($data);
    }

    public function allAbout(Request $request)
    {
        $abouts = About::where('subcat_id', $request->id)->take(100)->get();
        $categories = category::all();
        $subcategories = subcategory::all();
        $subcategories = subcategory::all();
        $users = User::all();
        $basics = Basic::all();
        return view('layouts.frontend.about.at_glance', compact('categories', 'subcategories', 'abouts','users','basics'));
    }
    public function administration(Request $request)
    {
        $administrations = Administration::where('subcat_id', $request->id)->take(100)->get();
        $categories = category::all();
        $subcategories = subcategory::all();
        $subcategories = subcategory::all();
        $users = User::all();
        $basics = Basic::all();
        // $administrations = Administration::all();
        return view('layouts.frontend.administration.forPerson', compact('categories', 'subcategories','users','administrations','basics'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
