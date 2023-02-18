import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from '../models/usuario';
import { Observable, of, throwError } from 'rxjs';

import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { Mensaje } from '../models/mensaje';
import { Token } from '../models/token';

export const USUARIO_ACTUAL = 'usuario-actual';
export const AUTH_TOKEN = 'token';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  private readonly servidor = `${environment.urlServidor}/login`;

  // Inyección de la depenencia del Router
  constructor(private router:Router, private http:HttpClient) { }

  public login( usuario:Usuario ): Observable<Token|Mensaje> {
    return this.http.post<Token|Mensaje>(this.servidor, usuario);
  }

  public logout( ): void {
    localStorage.clear();
    this.router.navigateByUrl('/login');
  }

  public usuarioActual(): string|null {
    return localStorage.getItem(USUARIO_ACTUAL);
  }

  public loggedIn(): boolean {
    return !!this.usuarioActual();
  }

}
