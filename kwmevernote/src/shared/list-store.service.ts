import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { retry, catchError, map } from 'rxjs/operators';
import { List } from './list';
import { User } from './user';

@Injectable({
providedIn: 'root'
})
export class ListStoreService {
private api= "http://kwm-evernote.s2110456019.student.kwmhgb.at/api";

constructor(private http: HttpClient) {}

getOneList(id: number): Observable<List> {
    return this.http.get<List>(`${this.api}/lists/${id}`);
}

getAllLists(): Observable<any> {
    return this.http.get(`${this.api}/lists`);
  }

createList(list: Partial<List>): Observable<any> {
    return this.http.post(`${this.api}/lists`, list)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

updateList(list: List): Observable<any> {
    return this.http.put(`${this.api}/lists/${list.id}`, list)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

private errorHandler(error: any): Observable<never> {
    console.error('Error occurred:', error);
    return throwError(error);
  }

deleteList(id: number): Observable<any> {
    return this.http.delete(`${this.api}/lists/${id}`)
      .pipe(retry(3))
      .pipe(catchError(this.errorHandler));
  }

}
