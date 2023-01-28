import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Mascota } from 'src/app/models/mascota';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { EliminarComponent } from '../eliminar/eliminar.component';

@Component({
  selector: 'app-mascota',
  templateUrl: './mascota.component.html',
  styleUrls: ['./mascota.component.css']
})
export class MascotaComponent {

  @Input()
  mascota!: Mascota;

  @Output()
  emisor = new EventEmitter<Mascota>();

  constructor( private router:Router, private modalSvc:NgbModal) { }

  public editar(): void {
    // TODO: Implementar lógica para editar una mascota
    console.log("Editar registro de mascota");
  }

  public confirmarEliminar( evt:Event ): void {
    const dialogo = this.modalSvc.open(EliminarComponent, { centered:true });
    dialogo.componentInstance.mensaje = `¿Estás seguro de eliminar el registro de ${this.mascota.nombre}?`;
    dialogo.result.then( opcion => {
      if( opcion ) this.emisor.emit(this.mascota);
    } );
    evt.stopPropagation();
  }

}
