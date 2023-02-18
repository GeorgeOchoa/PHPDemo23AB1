import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { Mascota } from '../models/mascota';

import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MascotaService {

  private readonly servidor = `${environment.urlServidor}/mascota`;

  constructor(private http:HttpClient) { }

  public obtener( id:number ): Observable<Mascota> {
    return this.http.get<Mascota>(`${this.servidor}/${id}`);
  }

  public lista( propietario:string ): Observable<Mascota[]> {
    return this.http.get<Mascota[]>(`${this.servidor}/catalogo/${propietario}`);
  }

  public insertar( m:Mascota ): Observable<Mascota> {
    console.log(`Insertando registro de: ${m.nombre}`);
    return this.http.post<Mascota>(this.servidor, m);
  }

  public actualizar( m:Mascota ): Observable<Mascota> {
    console.log(`Acualizando registro de: ${m.nombre}`);
    return this.http.put<Mascota>(`${this.servidor}/${m.id}`, m);
  }

  public eliminar( m:Mascota ): Observable<Mascota> {
    console.log(`Eliminando registro de: ${m.nombre}`);
    return this.http.delete<Mascota>(`${this.servidor}/${m.id}`);
  }

}
