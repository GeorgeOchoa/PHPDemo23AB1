import { formatDate } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Mascota } from 'src/app/models/mascota';
import { Observable } from 'rxjs';
import { ActivatedRoute } from '@angular/router';
import { MascotaService } from '../../services/mascota.service';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-editar',
  templateUrl: './editar.component.html',
  styleUrls: ['./editar.component.css']
})
export class EditarComponent implements OnInit {

  public formulario:FormGroup;
  public mascota!:Mascota;

  constructor( private builder:FormBuilder, private loginSvc:LoginService, private rutaActual:ActivatedRoute, private mascotaSvc:MascotaService ) {
    this.formulario = this.builder.group({
      id:['', Validators.required],
      propietario:[loginSvc.usuarioActual(), Validators.required],
      nombre:['', Validators.required],
      raza:['', Validators.required],
      color:['', Validators.required],
      fechaNac:['', Validators.required],
      genero:['', Validators.required],
      tipo:['', Validators.required],
      fotoUrl:['']
    });
  }

  ngOnInit(): void {
    this.mascota = window.history.state.mascota;
    if( this.mascota ) {
      this.cargarDatos();
    } else {
      this.obtenerMascota().subscribe(
        resultado => {
          this.mascota = resultado;
          this.cargarDatos();
        }
      )
    }
  }

  private obtenerMascota():Observable<Mascota> {
    const mascotaId = this.rutaActual.snapshot.params['id'];
    return this.mascotaSvc.obtener( mascotaId );
  }

  private cargarDatos():void {
    this.formulario.setValue({
      id:this.mascota.id,
      propietario:this.mascota.propietario,
      nombre:this.mascota.nombre,
      raza:this.mascota.raza,
      color:this.mascota.color,
      fechaNac: formatDate( this.mascota.fechaNac, 'yyyy-MM-dd', 'en-US', '+0000' ) ,
      genero:this.mascota.genero,
      tipo:this.mascota.tipo,
      fotoUrl:this.mascota.fotoUrl
    });
  }

  public enviarDatos():void {
    console.log( this.formulario.getError );
    if( this.formulario.valid ) {
      console.log(this.formulario.value);
    }
  }

}
