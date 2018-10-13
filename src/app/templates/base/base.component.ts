/*
 * Page : Base Component
 * Created Date : 01/08/2018
 * Updated Date : 18/08/2018
 * Copyright : Bsetec
 */
import { Component, ChangeDetectorRef, Inject } from '@angular/core';
import { Router, ActivatedRoute, NavigationEnd, RoutesRecognized } from '@angular/router';
import { environment } from './../../../environments/environment';
import 'rxjs/add/operator/filter';
import { UserService } from './../../services/sync/user.service';
import { MatSnackBar } from '@angular/material';
import { ApiService } from '../../services/api/api.service';
import { constant } from '../../../data/constant';
import { Observable } from 'rxjs/Observable';
import { Setting } from '../../../model/setting';
import { HostListener} from '@angular/core';

@Component({
  selector: 'app-base',
  templateUrl: './base.component.html',
  styleUrls: ['./base.component.css']
})
export class BaseComponent {
    public page_app_name;
    public site_logo;
   constructor(
    private router: Router,
    private route: ActivatedRoute,
    private usersService: UserService,
    public snackBar: MatSnackBar,
    private apiService: ApiService,
    private cdr: ChangeDetectorRef,
    public apiservice: ApiService
  ) {
  }

  ngOnInit() {
    // get and update favi icon & appliaction name
    const getSiteDetailsUrl = constant.apiurl + constant.getgeneraldata;
    this.apiservice.init(getSiteDetailsUrl).subscribe(row => {
      this.page_app_name = row.app_name;
      this.site_logo = constant.apiurl + 'uploads/images/logo/' + row.logo_url;
    });
  }

  ngAfterViewChecked() {
    this.cdr.detectChanges();
  }
}
