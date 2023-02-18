import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-agregar',
  templateUrl: './agregar.component.html',
  styleUrls: ['./agregar.component.css']
})
export class AgregarComponent implements OnInit {

  public formulario:FormGroup;

  constructor( private builder:FormBuilder, private loginSvc:LoginService ) {
    this.formulario = this.builder.group({
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
  }

  public enviarDatos():void {
    console.log( this.formulario.getError );
    if( this.formulario.valid ) {
      console.log(this.formulario.value);
    }
  }

}
