<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use App\Models\Note;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ListController extends Controller {

    public function index(): JsonResponse {
        // alle listen zurück
        $lists = Liste::with(['user', 'notes' ])->get();
        return response()->json($lists, 200);
    }

//Ruft eine Notizliste nach ihrer ID ab.
    public function getById($id): JsonResponse {
        $list = Liste::with(['notes'])->find($id);
        return response()->json($list);
    }

    //Ruft alle Notizlisten für einen bestimmten Benutzer ab.
    public function getByUserId(Request $req): JsonResponse {
        $userId = $req->route('userId');
        $lists = Liste::with(['notes'])
            ->where('user_id', '=', $userId)
            ->get();
        return response()->json($lists);
    }

    //Erstellt eine neue Notizliste.
    public function create(Request $request): JsonResponse {
        //selbe wie Notiz
        // Parse the incoming request
        $request = $this->parseRequest($request);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new note with the provided data
            $liste = Liste::create($request->all());

        // Commit the transaction
        DB::commit();
        // Return the created note with a 200 status
        return response()->json($liste, 200);
    } catch
        (\Exception $e) {
    // Rollback the transaction in case of errors
            DB::rollBack();
    // Return error message with a 500 status
            return response()->json("Saving note failed: " . $e->getMessage(), 500);
        }
    }

    private function parseRequest(Request $request) : Request {
        // Assuming 'updated_at' might need formatting if passed in the request
        if ($request->has('updated_at')) {
            $date = new \DateTime($request->updated_at);
            $request['updated_at'] = $date->format('Y-m-d H:i:s');
        }
        return $request;
    }

    public function update(Request $req, int $id): JsonResponse {
        $list = Liste::find($id);

        if (!$list) {
            return response()->json(['message' => 'List not found'], 404); // Fehlerbehandlung, wenn keine Liste gefunden wird
        }

        DB::beginTransaction();
        try {
            $list->update($req->all()); // Aktualisieren der Liste




            DB::commit();
            return response()->json($list);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Updating list failed: ' . $e->getMessage()], 500);
        }
    }


    //löschen
    public function delete($id): JsonResponse {
        $list = Liste::find($id);

        if ($list !== null) {
            // Überprüfe, ob der angemeldete Benutzer berechtigt ist, die Liste zu löschen
            //if (!Gate::allows('own-list', $list)) {
            //return response()->json([
                   // 'message' => 'You are not allowed to delete this list'
               // ], 403);
            //}

            // Versuche, die Liste zu löschen
            if ($list->delete()) {
                return response()->json('List successfully deleted', 200);
            } else {
                return response()->json('List could not be deleted', 500);
            }
        } else {
            return response()->json('List could not be deleted - it does not exist', 422);
        }
    }
}
