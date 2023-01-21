import { Component, Input } from '@angular/core';
import { Mascota } from 'src/app/models/mascota';

@Component({
  selector: 'app-mascota',
  templateUrl: './mascota.component.html',
  styleUrls: ['./mascota.component.css']
})
export class MascotaComponent {

  @Input()
  mascota!: Mascota;

  public editar(): void {
    // TODO: Implementar lógica para editar una mascota
    console.log("Editar registro de mascota");
  }

  public confirmarEliminar( evt:Event ): void {
    // TODO: Implementar lógica para confirmación
    console.log("Confirmar eliminación de mascota");
    evt.stopPropagation();
  }

}
