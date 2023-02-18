import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { LoginService, USUARIO_ACTUAL, AUTH_TOKEN } from '../../services/login.service';
import { Router } from '@angular/router';
import { Usuario } from '../../models/usuario';
import { Token } from 'src/app/models/token';
import { Mensaje } from 'src/app/models/mensaje';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  formulario:FormGroup;
  mensajeError:string = '';

  // builder es injectado como depencia por Angular
  constructor(private builder:FormBuilder, private loginSvc:LoginService, private router:Router) {
    this.formulario = builder.group( {
      username:[''], password:['']
    } );
  }

  public enviarDatos():void {
    const credenciales = this.formulario.value;
    this.loginSvc.login( credenciales ).subscribe({
      next: datos => this.procesarLogin(datos, credenciales),
      error: datos => this.mensajeError = datos
    });
  }

  private procesarLogin( datos:Token|Mensaje, usuario:Usuario ): void {
    if( 'token' in datos ) {
      localStorage.setItem( USUARIO_ACTUAL, usuario.username );
      localStorage.setItem( AUTH_TOKEN, datos.token );
      this.router.navigateByUrl('/catalogo');
    } else {
      localStorage.removeItem( USUARIO_ACTUAL );
      localStorage.removeItem( AUTH_TOKEN );
      this.mensajeError = `${datos.codigo}: ${datos.mensaje}`;
    }
  }


}
