import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { Mascota } from '../models/mascota';
import { mascotas } from './datos-prueba';

@Injectable({
  providedIn: 'root'
})
export class MascotaService {

  // TODO: Implementar URL de conexión con el backend (servidor)

  constructor() { }

  public obtener( id:number ): Observable<Mascota> {
    const result  = mascotas.filter( m => m.id == id );
    return of( result[0] );
  }

  public lista( propietario:string ): Observable<Mascota[]> {
    const result  = mascotas.filter( m => m.propietario == propietario );
    return of( result );
  }

  public insertar( m:Mascota ): Observable<Mascota> {
    // TODO: Implementar insertar en el backend
    console.log(`Insertando registro de: ${m.nombre}`);
    return of( m );
  }

  public actualizar( m:Mascota ): Observable<Mascota> {
    // TODO: Implementar actualizar en el backend
    console.log(`Acualizando registro de: ${m.nombre}`);
    return of( m );
  }

  public eliminar( m:Mascota ): Observable<Mascota> {
    // TODO: Implementar eliminar en el backend
    console.log(`Eliminando registro de: ${m.nombre}`);
    return of( m );
  }


}
