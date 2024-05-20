import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { retry, catchError, map } from 'rxjs/operators';
import { List } from './list';
import { User } from './user';
import { Todo } from './todo';

@Injectable({
  providedIn: 'root'
})
export class TodoServiceService {
private api = "http://kwm-evernote.s2110456019.student.kwmhgb.at/api";

constructor(private http: HttpClient) {}

  getAllTodos(): Observable<Todo[]> {
    return this.http.get<Todo[]>(`${this.api}/todos`);
  }
}
