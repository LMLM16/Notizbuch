import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { retry, catchError, map } from 'rxjs/operators';
import { List } from './list';
import { User } from './user';
import { Tag } from './tag';

@Injectable({
  providedIn: 'root'
})

export class TagStoreService {
private api= "http://kwm-evernote.s2110456019.student.kwmhgb.at/api";


constructor(private http: HttpClient) {}

getAllTags(): Observable<any> {
    return this.http.get(`${this.api}/tags`);
  }

getNoteTags(noteId: number): Observable<Tag[]> {
    return this.http.get<Tag[]>(`${this.api}/notes/${noteId}/tags`);
  }
}
