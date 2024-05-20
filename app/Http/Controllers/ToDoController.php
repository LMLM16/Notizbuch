<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToDoController extends Controller {

    // Ruft alle Todos ab
    public function index(): JsonResponse {
        // Lädt alle Todos mit den zugehörigen Tags
        $todos = Todo::with(['tags'])->get();
        return response()->json($todos, 200);
    }


     //Ruft ein spezifisches TD nach ID ab

    public function show($id): JsonResponse {
        // Findet das Todo nach ID mit den zugehörigen Tags
        $todo = Todo::with(['tags'])->find($id);
        if ($todo) {
            return response()->json($todo, 200);
        } else {
            return response()->json("Todo not found", 404);
        }
    }

    //NEU - noch nicht im FE getesttt
    public function create(Request $req): JsonResponse {

        DB::beginTransaction();
        try {
            $todo = Todo::create($req->all());

            if (isset($req['tags']) && is_array($req['tags'])) {
                foreach ($req['tags'] as $tagId) {
                    $tag = Tag::find($tagId);
                    if ($tag) {
                        $todo->tags()->attach($tag);
                    }
                }
            }

            //COMMIT
            DB::commit();
            return response()->json($todo, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json("Creating todo failed: " . $e->getMessage(), 500);
        }
    }


     //Aktualisiert ein bestehendes Todo.

    public function update(Request $req, $id): JsonResponse {
        DB::beginTransaction();
        try {
            $todo = Todo::find($id);

            if ($todo) {
                $todo->update($req->all());

                $todo->tags()->detach();
                if (isset($req['tags']) && is_array($req['tags'])) {
                    foreach ($req['tags'] as $tagId) {
                        $tag = Tag::find($tagId);
                        if ($tag) {
                            $todo->tags()->attach($tag);
                        }
                    }
                }

                DB::commit();
                return response()->json($todo, 200);
            } else {
                DB::rollBack();
                return response()->json("Todo not found", 404);
            }
        } catch (Exception $e) {
            // Rollback der Transaktion im Fehlerfall
            DB::rollBack();
            return response()->json("Updating todo failed: " . $e->getMessage(), 500);
        }
    }

    //löschen
    public function delete($id): JsonResponse {
        DB::beginTransaction();
        try {
            $todo = Todo::find($id);

            if ($todo) {
                $todo->delete();

                DB::commit();
                return response()->json(true, 200);
            } else {
                DB::rollBack();
                return response()->json("Todo not found", 404);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json("Deleting todo failed: " . $e->getMessage(), 500);
        }
    }
}
