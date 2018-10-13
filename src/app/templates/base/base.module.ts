/*
 * Page : Base Module
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : bsetec
 */
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminModule } from '../../admin/admin.module';
import { BaseRoutingModule } from './base-routing.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { declaration } from './../../../data/declaration';
import { entrycomponent } from './../../../data/entrycomponent';
import { bootstraps } from './../../../data/bootstraps';
import { constant } from '../../../data/constant';
import {
  MatIconModule,
  MatSidenavModule,
  MatDialogModule,
  MatFormFieldModule,
  MatMenuModule,
  MatInputModule,
  MatButtonModule,
  MatTabsModule,
  MatExpansionModule,
  MatCheckboxModule,
  MatPaginatorModule,
  MatSortModule,
  MatTableModule,
  MatListModule,
  MatRadioModule,
  MatProgressSpinnerModule,
  MatSnackBarModule,
  MatSelectModule,
  MatTooltipModule,
  MatAutocompleteModule} from '@angular/material';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FileUploadModule } from 'ng2-file-upload';
import 'hammerjs';
@NgModule({
  declarations: declaration.main,
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    BaseRoutingModule,
    MatIconModule,
    MatSidenavModule,
    MatDialogModule,
    MatFormFieldModule,
    MatMenuModule,
    MatInputModule,
    MatTabsModule,
    MatButtonModule,
    MatTableModule,
    MatPaginatorModule,
    MatSortModule,
    MatListModule,
    MatExpansionModule,
    MatCheckboxModule,
    MatProgressSpinnerModule,
    MatSnackBarModule,
    MatSelectModule,
    MatAutocompleteModule,
    MatRadioModule,
    MatTooltipModule, 
    AdminModule,    
    FileUploadModule,
    NgbModule.forRoot(),
  ],
  entryComponents: entrycomponent.main,
})
export class BaseModule { }
