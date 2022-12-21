# Creación de un proyecto en Angular

1. Instalar Node [https://nodejs.org/es/](https://nodejs.org/es/)

2. Verificar la instalación con los siguientes comandos

    ```bash
    $ node -v
    $ npm -v
    ```

3. Instalar Angular globalmente, con el siguiente comando

    ```bash
    $ npm install -g @angular/cli@v13-lts
    ```

4. Creación del proyecto, con el siguiente comando

    ```bash
    $ ng new dogtorvet
    ```

    Seleccionando las siguientes opciones:
    ```
    - Would you like to add Angular routing? Yes
    - Which stylesheet format would you like to use? SCSS
    ```

5. Acceder a la carpeta nueva llamada dogtorvet

    ```bash
    $ cd dogtorvet
    ```

6. Instalar dependencias del proyecto

    ```bash
    $ ng add mdb-angular-ui-kit
    ```
    Seleccionando las siguientes opciones:
    ```
    - Would you like to proceed? Yes
    - Import all MDB modules? Yes
    - Set up Roboto Font? No
    - Set up Angular browser animations? Yes
    - Set up Font Awesome? Yes
    - Set up Charts? No

7. Para levantar el seridor de Angular para desarrollo, ejecutar el siguiente comando desde la carpeta `empleados` del proyecto

    ```bash
    $ ng serve
    ```

8. Abrir la siguiente url en el browser
    [http://localhost:4200/](http://localhost:4200/)

# Crear componentes en el proyecto

> **Nota:** Si se encuentra ejecutando el servidor de angular terminar el proceso con `CTRL-C`, después de ejecutar los siguientes comandos podrás volver a levantar el servidor ejecutando el comando `ng serve`.

1. Ejecutar el siguiente comando para crear el componente del login,

    ```bash
    $ ng generate component components/login --skip-tests
    ```

2. Ejecutar el siguiente comando para crear el componente de catalogo

   ```bash
   $ ng generate component components/catalogo --skip-tests
   ```

3. Ejecutar el siguiente comando para crear el componente de agregar registrto

   ```bash
   $ ng generate component components/agregar --skip-tests
   ```

4. Ejecutar el siguiente comando para crear el componente de editar registro (como ves en algunos casos es solo necesario poner la inicial del subcomando)

   ```bash
   $ ng g c components/editar --skip-tests
   ```

5. Ejecutar el siguiente comando para crear el componente de eliminar registro

    ```bash
    $ ng g c components/eliminar --skip-tests
    ```

6. Ejecutar el siguiente comando para crear el modelo de Usuario

    ```bash
    $ ng g interface models/usuario
    ```

7. Ejecutar el siguiente comando para crear el modelo de Mascota

    ```bash
    $ ng g interface models/mascota
    ```

8. Ejecutar el siguiente comando para crear el modelo de Tipo

    ```bash
    $ ng g interface models/tipo
    ```

9. Ejecutar el siguiente comando para crear el modelo de Revision

    ```bash
    $ ng g interface models/revision
     ```

10. Ejecutar el siguiente comando para crear el modelo de Vacuna

    ```bash
    $ ng g interface models/vacuna
    ```

11. Ejecutar el siguiente comando para crear el servicio de Mascota

    ```bash
    $ ng g service services/mascota --skip-tests
    ```

12. Ejecutar el siguiente comando para crear el servicio de Login

    ```bash
    $ ng g service services/login --skip-tests
    ```

13. Ejecutar el siguiente comando para crear el servicio de Local

    ```bash
    $ ng g service services/local --skip-tests
    ```

14. Agregar las rutas de cada componente en el archivo `app-routing.module.ts`, el cual debe quedar similar a lo siguiente,

    ```typescript
    import { NgModule } from '@angular/core';
    import { RouterModule, Routes } from '@angular/router';
    import { LoginComponent } from './components/login/login.component';
    import { AgregarComponent } from './components/agregar/agregar.component';
    import { CatalogoComponent } from './components/catalogo/catalogo.component';
    import { EditarComponent } from './components/editar/editar.component';
    import { EliminarComponent } from './components/eliminar/eliminar.component';

    const routes: Routes = [
      { path: '', redirectTo: '/catalogo', pathMatch: 'full' },
      { path: 'login', component: LoginComponent },
      { path: 'catalogo', component: CatalogoComponent },
      { path: 'nuevo', component: AgregarComponent },
      { path: 'editar/:id', component: EditarComponent },
      { path: 'eliminar/:id', component: EliminarComponent }
    ];

    @NgModule({
      imports: [RouterModule.forRoot(routes)],
      exports: [RouterModule]
    })
    export class AppRoutingModule { }
    ```
15. Ejecutar el siguiente comando para crear el filtro de seguridad (guardas)

    ```bash
    $ ng g guard guards/login --skip-tests
    ```
    Seleccionando las siguientes opciones con la barra espaciadora y dar enter para finalizar
    >(*) CanActivate
     ( ) CanActivateChild
     ( ) CanDeactivate
     ( ) CanLoad

16. Modifica las rutas dentro el archivo `app-routing.module.ts`, el cual debe quedar similar a lo siguiente,

    ```typescript
    //...
    import { LoginGuard } from './guards/login.guard';

    const routes: Routes = [
      { path: '', redirectTo: '/catalogo', pathMatch: 'full' },
      { path: 'login', component: LoginComponent },
      { path: 'catalogo', component: CatalogoComponent, canActivate: [LoginGuard]  },
      { path: 'nuevo', component: AgregarComponent, canActivate: [LoginGuard]  },
      { path: 'editar/:id', component: EditarComponent, canActivate: [LoginGuard]  },
      { path: 'eliminar/:id', component: EliminarComponent, canActivate: [LoginGuard]  }
    ];

    //...
    ```