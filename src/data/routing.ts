/*
 * File : routing.ts
 * Use: Url routings
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { BaseComponent } from './../app/templates/base/base.component';
import { LoginComponent } from './../app/templates/base/user/login/login.component';
import { NotfoundComponent } from './../app/templates/base/notfound/notfound.component';
import { ForgotpasswordComponent } from './../app/templates/base/user/forgotpassword/forgotpassword.component';
import { UserGuard } from './../app/auth/user.guard';
export const routing = {
frontend: [
  {
    path: '',
    component: BaseComponent,
    data: {
      title: 'Home',
      layout: 'layout1',
      meta: {
      description: 'Instasocial Base Component',
      'og:image': 'http://localhost:4200/assets/images/logo.png'
    }
   },
    children: [
      {
        component: LoginComponent,
        path: '',
        pathMatch: 'full',
        data: {
                title: 'Login',
                layout: 'layout1',
                meta: {
                description: 'Instasocial Login Page',
                'og:image': 'http://localhost:4200/assets/images/logo.png'
              }
          }
      },
      {
      component: NotfoundComponent,
      path: '404',
      data: {
              title: '404 Not Found',
              layout: 'layout1',
              meta: {
              description: 'Instasocial 404 Page',
              'og:image': 'http://localhost:4200/assets/images/logo.png'
        }
      }
    } ,
    {
      component: ForgotpasswordComponent,
      path: 'forgot',
      data: {
              title: 'Forgot Password',
              layout: 'layout1',
              meta: {
              description: 'Instasocial Forgot Password Page',
              'og:image': 'http://localhost:4200/assets/images/logo.png'
              }
            }
    }
    ]
  },
]};



