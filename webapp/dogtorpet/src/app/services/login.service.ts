import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from '../models/usuario';
import { Observable, of, throwError } from 'rxjs';
import { usuarios } from './datos-prueba';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  // Inyección de la depenencia del Router
  constructor(private router:Router) { }

  public login( usuario:Usuario ): Observable<Usuario> {
    // TODO: Implementar login a través del backend
    let usr = usuarios.filter( u => u.username == usuario.username )[0];
    if( usr && usr.password == usuario.password ) {
      localStorage.setItem('usuario-actual', usr.username);
      return of( usr );
    } else {
      return throwError( () => new Error('Credenciales incorrectas') );
    }
  }

  public logout( ): void {
    localStorage.clear();
    this.router.navigateByUrl('/login');
  }

  public usuarioActual(): string|null {
    return localStorage.getItem('usuario-actual');
  }

  public loggedIn(): boolean {
    return !!this.usuarioActual();
  }

}
