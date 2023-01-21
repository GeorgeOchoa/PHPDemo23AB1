import { Component, OnInit } from '@angular/core';
import { Mascota } from 'src/app/models/mascota';
import { mascotas } from '../../services/datos-prueba';
import { MascotaService } from '../../services/mascota.service';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-catalogo',
  templateUrl: './catalogo.component.html',
  styleUrls: ['./catalogo.component.css']
})
export class CatalogoComponent implements OnInit {

  mascotas!:Mascota[];

  // mascotaSvc y loginSvc son injectadas como dependencias por Angular
  constructor( private mascotaSvc:MascotaService, private loginSvc:LoginService ) {  }

  ngOnInit(): void {
      const propietario = String( this.loginSvc.usuarioActual() );
      this.mascotaSvc.lista( propietario ).subscribe(
        resultado => this.mascotas = resultado
      );
  }

}
