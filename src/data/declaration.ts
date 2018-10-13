/*
 * File : declaration.ts
 * Use: Declare the components
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { BaseComponent } from './../app/templates/base/base.component';
import { LoginComponent } from './../app/templates/base/user/login/login.component';
import { NotfoundComponent } from './../app/templates/base/notfound/notfound.component';
import { ForgotpasswordComponent } from './../app/templates/base/user/forgotpassword/forgotpassword.component';

export const declaration = {
  main: [
    BaseComponent,
    LoginComponent,
    NotfoundComponent,
    ForgotpasswordComponent
  ]
};
