/*
 * Page : Admin Component
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, ChangeDetectorRef, OnInit, Inject, Input } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { Router } from '@angular/router';
import { UserService } from './../services/sync/user.service';
import { MatSnackBar } from '@angular/material';
import { ApiService } from '../services/api/api.service';
import { Title, Meta, DOCUMENT } from '@angular/platform-browser';
import { constant } from '../../data/constant';
import { trigger, state, style, transition, animate} from '@angular/animations';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css'],
  animations: [
    trigger('slideInOut', [
      state('in', style({
        transform: 'translate3d(0, 0, 0)'
      })),
      state('out', style({
        transform: 'translate3d(0, 0, 0)'
      })),
      transition('in => out', animate('400ms ease-in-out')),
      transition('out => in', animate('400ms ease-in-out'))
    ]),
  ]
})
export class AdminComponent implements OnInit {
  menuState:string = 'in';
  logged_admin_name: string;
  logged_image: string= '';
  initdata: any;
  postCls: string;
  userCls: string;
  pagesCls: string;
  DropdownVar = 0;
  tooltip_action:boolean = false;
  public page_app_name;
  constructor(
    private sanitizer:DomSanitizer, 
    private router:Router, 
    private usersService:UserService, 
    public snackBar: MatSnackBar,
    private cdr: ChangeDetectorRef,
    public apiservice: ApiService,
    @Inject(DOCUMENT) private document: HTMLDocument
  ) {
   }

 ngOnInit() {
   var splits  = this.router.url.split("/");
    if(splits['2']=='profile'){
      this.userCls = 'active';
    }else if(splits['2']=='post-details'){
      this.postCls = 'active';
    }else if(splits['2']=='add-page' || splits['2']=='edit-page'){
      this.pagesCls = 'active';
    }
    // Display the admin name, profile image & app-name in header layout
    this.logged_admin_name = localStorage.getItem('instasocial_admin_name');
    this.logged_image = localStorage.getItem('instasocial_admin_pic');
    this.usersService.headerinfoAlert.subscribe(headerinfo => {
      if (headerinfo) {
        this.logged_admin_name = localStorage.getItem('instasocial_admin_name');
        this.logged_image = localStorage.getItem('instasocial_admin_pic');
      }
    });
    // get and update favi icon & appliaction name
    const getSiteDetailsUrl = constant.apiurl + constant.getgeneraldata;
    this.apiservice.init(getSiteDetailsUrl).subscribe(row => {
      this.page_app_name = row.app_name;
      this.document.getElementById('app_name').innerHTML = row.app_name;
      this.document.getElementById('app_footer').innerHTML = row.app_name;
      this.document.getElementById('appFavicon').setAttribute('href', constant.apiurl + 'uploads/images/logo/' + row.favi_url);
    });
  }

  ngAfterViewChecked(){
    this.cdr.detectChanges();
  }

   /** This function used for side nav menu hide & show option */
  toggleMenu() {
    if(window.screen.width < 768){
      if(this.menuState==='in'){
        document.body.className += ' ' + 'show-sidebar';  
      }else{
        document.body.classList.remove('show-sidebar');  
      }
    }else{
      if(this.menuState==='in'){
        this.tooltip_action = true;
        document.body.className += ' ' + 'hide-sidebar';
      }else{
        this.tooltip_action = false;
        document.body.classList.remove('hide-sidebar');  
      }
    }
    this.menuState = this.menuState === 'out' ? 'in' : 'out';
  }

  /** This function is used for clear the localstorage and user logout functionality */
  logout() {
    localStorage.removeItem('instasocial_admin_name');
    localStorage.removeItem('instasocial_admin_pic');
    localStorage.removeItem('instasocial_token');
    this.router.navigate(['/']);
   }

}
