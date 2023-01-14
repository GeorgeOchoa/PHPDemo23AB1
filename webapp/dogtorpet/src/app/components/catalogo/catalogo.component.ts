import { Component } from '@angular/core';
import { Mascota } from 'src/app/models/mascota';
import { mascotas } from '../../services/datos-prueba';

@Component({
  selector: 'app-catalogo',
  templateUrl: './catalogo.component.html',
  styleUrls: ['./catalogo.component.css']
})
export class CatalogoComponent {

  mascotas!:Mascota[];

  constructor() {
    this.mascotas = mascotas;
  }

}
