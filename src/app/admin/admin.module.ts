/*
 * Page : Admin Module
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { BrowserModule} from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ColorPickerModule } from 'ngx-color-picker';
import { AdminRoutingModule } from './admin-routing.module';
import { AdminComponent } from './admin.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import {
  MatTableModule,
  MatPaginatorModule,
  MatSortModule,
  MatIconModule,
  MatSidenavModule,
  MatDialogModule,
  MatFormFieldModule,
  MatMenuModule,
  MatInputModule,
  MatButtonModule,
  MatCheckboxModule,
  MatRadioModule,
  MatProgressSpinnerModule, 
  MatSnackBarModule,
  MatSelectModule,
  MatGridListModule,
  MatBadgeModule,
  MatSlideToggleModule,
  MatTooltipModule,
  MatListModule} from '@angular/material';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ChartsModule } from 'ng2-charts';
import { UsersComponent } from './users/users.component';
import { PagesComponent } from './pages/pages.component';
import { AddPageComponent } from './pages/add-page/add-page.component';
import { EditPageComponent } from './pages/edit-page/edit-page.component';
import { DeletionComponent } from './dialogs/deletion/deletion.component';
import { PostsComponent } from './posts/posts.component';
import { DetailsComponent } from './posts/details/details.component';
import { SettingsComponent } from './users/settings/settings.component';
import { ChangepasswordComponent } from './users/changepassword/changepassword.component';
import { FileUploadModule } from 'ng2-file-upload';
import { Daterangepicker } from 'ng2-daterangepicker';
import { ProfileComponent } from './users/profile/profile.component';
import { ReportsComponent } from './posts/reports/reports.component';
import { SiteSettingComponent } from './site-setting/site-setting.component';
import { MailsettingComponent } from './site-setting/mailsetting/mailsetting.component';
import { MailtemplateComponent } from './site-setting/mailtemplate/mailtemplate.component';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { TruncatetextPipe } from './users/profile/truncatetext.pipe';
import { FooterComponent } from './footer/footer.component';
@NgModule({
  imports: [
  CommonModule,
  AdminRoutingModule,
  MatTableModule,
  MatPaginatorModule,
  MatSortModule,
  MatIconModule,
  MatSidenavModule,
  MatDialogModule,
  MatFormFieldModule,
  MatMenuModule,
  MatInputModule,
  MatButtonModule,
  MatCheckboxModule,
  MatRadioModule,
  MatProgressSpinnerModule, 
  MatSnackBarModule,
  MatSelectModule,
  MatGridListModule,
  MatBadgeModule,
  MatSlideToggleModule,
  MatTooltipModule,
  MatListModule,
  FormsModule,
  ReactiveFormsModule,
  ChartsModule,
  FileUploadModule,
  ColorPickerModule,
  Daterangepicker,
  InfiniteScrollModule
  ],
  entryComponents: [DeletionComponent],
  declarations: [
    AdminComponent,
    DashboardComponent,
    UsersComponent,
    PagesComponent,
    AddPageComponent,
    EditPageComponent,
    DeletionComponent,
    PostsComponent,
    DetailsComponent,
    SettingsComponent,
    ChangepasswordComponent,
    ProfileComponent,
    ReportsComponent,
    SiteSettingComponent,
    MailsettingComponent,
    MailtemplateComponent,
    TruncatetextPipe,
    FooterComponent
  ],
  bootstrap: [
    AdminComponent,
  ],
  exports: [
  ]
})
export class AdminModule { }
