/*
 * File : app-routing.module.ts
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
  
const routes: Routes = [
  {
    path: '',
    loadChildren: 'app/templates/base/base.module#BaseModule',
    data: {
        title: "Home",
        layout:"layout1",
        meta: {
        description: "Instasocial software",
        "og:image": "http://localhost:4200/assets/images/logo.png"
      }
    } 
  },
  {
    path: 'admin',
    loadChildren: 'app/admin/admin.module#AdminModule',
    data: {
        title: "Dashboard",
        layout:"layout4",
        meta: {
        description: "Instasocial software",
        "og:image": "http://localhost:4200/assets/images/logo.png"
      }
    } 
  },
   {
    path: '**',
    redirectTo: '/404',
    data: {
        title: "Home",
        layout:"layout1",
        meta: {
        description: "Instasocial software",
        "og:image": "http://localhost:4200/assets/images/logo.png"
      }
    } 
  }
     
];

@NgModule({
  imports: [ RouterModule.forRoot(routes) ],
  exports: [ RouterModule ]
})


export class AppRoutingModule {

  titlePrefix:any;
  production:boolean;
}
