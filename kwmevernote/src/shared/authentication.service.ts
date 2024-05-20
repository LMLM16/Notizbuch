import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import jwtDecode from 'jwt-decode';

interface Token {
exp: number;
user: {
id: string;
};
}

@Injectable({
providedIn: 'root'
})
export class AuthenticationService {
private api = 'http://kwm-evernote.s2110456019.student.kwmhgb.at/api';

constructor(private http: HttpClient) {}

  login(email: string, password: string) {
    return this.http.post<any>(`${this.api}/auth/login`, { email, password })
      .subscribe({
        next: response => {
          if (response.access_token) {
            this.setSessionStorage('token', response.access_token);
            const decodedToken = jwtDecode<Token>(response.access_token);
            this.setSessionStorage('userId', decodedToken.user.id);
          } else {
            console.error('Invalid token format');
          }
        },
        error: error => {
          console.error('Login failed', error);
        }
      });
  }

  setSessionStorage(key: string, value: string) {
    sessionStorage.setItem(key, value);
  }

  public getCurrentUserId(): number {
    return Number.parseInt(<string>sessionStorage.getItem('userId'));
  }

  logout() {
    this.http.post(`${this.api}/logout`, {}).subscribe(() => {
      sessionStorage.removeItem('token');
      sessionStorage.removeItem('userId');
      console.log('logged out');
    });
  }

  public isLoggedIn(): boolean {
    const token = sessionStorage.getItem('token');
    if (token) {
      const decodedToken = jwtDecode<Token>(token);
      let expirationDate: Date = new Date(0);
      expirationDate.setUTCSeconds(decodedToken.exp);
      if (expirationDate < new Date()) {
        console.log('token expired');
        sessionStorage.removeItem('token');
        return false;
      }
      return true;
    } else {
      return false;
    }
  }

  isLoggedOut(): boolean {
    return !this.isLoggedIn();
  }
}

