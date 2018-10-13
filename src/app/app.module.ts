import { BrowserModule, Title, Meta } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import { JwtModule } from '@auth0/angular-jwt';
import {HttpClientModule} from '@angular/common/http';
import { AppRoutingModule } from './route/app-routing.module';
import { AppComponent } from './app.component';
import { AdminGuard } from './auth/admin.guard';
import { ApiService } from './services/api/api.service';
import { UserService } from './services/sync/user.service';
import { AuthService } from './services/auth/auth.service';
import { UserGuard } from './auth/user.guard';
import { NgProgressModule } from '@ngx-progressbar/core';
import { NgProgressHttpClientModule } from '@ngx-progressbar/http-client';
import {
  MatIconModule,
  MatSidenavModule,
  MatDialogModule,
  MatFormFieldModule,
  MatMenuModule,
  MatInputModule,
  MatButtonModule,
  MatCheckboxModule,
  MatProgressSpinnerModule, 
  MatSnackBarModule,
  MatSelectModule,
  MatGridListModule,
  MatListModule} from '@angular/material';
import {RouterModule} from '@angular/router';
// fontawesome
import { AngularFontAwesomeModule } from 'angular-font-awesome';
import { FileUploadModule } from 'ng2-file-upload';
export function tokenGetter() {
  return localStorage.getItem('instasocial_token');
}

@NgModule({
  imports: [
    BrowserModule,
    RouterModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    HttpClientModule,
    MatIconModule,
    MatSidenavModule,
    MatDialogModule,
    MatFormFieldModule,
    MatInputModule,
    MatMenuModule,
    MatButtonModule,
    MatCheckboxModule,
    MatProgressSpinnerModule,
    MatSnackBarModule,
    MatSelectModule,
    MatGridListModule,
    MatListModule,
    NgProgressModule.forRoot(),
    NgProgressHttpClientModule,
    AngularFontAwesomeModule,
    FileUploadModule,
    JwtModule.forRoot({
      config: {
        tokenGetter: tokenGetter,
        whitelistedDomains: [''],
        headerName: 'instasocial',
        throwNoTokenError: false
      }
    })
  ],
  declarations: [AppComponent],
  bootstrap: [
    AppComponent,
  ],
  providers: [
    AdminGuard,
    Title,
    Meta,
    ApiService,
    UserService,
    AuthService,
    UserGuard
  ]
})
export class AppModule { }
