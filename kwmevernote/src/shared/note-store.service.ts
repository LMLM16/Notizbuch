import { Injectable } from '@angular/core';
import { HttpClient} from '@angular/common/http';
import {catchError, Observable, retry, throwError} from "rxjs";
import { Note } from "./note";
import { User } from "./user";
import { Image } from "./image";
import { Tag } from "./tag";


@Injectable({
providedIn: 'root'
})

export class NoteStoreService {

private api= "http://kwm-evernote.s2110456019.student.kwmhgb.at/api";

constructor(private http:HttpClient) {

}

getOneNote(id: number): Observable<Note> {
    return this.http.get<Note>(`${this.api}/notes/${id}`);
  }

  getAllNotes(): Observable<Note[]> {
    return this.http.get<Note[]>(`${this.api}/notes`);
  }

  createNote(note: Partial<Note>): Observable<any> {
    return this.http.post(`${this.api}/notes`, note)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  updateNote(note: Note): Observable<any> {
    return this.http.put(`${this.api}/notes/${note.id}`, note)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

  private errorHandler(error: any): Observable<never> {
    console.error('Error occurred:', error.message);
    if (error.error instanceof ErrorEvent) {
      console.error('Client-side error:', error.error.message);
    } else {
      console.error(`Backend returned code ${error.status}, body was: ${error.error}`);
    }
    return throwError(() => new Error('Something bad happened; please try again later.'));
  }

deleteNote(id: number): Observable<any> {
    return this.http.delete(`${this.api}/notes/${id}`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

getNoteTags(noteId: number): Observable<any> {
    return this.http.get(`${this.api}/notes/${noteId}/tags`);
  }

}
