/*
 * File : admin-routing.module.ts
 * Use: Admin page url routings
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */

import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AdminComponent } from './admin.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UsersComponent } from './users/users.component';
import { PagesComponent } from './pages/pages.component';
import { AddPageComponent } from './pages/add-page/add-page.component';
import { EditPageComponent } from './pages/edit-page/edit-page.component';
import { PostsComponent } from './posts/posts.component';
import { DetailsComponent } from './posts/details/details.component';
import { SettingsComponent } from './users/settings/settings.component';
import { ProfileComponent } from './users/profile/profile.component';
import { ReportsComponent } from './posts/reports/reports.component';
import { SiteSettingComponent } from './site-setting/site-setting.component';
import { MailsettingComponent } from './site-setting/mailsetting/mailsetting.component';
import { MailtemplateComponent } from './site-setting/mailtemplate/mailtemplate.component';
import { AdminGuard } from './../auth/admin.guard';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'dashboard',
    pathMatch: 'full'
  },
  {
    path: 'dashboard',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: DashboardComponent }
    ],
    data: {
            title: "Dashboard"
    }
  },
  {
    path: 'users',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: UsersComponent }
    ],
    data: {
            title: "User Management"
    }
  },
  {
    path: 'pages',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: PagesComponent }
    ],
    data: {
            title: "Pages"
    }
  },{
    path: 'add-page',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: AddPageComponent }
    ],
    data: {
            title: "Add Page"
    }
  },{
    path: 'edit-page/:id',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: EditPageComponent }
    ],
    data: {
            title: "Edit Page"
    }
  },{
    path: 'posts',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: PostsComponent }
    ],
    data: {
            title: "Posts Listing"
    }
  },{
    path: 'post-details/:id',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: DetailsComponent }
    ],
    data: {
            title: "Post Details"
    }
  },{
    path: 'post-repots',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: ReportsComponent }
    ],
    data: {
            title: "Post Reports"
    }
  },{
    path: 'settings',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: SettingsComponent }
    ],
    data: {
            title: "Settings"
    }
  },{
    path: 'profile/:id',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: ProfileComponent }
    ],
    data: {
            title: "Profile"
    }
  }, {
    path: 'profile/:id',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: ProfileComponent }
    ],
    data: {
            title: 'Profile'
    }
  }, {
    path: 'site-setting',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: SiteSettingComponent }
    ],
    data: {
            title: 'setting'
    }
  }, {
    path: 'mail-setting',
    component: AdminComponent,
    canActivateChild: [AdminGuard],
    children: [
      { path: '', component: MailsettingComponent }
    ],
    data: {
            title: 'mail setting'
    }
  }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }
