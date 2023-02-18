import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { LoginService, AUTH_TOKEN } from '../services/login.service';
import { environment } from '../../environments/environment';

@Injectable()
export class JwtInterceptor implements HttpInterceptor {

  constructor(private loginSvc:LoginService) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const isApiURL = request.url.startsWith( environment.urlServidor );
    const token = localStorage.getItem(AUTH_TOKEN);
    if( this.loginSvc.loggedIn() && isApiURL ) {
      request = request.clone( {
        setHeaders: { 'Authorization':`Bearer ${token}` }
      } );
    }
    return next.handle(request);
  }
}
