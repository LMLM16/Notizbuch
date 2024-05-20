<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{


    public function show($id) {
        // Lade die Notiz zusammen mit den Beziehungen
        $note = Note::with(['user', 'images', 'tags'])->find($id);

        if ($note) {
            // Loggen der geladenen Notiz für Debugging-Zwecke
            \Log::info('Fetched note with relationships:', $note->toArray());
            return response()->json($note, 200);
        }

        // Fehlerbehandlung, falls die Notiz nicht gefunden wurde
        \Log::error('Note not found:', ['note_id' => $id]);
        return response()->json(['message' => 'Note not found'], 404);
    }


    public function index() : JsonResponse {
        // Retrieves all notes with user and images relations
        $notes = Note::with(['user', 'images', 'tags'])->get();
        return response()->json($notes, 200);
    }

    public function findByRating(int $rating) : JsonResponse {
        // Finds a note by minimum rating
        $note = Note::with(['user', 'images'])
            ->where('rating', '>=', $rating)
            ->first();
        return $note != null ? response()->json($note, 200) : response()->json(null, 200);
    }

    public function findBySearchTerm(string $searchTerm) : JsonResponse {
        // Searches notes by title, subtitle, or content
        $notes = Note::with(['user', 'images'])
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('subtitle', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        return response()->json($notes, 200);
    }

    public function favouriteNotes() : JsonResponse {
        // Retrieves all favourite notes based on a predefined scope
        $notes = Note::favourite()->with(['user', 'images'])->get();
        return response()->json($notes, 200);
    }

    public function save(Request $request)
    {
        // Parse the incoming request
        $request = $this->parseRequest($request);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new note with the provided data
            $note = Note::create($request->all());

            // Check if there are images and they are in an array format
            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    // Check or create new image
                    $image = Image::firstOrNew([
                        'url' => $img['url'],
                        'title' => $img['title']
                    ]);
                    // Save image associated with the note
                    $note->images()->save($image);
                }
            }

            // Commit the transaction
            DB::commit();
            // Return the created note with a 200 status
            return response()->json($note, 200);
        } catch (\Exception $e) {
            // Rollback the transaction in case of errors
            DB::rollBack();
            // Return error message with a 500 status
            return response()->json("Saving note failed: " . $e->getMessage(), 500);
        }
    }

    public function updateTags(Request $request, $noteId)
    {
        $tagIds = $request->input('tag_ids');  // angenommen, Tag-IDs kommen als Array
        $note = Note::findOrFail($noteId);
        $note->tags()->sync($tagIds);

        return redirect()->back()->with('success', 'Tags updated successfully!');
    }

    public function update(Request $request, int $noteId)
    {
        $note = Note::find($noteId);
        DB::beginTransaction();
        try {

            // Update note fields with the request data
            $note->update($request->all());


            DB::commit();
            return response()->json($note, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Updating note failed: " . $e->getMessage(), 500);
        }
    }

    public function delete(int $noteId) : JsonResponse {
        $note = Note::find($noteId);

        if ($note !== null) {
            // Überprüfe, ob der angemeldete Benutzer berechtigt ist, die Notiz zu löschen
            //if (!Gate::allows('delete-note', $note)) {
               // return response()->json([
                    //'message' => 'You are not allowed to delete this note'
                //], 403);
            //}

            // Versuche, die Notiz zu löschen
            if ($note->delete()) {
                return response()->json('Note successfully deleted', 200);
            } else {
                return response()->json('Note could not be deleted', 500);
            }
        } else {
            return response()->json('Note could not be deleted - it does not exist', 422);
        }
    }

    public function checkExists(int $noteId) {
        $note = Note::find($noteId);
        return $note != null ? response()->json(true, 200) : response()->json(false, 200);
    }

    private function parseRequest(Request $request) : Request {
        // Assuming 'updated_at' might need formatting if passed in the request
        if ($request->has('updated_at')) {
            $date = new \DateTime($request->updated_at);
            $request['updated_at'] = $date->format('Y-m-d H:i:s');
        }
        return $request;
    }




}
