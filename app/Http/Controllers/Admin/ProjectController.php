<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller 
{
    /**
     * INDEX
     */
    public function index()
    {
        $projects = Project::all();
        return view("admin.projects.index", ["projects"=>$projects]);
    }

    /**
     * CREATE
     */
    public function create()
    {   $project = Project::all();
        $types = Type::all();
        return view("admin.projects.create", ["types" => $types, "project" => $project]);
    }

    /**
     * STORE
     */
    public function store(Request $request){   

        $data = $request->validate([
            "name"=>"required|string",
            //<1mb
            "image"=>"required|image|mimes:jpeg,png,jpg|max:5120",
            "type_id" => "exists:types,id",
            "url"=>"required|string",
            "description"=>"required|string",
            "publication_time"=>"required|date",
        ]);
        
        $data["slug"] = $this->generateSlug($data["name"]);
        $data["image"] = Storage::put("projects", $data["image"]);
        //Se il problema è qui, che sia create o singolarmente scritte le seguenti righe, non funziona.
        //$newProject = new Project();
        //$newProject->fill($data);
        //$newProject->save();
        //Con questa stringa, creo tutte e tre le sovrastranti in una
        $newProject = Project::create($data);
        return redirect()->route('admin.projects.index');
    }

    /**
     * SHOW
     */
    public function show($slug) {
        $project = Project::where("slug", $slug)->first();  
        return view("admin.projects.show", ["project"=>$project]);
    }

    /**
     * EDIT
     */
    public function edit($slug)
    {
        $project = Project::where("slug", $slug)->first();
        $types = Type::all();
        return view('admin.projects.edit', ["project"=> $project, "types" => $types]);
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $slug)
    {   $project = Project::where("slug", $slug)->first();

        $data = $request->validate([
            "name"=>"required|string",
            //<1mb
            "image"=>"required|image|mimes:jpeg,png,jpg|max:5120",
            "type_id" => "exists:types,id",
            "url"=>"required|string",
            "description"=>"required|string",
            "publication_time"=>"required|date",
        ]);
        
        $data["slug"] = $this->generateSlug($data["name"]);
        $data["image"] = Storage::put("projects", $data["image"]);

        $project->update($data);
        return redirect()->route('admin.projects.index');
    }


    /**
     * TRASH
     */
    public function trash() {
        $Projects = Project::onlyTrashed()->get();
        return view("admin.projects.trash", ["Projects" => $Projects]);
    }

    /**
     * DESTROY
     */
    public function destroy(Request $request, $slug){
        if ($request->input("force")) {
            $Projects = Project::onlyTrashed()->where("slug", $slug)->first();
             //Force delete (permanente)
            $Projects->forceDelete();
        }else {
            $Projects = Project::where("slug", $slug)->first(); 
             //Soft delete (non permanente -> trash)
            $Projects->delete();
        }
        return redirect()->route('admin.projects.index');
    }
    

    //Gentilmente rubato a Florian 💖
    protected function generateSlug($name) {
        // contatore da usare per avere un numero incrementale
        $counter = 0;

        do {
            // creo uno slug e se il counter è maggiore di 0, concateno il counter
            $slug = Str::slug($name) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // finché esiste già un elemento con questo slug, ripeto il ciclo per creare uno slug nuovo

        return $slug;
    }
}
