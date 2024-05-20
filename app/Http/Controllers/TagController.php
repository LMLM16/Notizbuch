<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use App\Models\Todo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller {


    public function getAllTags(): JsonResponse {
        try {
            $tags = Tag::all();
            return response()->json($tags, 200);
        } catch (Exception $e) {
            return response()->json("Fetching tags failed: " . $e->getMessage(), 500);
        }
    }



    public function getNotesByTag(int $tagId): JsonResponse {
            $tag = Tag::with('notes')->find($tagId);

            if ($tag) {
                return response()->json($tag->notes, 200);
            } else {
                return response()->json('Tag not found', 404);
            }
    }

    // Holt alle Tags einer bestimmten Note.
    public function showNoteTags($id): JsonResponse {
        try {
            $note = Note::findOrFail($id);
            $tags = $note->tags;

            return response()->json([ 'tags' => $tags], 200);
        } catch (Exception $e) {
            return response()->json("Fetching note tags failed: " . $e->getMessage(), 500);
        }
    }

    // Holt alle Tags eines bestimmten Todos.
    public function showTodoTags($id): JsonResponse {
        try {
            $todo = Todo::findOrFail($id);
            $tags = $todo->tags;

            return response()->json(['entity' => $todo, 'tags' => $tags], 200);
        } catch (Exception $e) {
            return response()->json("Fetching todo tags failed: " . $e->getMessage(), 500);
        }
    }

//Erstellt einen neuen Tag.
    public function create(Request $req): JsonResponse {
        // Beginnt eine Datenbank-Transaktion
        DB::beginTransaction();
        try {
            // Erstellt den Tag mit den übrgeb. Daten
            $tag = $req->all();
            $tag['user_id'] = auth()->user()->id;
            $tag = Tag::create($tag);
            //commit
            DB::commit();
            return response()->json($tag);
        } catch (Exception $e) {
            // Rollback der Transaktion im Fehlerfall
            DB::rollBack();
            return response()->json("Creating tag failed: " . $e->getMessage(), 500);
        }
    }

//Aktualisiert einen bestehenden Tag.
    public function update(Request $req): JsonResponse {
        // Beginnt eine Datenbank-Transaktion
        DB::beginTransaction();
        try {
            // Findet den Tag nach ID
            $id = $req->route('id');
            $tag = Tag::find($id);

            if ($tag) {
                // Aktualisiert den Tag mit den neuen Daten
                $tag->update($req->all());

                // Commit der Transaktion
                DB::commit();
                return response()->json($tag);
            } else {
                // Rollback der Transaktion, wenn der Tag nicht gefunden wurde
                DB::rollBack();
                return response()->json("Tag not found", 404);
            }
        } catch (Exception $e) {
            // Rollback der Transaktion im Fehlerfall
            DB::rollBack();
            return response()->json("Updating tag failed: " . $e->getMessage(), 500);
        }
    }

    //löschen
    public function delete($id): JsonResponse {
        DB::beginTransaction();
        try {
            $tag = Tag::find($id);

            if ($tag) {
                // Löscht den Tag
                $tag->delete();

                // Commit der Transaktion
                DB::commit();
                return response()->json(true);
            } else {
                // Rollback der Transaktion, wenn der Tag nicht gefunden wurde
                DB::rollBack();
                return response()->json("Tag not found", 404);
            }
        } catch (Exception $e) {
            // Rollback der Transaktion im Fehlerfall
            DB::rollBack();
            return response()->json("Deleting tag failed: " . $e->getMessage(), 500);
        }
    }
}
